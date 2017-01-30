<?php

namespace Application\Sonata\UserBundle\Controller;

use Application\Sonata\UserBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Group controller.
 *
 * @Route("group")
 */
class GroupController extends Controller
{
    /**
     * Lists all group entities.
     *
     * @Route("/", name="group_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('ApplicationSonataUserBundle:Group')->findAll();

        dump($groups);
        die;


        return $this->render('group/index.html.twig', array(
            'groups' => $groups,
        ));
    }

    /**
     * Finds and displays a group entity.
     *
     * @Route("/{id}", name="group_show")
     * @Method("GET")
     */
    public function showAction(Group $group)
    {

        return $this->render('group/show.html.twig', array(
            'group' => $group,
        ));
    }
}
