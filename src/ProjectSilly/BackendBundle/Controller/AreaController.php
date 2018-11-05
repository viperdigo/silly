<?php

namespace ProjectSilly\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\BackendBundle\Form\AreaType;

/**
 * @Route("/area")
 */
class AreaController extends Controller
{

    /**
     * @Route("/", name="area")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $filter = $this->get('filter')->createFilterBuilder('CoreBundle:Area')
            ->addField('id')
            ->addField('name')
            ->addOrder('createdAt','DESC')
            ->addPagination(10)
            ->addCache(0)
            ->build();

        return array(
            'filter' => $filter,
            'result' => $filter->getResult(),
        );
    }

    /**
     * @Route("/", name="area_create")
     * @Method("POST")
     * @Template("BackendBundle:Area:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Area();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Area %name% created.', array('%name%' => $entity->getName()))
            );

            return $this->redirect($this->generateUrl('area'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @param Area $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(Area $entity)
    {
        $form = $this->createForm(
            new AreaType(),
            $entity,
            array(
                'action' => $this->generateUrl('area_create'),
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal'
                )
            )
        );

        return $form;
    }

    /**
     * @Route("/new", name="area_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Area();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="area_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find area entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @param Area $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(Area $entity)
    {
        $form = $this->createForm(
            new AreaType(),
            $entity,
            array(
                'action' => $this->generateUrl('area_update', array('id' => $entity->getId())),
                'method' => 'PUT',
                'attr' => array(
                    'class' => 'form-horizontal'
                )
            )
        );

        return $form;
    }

    /**
     * @Route("/{id}", name="area_update")
     * @Method("PUT")
     * @Template("BackendBundle:Area:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Area')->find($id);

        if (!$entity instanceof Area) {
            throw $this->createNotFoundException('Unable to find Area entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Area %name% updated.', array('%name%' => $entity->getName()))
            );
            return $this->redirect($this->generateUrl('area'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @Route("/{id}/delete", name="area_delete")
     * @Method("GET")
     * @Template()
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Area entity.');
        }

        try {

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Area %name% excluded.', array('%name%' => $entity->getName()))
            );

        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans('Area %name% not excluded. Contact Administrator.', array('%name%' => $entity->getName()))
            );

        }

        return $this->redirect($this->generateUrl('area'));
    }

}
