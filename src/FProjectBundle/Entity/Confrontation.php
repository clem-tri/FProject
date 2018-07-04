<?php

namespace FProjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Confrontation
 *
 * @ORM\Table(name="confrontation", indexes={@ORM\Index(name="club_ext", columns={"id_club_ext"}), @ORM\Index(name="club_dom", columns={"id_club_dom"}), @ORM\Index(name="idx_ligue", columns={"id_ligue"}), @ORM\Index(name="idx_saison_confrontation", columns={"id_saison"}), @ORM\Index(name="idx_phasefinale", columns={"id_phase_finale"})})
 * @ORM\Entity
 */
class Confrontation
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
     * @ORM\Column(name="score_club_dom", type="integer", nullable=true)
     */
    private $scoreClubDom;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_club_ext",type="decimal", precision=2, scale=2, nullable=true)
     *
     */
    private $scoreClubExt;

    /**
     * @var integer
     *
     * @ORM\Column(name="possession_dom",type="decimal", precision=3, scale=1, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Min % is 0",
     *      maxMessage = "Max % is 100"
     * )
     */

    private $possessionDom;

    /**
     * @var integer
     *
     * @ORM\Column(name="possession_ext",type="decimal", precision=3, scale=1, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Min % is 0",
     *      maxMessage = "Max % is 100"
     * )
     */

    private $possessionExt;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \FProjectBundle\Entity\Club
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club_dom", referencedColumnName="id")
     * })
     */
    private $idClubDom;

    /**
     * @var \FProjectBundle\Entity\Club
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club_ext", referencedColumnName="id")
     * })
     */
    private $idClubExt;

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
     * @var \FProjectBundle\Entity\Saison
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Saison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_saison", referencedColumnName="id")
     * })
     */
    private $idSaison;

    /**
     * @var \FProjectBundle\Entity\PhaseFinale
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\PhaseFinale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_phase_finale", referencedColumnName="id")
     * })
     */
    private $idPhaseFinale;

    /**
     * @ORM\OneToMany(
     *     targetEntity="FProjectBundle\Entity\But",
     *     mappedBy="idConfrontation",
     *     orphanRemoval=true,
     *     cascade={"all"}
     * )
     * @ORM\OrderBy({"ordre"="ASC"})
     */
    private $Buts;

    /**
     * @ORM\OneToMany(
     *     targetEntity="FProjectBundle\Entity\Composition",
     *     mappedBy="idConfrontation",
     *     orphanRemoval=true,
     *     cascade={"all"}
     * )
     *
     */
    private $Compositions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Buts = new ArrayCollection();
        $this->Compositions = new ArrayCollection();
    }

    public function __toString(){
        return sprintf("%s vs %s",$this->getIdClubDom(), $this->getIdClubExt());
    }



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
     * Set scoreClubDom
     *
     * @param float $scoreClubDom
     * @return Confrontation
     */
    public function setScoreClubDom($scoreClubDom)
    {
        $this->scoreClubDom = $scoreClubDom;

        return $this;
    }

    /**
     * Get scoreClubDom
     *
     * @return integer 
     */
    public function getScoreClubDom()
    {
        return $this->scoreClubDom;
    }

    /**
     * Set scoreClubExt
     *
     * @param integer $scoreClubExt
     * @return Confrontation
     */
    public function setScoreClubExt($scoreClubExt)
    {
        $this->scoreClubExt = $scoreClubExt;

        return $this;
    }

    /**
     * Get scoreClubExt
     *
     * @return integer
     */
    public function getScoreClubExt()
    {
        return $this->scoreClubExt;
    }

    /**
     * Get possessionDom
     *
     *
     */
    public function getPossessionDom()
    {
        return $this->possessionDom;
    }

    /**
     * @param  $possessionDom
     *
     * @return Confrontation
     */
    public function setPossessionDom($possessionDom)
    {
        $this->possessionDom = $possessionDom;

        return $this;
    }

    /**
     * Get possessionExt
     *
     *
     */
    public function getPossessionExt()
    {
        return $this->possessionExt;
    }

    /**
     * @param $possessionExt
     * @return Confrontation
     */
    public function setPossessionExt($possessionExt)
    {
        $this->possessionExt = $possessionExt;

        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Confrontation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }



    /**
     * Set idClubDom
     *
     * @param \FProjectBundle\Entity\Club $idClubDom
     * @return Confrontation
     */
    public function setIdClubDom(\FProjectBundle\Entity\Club $idClubDom = null)
    {
        $this->idClubDom = $idClubDom;

        return $this;
    }

    /**
     * Get idClubDom
     *
     * @return \FProjectBundle\Entity\Club 
     */
    public function getIdClubDom()
    {
        return $this->idClubDom;
    }

    /**
     * Set idClubExt
     *
     * @param \FProjectBundle\Entity\Club $idClubExt
     * @return Confrontation
     */
    public function setIdClubExt(\FProjectBundle\Entity\Club $idClubExt = null)
    {
        $this->idClubExt = $idClubExt;

        return $this;
    }

    /**
     * Get idClubExt
     *
     * @return \FProjectBundle\Entity\Club 
     */
    public function getIdClubExt()
    {
        return $this->idClubExt;
    }

    /**
     * Set idLigue
     *
     * @param \FProjectBundle\Entity\Ligue $idLigue
     * @return Confrontation
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

    /**
     * Set idSaison
     *
     * @param \FProjectBundle\Entity\Saison $idSaison
     * @return Confrontation
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
     * Set idPhaseFinale
     *
     * @param \FProjectBundle\Entity\PhaseFinale $idPhaseFinale
     * @return Confrontation
     */
    public function setIdPhaseFinale(\FProjectBundle\Entity\PhaseFinale $idPhaseFinale = null)
    {
        $this->idPhaseFinale = $idPhaseFinale;

        return $this;
    }

    /**
     * Get idPhaseFinale
     *
     * @return \FProjectBundle\Entity\PhaseFinale 
     */
    public function getIdPhaseFinale()
    {
        return $this->idPhaseFinale;
    }

    /**
     * Get Buts
     *
     * @return \Doctrine\Common\Collections\Collection|But[]
     */
    public function getButs(){
        return $this->Buts?: new ArrayCollection();
    }

    /**
     * @param mixed $Buts
     * @return Confrontation
     */
    public function setButs($Buts){
        if(empty($Buts)){
            $Buts = new ArrayCollection();
        }

        $this->Buts = $Buts;

        return $this;
    }

    /**
     * Add Buts
     *
     * @param But $buts
     * @return Confrontation
     */
    public function addBut(But $buts){
        $buts->setIdConfrontation($this);
        $this->Buts[] = $buts;

        return $this;
    }

    /*
     * Remove Buts
     *
     * @param But $buts
     */
    public function removeBut(But $buts){
        $this->Buts->removeElement($buts);
    }

    /**
     * Get Compositions
     *
     * @return \Doctrine\Common\Collections\Collection|Composition[]
     */
    public function getCompositions(){
        return $this->Compositions?: new ArrayCollection();
    }

    /**
     * @param mixed $Compositions
     * @return Confrontation
     */
    public function setCompositions($Compositions){
        if(empty($Compositions)){
            $Compositions = new ArrayCollection();
        }

        $this->Compositions = $Compositions;

        return $this;
    }

    /**
     * Add Compositions
     *
     * @param Composition $compositions
     * @return Confrontation
     */
    public function addComposition(Composition $composition){
        $composition->setIdConfrontation($this);
        $this->Compositions[] = $composition;

        return $this;
    }

    /*
     * Remove Composition
     *
     * @param Composition $composition
     */
    public function removeComposition(Composition $composition){
        $this->Compositions->removeElement($composition);
    }
}
