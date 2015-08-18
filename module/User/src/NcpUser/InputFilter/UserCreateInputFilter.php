<?php

namespace User\InputFilter;

use Dws\Exception\Service\ModelNotFoundException;
use Dws\Zend\InputFilter\InputFilter;
use Exception;
use User\Service\UserService;
use Zend\Validator\Callback;

class UserCreateInputFilter extends InputFilter
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var Callback
     */
    private $usernameValidator;

    /**
     * @var Callback
     */
    private $emailValidator;

    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;

        $this->usernameValidator = new Callback(function($value) {
            try {
                $this->userService->findOneByUsername($value);
                $this->usernameValidator->setMessage(sprintf('Username "%s" already exists', $value));
                return false;
            } catch (ModelNotFoundException $e) {
                return true;
            } catch (Exception $e) {
                $this->usernameValidator->setMessage('Unknown error during validation');
                return false;
            }
        });
        $this->add(
            [
                'name' => 'username',
                'validators' => [
                    $this->usernameValidator
                ]
            ]
        )

        ->add(
            [
                'name' => 'password',
                'filters' => [
                    [
                        'name' => 'StripTags'
                    ],
                    [
                        'name' => 'StringTrim'
                    ],
                ],
            ]
        )
        ->add(
            [
                'name' => 'first_name',
                'filters' => [
                    [
                        'name' => 'StripTags'
                    ],
                    [
                        'name' => 'StringTrim'
                    ],
                ],
            ]
        )
        ->add(
            [
                'name' => 'last_name',
                'filters' => [
                    [
                        'name' => 'StripTags'
                    ],
                    [
                        'name' => 'StringTrim'
                    ],
                ],
            ]
        )
        ->add(
            [
                'name' => 'display_name',
                'filters' => [
                    [
                        'name' => 'StripTags'
                    ],
                    [
                        'name' => 'StringTrim'
                    ],
                ],
            ]
        );

        $this->emailValidator = new Callback(function($value) {
            try {
                $this->userService->findOneByEmail($value);
                $this->emailValidator->setMessage(sprintf('Email address "%s" already exists', $value));
                return false;
            } catch (ModelNotFoundException $e) {
                return true;
            } catch (Exception $e) {
                $this->emailValidator->setMessage('Unknown error during validation');
                return false;
            }
        });
        $this->add(
            [
                'name' => 'email',
                'validators' => [
                    [
                        'name' => 'EmailAddress'
                    ],
                    $this->emailValidator
                ]
            ]
        )
        ->add(
            [
                'name' => 'date_of_birth',
                'validators' => [
                    [
                        'name' => 'Date',
                        'options' => [
                            'locale' => 'en',
                            'format' => 'Y-m-d',
                        ],
                    ]
                ],
            ]
        );
    }
}
