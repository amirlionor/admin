<?php

namespace AdministrationBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AdministrationBundle\Entity\Produit;

/**
 * cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="AdministrationBundle\Repository\cartRepository")
 */
class cart
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /** @var User $customer
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User",inversedBy="carts")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="costumer_id",referencedColumnName="id")
     *})
     *
     */
    private $customer;



   /** @var ArrayCollection $produits
    *
    * @ORM\ManyToMany(targetEntity="Produit" ,inversedBy="carts" ,cascade={"persist", "merge","remove"})
    * @ORM\JoinTable(name="cart_produit",joinColumns={ @ORM\JoinColumn(name="carte_id",referencedColumnName="id")},inverseJoinColumns={ @ORM\JoinColumn(name="produit_id",referencedColumnName="id")}
    *
    *)
    *
    */


    private $produits;




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
     * Set date
     *
     * @param \DateTime $date
     * @return cart
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
     * Set customer
     *
     * @param User $customer
     * @return cart
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return integer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
