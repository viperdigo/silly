<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\CoreBundle\Entity\Customer;
use ProjectSilly\CoreBundle\Entity\PublicPlace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeBedType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(
                    PublicPlace::TYPE_BED_ASPHALT => 'Asfalto',
                    PublicPlace::TYPE_BED_BLOCKS => 'Bloquetes',
                    PublicPlace::TYPE_BED_CEMENTED => 'Cimentado',
                    PublicPlace::TYPE_BED_LAND => 'Terra',
                    PublicPlace::TYPE_BED_PARALLELEPIPED => 'Paralelepipedo',
                    PublicPlace::TYPE_BED_SPECIAL => 'Especial',
                    PublicPlace::TYPE_BED_MIRACEMA => 'Miracema',
                    PublicPlace::TYPE_BED_OTHERS => 'Outros',
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
        return 'type_bed';
    }
}