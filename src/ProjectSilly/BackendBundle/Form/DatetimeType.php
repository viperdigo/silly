<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatetimeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'format' => 'dd/MM/yyyy hh:ii:ss',
                'widget' => 'single_text',
                'attr' => array('class' => 'date-picker input-medium maskDateTime'),
            )
        );
    }

    public function getParent()
    {
        return 'datetime';
    }

    public function getName()
    {
        return 'datetime_type';
    }
}