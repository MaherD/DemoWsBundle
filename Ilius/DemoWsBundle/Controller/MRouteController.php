<?php

namespace Ilius\DemoWsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ilius\DemoWsBundle\Entity\MRoute;
use Ilius\DemoWsBundle\Form\MRouteType;
use Symfony\Component\HttpFoundation\Response;
/**
 * MRoute controller.
 *
 * @Route("/mroute")
 */
class MRouteController extends Controller
{
    /**
     * Lists all MRoute entities.
     *
     * @Route("/", name="mroute")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IliusDemoWsBundle:MRoute')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a MRoute entity.
     *
     * @Route("/{id}/show", name="mroute_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IliusDemoWsBundle:MRoute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MRoute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new MRoute entity.
     *
     * @Route("/new", name="mroute_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MRoute();
        $form   = $this->createForm(new MRouteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new MRoute entity.
     *
     * @Route("/create", name="mroute_create")
     * @Method("POST")
     * @Template("IliusDemoWsBundle:MRoute:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new MRoute();
        $form = $this->createForm(new MRouteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mroute_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MRoute entity.
     *
     * @Route("/{id}/edit", name="mroute_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IliusDemoWsBundle:MRoute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MRoute entity.');
        }

        $editForm = $this->createForm(new MRouteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing MRoute entity.
     *
     * @Route("/{id}/update", name="mroute_update")
     * @Method("POST")
     * @Template("IliusDemoWsBundle:MRoute:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IliusDemoWsBundle:MRoute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MRoute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MRouteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mroute_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a MRoute entity.
     *
     * @Route("/{id}/delete", name="mroute_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IliusDemoWsBundle:MRoute')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MRoute entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mroute'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

/**
 *shows route Info  a MRoute entity.
 *
 * @Route("/routing-info/info.json", name="mroute_json_list")
 * @Method("get")
 */
public function routingInfoAction() {
    $page = 1;

    $count = 25;
    $em = $this->getDoctrine()->getEntityManager();
    $mroutes  = $em->getRepository('IliusDemoWsBundle:MRoute')->getMRoutes();
    $r_array = $this->routes2Array($mroutes);
    $r = array('page' => $page, 'count' => $count, 'routes' => $r_array);
    return new Response(json_encode($r));
}

private function routes2Array($routes){
    $routes_array = array();

    foreach ($routes as $route) {
        $points_array = array();
       foreach ($route->getPoints() as $point){
           $p_array = array('id' => $point->getId(), 'name' => $point->getName(),
               'x' => $point->getX(),'y' => $point->getY(), 'ptype' => $point->getPType());
           $points_array[] = $p_array;
       }
       $r_array = array('id' => $route->getId(), 'name' => $route->getName(), 'points' => $points_array);
       $routes_array[] = $r_array;
    }
    return $routes_array;
}
}
