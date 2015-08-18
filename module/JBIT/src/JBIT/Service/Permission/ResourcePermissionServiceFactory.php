<?php

namespace JBIT\Service\Permission;

use JBIT\Service\ResourcePermissionService;
use Zend\ServiceManager\ServiceLocatorInterface;

class ResourcePermissionServiceFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ResourcePermissionService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new ResourcePermissionService(

        );
    }

}