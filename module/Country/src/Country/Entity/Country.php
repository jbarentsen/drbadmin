<?php

namespace Country\Entity;

use Doctrine\ORM\Mapping as ORM;
use JBIT\Entitiy\Traits\TimestampableTrait;

/**
 * Country
 *
 * @ORM\Entity
 * @ORM\Table(name="Country")
 */
class Country
{
    /**
     * Hook timestampable behavior
     * updates created, modifed fields
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
     * @ORM\Column(type="boolean", length=5, nullable=false)
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
        return $this;
    }


}
