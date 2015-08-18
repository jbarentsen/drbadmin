<?php

namespace User\Repository\User;

use User\Repository\UserRepository;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserRepositoryFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return UserRepository
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('User\Model\User');
    }
}
