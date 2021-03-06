<?php
namespace AdministrationBundle\Controller;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Search\SearchHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class CoreController.
 *
 * @author  Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class CoreController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function dashboardAction()
    {
        $blocks = array(
            'top' => array(),
            'left' => array(),
            'center' => array(),
            'right' => array(),
            'bottom' => array(),
        );
        foreach ($this->container->getParameter('sonata.admin.configuration.dashboard_blocks') as $block) {
            $blocks[$block['position']][] = $block;
        }
        $parameters = array(
            'base_template' => $this->getBaseTemplate(),
            'admin_pool' => $this->container->get('sonata.admin.pool'),
            'blocks' => $blocks,
        );
        if (!$this->getRequest()->isXmlHttpRequest()) {
            $parameters['breadcrumbs_builder'] = $this->get('sonata.admin.breadcrumbs_builder');
        }
        
        //dump($parameters);
        //die();
        
        
       // return $this->render($this->getAdminPool()->getTemplate('dashboard'), $parameters);
        return $this->render('AdministrationBundle:Dashboard:Dashboard.html.twig', $parameters);
    }

    
    /**
     * @param Request $request
     * @return JsonResponse|Response
     * @throws \RuntimeException
     */
    public function searchAction(Request $request)
    {
        if ($request->get('admin') && $request->isXmlHttpRequest()) {
            try {
                $admin = $this->getAdminPool()->getAdminByAdminCode($request->get('admin'));
            } catch (ServiceNotFoundException $e) {
                throw new \RuntimeException('Unable to find the Admin instance', $e->getCode(), $e);
            }
            if (!$admin instanceof AdminInterface) {
                throw new \RuntimeException('The requested service is not an Admin instance');
            }
            $handler = $this->getSearchHandler();
            $results = array();
            if ($pager = $handler->search($admin, $request->get('q'), $request->get('page'), $request->get('offset'))) {
                foreach ($pager->getResults() as $result) {
                    $results[] = array(
                        'label' => $admin->toString($result),
                        'link' => $admin->generateObjectUrl('edit', $result),
                        'id' => $admin->id($result),
                    );
                }
            }
            $response = new JsonResponse(array(
                'results' => $results,
                'page' => $pager ? (int) $pager->getPage() : false,
                'total' => $pager ? (int) $pager->getNbResults() : false,
            ));
            $response->setPrivate();

            return $response;
        }
        return $this->render($this->container->get('sonata.admin.pool')->getTemplate('search'), array(
            'base_template' => $this->getBaseTemplate(),
            'breadcrumbs_builder' => $this->get('sonata.admin.breadcrumbs_builder'),
            'admin_pool' => $this->container->get('sonata.admin.pool'),
            'query' => $request->get('q'),
            'groups' => $this->getAdminPool()->getDashboardGroups(),
        ));
    }
    /**
     * @deprecated Use the Request action argument. This method will be removed
     * @return Request
     */
    public function getRequest()
    {
        if ($this->container->has('request_stack')) {
            return $this->container->get('request_stack')->getCurrentRequest();
        }
        return $this->container->get('request');
    }
    /**
     * @return Pool
     */
    protected function getAdminPool()
    {
        return $this->container->get('sonata.admin.pool');
    }
    /**
     * @return SearchHandler
     */
    protected function getSearchHandler()
    {
        return $this->get('sonata.admin.search.handler');
    }
    /**
     * @param Request $request
     *
     * @return string
     */
    protected function getBaseTemplate()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            return $this->getAdminPool()->getTemplate('ajax');
        }
        return $this->getAdminPool()->getTemplate('layout');
    }
}
