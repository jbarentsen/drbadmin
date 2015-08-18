<?php

namespace Country\Hydrator\Model\Country;

use Country\Hydrator\Model\CountryHydrator;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\HydratorPluginManager;

/**
 * Class CountryHydratorFactory
 * @package Country\Hydrator\Model\Country
 */
class CountryHydratorFactory
{
    /**
     * @param HydratorPluginManager $hydratorPluginManager
     * @return CountryHydrator
     */
    public function __invoke(HydratorPluginManager $hydratorPluginManager)
    {
        try {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $hydratorPluginManager->getServiceLocator();

        /** @var ObjectManager $objectManager */
        $objectManager = $serviceManager->get('doctrine.entitymanager.ormdefault');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return new CountryHydrator(
            $objectManager
        );
    }
}