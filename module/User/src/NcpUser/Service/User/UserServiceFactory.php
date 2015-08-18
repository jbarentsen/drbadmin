<?php

namespace User\Service\User;

use Doctrine\ORM\EntityManager;
use NcpBase\Hydrator\Model\BaseHydrator;
use User\Repository\UserRepository;
use User\Service\UserService;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\HydratorPluginManager;

class UserServiceFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return UserService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        /** @var UserRepository $userRepository */
        $userRepository = $serviceLocator->get('User\Repository\User');

        /** @var AuthenticationService $authenticationService */
        $authenticationService = $serviceLocator->get('zfcuser_auth_service');

        /** @var EntityManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        /** @var HydratorPluginManager $hydratorPluginManager */
        $hydratorPluginManager = $serviceLocator->get('hydratormanager');

        /** @var BaseHydrator $baseHydrator */
        $baseHydrator = $hydratorPluginManager->get('NcpBase\Hydrator\Model\Base');

        return new UserService(
            $userRepository,
            $authenticationService,
            $entityManager,
            $baseHydrator
        );
    }
}
