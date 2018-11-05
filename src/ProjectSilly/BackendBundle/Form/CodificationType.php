<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodificationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'attr' => array(
                    'class' => 'maskCodification',
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
        return 'codification_type';
    }
}