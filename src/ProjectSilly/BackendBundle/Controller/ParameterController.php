<?php

namespace ProjectSilly\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectSilly\CoreBundle\Entity\Parameter;
use ProjectSilly\BackendBundle\Form\ParameterType;

/**
 * @Route("/parameter")
 */
class ParameterController extends Controller
{

    /**
     * @Route("/", name="parameter")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $filter = $this->get('filter')->createFilterBuilder('CoreBundle:Parameter')
            ->addField('id')
            ->addField('name')
            ->addField('type')
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
     * @Route("/", name="parameter_create")
     * @Method("POST")
     * @Template("BackendBundle:Parameter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Parameter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Parameter %name% created.', array('%name%' => $entity->getName()))
            );

            return $this->redirect($this->generateUrl('parameter'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @param Parameter $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(Parameter $entity)
    {
        $form = $this->createForm(
            new ParameterType(),
            $entity,
            array(
                'action' => $this->generateUrl('parameter_create'),
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal'
                )
            )
        );

        return $form;
    }

    /**
     * @Route("/new", name="parameter_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Parameter();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="parameter_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Parameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find parameter entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @param Parameter $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(Parameter $entity)
    {
        $form = $this->createForm(
            new ParameterType(),
            $entity,
            array(
                'action' => $this->generateUrl('parameter_update', array('id' => $entity->getId())),
                'method' => 'PUT',
                'attr' => array(
                    'class' => 'form-horizontal'
                )
            )
        );

        return $form;
    }

    /**
     * @Route("/{id}", name="parameter_update")
     * @Method("PUT")
     * @Template("BackendBundle:Parameter:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Parameter')->find($id);

        if (!$entity instanceof Parameter) {
            throw $this->createNotFoundException('Unable to find Parameter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Parameter %name% updated.', array('%name%' => $entity->getName()))
            );
            return $this->redirect($this->generateUrl('parameter'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @Route("/{id}/delete", name="parameter_delete")
     * @Method("GET")
     * @Template()
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Parameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parameter entity.');
        }

        try {

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Parameter %name% excluded.', array('%name%' => $entity->getName()))
            );

        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans('Parameter %name% not excluded. Contact Administrator.', array('%name%' => $entity->getName()))
            );

        }

        return $this->redirect($this->generateUrl('parameter'));
    }

}
