<?php

namespace Kaiako\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("AdBundle:Category")->findBy(array(), array('name' => 'ASC'));
        $provinces = $em->getRepository("AdBundle:Province")->findBy(array(), array('name' => 'ASC'));

        return $this->render('StaticBundle:Default:index.html.twig',array('provinces' => $provinces,'categories'=>$categories));
        
    }
    
    public function staticPageAction($page)
    {
        return $this->render('StaticBundle:Default:'.$page.'.html.twig');
    }
    
    /**
     * Muestra el formulario de contacto y también procesa el envío de emails
     *
     */
    public function contactAction()
    {
        $request = $this->getRequest();

        // Se crea un formulario "in situ", sin clase asociada
        $form = $this->createFormBuilder()
            ->add('name', 'text', array('label'=> 'Nombre y Apellidos'))
            ->add('sender', 'email', array('label'=> 'Email'))
            ->add('message', 'textarea', array('label'=> 'Mensaje'))
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {
            $dataForm = $form->getData();

            $content = sprintf(" Remitente: %s \n\n Email: %s \n\n Mensaje: %s \n\n Navegador: %s \n Dirección IP: %s \n",
                $dataForm ['name'],
                $dataForm ['sender'],
                htmlspecialchars($dataForm ['message']),
                $request->server->get('HTTP_USER_AGENT'),
                $request->server->get('REMOTE_ADDR')
            );
            
            $message = \Swift_Message::newInstance()
                ->setSubject('Contacto')
                ->setFrom($dataForm ['sender'])
                ->setTo('jdexpositocanete@gmail.com')
                ->setBody($content)
            ;

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('info', 'Tu mensaje se ha enviado correctamente.');
            
            return $this->redirect($this->generateUrl('contact'));
        }

        return $this->render('StaticBundle:Default:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
