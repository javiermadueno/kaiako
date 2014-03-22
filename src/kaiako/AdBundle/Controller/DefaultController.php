<?php

namespace kaiako\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use kaiako\AdBundle\Entity\Ad;
use kaiako\AdBundle\Form\AdType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AdBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function newAdAction(){
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $roles = array();
        // Si el usuario registrado es un profesor, mostramos el form para nuevo anuncio. Si es estudiante o no está registrado, 
        // mostramos mensaje de que no puede crearlo porque no es un profesor.
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $roles = $this->get('security.context')->getToken()->getUser()->getRoles();
        }
        if( in_array('ROLE_USER_TEACHER', array_change_key_case ($roles, CASE_UPPER)) )
        {            
            $ad = new Ad();

            // Buscamos el profesor registrado y lo asignamos al profesor del anuncio
            $registered_teacher = $this->get('security.context')->getToken()->getUser();       
            $ad->setTeacher($registered_teacher);
            
            $form = $this->createForm(new AdType(), $ad);

            if ($request->getMethod() == 'POST') {
                
                // Asigna los campos de $trOrder con la entidad
                $form->bind($request);
                
                // Comprueba que los datos son válidos, mirando los Assets especificados en la entidad
                if ($form->isValid()) {

                    // Guardar el nuevo encargo en la base de datos
                    $em->persist($ad);                     
                    $em->flush();
                    
                    //email 1.Documento Datos de transporte cumplimentados
//                    $message = \Swift_Message::newInstance()
//                                ->setSubject('Transporte #'.$trOrder->getId().' publicado.')
//                                ->setFrom('eurotransportcar@eurotransportcar.com')
//                                ->setTo($trOrder->getClientCreator()->getId())
//                                ->setBody($this->renderView('UserBundle:Emails:email1client.html.twig', array('trOrder' => $trOrder)), 'text/html');
//                    $this->get('mailer')->send($message);
                    
                    $date = new \DateTime();  
                    $this->get('session')->getFlashBag()->add('info', 'El anuncio #'.$ad->getId().' se ha creado correctamente (' . $date->format('H:i:s') . "). ¿Deseas añadirle adjuntos?");
                    
                    return $this->render('StaticBundle:Default:index.html.twig', array('id' => $ad->getId()));
                }
                
                if ($request->request->count() > 0){        // Se recarga el formulario porque no es válido y había datos
                    return $this->render('AdBundle:Default:new_ad.html.twig', array('form' => $form->createView()));
                }else   // Se recarga el formulario porque no es válido y NO había datos
                    return $this->render('AdBundle:Default:new_ad.html.twig', array('form' => $form->createView()));
            }
            else        // No es post
                return $this->render('AdBundle:Default:new_ad.html.twig', array('form' => $form->createView()));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('user_teacher_register', array('errorMsg' => 1)));
        }
    }


    public function filterAdsAction(){
        
        $session = $this->get("session");
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
//        $total = $em->createQuery('SELECT COUNT(t.id) FROM TrOrderBundle:TrOrder t WHERE t.trOrderStatus = 3')
//        ->getSingleScalarResult();
        
        $filters = array();
        
        //Si la petición viene del formulario de filtrar, se cogen los datos por POST y se almacenan en
        //variables de sesión
        if($request->request->count()>0){
            array_push($filters, $request->request->get('filter[category]', null, true));
            $session->set('category',$request->request->get('filter[category]', null, true));
            array_push($filters, $request->request->get('filter[province]', null, true));
            $session->set('province',$request->request->get('filter[province]', null, true));
            array_push($filters, $request->request->get('filter[datepicker_in]', null, true));
            $session->set('datepicker_in',$request->request->get('filter[datepicker_in]', null, true));
            array_push($filters, $request->request->get('filter[datepicker_out]', null, true));
            $session->set('datepicker_out',$request->request->get('filter[datepicker_out]', null, true));
            array_push($filters, $request->request->get('filter[hour_in]', null, true));
            $session->set('hour_in',$request->request->get('filter[hour_in]', null, true));
            array_push($filters, $request->request->get('filter[hour_out]', null, true));
            $session->set('hour_out',$request->request->get('filter[hour_out]', null, true));
            
        //Si la petición viene del paginador se cogen los datos de las variables de sesión
        }else{
            array_push($filters, $session->get('category'));
            array_push($filters, $session->get('province'));
            array_push($filters, $session->get('datepicker_in'));
            array_push($filters, $session->get('datepicker_out'));
            array_push($filters, $session->get('hour_in'));
            array_push($filters, $session->get('hour_out'));
            
        }
        
        $pager = $this->get('knp_paginator');
        $ads = $pager->paginate(
            $em->getRepository('AdBundle:Ad')->findBy(array('category' => $filters[0])),
            $this->get('request')->query->get('page', 1),
            10
        );
        return $this->render('AdBundle:Default:index.html.twig', array('ads' => $ads));
        //$trOrders = $em->getRepository('TrOrderBundle:TrOrder')->geographicFilterTrOrders($filters, 0, 1);
        
        //return $this->render('TrOrderBundle:Default:includes/auction_trOrder.html.twig', array('trOrders' => $trOrders));
        
    }

}
