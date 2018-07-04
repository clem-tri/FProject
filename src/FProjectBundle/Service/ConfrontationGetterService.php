<?php
namespace FProjectBundle\Service;
use Doctrine\ORM\EntityManager;
use FProjectBundle\Entity\ConfrontationRepository;

/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 16/02/2017
 * Time: 17:04
 */
class ConfrontationGetterService
{
    /**
     * @var EntityManager $em
     */
    protected $em;


    /**
     * Constructor
     * @param EntityManager $em
     */
    public function __construct($em)
    {
        $this->em = $em;

    }

    public function getNextGames(){
        /** @var ConfrontationRepository $repo */
        $repo = $this->em->getRepository('FProjectBundle:Confrontation');

        return $repo->getNextGames();
    }

    public function getGame($id){
        /** @var ConfrontationRepository $repo */
        $repo = $this->em->getRepository('FProjectBundle:Confrontation');

        return $repo->find($id);
    }

    public function getThisWeekGames(){
        /** @var ConfrontationRepository $repo */
        $repo = $this->em->getRepository('FProjectBundle:Confrontation');

        return $repo->getThisWeekGames();
    }

    public function getThisMonthGames(){
        /** @var ConfrontationRepository $repo */
        $repo = $this->em->getRepository('FProjectBundle:Confrontation');

        return $repo->getThisMonthGames();
    }

    public function getGamesByPlayer($idJoueur){
        /** @var ConfrontationRepository $repo */
        $repo=  $this->em->getRepository('FProjectBundle:Confrontation');

        return $repo->getGamesByPlayer($idJoueur);
    }

}