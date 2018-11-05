<?php

namespace ProjectSilly\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\EventListener\AuthenticationListener as FOSAuthenticationListener;

/**
 * Class AuthenticationListener
 * @package ProjectSilly\UserBundle\EventListener
 */
class AuthenticationListener extends FOSAuthenticationListener
{
    public static function getSubscribedEvents()
    {
        return array(
//            FOSUserEvents::REGISTRATION_COMPLETED => 'authenticate',
//            FOSUserEvents::REGISTRATION_CONFIRMED => 'authenticate',
//            FOSUserEvents::RESETTING_RESET_COMPLETED => 'authenticate',
        );
    }

}