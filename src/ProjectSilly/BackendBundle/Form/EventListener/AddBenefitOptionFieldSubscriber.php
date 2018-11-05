<?php
namespace ProjectSilly\BackendBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use ProjectSilly\CoreBundle\Entity\Benefit;

class AddBenefitOptionFieldSubscriber implements EventSubscriberInterface
{
//    private $propertyPathToBenefitOption;

//    public function __construct($propertyPathToBenefitOption)
//    {
//        $this->propertyPathToBenefitOption = $propertyPathToBenefitOption;
//    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }

    private function addBenefitOptionForm($form, $benefitId, $benefitOption = null)
    {
        $formOptions = array(
            'class' => 'CoreBundle:Benefit',
            'empty_value' => null,
            'mapped' => false,
            'attr' => array(
                'class' => 'benefit_option_selector',
            ),
            'query_builder' => function (EntityRepository $repository) use ($benefitId) {
                $qb = $repository->createQueryBuilder('b')
                    ->where('b.type = :benefitId')
                    ->setParameter('benefitId', $benefitId);

                return $qb;
            },
        );

        if ($benefitOption) {
            $formOptions['data'] = $benefitOption;
        }

        $form->add('benefitOption', 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::getPropertyAccessor();
        $benefitId = $accessor->getValue($data, 'benefit');
        $this->addBenefitOptionForm($form, $benefitId);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $benefitId = array_key_exists('benefit', $data) ? $data['benefit'] : null;

        $this->addBenefitOptionForm($form, $benefitId);
    }
}