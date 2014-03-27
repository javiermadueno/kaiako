<?php

namespace kaiako\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use kaiako\UserBundle\Entity\Teacher;
use kaiako\UserBundle\Form\Frontend\TeacherType;
use kaiako\UserBundle\Entity\Student;
use kaiako\UserBundle\Form\Frontend\StudentType;

use Symfony\Component\HttpFoundation\Response;
use eurotransportcar\StaticBundle\Util\Util;
use Ps\PdfBundle\Annotation\Pdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UserBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /* Registro de un usuario. Da a elegir entre profesor o estudiante */
    public function registerAction()
    {
        return $this->render('UserBundle:Default:register.html.twig');
    }
    
    /* Registro de un profesor */
    public function registerTeacherAction($errorMsg)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $user = new Teacher();
        
        $form = $this->createForm(new TeacherType(), $user);
        
        $errorPass = "";
        if($errorMsg == 1)
            $errorMsg = 'Para publicar un transporte debe estar registrado como cliente.';
        else
            $errorMsg = "";


        
        if ($request->getMethod() == 'POST') {

            $email=$request->get('teachertype[email]', null, true);
            $existUser = $em->getRepository('UserBundle:Teacher')->findBy(array('email' => $email));
            if (!$existUser) {
                
                // Validar los datos enviados y guardarlos en la base de datos
               // $form->bind($request);

                
                // Verifica que ha introducido la contraseña
                if (strcmp($form->get('password')->get('first')->getViewData(), "") == 0 && strcmp($form->get('password')->get('second')->getViewData(), "") == 0)
                    $errorPass = "Por favor, indica la contraseña";
                    $form->handleRequest($request);
                if ($form->isValid() && strcmp($errorPass,"")!=0) {
                    // Guardar la información en la base de datos
                    $encoder = $this->get('security.encoder_factory')
                    ->getEncoder($user);
                    $user->setSalt(md5(time()));
                    $encodedPassword = $encoder->encodePassword($user->getPassword(),
                                                                $user->getSalt()
                                                                );
                    $user->setPassword($encodedPassword);

                    $em->persist($user);
                    $em->flush();
                    
                    //mensaje de bienvenida
//                    $message = \Swift_Message::newInstance()
//                        ->setSubject('¡Bienvenid@ a euroTransportcar!‏')
//                        ->setFrom('eurotransportcar@eurotransportcar.com')
//                        ->setTo($user->getId())
//                        ->setBody($this->renderView('UserBundle:Emails:emailregisterclient.html.twig', array('client' => $user)), 'text/html');
//                    $this->get('mailer')->send($message);

                    $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Te has registrado correctamente en Kaiako. Introduce tus datos para acceder.');

                    return $this->render('UserBundle:Default:login.html.twig', array('last_username' => $user->getEmail(),
                                                                                     'error' => ""));
                }
            }else{  // El usuario ya existe
                $errorMsg = "El email ya está en uso en Kaiako";
            }
        }
        
        return $this->render('UserBundle:Default:register_teacher.html.twig',array('form' => $form->createView(), 
                                                                                  'errorMsg' => $errorMsg, 
                                                                                  'errorPass' => $errorPass));
    }
    
    /* Registro de un estudiante */
    public function registerStudentAction($errorMsg)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $user = new Student();
        
        $form = $this->createForm(new StudentType(), $user);
        
        $errorPass = "";
        if($errorMsg == 1)
            $errorMsg = 'Para publicar un transporte debe estar registrado como cliente.';
        else
            $errorMsg = "";
        
        if ($request->getMethod() == 'POST') {
            $email=$request->get('studenttype[email]', null, true);
            $existUser = $em->getRepository('UserBundle:Student')->findBy(array('email' => $email));
            if (!$existUser) {
                
                // Validar los datos enviados y guardarlos en la base de datos
                $form->bind($request);
                
                // Verifica que ha introducido la contraseña
                if (strcmp($form->get('password')->get('first')->getViewData(), "") == 0 && strcmp($form->get('password')->get('second')->getViewData(), "") == 0)
                    $errorPass = "Por favor, indica la contraseña";

                if ($form->isValid() && strcmp($user->getPassword(),"")!=0) {
                    // Guardar la información en la base de datos
                    $encoder = $this->get('security.encoder_factory')
                    ->getEncoder($user);
                    $user->setSalt(md5(time()));
                    $encodedPassword = $encoder->encodePassword($user->getPassword(),
                                                                $user->getSalt()
                                                                );
                    $user->setPassword($encodedPassword);
                    $em->persist($user);
                    $em->flush();
                    
                    //mensaje de bienvenida
//                    $message = \Swift_Message::newInstance()
//                        ->setSubject('¡Bienvenid@ a euroTransportcar!‏')
//                        ->setFrom('eurotransportcar@eurotransportcar.com')
//                        ->setTo($user->getId())
//                        ->setBody($this->renderView('UserBundle:Emails:emailregisterclient.html.twig', array('client' => $user)), 'text/html');
//                    $this->get('mailer')->send($message);

                    $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Te has registrado correctamente en Kaiako. Introduce tus datos para acceder.');

                    return $this->render('UserBundle:Default:login.html.twig', array('last_username' => $user->getEmail(),
                                                                                     'error' => ""));
                }
            }else{  // El usuario ya existe
                $errorMsg = "El email ya está en uso en Kaiako";
            }
        }
        
        return $this->render('UserBundle:Default:register_student.html.twig',array('form' => $form->createView(), 
                                                                                  'errorMsg' => $errorMsg, 
                                                                                  'errorPass' => $errorPass));
    }
    
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $error = $request->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $session->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        
        return $this->render('UserBundle:Default:login.html.twig', array('last_username' => $session->get(SecurityContext::LAST_USERNAME),
                                                                         'error' => $error
                                                                        ));
    }

    public function menuAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $session = $request->getSession();

        $error = $request->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $session->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return $this->render('UserBundle:Default:menu.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
            'usuario' => $usuario
        ));
    }
}
