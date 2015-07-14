<?php

namespace Country\Repository;

use Country\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Exception;
use InvalidArgumentException;

class CountryRepository extends EntityRepository
{
    /**
     * @var string ModelClassName
     */
    protected $modelClassName = 'Country\Model\Country';

    /**
     * @param Country $country
     * @return Country
     * @throws InvalidArgumentException
     */
    public function persist(Country $country)
    {
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($country);
            $entityManager->flush();
            return $country;
        } catch (Exception $e) {
            throw new InvalidArgumentException(
                sprintf('Failed to persist country with identifier %d', $country->getId()),
                0,
                $e
            );
        }
    }

    /**
     * @param Country $country
     * @throws InvalidArgumentException
     */
    public function delete(Country $country)
    {
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->remove($country);
            $entityManager->flush();
        } catch (Exception $e) {
            throw new InvalidArgumentException(
                sprintf('Failed to remove country with identifier %d', $country->getId()),
                0,
                $e
            );
        }
    }

}

