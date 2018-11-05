<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(
            array(
                'attr' => array('class' => 'maskTime'),
            )
        );
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'time_type';
    }
}