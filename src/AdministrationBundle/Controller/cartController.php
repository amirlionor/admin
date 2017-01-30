<?php

namespace AdministrationBundle\Controller;

use AdministrationBundle\Entity\cart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Cart controller.
 *
 * @Route("cart")
 */
class cartController extends Controller
{
    /**
     * Lists all cart entities.
     *
     * @Route("/", name="cart_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carts = $em->getRepository('AdministrationBundle:cart')->findAll();

        dump($carts);
        die();


        return $this->render('cart/index.html.twig', array(
            'carts' => $carts,
        ));
    }

    /**
     * Finds and displays a cart entity.
     *
     * @Route("/{id}", name="cart_show")
     * @Method("GET")
     */
    public function showAction(cart $cart)
    {

        return $this->render('cart/show.html.twig', array(
            'cart' => $cart,
        ));
    }
}
