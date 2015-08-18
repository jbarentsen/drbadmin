<?php

namespace Country\Repository;

use Country\Entity\Country;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Exception;
use InvalidArgumentException;
use JBIT\Repository\AbstractRepository;

class CountryRepository extends AbstractRepository
{

    /**
     * @var string ModelClassName
     */
    protected $modelClassName = 'Country\Entity\Country';

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
            var_dump($e->getMessage());
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

    /**
     * Get paginator for items
     *
     * @return DoctrinePaginator
     */
    public function findAllPaged()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from($this->getClassName(), 'u')
            ->orderBy('u.name');

        return $this->getPaginator($qb->getQuery());
    }

}

