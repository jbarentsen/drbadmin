<?php

namespace Country;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Country\Repository\Country' =>
                    'Country\Repository\Country\CountryRepositoryFactory',

                'Country\Service\Country' =>
                    'Country\Service\Country\CountryServiceFactory',
            ]
        ];
    }

    /**
     * @return array
     */
    public function getHydratorConfig()
    {
        return [
            'factories' => [
                'Country\Hydrator\Model\Country' =>
                    'Country\Hydrator\Model\Country\CountryHydratorFactory',
            ]
        ];
    }

}
