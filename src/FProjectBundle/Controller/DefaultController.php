<?php

namespace FProjectBundle\Controller;


use FProjectBundle\Service\LigueService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');

        $ligues = $service->get();
        return $this->render('FProjectBundle:Default:index.html.twig',array(
            'ligues'  => $ligues
        ));

    }

    /**
     * @Template
     */
    public function navbarAction(){
        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');

        $ligues = $service->get();
        return array(
            'ligues'  => $ligues
        );
    }


}