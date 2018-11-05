<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'format' => 'dd/MM/yyyy',
                'widget' => 'single_text',
                'attr' => array('class' => 'date-picker input-small maskDate'),
            )
        );
    }

    public function getParent()
    {
        return 'date';
    }

    public function getName()
    {
        return 'date_type';
    }
}