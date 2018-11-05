<?php

namespace ProjectSilly\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectSilly\UserBundle\Form\Type\UserType;
use ProjectSilly\UserBundle\Entity\User;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $filter = $this->get('filter')->createFilterBuilder('UserBundle:User')
            ->addField('id')
            ->addField('name')
            ->addField('username')
            ->addField('email')
            ->addPagination(10)
            ->addCache(0)
            ->build();

        return array(
            'filter' => $filter,
            'result' => $filter->getResult(),
        );
    }

    /**
     * @Route("/", name="user_create")
     * @Method("POST")
     * @Template("UserBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {

        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $name       = $form->getData()->getName();
            $username   = $form->getData()->getUsername();
            $email      = $form->getData()->getEmail();

            $user_manager = $this->get('fos_user.user_manager');

            $user = $user_manager->createUser();
            $user->setUsername($username);
            $user->setName($name);
            $user->setEmail($email);
            $user->setPlainPassword("silly@123");
            $user->setEnabled(true);

            $user_manager->updateUser($user);

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('User %username% created.', array('%username%' => $entity->getUsername()))
            );

            return $this->redirect($this->generateUrl('user'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @param User $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(
            new UserType(),
            $entity,
            array(
                'action' => $this->generateUrl('user_create'),
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal',
                ),
            )
        );

        return $form;
    }

    /**
     * @Route("/new", name="user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);


        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @param User $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(
            new UserType(),
            $entity,
            array(
                'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
                'method' => 'PUT',
                'attr' => array(
                    'class' => 'form-horizontal',
                ),
            )
        );

        return $form;
    }

    /**
     * @Route("/{id}", name="user_update")
     * @Method("PUT")
     * @Template("UserBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:User')->find($id);

        if (!$entity instanceof User) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('User %username% updated.', array('%username%' => $entity->getUsername()))
            );

            return $this->redirect($this->generateUrl('user'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @Route("/{id}/delete", name="user_delete")
     * @Method("GET")
     * @Template()
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        try {

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('User %username% excluded.', array('%username%' => $entity->getUsername()))
            );

        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans(
                    'User %username% not excluded. Contact Administrator.',
                    array('%username%' => $entity->getUsername())
                )
            );

        }

        return $this->redirect($this->generateUrl('user'));
    }
}