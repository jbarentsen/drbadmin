<?php

namespace JBIT\Hydrator\Model\Base;



use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\HydratorPluginManager;

class BaseHydratorFactory
{
    /**
     * @param HydratorPluginManager $hydratorPluginManager
     * @return BaseHydrator
     */
    public function __invoke(HydratorPluginManager $hydratorPluginManager)
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $hydratorPluginManager->getServiceLocator();

        /** @var ObjectManager $objectManager */
        $objectManager = $serviceManager->get('doctrine.entitymanager.ormdefault');

        return new BaseHydrator($objectManager);
    }
}