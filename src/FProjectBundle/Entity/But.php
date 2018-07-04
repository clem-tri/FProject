<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * But
 *
 * @ORM\Table(name="but", indexes={@ORM\Index(name="idx_joueur_buteur", columns={"id_joueur"}), @ORM\Index(name="idx_club_buteur", columns={"id_club"}), @ORM\Index(name="idx_conf_buteur", columns={"id_confrontation"}), @ORM\Index(name="idx_assist_but", columns={"id_assist"})})
 * @ORM\Entity
 */
class But
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
     * @ORM\Column(name="ordre", type="integer", nullable=false)
     */
    private $ordre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="penalty", type="boolean", nullable=false)
     */
    private $penalty;

    /**
     * @var boolean
     *
     * @ORM\Column(name="csc", type="boolean", nullable=false)
     */
    private $csc;

    /**
     * @var integer
     *
     * @ORM\Column(name="minute", type="integer", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 90,
     *      minMessage = "Le minimum est de : {{ limit }} minute",
     *      maxMessage = "Le maximum est de {{ limit }} minutes"
     * )
     */
    private $minute;

    /**
     * @var integer
     *
     * @ORM\Column(name="minute_additionnelle", type="integer", nullable=true)
     *  @Assert\Range(
     *      min = 1,
     *      max = 10,
     *      minMessage = "Le minimum est de : {{ limit }} minute",
     *      maxMessage = "Le maximum est de {{ limit }} minutes"
     * )
     */
    private $minuteAdditionnelle;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur", referencedColumnName="id")
     * })
     */
    private $idJoueur;

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
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Confrontation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_confrontation", referencedColumnName="id")
     * })
     */
    private $idConfrontation;

    /**
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_assist", referencedColumnName="id")
     * })
     */
    private $idAssist;



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
     * Set ordre
     *
     * @param integer $ordre
     * @return But
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set penalty
     *
     * @param boolean $penalty
     * @return But
     */
    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;

        return $this;
    }

    /**
     * Get penalty
     *
     * @return boolean 
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * Set csc
     *
     * @param boolean $csc
     * @return But
     */
    public function setCsc($csc)
    {
        $this->csc = $csc;

        return $this;
    }

    /**
     * Get csc
     *
     * @return boolean 
     */
    public function getCsc()
    {
        return $this->csc;
    }

    /**
     * Set minute
     *
     * @param integer $minute
     * @return But
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute
     *
     * @return integer 
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set minuteAdditionnelle
     *
     * @param integer $minuteAdditionnelle
     * @return But
     */
    public function setMinuteAdditionnelle($minuteAdditionnelle)
    {
        $this->minuteAdditionnelle = $minuteAdditionnelle;

        return $this;
    }

    /**
     * Get minuteAdditionnelle
     *
     * @return integer 
     */
    public function getMinuteAdditionnelle()
    {
        return $this->minuteAdditionnelle;
    }

    /**
     * Set idJoueur
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur
     * @return But
     */
    public function setIdJoueur(\FProjectBundle\Entity\Joueur $idJoueur = null)
    {
        $this->idJoueur = $idJoueur;

        return $this;
    }

    /**
     * Get idJoueur
     *
     * @return \FProjectBundle\Entity\Joueur 
     */
    public function getIdJoueur()
    {
        return $this->idJoueur;
    }

    /**
     * Set idClub
     *
     * @param \FProjectBundle\Entity\Club $idClub
     * @return But
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
     * @return But
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
     * Set idAssist
     *
     * @param \FProjectBundle\Entity\Assist $idAssist
     * @return But
     */
    public function setIdAssist(\FProjectBundle\Entity\Joueur $idAssist = null)
    {
        $this->idAssist = $idAssist;

        return $this;
    }

    /**
     * Get idAssist
     *
     * @return \FProjectBundle\Entity\Joueur
     */
    public function getIdAssist()
    {
        return $this->idAssist;
    }

    public function __toString()
    {
        return sprintf('But de %s (%s, %s)',
            $this->getIdJoueur(),
            $this->getIdConfrontation(),
            $this->getIdConfrontation()->getDate()->format('Y-m-d'));
    }
}
