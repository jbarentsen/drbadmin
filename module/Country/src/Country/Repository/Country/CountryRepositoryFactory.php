<?php

namespace Country\Repository\Country;

use Doctrine\ORM\EntityManager;
use JBIT\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use Country\Repository\CountryRepository;

class CountryRepositoryFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CountryRepository
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('Country\Entity\Country');
    }
}