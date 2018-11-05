<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'attr' => array(
                    'class' => 'maskPhone',
                ),
            )
        );
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'phone_type';
    }
}