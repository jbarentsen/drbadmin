<?php

namespace Country\Service;
use Country\Entity\Country;
use Country\Hydrator\Model\CountryHydrator;
use Country\InputFilter\CountryInputFilter;
use Country\Repository\CountryRepository;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use JBIT\Exception\RepositoryException;
use JBIT\Exception\Service\InvalidInputException;
use JBIT\Exception\Service\ModelNotFoundException;
use JBIT\Exception\Service\UnauthorizedException;
use JBIT\Exception\ServiceException;
use JBIT\Service\ResourcePermissionService;
use JBIT\Utils;

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
    private $countryHydrator;

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
     * @throws InvalidInputException
     */
    public function create($data)
    {
        /** @var CountryInputFilter $inputFilter */
        $inputFilter = $this->getInputFilter($data);
        if (!$inputFilter->isValid()) {
            throw new InvalidInputException(
                'Unable to create country because of invalid input',
                0,
                null,
                $inputFilter->getMessages()
            );
        }

        return $this->countryHydrator->hydrate($inputFilter->getValues(), new Country());
    }

    /**
     * @param array|Traversable|stdClass|null $data
     * @return CountryInputFilter
     */
    private function getInputFilter($data = [])
    {
        if (!$this->inputFilter) {
            $this->inputFilter = new CountryInputFilter(
                $this->countryRepository
            );
        }
        return $this->inputFilter->setData((array)$data);
    }

    /**
     * @param array|Traversable|stdClass $data
     * @return Country
     * @throws InvalidInputException
     * @throws UnauthorizedException
     */
    public function populate($data)
    {
        /** @var  $inputFilter */
        $inputFilter = $this->getInputFilter($data);

        if (!$inputFilter->isValid()) {
            throw new InvalidInputException(
                'Unable to update country because of invalid input',
                0,
                null,
                $inputFilter->getMessages()
            );
        }

        /** @var Country $country */
        $country = $this->countryHydrator->hydrate(
                $inputFilter->getValues(),
                $this->countryRepository->find($inputFilter->getValue('id'))
        );

        if (!$this->resourcePermissionService->isAllowedToCountry($country, 'update')) {
            throw new UnauthorizedException(
                sprintf('Not authorized to update country with identifier %d', $country->getId())
            );
        }
print get_class($country);die;
        return $country;
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
            var_dump($e->getTraceAsString());die;
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

        if (!$this->resourcePermissionService->isAllowedToCountry($country, 'delete')) {
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