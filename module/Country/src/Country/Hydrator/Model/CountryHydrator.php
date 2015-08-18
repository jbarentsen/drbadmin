<?php

namespace Country\Hydrator\Model;


use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class CountryHydrator extends DoctrineHydrator
{
    /**
     * Constructor
     *
     * @param ObjectManager $objectManager
     * @param bool $byValue
     */
    public function __construct(
        ObjectManager $objectManager,
        $byValue = true
    ) {
        parent::__construct($objectManager, $byValue);

    }
}