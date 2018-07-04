<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 02/03/2017
 * Time: 12:40
 */

namespace FProjectBundle\Service;


use Doctrine\ORM\EntityManager;

class ButService
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

    public function getAllButs($saison){
        $repo = $this->em->getRepository('FProjectBundle:But');
      return $repo
          ->getButsAllLigues($saison)
          ->getQuery()
          ->getResult();
    }

    public function getButsLigue($ligue,$saison){
        $repo = $this->em->getRepository('FProjectBundle:But');
        return $repo
            ->getButsByLigue($ligue, $saison)
            ->getQuery()
            ->getResult();
    }

}