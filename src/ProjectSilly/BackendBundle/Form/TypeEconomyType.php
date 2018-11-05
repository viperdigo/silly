<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Customer;
use ProjectSilly\CoreBundle\Entity\PublicPlace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeEconomyType extends AbstractType {

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults(
			array(
				'choices'  => array(
					Customer::TYPE_ECONOMY_INDUSTRIAL  => 'industrial',
					Customer::TYPE_ECONOMY_MERCHANT    => 'merchant',
					Customer::TYPE_ECONOMY_PUBLIC      => 'public',
					Customer::TYPE_ECONOMY_RESIDENTIAL => 'residential',
				),
			)
		);
	}

	public function getParent() {
		return 'choice';
	}

	public function getName() {
		return 'type_economy';
	}
}