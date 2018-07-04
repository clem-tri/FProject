<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 16/02/2017
 * Time: 15:33
 */

namespace FProjectBundle\Controller;


use FProjectBundle\Entity\Confrontation;
use FProjectBundle\Entity\Joueur;
use FProjectBundle\Service\ConfrontationGetterService;
use FProjectBundle\Service\LigueService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Class ConfrontationController
 * @package FProjectBundle\Controller
 * @Route("/matchs")
 */
class ConfrontationController extends Controller
{

    protected function getLigues(){
        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');
        $ligues = $service->get();

        return $ligues;
    }


    /**
     * @Route("/nextgames/")
     * @Template
     */
    public function nextGamesAction(){

        $distinctDate = []; // todo

        /** @var ConfrontationGetterService $service */
        $service = $this->get('fProjectBundle.confrontationgetter');
        $nextGames = $service->getNextGames();

        /** @var Confrontation $nextGame */
        foreach ($nextGames as $nextGame){
           $distinctDate[] = $nextGame->getDate();
        }


        return array(
            'title' => 'Prochains matchs',
            'games' => $nextGames,
            'ligues' => $this->getLigues()
        );
    }


    /**
     * @Route("/game/{id}/{date}/{idClubDom}-{idClubExt} ")
     * @Template("FProjectBundle:Confrontation:game.html.twig")
     */
    public function gameAction($id){

        /** @var ConfrontationGetterService $service */
        $service = $this->get('fProjectBundle.confrontationgetter');

        /** @var Confrontation $game */
        $game = $service->getGame($id);


        return array(
            'game' => $game,
            'ligues' => $this->getLigues()
        );


    }

    /**
     * @Route("/this-week")
     * @Template("FProjectBundle:Confrontation:nextgames.html.twig")
     */
    public function thisWeekGames(){
        /** @var ConfrontationGetterService $service */
        $service = $this->get('fProjectBundle.confrontationgetter');

        $thisWeekGames = $service->getThisWeekGames();

        return array(
            'title' => 'Matchs de la semaine',
            'games' => $thisWeekGames,
            'ligues' => $this->getLigues()
        );
    }


    /**
     * @Route("/this-month")
     * @Template("FProjectBundle:Confrontation:nextgames.html.twig")
     */
    public function thisMonthGames(){
        $service = $this->get('fProjectBundle.confrontationgetter');

        $thisMonthGames = $service->getThisMonthGames();

        return array(
            'title' => 'Matchs ce mois-ci',
            'games' => $thisMonthGames,
            'ligues' => $this->getLigues()
        );
    }

}