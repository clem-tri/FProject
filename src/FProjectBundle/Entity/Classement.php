<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classement
 *
 * @ORM\Table(name="classement", indexes={@ORM\Index(name="idx_club_classement", columns={"id_club"}), @ORM\Index(name="idx_saison_classement", columns={"id_saison"}), @ORM\Index(name="idx_ligue", columns={"id_ligue"})})
 * @ORM\Entity
 */
class Classement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_match_joue", type="integer", nullable=true)
     */
    private $nbMatchJoue;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_victoire", type="integer", nullable=true)
     */
    private $nbVictoire;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_nul", type="integer", nullable=true)
     */
    private $nbNul;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_defaite", type="integer", nullable=true)
     */
    private $nbDefaite;

    /**
     * @var integer
     *
     * @ORM\Column(name="but_pour", type="integer", nullable=true)
     */
    private $butPour;

    /**
     * @var integer
     *
     * @ORM\Column(name="but_contre", type="integer", nullable=true)
     */
    private $butContre;

    /**
     * @var integer
     *
     * @ORM\Column(name="difference_but", type="integer", nullable=true)
     */
    private $differenceBut;

    /**
     * @var \FProjectBundle\Entity\Club
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club", referencedColumnName="id")
     * })
     */
    private $idClub;

    /**
     * @var \FProjectBundle\Entity\Saison
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Saison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_saison", referencedColumnName="id")
     * })
     */
    private $idSaison;

    /**
     * @var \FProjectBundle\Entity\Ligue
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Ligue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ligue", referencedColumnName="id")
     * })
     */
    private $idLigue;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Classement
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set nbMatchJoue
     *
     * @param integer $nbMatchJoue
     * @return Classement
     */
    public function setNbMatchJoue($nbMatchJoue)
    {
        $this->nbMatchJoue = $nbMatchJoue;

        return $this;
    }

    /**
     * Get nbMatchJoue
     *
     * @return integer 
     */
    public function getNbMatchJoue()
    {
        return $this->nbMatchJoue;
    }

    /**
     * Set nbVictoire
     *
     * @param integer $nbVictoire
     * @return Classement
     */
    public function setNbVictoire($nbVictoire)
    {
        $this->nbVictoire = $nbVictoire;

        return $this;
    }

    /**
     * Get nbVictoire
     *
     * @return integer 
     */
    public function getNbVictoire()
    {
        return $this->nbVictoire;
    }

    /**
     * Set nbNul
     *
     * @param integer $nbNul
     * @return Classement
     */
    public function setNbNul($nbNul)
    {
        $this->nbNul = $nbNul;

        return $this;
    }

    /**
     * Get nbNul
     *
     * @return integer 
     */
    public function getNbNul()
    {
        return $this->nbNul;
    }

    /**
     * Set nbDefaite
     *
     * @param integer $nbDefaite
     * @return Classement
     */
    public function setNbDefaite($nbDefaite)
    {
        $this->nbDefaite = $nbDefaite;

        return $this;
    }

    /**
     * Get nbDefaite
     *
     * @return integer 
     */
    public function getNbDefaite()
    {
        return $this->nbDefaite;
    }

    /**
     * Set butPour
     *
     * @param integer $butPour
     * @return Classement
     */
    public function setButPour($butPour)
    {
        $this->butPour = $butPour;

        return $this;
    }

    /**
     * Get butPour
     *
     * @return integer 
     */
    public function getButPour()
    {
        return $this->butPour;
    }

    /**
     * Set butContre
     *
     * @param integer $butContre
     * @return Classement
     */
    public function setButContre($butContre)
    {
        $this->butContre = $butContre;

        return $this;
    }

    /**
     * Get butContre
     *
     * @return integer 
     */
    public function getButContre()
    {
        return $this->butContre;
    }

    /**
     * Set differenceBut
     *
     * @param integer $differenceBut
     * @return Classement
     */
    public function setDifferenceBut($differenceBut)
    {
        $this->differenceBut = $differenceBut;

        return $this;
    }

    /**
     * Get differenceBut
     *
     * @return integer 
     */
    public function getDifferenceBut()
    {
        return $this->differenceBut;
    }

    /**
     * Set idClub
     *
     * @param \FProjectBundle\Entity\Club $idClub
     * @return Classement
     */
    public function setIdClub(\FProjectBundle\Entity\Club $idClub = null)
    {
        $this->idClub = $idClub;

        return $this;
    }

    /**
     * Get idClub
     *
     * @return \FProjectBundle\Entity\Club 
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * Set idSaison
     *
     * @param \FProjectBundle\Entity\Saison $idSaison
     * @return Classement
     */
    public function setIdSaison(\FProjectBundle\Entity\Saison $idSaison = null)
    {
        $this->idSaison = $idSaison;

        return $this;
    }

    /**
     * Get idSaison
     *
     * @return \FProjectBundle\Entity\Saison 
     */
    public function getIdSaison()
    {
        return $this->idSaison;
    }

    /**
     * Set idLigue
     *
     * @param \FProjectBundle\Entity\Ligue $idLigue
     * @return Classement
     */
    public function setIdLigue(\FProjectBundle\Entity\Ligue $idLigue = null)
    {
        $this->idLigue = $idLigue;

        return $this;
    }

    /**
     * Get idLigue
     *
     * @return \FProjectBundle\Entity\Ligue 
     */
    public function getIdLigue()
    {
        return $this->idLigue;
    }
}
