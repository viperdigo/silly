<?php

namespace ProjectSilly\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectSilly\CoreBundle\Entity\Material;
use ProjectSilly\BackendBundle\Form\MaterialType;

/**
 * @Route("/material")
 */
class MaterialController extends Controller
{

    /**
     * @Route("/", name="material")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $filter = $this->get('filter')->createFilterBuilder('CoreBundle:Material')
            ->addField('description')
            ->addField('code')
            ->addOrder('description','ASC')
            ->addPagination(10)
            ->addCache(0)
            ->build();

        return array(
            'filter' => $filter,
            'result' => $filter->getResult(),
        );
    }

    /**
     * @Route("/", name="material_create")
     * @Method("POST")
     * @Template("BackendBundle:Material:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Material();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Material %name% created.', array('%name%' => $entity->getDescription()))
            );

            return $this->redirect($this->generateUrl('material'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @param Material $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(Material $entity)
    {
        $form = $this->createForm(
            new MaterialType(),
            $entity,
            array(
                'action' => $this->generateUrl('material_create'),
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal'
                )
            )
        );

        return $form;
    }

    /**
     * @Route("/new", name="material_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Material();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="material_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Material')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find material entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @param Material $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(Material $entity)
    {
        $form = $this->createForm(
            new MaterialType(),
            $entity,
            array(
                'action' => $this->generateUrl('material_update', array('id' => $entity->getId())),
                'method' => 'PUT',
                'attr' => array(
                    'class' => 'form-horizontal'
                )
            )
        );

        return $form;
    }

    /**
     * @Route("/{id}", name="material_update")
     * @Method("PUT")
     * @Template("BackendBundle:Material:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Material')->find($id);

        if (!$entity instanceof Material) {
            throw $this->createNotFoundException('Unable to find Material entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Material %name% updated.', array('%name%' => $entity->getDescription()))
            );
            return $this->redirect($this->generateUrl('material'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @Route("/{id}/delete", name="material_delete")
     * @Method("GET")
     * @Template()
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Material')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Material entity.');
        }

        try {

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Material %name% excluded.', array('%name%' => $entity->getDescription()))
            );

        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans('Material %name% not excluded. Contact Administrator.', array('%name%' => $entity->getDescription()))
            );

        }

        return $this->redirect($this->generateUrl('material'));
    }

}
