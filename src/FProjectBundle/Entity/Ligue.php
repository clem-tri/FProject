<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Ligue
 *
 * @ORM\Table(name="ligue")
 * @ORM\Entity
 */
class Ligue
{
    const SERVER_PATH_TO_LEAGUE_PICTURES_FOLDER =  'media/images/ligues/';

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
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;


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
            Ligue::SERVER_PATH_TO_LEAGUE_PICTURES_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        $path =str_replace("media/", "", Ligue::SERVER_PATH_TO_LEAGUE_PICTURES_FOLDER);

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
     * @return Ligue
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
     * Set logo
     *
     * @return string
     */
    public function setLogo($logo){
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo(){
        return $this->logo;
    }

    public function __toString(){
        return $this->getNom();
    }
}
