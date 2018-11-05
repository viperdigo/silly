<?php

namespace ProjectSilly\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use ProjectSilly\UserBundle\Entity\User;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;


class LoadUser extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {

        $adminType = $this->getReference('administrator');
        $supervisorType = $this->getReference('administrator');
        $operatorType = $this->getReference('administrator');

        // Adiciona Administradores
        $admin = new User();
        $admin->setUsername('rodrigo');
        $admin->setPlainPassword('hseDP09zP');
        $admin->setIsActive(true);
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setEmail('viperdigo@gmail.com');
        $admin->setName('Rodrigo Alfieri');
        $admin->setUserType($adminType);
        $manager->persist($admin);

        $admin = new User();
        $admin->setUsername('wilian');
        $admin->setPlainPassword('@12345#');
        $admin->setIsActive(true);
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setEmail('rh@plentypark.com.br');
        $admin->setName('Wilian');
        $admin->setUserType($adminType);
        $manager->persist($admin);

        // Adiciona Supervisores
//        $sup = new User();
//        $sup->setUsername('rodrigo');
//        $sup->setPlainPassword('hseDP09zP');
//        $sup->setIsActive(true);
//        $sup->setRoles(array('ROLE_ADMIN'));
//        $sup->setEmail('viperdigo@gmail.com');
//        $sup->setName('Rodrigo Alfieri');
//        $sup->setUserType($supervisorType);
//        $manager->persist($sup);

        $manager->flush();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}