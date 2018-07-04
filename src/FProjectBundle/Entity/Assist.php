<?php

namespace FProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Assist
 *
 * @ORM\Table(name="assist", indexes={@ORM\Index(name="idx_joueur_assist", columns={"id_joueur"})})
 * @ORM\Entity
 */
class Assist
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
     * @var \FProjectBundle\Entity\Joueur
     *
     * @ORM\ManyToOne(targetEntity="FProjectBundle\Entity\Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur", referencedColumnName="id")
     * })
     */
    private $idJoueur;



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
     * Set idJoueur
     *
     * @param \FProjectBundle\Entity\Joueur $idJoueur
     * @return Assist
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
}
