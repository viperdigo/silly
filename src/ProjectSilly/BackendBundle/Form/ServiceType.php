<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\CoreBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(

                    Customer::SERVICE_NEW_LINK => 'Instalação Nova',
                    Customer::SERVICE_CONSUME_ZERO_WITH_EXCHANGE => 'Consumo Zero com Troca',
                    Customer::SERVICE_CONSUME_ZERO_WITHOUT_EXCHANGE => 'Consumo Zero sem Troca',
                    Customer::SERVICE_INACTIVE_WITH_EXCHANGE => 'Inativo com Troca',
                    Customer::SERVICE_INACTIVE_WITHOUT_EXCHANGE => 'Inativo sem Troca',

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