<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 02/03/2017
 * Time: 12:26
 */

namespace FProjectBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ButRepository extends EntityRepository
{
    public function getButsAllLigues($saison){
        return $query = $this->createQueryBuilder('b')
            ->select($this->createQueryBuilder('b')->expr()->count('b').' AS nbButs')
            ->addSelect('b')
            ->leftJoin('b.idConfrontation', 'confrontation')
            ->leftJoin('confrontation.idSaison', 'saison')
            ->andWhere('saison.libelle = :saison')
            ->groupBy('b.idJoueur')
            ->orderBy('nbButs', 'DESC')
            ->setParameter('saison', $saison)

            ;
            //SELECT id_joueur ,COUNT(*) as NbButs FROM `but` GROUP BY id_joueur ORDER BY NbButs DESC
    }

    public function getButsByLigue($ligue,$saison){
        return $query = $this->getButsAllLigues($saison)
            ->leftJoin('b.idClub', 'club')
            ->leftJoin('confrontation.idLigue','ligue')
            ->where('ligue.nom = :ligue')
            ->andWhere('saison.libelle = :saison')
            ->setParameter('ligue', $ligue);
    }

}