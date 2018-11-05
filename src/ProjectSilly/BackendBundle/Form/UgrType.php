<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\CoreBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UgrType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(
                    Area::UGR_BRAGANTINA => 'Bragantina',
                    Area::UGR_EXTREMO_NORTE=> 'Extremo norte',
                    Area::UGR_FREGUESIA=> 'Freguesia',
                    Area::UGR_PIRITUBA=> 'Pirituba',
                    Area::UGR_SANTANA=> 'Santana',

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
        return 'ugr';
    }
}