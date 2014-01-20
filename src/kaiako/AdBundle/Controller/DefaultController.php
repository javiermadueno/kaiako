<?php

namespace kaiako\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AdBundle:Default:index.html.twig', array('name' => $name));
    }
}
