<?php

namespace AdministrationBundle\Controller;

use AdministrationBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Category controller.
 *
 * @Route("category")
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AdministrationBundle:Category')->findAll();

        return $this->render('AdministrationBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction(Category $category)
    {

        return $this->render('AdministrationBundle:Category:modifier.html.twig', array(
            'category' => $category,
        ));
    }


    /**
     * @Route("/", name="category_add")
     * @Method("GET")
     */
    public function AddAction()
    {
        return $this->render('AdministrationBundle:Category:add.html.twig');
    }

    /**
     * @Route("/", name="category_remove")
     * @Method("GET")
     */
    public function removeAction()
    {
        return $this->render('AdministrationBundle:Category:list.html.twig');
    }


    /**
     * @Route("/{id}", name="category_modifier")
     * @Method("GET")
     */
    public function ModifierAction(Category $produit)
    {

        return $this->render('AdministrationBundle:Category:add.html.twig', array(
            'produit' => $produit,
        ));
    }


}
