<?php

namespace AdministrationBundle\Controller;

use AdministrationBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Produit controller.
 *
 * @Route("produit")
 */
class ProduitController extends Controller
{
    /**
     * @Route("/", name="produit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AdministrationBundle:Produit')->findAll();


        return $this->render('AdministrationBundle:Produit:list.html.twig', array(
            'produits' => $produits,
        ));
    }

    /**
     * @Route("/{id}", name="produit_show")
     * @Method("GET")
     */
    public function showAction(Produit $produit)
    {

        return $this->render('AdministrationBundle:Produit:add.html.twig', array(
            'produit' => $produit,
        ));
    }



    /**
     * @Route("/", name="produit_add")
     * @Method("GET")
     */
    public function AddAction()
    {
        return $this->render('AdministrationBundle:Produit:add.html.twig');
    }

    /**
     * @Route("/", name="produit_remove")
     * @Method("GET")
     */
    public function removeAction()
    {
        return $this->render('AdministrationBundle:Produit:list.html.twig');
    }


    /**
     * @Route("/{id}", name="produit_modifier")
     * @Method("GET")
     */
    public function ModifierAction(Produit $produit)
    {

        return $this->render('AdministrationBundle:Produit:add.html.twig', array(
            'produit' => $produit,
        ));
    }

}
