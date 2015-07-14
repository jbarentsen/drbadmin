<?php

use Country\Entity\Country;
use Country\Repository\CountryRepository;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;

class CountryService
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @var ResourcePermissionService
     */
    private $resourcePermissionService;

    /**
     * @var CountryHydrator
     */
    private $facilityHydrator;

    /**
     * @var CountryInputFilter
     */
    private $inputFilter;

    /**
     * @param CountryRepository $countryRepository
     * @param ResourcePermissionService $resourcePermissionService
     * @param CountryHydrator $countryHydrator
     */
    public function __construct(
        CountryRepository $countryRepository,
        ResourcePermissionService $resourcePermissionService,
        CountryHydrator $countryHydrator
    ) {
        $this->countryRepository = $countryRepository;
        $this->resourcePermissionService = $resourcePermissionService;
        $this->countryHydrator = $countryHydrator;
    }

    /**
     * Find country by id
     *
     * @param $id
     * @return Country
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     */
    public function find($id)
    {
        /** @var Country $country */
        $country = $this->countryRepository->find($id);
        if ($country === null) {
            throw new ModelNotFoundException(
                sprintf('Country with identifier %d not found', $id)
            );
        }

        if (!$this->resourcePermissionService->isAllowedToCountry($country, 'read')) {
            throw new UnauthorizedException(
                sprintf('Not authorized to read country with identifier %d', $country->getId())
            );
        }
        return $country;
    }

    /**
     * @return DoctrinePaginator
     */
    public function findAllPaged()
    {
        return $this->countryRepository->findAllPaged();
    }

    /**
     * @param array|Traversable|stdClass $data
     * @return Country
     * @throws InvalidArgumentException
     * @throws ServiceException
     */
    public function create($data)
    {
        /** @var CountryInputFilter $inputFilter */
        $inputFilter = $this->getCreateInputFilter($data);
        if (!$inputFilter->isValid()) {
            throw new InvalidInputException(
                'Unable to create country because of invalid input',
                0,
                null,
                $inputFilter->getMessages()
            );
        }

        return $this->facilityHydrator->hydrate($inputFilter->getValues(), new Country());
    }

    /**
     * @param array|Traversable|stdClass|null $data
     * @return CountryInputFilter
     */
    private function getCreateInputFilter($data = [])
    {
        if (!$this->inputFilter) {
            $this->createInputFilter = new CountryInputFilter(
                $this->countryRepository
            );
        }
        return $this->inputFilter->setData($data);
    }

    /**
     * @param array|Traversable|stdClass $data
     * @return Country
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     * @throws ServiceException
     */
    public function populate($data)
    {
        /** @var  $inputFilter */
        $inputFilter = $this->getPopulateInputFilter($data);

        if (!$inputFilter->isValid()) {
            throw new InvalidInputException(
                'Unable to update country because of invalid input',
                0,
                null,
                $inputFilter->getMessages()
            );
        }

        /** @var Country $country */
        $country = $this->facilityHydrator->hydrate($inputFilter->getValues(), $this->countryRepository->find($inputFilter->getValue('id')));

        if (!$this->resourcePermissionService->isAllowedToCountry($country, 'update')) {
            throw new UnauthorizedException(
                sprintf('Not authorized to update country with identifier %d', $country->getId())
            );
        }

        return $country;
    }

    /**
     * @param array|Traversable|stdClass|null $data
     * @return CountryInputFilter
     */
    private function getPopulateInputFilter($data = [])
    {
        if (!$this->inputFilter) {
            $this->populateInputFilter = new CountryInputFilter(
                $this->countryRepository
            );
        }
        return $this->populateInputFilter->setData($data);
    }

    /**
     * @param Country $country
     * @throws ServiceException
     * @return Country
     */
    public function persist(Country $country)
    {
        try {
            return $this->countryRepository->persist($country);
        } catch (RepositoryException $e) {
            throw new ServiceException('Failed to persist country', 0, $e);
        }
    }

    /**
     * @param integer $id
     * @return bool
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     * @throws ServiceException
     */
    public function delete($id)
    {
        $country = $this->find($id);

        if (!$this->resourcePermissionService->isAllowedToFacility($country, 'delete')) {
            throw new UnauthorizedException(
                sprintf('Not authorized to delete country with identifier %d', $country->getId())
            );
        }

        try {
            $this->countryRepository->delete($country);
            return true;
        } catch (RepositoryException $e) {
            throw new ServiceException(
                sprintf('Failed to delete country with identifier %d', $country->getId()),
                0,
                $e
            );
        }
    }

}