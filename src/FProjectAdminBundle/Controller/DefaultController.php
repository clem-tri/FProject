<?php

namespace FProjectAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FProjectAdminBundle:Default:index.html.twig');
    }
}
