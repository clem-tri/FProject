<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 16/02/2017
 * Time: 15:07
 */

namespace FProjectBundle\Entity;


use Doctrine\ORM\EntityRepository;
use DateTime;

class ConfrontationRepository extends EntityRepository
{
    /**
     * @return Confrontation[]
     */
    public function getNextGames(){
        return $query = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.date >= :date')
            ->setParameter(':date',  new DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME)
            ->orderBy('c.date')
            ->setMaxResults("30")
            ->getQuery()
            ->getResult();

    }

    public function getThisWeekGames(){
        $dateDeb =  new DateTime("Monday this week");
        $dateFin = new DateTime("Sunday this week");
        $dateDeb->setTime(00,00,00);
        $dateFin->setTime(23,59,59);


        return $query = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.date BETWEEN :date1 AND :date2')
            ->setParameter(':date1',$dateDeb, \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter(':date2',$dateFin, \Doctrine\DBAL\Types\Type::DATETIME)
            ->orderBy('c.date')
            ->getQuery()
            ->getResult()
           ;
    }


    public function getThisMonthGames(){

        $dateDeb =  new DateTime("first day of this month");
        $dateFin = new DateTime("last day of this month");
        $dateDeb->setTime(00,00,00);
        $dateFin->setTime(23,59,59);


       return $query = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.date BETWEEN :date1 AND :date2')
            ->setParameter(':date1', $dateDeb, \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter(':date2', $dateFin, \Doctrine\DBAL\Types\Type::DATETIME)
            ->orderBy('c.date')
            ->getQuery()
           ->getResult();


    }

    public function getGamesByPlayer($idJoueur){
         $query = $this->createQueryBuilder('c')
            ->select('c')
            ->join('c.Compositions', 'compositions')
            ->where('compositions.idJoueur1 = :joueur')
            ->orderBy('c.date','DESC');

         for($i = 2; $i <= 11; $i++){
             $query->orWhere('compositions.idJoueur'.$i.' = :joueur');
         }

         $query->setParameter('joueur', $idJoueur)
         ->setMaxResults(10);


        return $query
            ->getQuery()
            ->getResult();

    }

}