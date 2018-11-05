<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\CoreBundle\Entity\Customer;
use ProjectSilly\CoreBundle\Entity\MaterialCustomer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnitMeasurementType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(

                    MaterialCustomer::UNIT_MEASUREMENT_PIECE => 'PÇ',
                    MaterialCustomer::UNIT_MEASUREMENT_UNIT => 'UN',
                    MaterialCustomer::UNIT_MEASUREMENT_CUBIC_METER => 'M3',
                    MaterialCustomer::UNIT_MEASUREMENT_METER => 'M',

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
        return 'unit_measurement';
    }
}