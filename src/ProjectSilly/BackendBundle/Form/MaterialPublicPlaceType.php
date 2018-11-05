<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialPublicPlaceType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'material' )
			->add( 'quantity', new MoneyType() )
			->add( 'unitMeasurement', new UnitMeasurementType(), [ 'required' => true ] )
			->add( 'dateApplication', new DateType() );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults(
			array(
				'data_class' => 'ProjectSilly\CoreBundle\Entity\MaterialPublicPlace',
			)
		);
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'material_public_place';
	}
}
