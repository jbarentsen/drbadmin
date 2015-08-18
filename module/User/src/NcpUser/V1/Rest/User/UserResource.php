<?php
namespace User\V1\Rest\User;

use DwsAuth\Adapter\HmacValidationAdapter;
use User\Model\User;
use User\Service\UserService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class UserResource extends AbstractResourceListener
{

    /** @var UserService $userService */
    private $userService;

    /** @var HmacValidationAdapter $hmacValidationAdapter */
    private $hmacValidationAdapter;

    public function __construct(UserService $userService, HmacValidationAdapter $hmacValidationAdapter)
    {
        $this->userService = $userService;
        $this->hmacValidationAdapter = $hmacValidationAdapter;
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = $this->userService->getAuthenticatedUser();

        return [
            'user_id' => $authenticatedUser->getId(),
            'first_name' => $authenticatedUser->getFirstName(),
            'last_name' => $authenticatedUser->getLastName(),
        ];
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return [1,2,3];
    }
}
