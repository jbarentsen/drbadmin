<?php
namespace Country\V1\Rest\Country;

use Country\Service\CountryService;
use Zend\ServiceManager\ServiceLocatorInterface;
use Exception;

class CountryResourceFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CountryResource
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        /** @var CountryService $countryService */
        $countryService = $serviceLocator->get('Country\Service\Country');
        return new CountryResource(
            $countryService
        );
    }
}
