<?php

namespace Country\Repository\Country;

use Zend\ServiceManager\ServiceLocatorInterface;
use Country\Repository\CountryRepository;

class CountryRepositoryFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CountryRepository
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('Country\Model\Country');
    }
}