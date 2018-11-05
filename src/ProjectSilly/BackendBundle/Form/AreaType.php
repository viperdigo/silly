<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AreaType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'name' )
			->add( 'ugr', new UgrType() )
			->add( 'polo', new PoloType() )
			->add( 'liberation', new LiberationType() )
			->add( 'dateLiberation', new DateType() )
			->add( 'property', new PropertyType() )
			->add( 'eletricEnergy', new GenericAreaType() )
			->add( 'garbageCollection', new GarbageCollectionType() )
			->add( 'streetLighting', new StreetLighthingType() )
			->add( 'typeHousing' )
			->add( 'contactLeadership' )
			->add( 'socialAction', new GenericAreaType() )
			->add( 'dateSocialAction', new DateType() )
			->add( 'estimatedLinks' )
			->add( 'acceptsBackhoe' )
			->add( 'sewer', new SewerType() )
			->add( 'senseCadastral', new GenericAreaType() )
			->add( 'dateSenseCadastral', new DateType() )
			->add( 'sketches', new GenericAreaType() )
			->add( 'dateSketches', new DateType() )
			->add( 'design', new GenericAreaType() )
			->add( 'dateDesign', new DateType() )
			->add( 'creatingRgi', new GenericAreaType() )
			->add( 'dateCreatingRgi', new DateType() )
			->add( 'lowSigns', new GenericAreaType() )
			->add( 'dateLowSigns', new DateType() )
			->add( 'datePrevisionStartProject', new DateType() )
			->add( 'datePrevisionEndProject', new DateType() )
			->add( 'filedDocumentation', new GenericAreaType() )
			->add( 'comments' );

	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults(
			array(
				'data_class' => 'ProjectSilly\CoreBundle\Entity\Area',
			)
		);
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'area';
	}
}
