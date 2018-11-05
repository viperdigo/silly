<?php

namespace ProjectSilly\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicPlaceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area')
            ->add('typePublicPlace', new TypePublicPlaceType())
            ->add('publicPlace')
            ->add('typeBed', new TypeBedType())
            ->add('typeRide', new TypeRideType())
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ProjectSilly\CoreBundle\Entity\PublicPlace',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'public_place';
    }
}
