<?php

namespace JBIT\Service;

use Country\Entity\Country;

class ResourcePermissionService
{
    /**
    * Constructor
    *
    */
    public function __construct()
    {
    }

    public function isAllowedToCountry(Country $country = null, $privilegeName = null) {
        return true;
    }
}