<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyRelationshipType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'choices' => array(
                    Customer::PROPERTY_RELATIONSHIP_OWNER => 'owner',
                    Customer::PROPERTY_RELATIONSHIP_TENANT => 'tenant',
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
        return 'property_relationship';
    }
}