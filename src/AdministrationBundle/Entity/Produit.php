<?php

namespace AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use AdministrationBundle\Entity\Famille;
use AdministrationBundle\Entity\cart;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AdministrationBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var Famille $famille
     *
     * @ORM\ManyToOne(targetEntity="Famille",inversedBy="produits",cascade={"persist","merge","remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="famille_id",referencedColumnName="id")
     *     })
     */
    private $famille;




    /** @var ArrayCollection $cartes
     *
     * @ORM\ManyToMany(targetEntity="cart" ,mappedBy="produits" , cascade={"merge","persist","remove"})
     *
     */


    private $cartes;







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
     * Set code
     *
     * @param string $code
     * @return Produit
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Produit
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set famille
     *
     * @param Famille $famille
     * @return Produit
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return Famille
     */
    public function getFamille()
    {
        return $this->famille;
    }
}
