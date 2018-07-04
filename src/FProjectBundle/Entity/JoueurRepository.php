<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 01/06/2017
 * Time: 10:27
 */

namespace FProjectBundle\Entity;


use Doctrine\ORM\EntityRepository;

class JoueurRepository extends EntityRepository
{
    public function getJoueurAgeFromBirthDate($idJoueur){

        return $this->createQueryBuilder('j')
            ->select('DATE_DIFF(CURRENT_DATE(), j.dateNaissance)')
            ->where('j.id = :joueur')
            ->setParameter('joueur', $idJoueur)
            ->getQuery()->getResult();



    }

}