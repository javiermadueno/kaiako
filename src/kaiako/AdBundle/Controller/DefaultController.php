<?php

namespace kaiako\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use kaiako\AdBundle\Entity\Ad;

class DefaultController extends Controller
{
    public function indexAction($id)
    {   
        $em = $this->getDoctrine()->getManager();

        $ad = $em->getRepository('AdBundle:Ad')->findOneById($id);

        return $this->render('AdBundle:Default:index.html.twig', array('ad' => $ad));
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
        return $this->render('AdBundle:Default:index.html.twig', 
            array('ads' => $ads, 
                'session' => $filters)

        );
        //$trOrders = $em->getRepository('TrOrderBundle:TrOrder')->geographicFilterTrOrders($filters, 0, 1);
        
        //return $this->render('TrOrderBundle:Default:includes/auction_trOrder.html.twig', array('trOrders' => $trOrders));
        
    }

}
