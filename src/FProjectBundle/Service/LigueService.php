<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 01/03/2017
 * Time: 09:44
 */

namespace FProjectBundle\Service;
use Doctrine\ORM\EntityManager;

class LigueService
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

    public function get(){
        $repo = $this->em->getRepository('FProjectBundle:Ligue');

        return $repo->getLigues();
    }
}