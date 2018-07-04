<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 20/02/2017
 * Time: 12:31
 */

namespace FProjectBundle\Service;
use Doctrine\ORM\EntityManager;

class ClassementService
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

    public function get($ligue,$saison){
        $repo = $this->em->getRepository('FProjectBundle:Classement');

      return  $repo->getClassement($ligue,$saison);
    }
}