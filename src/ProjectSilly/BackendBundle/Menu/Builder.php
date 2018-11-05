<?php

namespace ProjectSilly\BackendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function sideBar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'page-sidebar-menu page-sidebar-menu-hover-submenu1');
        $menu->setChildrenAttribute('data-keep-expanded', 'false');
        $menu->setChildrenAttribute('data-auto-scroll', 'true');
        $menu->setChildrenAttribute('data-slide-speed', '200');

        $menu->addChild('Areas')
             ->setAttribute('dropdown', true)
             ->setAttribute('icon', 'icon-globe-alt');
        $menu['Areas']->addChild('New', array('route' => 'area_new'))->setAttribute('icon', 'fa fa-plus');
        $menu['Areas']->addChild('List', array('route' => 'area'))->setAttribute('icon', 'fa fa-search');

        $menu->addChild('PublicPlaces')
             ->setAttribute('dropdown', true)
             ->setAttribute('icon', 'fa fa-truck');
        $menu['PublicPlaces']->addChild('New', array('route' => 'public_place_new'))->setAttribute('icon', 'fa fa-plus');
        $menu['PublicPlaces']->addChild('List', array('route' => 'public_place'))->setAttribute('icon', 'fa fa-search');

        $menu->addChild('Customers')
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-user');
        $menu['Customers']->addChild('New', array('route' => 'customer_new'))->setAttribute('icon', 'fa fa-plus');
        $menu['Customers']->addChild('List', array('route' => 'customer'))->setAttribute('icon', 'fa fa-search');

        $menu->addChild('Materials')
             ->setAttribute('dropdown', true)
             ->setAttribute('icon', 'fa fa-gavel');
        $menu['Materials']->addChild('New', array('route' => 'material_new'))->setAttribute('icon', 'fa fa-plus');
        $menu['Materials']->addChild('List', array('route' => 'material'))->setAttribute('icon', 'fa fa-search');

        $menu->addChild('Users')
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-users');
        $menu['Users']->addChild('New', array('route' => 'user_new'))->setAttribute('icon', 'fa fa-plus');
        $menu['Users']->addChild('List', array('route' => 'user'))->setAttribute('icon', 'fa fa-search');

        return $menu;
    }

}