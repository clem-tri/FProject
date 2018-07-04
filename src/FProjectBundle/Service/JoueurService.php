<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 01/06/2017
 * Time: 10:26
 */

namespace FProjectBundle\Service;


use Doctrine\ORM\EntityManager;

class JoueurService
{

    /**
     * @var EntityManager $em
     */
    protected $em;

    /**
     * Constructor
     * @param EntityManager $em
     */
    public function __construct($em){
        $this->em = $em;
    }

    public function getJoueur($id){
        $repo = $this->em->getRepository('FProjectBundle:Joueur');

        $age = $repo->getJoueurAgeFromBirthDate($id);
        return array(
            $repo->find($id),
            $age);
    }



}