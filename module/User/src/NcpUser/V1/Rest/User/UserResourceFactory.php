<?php
namespace User\V1\Rest\User;

use DwsAuth\Adapter\HmacValidationAdapter;
use User\Service\UserService;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserResourceFactory
{
    /**
     * @param ServiceLocatorInterface $services
     * @return UserResource
     */
    public function __invoke(ServiceLocatorInterface $services)
    {
        /** @var UserService $userService */
        $userService = $services->get('NcpUser\Service\User');

        /**
         * @TODO: For now added here for test purposes only. Perhaps can be removed later.
         * @var HmacValidationAdapter $hmacValidationAdapter
         */
        $hmacValidationAdapter = $services->get('DwsAuth\Adapter\HmacValidationAdapter');

        return new UserResource($userService, $hmacValidationAdapter);
    }
}
