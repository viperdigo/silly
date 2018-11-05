<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'codification', new CodificationType() )
			->add( 'rgi', new RgiType() )
			->add( 'tl' )
			->add( 'hydrometer' )
			->add( 'sealLink' )
			->add( 'serviceOne', new ServiceType() )
			->add( 'serviceTwo' )
			->add( 'socialTariff' )
			->add( 'expirationSocialTariff', new DateType(), [ 'required' => false ] )
			->add( 'publicPlace' )
			->add( 'number' )
			->add( 'complement' )
			->add( 'zipcode', new ZipCodeType() )
			->add( 'homePhone',
				new PhoneType(),
				array(
					'required' => false,
				) )
			->add( 'cellPhone',
				new CellType(),
				array(
					'required' => false,
				) )
			->add( 'birthdayDate', new DateType(), [ 'required' => false ] )
			->add( 'name' )
			->add( 'document' )
			->add( 'socialSecurity', new SocialSecurityType(), [ 'required' => false ] )
			->add( 'email' )
			->add( 'waterTank' )
			->add( 'propertyRelationship', new PropertyRelationshipType(), [ 'required' => false ] )
			->add( 'timeOccupation' )
			->add( 'amountMature' )
			->add( 'amountChildren' )
			->add( 'typeEconomy', new TypeEconomyType(), [ 'required' => false ] )
			->add( 'savingAmount' )
			->add( 'branchActivity' )
			->add( 'dateLink', new DateType(), [ 'required' => false ] )
			->add( 'dateRegister',
				new DateType(),
				array(
					'required' => false,
					'data'     => new \DateTime( 'now' ),
				) );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults(
			array(
				'data_class' => 'ProjectSilly\CoreBundle\Entity\Customer',
			)
		);
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'customer';
	}
}
