<?php

namespace ProjectSilly\BackendBundle\Controller;

use ProjectSilly\BackendBundle\Form\MaterialCustomerType;
use ProjectSilly\CoreBundle\Entity\MaterialCustomer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectSilly\CoreBundle\Entity\Customer;
use ProjectSilly\BackendBundle\Form\CustomerType;

/**
 * @Route("/customer")
 */
class CustomerController extends Controller {

	/**
	 * @Route("/", name="customer")
	 * @Method("GET")
	 * @Template()
	 */
	public function indexAction() {

		$filter = $this->get( 'filter' )->createFilterBuilder( 'CoreBundle:Customer' )
		               ->addField( 'id' )
		               ->addField( 'name', [ 'length' => 6 ] )
		               ->addField( 'publicPlace', [ 'length' => 6 ] )
		               ->addField( 'socialSecurity' )
		               ->addField( 'rgi' )
		               ->addField( 'hydrometer' )
		               ->addOrder( 'createdAt', 'DESC' )
		               ->addPagination( 10 )
		               ->addCache( 0 )
		               ->build();

		return array(
			'filter' => $filter,
			'result' => $filter->getResult(),
		);
	}

	/**
	 * @Route("/", name="customer_create")
	 * @Method("POST")
	 * @Template("BackendBundle:Customer:new.html.twig")
	 */
	public function createAction( Request $request ) {
		$entity = new Customer();
		$form   = $this->createCreateForm( $entity );
		$form->handleRequest( $request );

		if ( $form->isValid() ) {

			$em = $this->getDoctrine()->getManager();
			$em->persist( $entity );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'Customer %name% created.', array( '%name%' => $entity->getName() ) )
			);

			return $this->redirect( $this->generateUrl( 'customer' ) );
		}

		return array(
			'entity' => $entity,
			'form'   => $form->createView(),
		);
	}

	/**
	 * @param Customer $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createCreateForm( Customer $entity ) {
		$form = $this->createForm(
			new CustomerType(),
			$entity,
			array(
				'action' => $this->generateUrl( 'customer_create' ),
				'method' => 'POST',
				'attr'   => array(
					'class' => 'form-horizontal',
				),
			)
		);

		return $form;
	}

	/**
	 * @Route("/new", name="customer_new")
	 * @Method("GET")
	 * @Template()
	 */
	public function newAction() {
		$entity = new Customer();
		$form   = $this->createCreateForm( $entity );

		return array(
			'entity' => $entity,
			'form'   => $form->createView(),
		);
	}

	/**
	 * @Route("/{id}/edit", name="customer_edit")
	 * @Method("GET")
	 * @Template()
	 */
	public function editAction( $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'CoreBundle:Customer' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Customer entity.' );
		}

		$editForm = $this->createEditForm( $entity );

		return array(
			'entity'    => $entity,
			'edit_form' => $editForm->createView(),
		);
	}

	/**
	 * @param Customer $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createEditForm( Customer $entity ) {
		$form = $this->createForm(
			new CustomerType(),
			$entity,
			array(
				'action' => $this->generateUrl( 'customer_update', array( 'id' => $entity->getId() ) ),
				'method' => 'PUT',
				'attr'   => array(
					'class' => 'form-horizontal',
				),
			)
		);

		return $form;
	}

	/**
	 * @param Customer $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createShowForm( Customer $entity ) {

		return $this->createForm( new CustomerType(), $entity );

	}
	
	/**
	 * @Route("/{id}", name="customer_update")
	 * @Method("PUT")
	 * @Template("BackendBundle:Customer:edit.html.twig")
	 */
	public function updateAction( Request $request, $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'CoreBundle:Customer' )->find( $id );

		if ( ! $entity instanceof Customer ) {
			throw $this->createNotFoundException( 'Unable to find Customer entity.' );
		}

		$editForm = $this->createEditForm( $entity );
		$editForm->handleRequest( $request );

		if ( $editForm->isValid() ) {
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'Customer %name% updated.', array( '%name%' => $entity->getName() ) )
			);

			return $this->redirect( $this->generateUrl( 'customer' ) );
		}

		return array(
			'entity'    => $entity,
			'edit_form' => $editForm->createView(),
		);
	}

	/**
	 * @Route("/{id}/delete", name="customer_delete")
	 * @Method("GET")
	 * @Template()
	 */
	public function deleteAction( $id ) {

		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'CoreBundle:Customer' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Customer entity.' );
		}

		try {

			$em->remove( $entity );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'Customer %name% excluded.',
					array( '%name%' => $entity->getName() ) )
			);

		} catch ( \Exception $e ) {

			$this->get( 'session' )->getFlashBag()->add(
				'error',
				$this->get( 'translator' )->trans(
					'Customer %name% not excluded. Contact Administrator.',
					array( '%name%' => $entity->getName() )
				)
			);

		}

		return $this->redirect( $this->generateUrl( 'customer' ) );
	}

	/**
	 * @Route("/{id}/show", name="customer_show")
	 * @Method("GET")
	 * @Template()
	 */
	public function showAction( $id ) {
		$em       = $this->getDoctrine()->getManager();
		$customer = $em->getRepository( 'CoreBundle:Customer' )->find( $id );

		$formShow = $this->createShowForm( $customer );

		return array(
			'customer'  => $customer,
			'show_form' => $formShow->createView(),
		);
	}

	/**
	 * @Route("/material/{id}", name="material_customer_create")
	 * @Template("BackendBundle:Customer:newMaterialCustomer.html.twig")
	 */
	public function createMaterialCustomerAction( Request $request, $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = new MaterialCustomer();
		$form   = $this->createMaterialCustomerCreateForm( $entity, $id );
		$form->handleRequest( $request );
		$customer = $em->getRepository( 'CoreBundle:Customer' )->find( $id );

		if ( $form->isValid() ) {

			$entity->setCustomer( $customer );
			$em->persist( $entity );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'Material associeted in customer %name% .',
					array( '%name%' => $entity->getMaterial()->getDescription() ) )
			);

			return $this->redirect( $this->generateUrl( 'material_customer_create', [ 'id' => $id ] ) );
		}


		return array(
			'entity'   => $entity,
			'customer' => $customer,
			'form'     => $form->createView(),
		);
	}

	/**
	 * @param MaterialCustomer $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createMaterialCustomerCreateForm( MaterialCustomer $entity, $id ) {
		$form = $this->createForm(
			new MaterialCustomerType(),
			$entity,
			array(
				'action' => $this->generateUrl( 'material_customer_create', [ 'id' => $id ] ),
				'method' => 'POST',
				'attr'   => array(
					'class' => 'form-horizontal',
				),
			)
		);

		return $form;
	}

	/**
	 * @Route("/material/{id}/{customerId}/delete", name="material_customer_delete")
	 * @Method("GET")
	 */
	public function deleteMaterialCustomerAction( $id, $customerId ) {
		$em     = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository( 'CoreBundle:MaterialCustomer' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Material Customer entity.' );
		}

		$em->remove( $entity );
		$em->flush();


		$this->get( 'session' )->getFlashBag()->add(
			'success',
			$this->get( 'translator' )->trans( 'Material removed in customer %name% .',
				array( '%name%' => $entity->getMaterial()->getDescription() ) )
		);

		return $this->redirect( $this->generateUrl( 'material_customer_create', [ 'id' => $customerId ] ) );
	}

}
