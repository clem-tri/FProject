<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 01/03/2017
 * Time: 09:41
 */

namespace FProjectBundle\Entity;


use Doctrine\ORM\EntityRepository;

class LigueRepository extends EntityRepository
{
    public function getLigues(){

        return $query =  $this
            ->createQueryBuilder('l')
            ->select('l')
            ->getQuery()
            ->getResult()
           ;
    }

}