<?php

namespace ProjectSilly\BackendBundle\Form;

use Plentypark\CoreBundle\Entity\Employee;
use ProjectSilly\CoreBundle\Entity\Area;
use ProjectSilly\CoreBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PoloType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'required' => false,
                'choices' => array(

                    Area::POLO_BRAGANCA => 'Bragança',
                    Area::POLO_FRANCO_DA_ROCHA => 'Franco da Rocha',
                    Area::POLO_FREGUESIA => 'Freguesia do Ó',
                    Area::POLO_PIRITUBA => 'Pirituba',
                    Area::POLO_SANTANA => 'Santana',
                    Area::POLO_SOCORRO => 'Socorro',
                    Area::POLO_VILA_MARIA => 'Vila Maria',

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
        return 'polo';
    }
}