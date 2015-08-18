<?php

namespace User\InputFilter\User;

use Dws\Exception\Service\ModelNotFoundException;
use Dws\Exception\Service\UnauthorizedException;
use Exception;
use NcpOrganisation\Model\Organisation;
use User\InputFilter\UserCreateInputFilter;
use User\Model\User;
use User\Service\UserService;
use Zend\Validator\Callback;

class UserPopulateInputFilter extends UserCreateInputFilter
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var Callback
     */
    private $userValidator;

    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    )
    {
        parent::__construct($userService);

        $this->userService = $userService;

        $this->add(
            [
                'name' => 'id',
                'filters' => [
                    [
                        'name' => 'Digits'
                    ],
                ],
                'validators' => [
                    $this->getUserValidator()
                ],
            ]
        );
    }

    private function getUserValidator()
    {
        if (empty($this->userValidator)) {
            $this->userValidator = new Callback(function ($value) {
                if ($value instanceof User) {
                    return true;
                } else if (!(is_array($value) && isset($value['id']))) {
                    $this->userValidator->setMessage('No valid identifier specified');
                    return false;
                }

                try {
                    $this->userService->find($value);
                    return true;
                } catch (ModelNotFoundException $e) {
                    $this->userValidator->setMessage($e->getMessage());
                } catch (UnauthorizedException $e) {
                    $this->userValidator->setMessage($e->getMessage());
                } catch (Exception $e) {
                    $this->userValidator->setMessage('Unknown error during validation');
                }
                return false;
            });
        }
        return $this->userValidator;
    }
}
