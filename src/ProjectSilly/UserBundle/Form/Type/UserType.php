<?php

namespace ProjectSilly\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Util\LegacyFormHelper;


class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('required' => true))
            ->add('username', 'text', array('required' => true))
            ->add('email', 'email', array('required' => true))
//            ->add(
//                'plainPassword',
//                'repeated',
//                array(
//                    'type' => 'password',
//                    'first_options' => array('label' => 'password'),
//                    'second_options' => array('label' => 'password_confirmation'),
//                    'invalid_message' => 'fos_user.password.mismatch',
//                )
//            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ProjectSilly\UserBundle\Entity\User',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user_type';
    }
}
