<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoneyType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'currency' => '',
                'precision' => 10,
                'scale' => 2,
                'attr' => array(
                    'class' => 'maskMoney',
                ),
            )
        );
    }

    public function getParent()
    {
        return 'money';
    }

    public function getName()
    {
        return 'money_type';
    }
}