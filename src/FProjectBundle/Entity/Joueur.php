<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="fk_club", columns={"id_club"}), @ORM\Index(name="fk_poste", columns={"id_poste"})})
 * @ORM\Entity
 */
class Joueur
{
    const SERVER_PATH_TO_PLAYER_PICTURES_FOLDER = 'media/images/joueurs/';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date")
     */

    private $dateNaissance;



    /**
     * @var string
     * @ORM\Column(name="nationalite", type="string", nullable=true)
     */
    private $nationalite;



    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var integer
     *
     *  @ORM\Column(name="num_maillot", type="integer", length=3, nullable=true)
     */
    private $numMaillot;

    /**
     * @var integer
     *
     *  @ORM\Column(name="taille", type="integer", length=3, nullable=true)
     */

    private $taille;



    /**
     * @var \FProjectBundle\Entity\Club
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Club", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club", referencedColumnName="id")
     * })
     */
    private $idClub;

    /**
     * @var \FProjectBundle\Entity\Poste
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Poste", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_poste", referencedColumnName="id")
     * })
     */
    private $idPoste;


    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            Joueur::SERVER_PATH_TO_PLAYER_PICTURES_FOLDER,
            $this->getFile()->getClientOriginalName()
        );


        $path =str_replace("media/", "", Joueur::SERVER_PATH_TO_PLAYER_PICTURES_FOLDER);
        // set the path property to the filename where you've saved the file
        $fileNamePath = utf8_encode($path.$this->getFile()->getClientOriginalName());
        $this->setPhoto($fileNamePath);;

        // clean up the file property as you won't need it anymore

        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server
     */
    public function lifecycleFileUpload() {
        $this->upload();
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
     * Set nom
     *
     * @param string $nom
     * @return Joueur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Joueur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param \DateTime $dateNaissance
     * @return Joueur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get Nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * @param string $nationalite
     * @return Joueur
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Joueur
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set idClub
     *
     * @param \FProjectBundle\Entity\Club $idClub
     * @return Joueur
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
     * Set idPoste
     *
     * @param \FProjectBundle\Entity\Poste $idPoste
     * @return Joueur
     */
    public function setIdPoste(\FProjectBundle\Entity\Poste $idPoste = null)
    {
        $this->idPoste = $idPoste;

        return $this;
    }

    /**
     * Get idPoste
     *
     * @return \FProjectBundle\Entity\Poste 
     */
    public function getIdPoste()
    {
        return $this->idPoste;
    }

    public function __toString(){
        return sprintf("%s %s", $this->getPrenom(),$this->getNom());
    }



    /**
     * Set numMaillot
     *
     * @param integer $numMaillot
     * @return Joueur
     */
    public function setNumMaillot($numMaillot)
    {
        $this->numMaillot = $numMaillot;

        return $this;
    }

    /**
     * Get numMaillot
     *
     * @return integer 
     */
    public function getNumMaillot()
    {
        return $this->numMaillot;
    }


    /**
     * @return integer
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param integer $taille
     *
     * @return Joueur
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }
}
