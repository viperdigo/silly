<?php

namespace ProjectSilly\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserProviderInterface
{

    public function findOneByUsernameOrPassword($user){
        return $this->createQueryBuilder("u")
            ->where("u.username = :username or u.email = :email")
            ->setParameter("username",$user)
            ->setParameter("email",$user)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @see UsernameNotFoundException
     *
     * @throws UsernameNotFoundException if the user is not found
     *
     */
    public function loadUserByUsername($username)
    {
        $user   =   $this->findOneByUsernameOrPassword($username);
        if(!$user){
            throw new UsernameNotFoundException("Usuário não encontrado {$username}");
        }

        return $user;
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        $class  =   get_class($user);
        if(!$this->supportsClass($class)){
            throw new UnsupportedUserException("Erro classe não suportada: {$class}");
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Whether this provider supports the given user class
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $this->getEntityName()   ==  $class;
    }

}
