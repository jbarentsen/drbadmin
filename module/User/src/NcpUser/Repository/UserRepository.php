<?php

namespace User\Repository;

use Dws\Exception\InvalidArgumentException;
use DwsBase\Repository\AbstractRepository;
use Exception;
use User\Model\User;

class UserRepository extends AbstractRepository
{
    /**
     * @var string Model name
     */
    protected $modelClassName = 'User\Model\User';

    /**
     * @param $username
     * @return User|null
     */
    public function findOneByUsername($username)
    {
        return $this->findOneBy([
            'username' => $username
        ]);
    }

    /**
     * @param $email
     * @return User|null
     */
    public function findOneByEmail($email)
    {
        return $this->findOneBy([
            'email' => $email
        ]);
    }

    /**
     * @param User $user
     * @return User
     * @throws InvalidArgumentException
     */
    public function persist(User $user)
    {
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $user;
        } catch (Exception $e) {
            throw new InvalidArgumentException(
                sprintf('Failed to persist user with identifier %d', $user->getId()),
                0,
                $e
            );
        }
    }
}
