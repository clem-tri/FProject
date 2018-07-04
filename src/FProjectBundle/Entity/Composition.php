<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composition
 *
 * @ORM\Table(name="composition", indexes={@ORM\Index(name="idx_id_conf", columns={"id_confrontation"}), @ORM\Index(name="idx_club", columns={"id_club"}), @ORM\Index(name="idx_gardien_joueur", columns={"id_joueur1"}), @ORM\Index(name="idx_formation", columns={"id_formation"}), @ORM\Index(name="idx_joueur2", columns={"id_joueur2"}), @ORM\Index(name="idx_joueur3", columns={"id_joueur3"}), @ORM\Index(name="idx_joueur4", columns={"id_joueur4"}), @ORM\Index(name="idx_joueur5", columns={"id_joueur5"}), @ORM\Index(name="idx_joueur6", columns={"id_joueur6"}), @ORM\Index(name="idx_joueur7", columns={"id_joueur7"}), @ORM\Index(name="idx_joueur8", columns={"id_joueur8"}), @ORM\Index(name="idx_joueur9", columns={"id_joueur9"}), @ORM\Index(name="idx_joueur10", columns={"id_joueur10"}), @ORM\Index(name="idx_joueur11", columns={"id_joueur11"})})
 * @ORM\Entity
 */
class Composition
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
     * @var \FProjectBundle\Entity\Club
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club", referencedColumnName="id")
     * })
     */
    private $idClub;

    /**
     * @var \FProjectBundle\Entity\Confrontation
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Confrontation", inversedBy="Compositions", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_confrontation", referencedColumnName="id")
     * })
     */
    private $idConfrontation;

    /**
     * @var \FProjectBundle\Entity\Formation
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Formation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formation", referencedColumnName="id")
     * })
     */
    private $idFormation;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur1", referencedColumnName="id")
     * })
     */
    private $idJoueur1;



    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur2", referencedColumnName="id")
     * })
     */
    private $idJoueur2;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur3", referencedColumnName="id")
     * })
     */
    private $idJoueur3;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur4", referencedColumnName="id")
     * })
     */
    private $idJoueur4;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur5", referencedColumnName="id")
     * })
     */
    private $idJoueur5;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur6", referencedColumnName="id")
     * })
     */
    private $idJoueur6;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur7", referencedColumnName="id")
     * })
     */
    private $idJoueur7;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur8", referencedColumnName="id")
     * })
     */
    private $idJoueur8;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur9", referencedColumnName="id")
     * })
     */
    private $idJoueur9;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur10", referencedColumnName="id")
     * })
     */
    private $idJoueur10;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur11", referencedColumnName="id")
     * })
     */
    private $idJoueur11;



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
     * Set idClub
     *
     * @param \FProjectBundle\Entity\Club $idClub
     * @return Composition
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
     * Set idConfrontation
     *
     * @param \FProjectBundle\Entity\Confrontation $idConfrontation
     * @return Composition
     */
    public function setIdConfrontation(\FProjectBundle\Entity\Confrontation $idConfrontation = null)
    {
        $this->idConfrontation = $idConfrontation;

        return $this;
    }

    /**
     * Get idConfrontation
     *
     * @return \FProjectBundle\Entity\Confrontation 
     */
    public function getIdConfrontation()
    {
        return $this->idConfrontation;
    }

    /**
     * Set idFormation
     *
     * @param \FProjectBundle\Entity\Formation $idFormation
     * @return Composition
     */
    public function setIdFormation(\FProjectBundle\Entity\Formation $idFormation = null)
    {
        $this->idFormation = $idFormation;

        return $this;
    }

    /**
     * Get idFormation
     *
     * @return \FProjectBundle\Entity\Formation 
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * Set idJoueur1
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur1
     * @return Composition
     */
    public function setIdJoueur1(\FProjectBundle\Entity\Joueur $idJoueur1 = null)
    {
        $this->idJoueur1 = $idJoueur1;

        return $this;
    }

    /**
     * Get idJoueur1
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur1()
    {
        return $this->idJoueur1;
    }

    /**
     * Set idJoueur10
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur10
     * @return Composition
     */
    public function setIdJoueur10(\FProjectBundle\Entity\Joueur $idJoueur10 = null)
    {
        $this->idJoueur10 = $idJoueur10;

        return $this;
    }

    /**
     * Get idJoueur10
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur10()
    {
        return $this->idJoueur10;
    }

    /**
     * Set idJoueur11
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur11
     * @return Composition
     */
    public function setIdJoueur11(\FProjectBundle\Entity\Joueur $idJoueur11 = null)
    {
        $this->idJoueur11 = $idJoueur11;

        return $this;
    }

    /**
     * Get idJoueur11
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur11()
    {
        return $this->idJoueur11;
    }

    /**
     * Set idJoueur2
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur2
     * @return Composition
     */
    public function setIdJoueur2(\FProjectBundle\Entity\Joueur $idJoueur2 = null)
    {
        $this->idJoueur2 = $idJoueur2;

        return $this;
    }

    /**
     * Get idJoueur2
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur2()
    {
        return $this->idJoueur2;
    }

    /**
     * Set idJoueur3
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur3
     * @return Composition
     */
    public function setIdJoueur3(\FProjectBundle\Entity\Joueur $idJoueur3 = null)
    {
        $this->idJoueur3 = $idJoueur3;

        return $this;
    }

    /**
     * Get idJoueur3
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur3()
    {
        return $this->idJoueur3;
    }

    /**
     * Set idJoueur4
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur4
     * @return Composition
     */
    public function setIdJoueur4(\FProjectBundle\Entity\Joueur $idJoueur4 = null)
    {
        $this->idJoueur4 = $idJoueur4;

        return $this;
    }

    /**
     * Get idJoueur4
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur4()
    {
        return $this->idJoueur4;
    }

    /**
     * Set idJoueur5
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur5
     * @return Composition
     */
    public function setIdJoueur5(\FProjectBundle\Entity\Joueur $idJoueur5 = null)
    {
        $this->idJoueur5 = $idJoueur5;

        return $this;
    }

    /**
     * Get idJoueur5
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur5()
    {
        return $this->idJoueur5;
    }

    /**
     * Set idJoueur6
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur6
     * @return Composition
     */
    public function setIdJoueur6(\FProjectBundle\Entity\Joueur $idJoueur6 = null)
    {
        $this->idJoueur6 = $idJoueur6;

        return $this;
    }

    /**
     * Get idJoueur6
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur6()
    {
        return $this->idJoueur6;
    }

    /**
     * Set idJoueur7
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur7
     * @return Composition
     */
    public function setIdJoueur7(\FProjectBundle\Entity\Joueur $idJoueur7 = null)
    {
        $this->idJoueur7 = $idJoueur7;

        return $this;
    }

    /**
     * Get idJoueur7
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur7()
    {
        return $this->idJoueur7;
    }

    /**
     * Set idJoueur8
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur8
     * @return Composition
     */
    public function setIdJoueur8(\FProjectBundle\Entity\Joueur $idJoueur8 = null)
    {
        $this->idJoueur8 = $idJoueur8;

        return $this;
    }

    /**
     * Get idJoueur8
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur8()
    {
        return $this->idJoueur8;
    }

    /**
     * Set idJoueur9
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur9
     * @return Composition
     */
    public function setIdJoueur9(\FProjectBundle\Entity\Joueur $idJoueur9 = null)
    {
        $this->idJoueur9 = $idJoueur9;

        return $this;
    }

    /**
     * Get idJoueur9
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur9()
    {
        return $this->idJoueur9;
    }
}
