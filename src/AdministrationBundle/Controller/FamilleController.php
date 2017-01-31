<?php

namespace AdministrationBundle\Controller;

use AdministrationBundle\Entity\Famille;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Famille controller.
 *
 * @Route("famille")
 */
class FamilleController extends Controller
{
    /**
     * Lists all famille entities.
     *
     * @Route("/", name="famille_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $familles = $em->getRepository('AdministrationBundle:Famille')->findAll();


        return $this->render('famille/index.html.twig', array(
            'familles' => $familles,
        ));
    }

    /**
     * Finds and displays a famille entity.
     *
     * @Route("/{id}", name="famille_show")
     * @Method("GET")
     */
    public function showAction(Famille $famille)
    {

        return $this->render('famille/show.html.twig', array(
            'famille' => $famille,
        ));
    }



    /**
     * @Route("/", name="famille_add")
     * @Method("GET")
     */
    public function AddAction()
    {
        return $this->render('AdministrationBundle:Famille:add.html.twig');
    }

    /**
     * @Route("/", name="famille_remove")
     * @Method("GET")
     */
    public function removeAction()
    {
        return $this->render('AdministrationBundle:Famille:list.html.twig');
    }


    /**
     * @Route("/{id}", name="famille_modifier")
     * @Method("GET")
     */
    public function ModifierAction(Famille $produit)
    {

        return $this->render('AdministrationBundle:Famille:add.html.twig', array(
            'produit' => $produit,
        ));
    }


}
