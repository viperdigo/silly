<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Customer;
use ProjectSilly\CoreBundle\Entity\PublicPlace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypePublicPlaceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(
                    PublicPlace::TYPE_AIRPORT => 'aeroporto',
                    PublicPlace::TYPE_ALLEY => 'viela',
                    PublicPlace::TYPE_AVENUE => 'avenida',
                    PublicPlace::TYPE_PARK => 'parque',
                    PublicPlace::TYPE_ROAD => 'estrada',
                    PublicPlace::TYPE_STREET => 'rua',
                    PublicPlace::TYPE_YARD => 'jardim',
                    PublicPlace::TYPE_LANE => 'travessa',
                ),
            )
        );
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'type_public_place';
    }
}