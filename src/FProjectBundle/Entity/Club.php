<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Club
 *
 * @ORM\Table(name="club", indexes={@ORM\Index(name="idx_ligue", columns={"id_ligue"})})
 * @ORM\Entity
 */
class Club
{
    const SERVER_PATH_TO_CLUB_PICTURES_FOLDER = 'media/images/clubs/';

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

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
            Club::SERVER_PATH_TO_CLUB_PICTURES_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        $path =str_replace("media/", "", Club::SERVER_PATH_TO_CLUB_PICTURES_FOLDER);

        $fileNamePath = utf8_encode($path.$this->getFile()->getClientOriginalName());
        // set the path property to the filename where you've saved the file
        $this->setLogo($fileNamePath);




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
     * @return Club
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Club
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Club
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set idLigue
     *
     * @param \FProjectBundle\Entity\Ligue $idLigue
     * @return Club
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

    public function __toString(){
        return $this->getNom();
    }
}
