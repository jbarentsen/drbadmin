<?php

namespace User\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Dws\Model\Traits\TimestampableTrait;
use NcpPerson\Model\Person;
use Zend\Crypt\Password\Bcrypt;
use ZfcUser\Entity\UserInterface;
use ZF\OAuth2\Doctrine\Entity\UserInterface as OAuth2UserInterface;

/**
 * User
 *
 * @ORM\Entity(repositoryClass="User\Repository\UserRepository")
 * @ORM\Table(uniqueConstraints={
 *      @ORM\UniqueConstraint(name="unique_username", columns={"username"}),
 *      @ORM\UniqueConstraint(name="unique_email", columns={"email"})
 * })

 */
class User implements UserInterface, OAuth2UserInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableTrait;

    /**
     * Required for Oauth2
     *
     * var string $client
     */
    private $client;

    /**
     * Required for Oauth2
     *
     * var string $client
     */
    private $accessToken;

    /**
     * Required for Oauth2
     *
     * var string $client
     */
    private $authorizationCode;

    /**
     * Required for Oauth2
     *
     * var string $client
     */
    private $refreshToken;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateOfBirth;

    /**
     * Whether the user is activated or not
     *
     * @var int
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $state = self::STATUS_ACTIVE;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $displayName;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="NcpPerson\Model\Person", mappedBy="user")
     */
    private $person;

    /**
     * Request
     *
     * {@inheritdoc}
     *
     * @param  int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username.
     *
     * @param  string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param  string $unencrypted
     * @return User
     */
    public function setPassword($unencrypted)
    {
        $bCrypt = new Bcrypt();
        $bCrypt->setCost(14);
        $this->password = $bCrypt->create($unencrypted);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Set email address
     *
     * @param  string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param DateTime $dateOfBirth
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param  int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param  string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return User
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;
        if ($person->getUser() !== $this) {
            $person->setUser($this);
        }

        return $this;
    }

    /**
     * Required by OAuth2UserInterface
     *
     * {@inheritdoc}
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Required by OAuth2UserInterface
     *
     * {@inheritdoc}
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Required by OAuth2UserInterface
     *
     * {@inheritdoc}
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Required by OAuth2UserInterface
     *
     * {@inheritdoc}
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
