<?php

namespace ProjectSilly\BackendBundle\Controller;

use ProjectSilly\BackendBundle\Form\MaterialPublicPlaceType;
use ProjectSilly\CoreBundle\Entity\MaterialPublicPlace;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectSilly\CoreBundle\Entity\PublicPlace;
use ProjectSilly\BackendBundle\Form\PublicPlaceType;

/**
 * @Route("/public_place")
 */
class PublicPlaceController extends Controller {

	/**
	 * @Route("/", name="public_place")
	 * @Method("GET")
	 * @Template()
	 */
	public function indexAction() {
		$filter = $this->get( 'filter' )->createFilterBuilder( 'CoreBundle:PublicPlace' )
		               ->addField( 'area' )
		               ->addField( 'publicPlace' )
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
	 * @Route("/", name="public_place_create")
	 * @Method("POST")
	 * @Template("BackendBundle:PublicPlace:new.html.twig")
	 */
	public function createAction( Request $request ) {
		$entity = new PublicPlace();
		$form   = $this->createCreateForm( $entity );
		$form->handleRequest( $request );

		if ( $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $entity );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'PublicPlace %name% created.',
					array( '%name%' => $entity->getPublicPlace() ) )
			);

			return $this->redirect( $this->generateUrl( 'public_place' ) );
		}

		return array(
			'entity' => $entity,
			'form'   => $form->createView(),
		);
	}

	/**
	 * @param PublicPlace $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createCreateForm( PublicPlace $entity ) {
		$form = $this->createForm(
			new PublicPlaceType(),
			$entity,
			array(
				'action' => $this->generateUrl( 'public_place_create' ),
				'method' => 'POST',
				'attr'   => array(
					'class' => 'form-horizontal',
				),
			)
		);

		return $form;
	}

	/**
	 * @Route("/new", name="public_place_new")
	 * @Method("GET")
	 * @Template()
	 */
	public function newAction() {
		$entity = new PublicPlace();
		$form   = $this->createCreateForm( $entity );

		return array(
			'entity' => $entity,
			'form'   => $form->createView(),
		);
	}

	/**
	 * @Route("/{id}/edit", name="public_place_edit")
	 * @Method("GET")
	 * @Template()
	 */
	public function editAction( $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'CoreBundle:PublicPlace' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find public_place entity.' );
		}

		$editForm = $this->createEditForm( $entity );

		return array(
			'entity'    => $entity,
			'edit_form' => $editForm->createView(),
		);
	}

	/**
	 * @param PublicPlace $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createEditForm( PublicPlace $entity ) {
		$form = $this->createForm(
			new PublicPlaceType(),
			$entity,
			array(
				'action' => $this->generateUrl( 'public_place_update', array( 'id' => $entity->getId() ) ),
				'method' => 'PUT',
				'attr'   => array(
					'class' => 'form-horizontal',
				),
			)
		);

		return $form;
	}

	/**
	 * @Route("/{id}", name="public_place_update")
	 * @Method("PUT")
	 * @Template("BackendBundle:PublicPlace:edit.html.twig")
	 */
	public function updateAction( Request $request, $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'CoreBundle:PublicPlace' )->find( $id );

		if ( ! $entity instanceof PublicPlace ) {
			throw $this->createNotFoundException( 'Unable to find PublicPlace entity.' );
		}

		$editForm = $this->createEditForm( $entity );
		$editForm->handleRequest( $request );

		if ( $editForm->isValid() ) {
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'PublicPlace %name% updated.',
					array( '%name%' => $entity->getPublicPlace() ) )
			);

			return $this->redirect( $this->generateUrl( 'public_place' ) );
		}

		return array(
			'entity'    => $entity,
			'edit_form' => $editForm->createView(),
		);
	}

	/**
	 * @Route("/{id}/delete", name="public_place_delete")
	 * @Method("GET")
	 * @Template()
	 */
	public function deleteAction( $id ) {

		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'CoreBundle:PublicPlace' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find PublicPlace entity.' );
		}

		try {

			$em->remove( $entity );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'PublicPlace %name% excluded.',
					array( '%name%' => $entity->getPublicPlace() ) )
			);

		} catch ( \Exception $e ) {

			$this->get( 'session' )->getFlashBag()->add(
				'error',
				$this->get( 'translator' )->trans( 'PublicPlace %name% not excluded. Contact Administrator.',
					array( '%name%' => $entity->getPublicPlace() ) )
			);

		}

		return $this->redirect( $this->generateUrl( 'public_place' ) );
	}

	/**
	 * @Route("/material/{id}", name="material_public_place_create")
	 * @Template("BackendBundle:PublicPlace:newMaterialPublicPlace.html.twig")
	 */
	public function createMaterialPublicPlaceAction( Request $request, $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = new MaterialPublicPlace();
		$form   = $this->createMaterialPublicPlaceCreateForm( $entity, $id );
		$form->handleRequest( $request );
		$publicPlace = $em->getRepository( 'CoreBundle:PublicPlace' )->find( $id );

		if ( $form->isValid() ) {

			$entity->setPublicPlace( $publicPlace );
			$em->persist( $entity );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				$this->get( 'translator' )->trans( 'Material associeted in public place %name% .',
					array( '%name%' => $entity->getMaterial()->getDescription() ) )
			);

			return $this->redirect( $this->generateUrl( 'material_public_place_create', [ 'id' => $id ] ) );
		}

		return array(
			'entity'      => $entity,
			'publicPlace' => $publicPlace,
			'form'        => $form->createView(),
		);
	}

	/**
	 * @param MaterialPublicPlace $entity
	 *
	 * @return \Symfony\Component\Form\Form
	 */
	private function createMaterialPublicPlaceCreateForm( MaterialPublicPlace $entity, $id ) {
		$form = $this->createForm(
			new MaterialPublicPlaceType(),
			$entity,
			array(
				'action' => $this->generateUrl( 'material_public_place_create', [ 'id' => $id ] ),
				'method' => 'POST',
				'attr'   => array(
					'class' => 'form-horizontal',
				),
			)
		);

		return $form;
	}

	/**
	 * @Route("/material/{id}/{publicPlaceId}/delete", name="material_public_place_delete")
	 * @Method("GET")
	 */
	public function deleteMaterialPublicPlaceAction( $id, $publicPlaceId ) {
		$em     = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository( 'CoreBundle:MaterialPublicPlace' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Material PublicPlace entity.' );
		}

		$em->remove( $entity );
		$em->flush();


		$this->get( 'session' )->getFlashBag()->add(
			'success',
			$this->get( 'translator' )->trans( 'Material removed in public place %name% .',
				array( '%name%' => $entity->getMaterial()->getDescription() ) )
		);

		return $this->redirect( $this->generateUrl( 'material_public_place_create', [ 'id' => $publicPlaceId ] ) );
	}

}
