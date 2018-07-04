<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 01/06/2017
 * Time: 10:16
 */

namespace FProjectBundle\Controller;


use FProjectBundle\Service\ConfrontationGetterService;
use FProjectBundle\Service\JoueurService;
use FProjectBundle\Service\LigueService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JoueurController extends Controller
{

    /**
     * @Template()
     * @Route("/joueur/{id}")
     * @param $id
     * @return array
     */
    public function joueurAction($id){

        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');
        $ligues = $service->get();

        /** @var JoueurService $service */
        $service = $this->get('fprojectbundle.joueur');

        $joueur = $service->getJoueur($id);

        /** @var ConfrontationGetterService $service */
         $service = $this->get('fprojectbundle.confrontationgetter');
        $confrontationsJoueur =  $service->getGamesByPlayer($id);


        return array(
            'joueur' => $joueur[0],
            'joueurAge' =>$joueur[1][0][1],
            'ligues' => $ligues,
            'confrontations' => $confrontationsJoueur
        );
    }

}