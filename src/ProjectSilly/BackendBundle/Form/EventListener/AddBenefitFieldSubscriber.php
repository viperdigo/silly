<?php

namespace ProjectSilly\BackendBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddBenefitFieldSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }

    private function addBenefitForm($form, $benefit = null)
    {
        $formOptions = array(
            'class' => 'CoreBundle:Employee',
            'mapped' => false,
            'empty_value' => null,
            'attr' => array(
                'class' => 'benefit_selector',
            ),
        );

        if ($benefit) {
            $formOptions['data'] = $benefit;
        }

        $form->add('benefit', 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::getPropertyAccessor();

//        $benefitOption = $accessor->getValue($data, $this->propertyPathToBenefitOption);

//        $benefit = ($benefitOption) ? $benefitOption->getBenefits : null;
        $benefit = null;

        $this->addBenefitForm($form, $benefit);
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();

        $this->addBenefitForm($form);
    }
}