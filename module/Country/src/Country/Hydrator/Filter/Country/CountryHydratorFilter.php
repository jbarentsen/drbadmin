<?php

namespace Country\Hydrator\Filter\Country;

use JBIT\Hydrator\Model\Base\BaseHydrator;


class CountryHydratorFilter extends BaseHydrator
{
    /**
     * Should return true, if the given filter
     * does not match
     *
     * @param string $property The name of the property
     * @return bool
     */
    public function filter($property)
    {
        return true;
    }
}