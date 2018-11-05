<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParameterTypeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'choices' => array(
                    'days' => 'Days',
                    'emails' => 'Emails',
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
        return 'parameter_type';
    }
}