<?php

namespace Country\Service\Country;


use Country\Repository\CountryRepository;
use Country\Hydrator\Model\CountryHydrator;
use Country\Service\CountryService;
use JBIT\Exception;
use JBIT\Service\ResourcePermissionService;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\HydratorPluginManager;

class CountryServiceFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CountryService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {

            /** @var CountryRepository $countryRepository */
            $countryRepository = $serviceLocator->get('Country\Repository\Country');

            /** @var  ResourcePermissionService $resourcePermissionService */
            $resourcePermissionService = $serviceLocator->get('JBIT\Service\ResourcePermissionService');

            /** @var HydratorPluginManager $hydratorPluginManager */
            $hydratorPluginManager = $serviceLocator->get('hydratormanager');

            /** @var CountryHydrator $countryHydrator */
            $countryHydrator = $hydratorPluginManager->get('Country\Hydrator\Model\Country');
        return new CountryService(
            $countryRepository,
            $resourcePermissionService,
            $countryHydrator
        );
    }
}