<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 02/03/2017
 * Time: 12:45
 */

namespace FProjectBundle\Controller;


use FProjectBundle\Service\ButService;
use FProjectBundle\Service\LigueService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Class ButController
 * @package FProjectBundle\Controller
 * @Route("/buteurs")
 */
class ButController extends Controller
{
    /**
     * @Template
     * @Route("/TopEurope/{saison}")
     */
    public function allButeursAction($saison){

        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');
        $ligues = $service->get();

        /** @var ButService $service */
        $service = $this->get('fprojectbundle.but');
        $buts = $service->getAllButs($saison);


        return array(
            'buts' => $buts,
            'ligues' => $ligues
        );
    }

    /**
     * @Route("/TopEurope/{saison}/{ligue}")
     */
    public function buteursByLigueAction($ligue,$saison){

        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');
        $ligues = $service->get();

        /** @var ButService $service */
        $service = $this->get('fprojectbundle.but');
        $buts = $service->getButsLigue($ligue,$saison);


        return $this->render("@FProject/But/allButeurs.html.twig",
            array(
            'buts' => $buts,
            'ligues' => $ligues
            )
        );

    }

}