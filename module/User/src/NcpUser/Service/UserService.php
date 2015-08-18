<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use Dws\Exception\RepositoryException;
use Dws\Exception\Service\InvalidInputException;
use Dws\Exception\Service\ModelNotFoundException;
use Dws\Exception\Service\UnauthenticatedException;
use Dws\Exception\Service\UnauthorizedException;
use Dws\Exception\ServiceException;
use Dws\Zend\InputFilter\InputFilter;
use NcpBase\Hydrator\Model\BaseHydrator;
use User\InputFilter\User\UserPopulateInputFilter;
use User\InputFilter\UserCreateInputFilter;
use User\Model\User;
use User\Repository\UserRepository;
use stdClass;
use Traversable;
use Zend\Authentication\AuthenticationService;

class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var BaseHydrator
     */
    private $baseHydrator;

    /*
     * @var UserCreateInputFilter
     */
    private $createInputFilter;

    /*
     * @var UserPopulateInputFilter
     */
    private $populateInputFilter;

    /**
     * @param UserRepository $userRepository
     * @param AuthenticationService $authenticationService
     * @param EntityManager $entityManager
     * @param BaseHydrator $baseHydrator
     */
    public function __construct(
        UserRepository $userRepository,
        AuthenticationService $authenticationService,
        EntityManager $entityManager,
        BaseHydrator $baseHydrator
    ) {
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
        $this->entityManager = $entityManager;
        $this->baseHydrator = $baseHydrator;
    }

    /**
     * Find match format by id
     *
     * @param $id
     * @return User
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     */
    public function find($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);
        if ($user === null) {
            throw new ModelNotFoundException(
                sprintf('User with identifier %d not found', $id)
            );
        }

        return $user;
    }

    /**
     * Find user by username
     *
     * @param $id
     * @return User
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     */
    public function findOneByUsername($id)
    {
        /** @var User $user */
        $user = $this->userRepository->findOneByUsername($id);
        if ($user === null) {
            throw new ModelNotFoundException(
                sprintf('User with username %d not found', $id)
            );
        }

        return $user;
    }

    /**
     * Find user by email address
     *
     * @param $id
     * @return User
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     */
    public function findOneByEmail($id)
    {
        /** @var User $user */
        $user = $this->userRepository->findOneByEmail($id);
        if ($user === null) {
            throw new ModelNotFoundException(
                sprintf('User with email address %d not found', $id)
            );
        }

        return $user;
    }

    /**
     * @return User
     * @throws UnauthenticatedException
     */
    public function getAuthenticatedUser()
    {
        if (!$this->authenticationService->hasIdentity()) {
            throw new UnauthenticatedException('Not authenticated');
        }
        return $this->authenticationService->getIdentity();
    }

    /**
     * @param array|Traversable|stdClass $data
     * @return User
     * @throws InvalidInputException
     * @throws ServiceException
     */
    public function create($data)
    {
        /** @var InputFilter $inputFilter */
        $inputFilter = $this->getCreateInputFilter($data);
        if (!$inputFilter->isValid()) {
            throw new InvalidInputException(
                'Unable to create user because of invalid input',
                0,
                null,
                $inputFilter->getMessages()
            );
        }

        return $this->baseHydrator->hydrate($inputFilter->getValues(), new User());
    }

    /**
     * @param array|Traversable|stdClass|null $data
     * @return UserCreateInputFilter
     */
    private function getCreateInputFilter($data)
    {
        if (!$this->createInputFilter) {
            $this->createInputFilter = new UserCreateInputFilter(
                $this
            );
        }
        return $this->createInputFilter->setData($data);
    }

    /**
     * @param array|Traversable|stdClass $data
     * @return User
     * @throws ModelNotFoundException
     * @throws UnauthorizedException
     * @throws ServiceException
     */
    public function populate($data)
    {
        /** @var InputFilter $inputFilter */
        $inputFilter = $this->getPopulateInputFilter($data);
        if (!$inputFilter->isValid()) {
            throw new InvalidInputException(
                'Unable to update user because of invalid input',
                0,
                null,
                $inputFilter->getMessages()
            );
        }

        return $this->baseHydrator->hydrate($inputFilter->getValues(), $this->userRepository->find($inputFilter->getValue('id')));
    }

    /**
     * @param array|Traversable|stdClass|null $data
     * @return UserPopulateInputFilter
     */
    private function getPopulateInputFilter($data = [])
    {
        if (!$this->populateInputFilter) {
            $this->populateInputFilter = new UserPopulateInputFilter(
                $this
            );
        }
        return $this->populateInputFilter->setData($data);
    }

    /**
     * @param User $user
     * @throws ServiceException
     * @return User
     */
    public function persist(User $user)
    {
        try {
            return $this->userRepository->persist($user);
        } catch (RepositoryException $e) {
            throw new ServiceException('Failed to persist user', 0, $e);
        }
    }

}
