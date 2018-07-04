<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 28/02/2017
 * Time: 11:41
 */

namespace FProjectBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ClassementRepository extends EntityRepository
{

    public function getClassement($ligue, $saison){
        return $query = $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.idClub', 'club')
            ->leftJoin('club.idLigue',"ligue")
            ->leftJoin('c.idSaison', "saison")
            ->where('ligue.nom = :ligue')
            ->andWhere("saison.libelle = :saison")
            ->orderBy('c.points',"DESC")
            ->addOrderBy('c.differenceBut', 'DESC')
            ->addOrderBy('c.idSaison')
            ->setParameter('ligue', $ligue)
            ->setParameter('saison', $saison)
            ->getQuery()
            ->getResult()
            ;
    }
}