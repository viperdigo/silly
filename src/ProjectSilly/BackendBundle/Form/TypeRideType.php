<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\CoreBundle\Entity\Customer;
use ProjectSilly\CoreBundle\Entity\PublicPlace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeRideType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(
                    PublicPlace::TYPE_RIDE_ASPHALT => 'Asfalto',
                    PublicPlace::TYPE_RIDE_BLOCKS => 'Bloquetes',
                    PublicPlace::TYPE_RIDE_CEMENTED => 'Cimentado',
                    PublicPlace::TYPE_RIDE_LAND => 'Terra',
                    PublicPlace::TYPE_RIDE_PARALLELEPIPED => 'Paralelepipedo',
                    PublicPlace::TYPE_RIDE_SPECIAL => 'Especial',
                    PublicPlace::TYPE_RIDE_MIRACEMA => 'Miracema',
                    PublicPlace::TYPE_RIDE_OTHERS => 'Outros',
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
        return 'type_ride';
    }
}