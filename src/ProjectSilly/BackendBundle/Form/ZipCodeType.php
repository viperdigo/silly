<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ZipCodeType
 * @package ProjectSilly\BackendBundle\Form
 */
class ZipCodeType extends AbstractType {

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults(
			array(
				'required' => false,
				'type'     => 'numeric',
				'attr'     => array(
					'class' => 'maskZipCode',
				),
			)
		);
	}

	/**
	 * @return string
	 */
	public function getParent() {
		return 'text';
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'zip_code_type';
	}
}