<?php

namespace Country\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JBIT\Entity\Traits\TimestampableTrait;

;

/**
 * Country
 *
 * @ORM\Entity(repositoryClass="Country\Repository\CountryRepository")
 * @ORM\Table(name="Country")
 */
class Country
{
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableTrait;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=false)
     */
    private $lc3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=false)
     */
    private $lc2;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $showInFrontEnd;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Country
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLc3()
    {
        return $this->lc3;
    }

    /**
     * @param string $lc3
     * @return Country
     */
    public function setLc3($lc3)
    {
        $this->lc3 = $lc3;
        return $this;
    }

    /**
     * @return string
     */
    public function getLc2()
    {
        return $this->lc2;
    }

    /**
     * @param string $lc2
     * @return Country
     */
    public function setLc2($lc2)
    {
        $this->lc2 = $lc2;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isShowInFrontEnd()
    {
        return $this->showInFrontEnd;
    }

    /**
     * @param boolean $showInFrontEnd
     * @return Country
     */
    public function setShowInFrontEnd($showInFrontEnd)
    {
        $this->showInFrontEnd = $showInFrontEnd;
        $this->showInFrontEnd = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return Country
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     * @return Country
     */
    public function setModified($modified)
    {
        $this->modified = $modified;;
        return $this;
    }




}
