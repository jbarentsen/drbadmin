<?php

namespace Country\Service\Country;


use Country\Repository\CountryRepository;
use Country\Hydrator\Model\CountryHydrator;
use NcpPermission\Service\Permission\ResourcePermissionService;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Country\Service\CountryService;

class CountryServiceFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CountryService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        /** @var CountryRepository $fcountryRepository */
        $countryRepository = $serviceLocator->get('Country\Repository\Country');

        /** @var  ResourcePermissionService $resourcePermissionService */
//        $resourcePermissionService = $serviceLocator->get('NcpPermission\Service\Permission\Resource');

        /** @var HydratorPluginManager $hydratorPluginManager */
        $hydratorPluginManager = $serviceLocator->get('hydratormanager');

        /** @var CountryHydrator $countryHydrator */
        $countryHydrator = $hydratorPluginManager->get('Country\Hydrator\Model\Country');

        return new CountryService(
            $countryRepository,
            //$resourcePermissionService,
            $countryHydrator,
        );
    }
}