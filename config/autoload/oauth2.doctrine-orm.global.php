<?php

/**
 * The user entity is always stored in another namespace than ZF\OAuth2
 */
$userEntity = 'NcpUser\Model\User';

return [
    'zf-oauth2-doctrine' => [
        'storage' => 'ZF\OAuth2\Doctrine\Adapter\Doctrine2Adapter',
        'storage_settings' => [
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'event_manager' => 'doctrine.eventmanager.orm_default',
            'driver' => 'doctrine.driver.orm_default',
            'enable_default_entities' => false,
            'bcrypt_cost' => 14, # match zfcuser
            // Dynamically map the user_entity to the client_entity

            'dynamic_mapping' => [
                'user_entity' => [
                    'entity' => $userEntity,
                    'field' => 'user',
                ],
                'client_entity' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                    'field' => 'client',
                ],
                'access_token_entity' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\AccessToken',
                    'field' => 'accessToken',
                ],
                'authorization_code_entity' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\AuthorizationCode',
                    'field' => 'authorizationCode',
                ],
                'refresh_token_entity' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\RefreshToken',
                    'field' => 'refreshToken',
                ],
            ],
            'mapping' => [
                'ZF\OAuth2\Doctrine\Mapper\User' => [
                    'entity' => $userEntity,
                    'mapping' => [
                        'user_id' => [
                            'type' => 'field',
                            'name' => 'id',
                            'datatype' => 'integer',
                        ],
                        'username' => [
                            'type' => 'field',
                            'name' => 'username',
                            'datatype' => 'string',
                        ],
                        'password' => [
                            'type' => 'field',
                            'name' => 'password',
                            'datatype' => 'string',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\Client' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                    'mapping' => [
                        'client_id' => [
                            'type' => 'field',
                            'name' => 'clientId',
                            'datatype' => 'integer',
                        ],
                        'client_secret' => [
                            'type' => 'field',
                            'name' => 'secret',
                            'datatype' => 'string',
                        ],
                        'redirect_uri' => [
                            'type' => 'field',
                            'name' => 'redirectUri',
                            'datatype' => 'text',
                        ],
                        'grant_types' => [
                            'type' => 'field',
                            'name' => 'grantType',
                            'datatype' => 'array',
                        ],
                        'scope' => [
                            'type' => 'collection',
                            'name' => 'scope',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Scope',
                            'mapper' => 'ZF\OAuth2\Doctrine\Mapper\Scope',
                        ],
                        'user_id' => [
                            'type' => 'relation',
                            'name' => 'user',
                            'entity_field_name' => 'id',
                            'entity' => $userEntity,
                            'datatype' => 'integer',
                            'allow_null' => true,
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\AccessToken' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\AccessToken',
                    'mapping' => [
                        'access_token' => [
                            'type' => 'field',
                            'name' => 'accessToken',
                            'datatype' => 'string',
                        ],
                        'expires' => [
                            'type' => 'field',
                            'name' => 'expires',
                            'datatype' => 'datetime',
                        ],
                        'scope' => [
                            'type' => 'collection',
                            'name' => 'scope',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Scope',
                            'mapper' => 'ZF\OAuth2\Doctrine\Mapper\Scope',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                        'user_id' => [
                            'type' => 'relation',
                            'name' => 'user',
                            'entity_field_name' => 'id',
                            'entity' => $userEntity,
                            'datatype' => 'integer',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\RefreshToken' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\RefreshToken',
                    'mapping' => [
                        'refresh_token' => [
                            'type' => 'field',
                            'name' => 'refreshToken',
                            'datatype' => 'string',
                        ],
                        'expires' => [
                            'type' => 'field',
                            'name' => 'expires',
                            'datatype' => 'datetime',
                        ],
                        'scope' => [
                            'type' => 'collection',
                            'name' => 'scope',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Scope',
                            'mapper' => 'ZF\OAuth2\Doctrine\Mapper\Scope',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                        'user_id' => [
                            'type' => 'relation',
                            'name' => 'user',
                            'entity_field_name' => 'id',
                            'entity' => $userEntity,
                            'datatype' => 'integer',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\AuthorizationCode' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\AuthorizationCode',
                    'mapping' => [
                        'authorization_code' => [
                            'type' => 'field',
                            'name' => 'authorizationCode',
                            'datatype' => 'string',
                        ],
                        'redirect_uri' => [
                            'type' => 'field',
                            'name' => 'redirectUri',
                            'datatype' => 'text',
                        ],
                        'expires' => [
                            'type' => 'field',
                            'name' => 'expires',
                            'datatype' => 'datetime',
                        ],
                        'scope' => [
                            'type' => 'collection',
                            'name' => 'scope',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Scope',
                            'mapper' => 'ZF\OAuth2\Doctrine\Mapper\Scope',
                        ],
                        'id_token' => [
                            'type' => 'field',
                            'name' => 'idToken',
                            'datatype' => 'text',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                        'user_id' => [
                            'type' => 'relation',
                            'name' => 'user',
                            'entity_field_name' => 'id',
                            'entity' => $userEntity,
                            'datatype' => 'integer',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\Jwt' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\Jwt',
                    'mapping' => [
                        'subject' => [
                            'type' => 'field',
                            'name' => 'subject',
                            'datatype' => 'string',
                        ],
                        'public_key' => [
                            'type' => 'field',
                            'name' => 'publicKey',
                            'datatype' => 'text',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\Jti' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\Jti',
                    'mapping' => [
                        'subject' => [
                            'type' => 'field',
                            'name' => 'subject',
                            'datatype' => 'string',
                        ],
                        'audience' => [
                            'type' => 'field',
                            'name' => 'audience',
                            'datatype' => 'string',
                        ],
                        'expiration' => [
                            'type' => 'field',
                            'name' => 'expires',
                            'datatype' => 'datetime',
                        ],
                        'jti' => [
                            'type' => 'field',
                            'name' => 'jti',
                            'datatype' => 'text',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\Scope' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\Scope',
                    'mapping' => [
                        'scope' => [
                            'type' => 'field',
                            'name' => 'scope',
                            'datatype' => 'text',
                        ],
                        'is_default' => [
                            'type' => 'field',
                            'name' => 'isDefault',
                            'datatype' => 'boolean',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                    ],
                ],
                'ZF\OAuth2\Doctrine\Mapper\PublicKey' => [
                    'entity' => 'ZF\OAuth2\Doctrine\Entity\PublicKey',
                    'mapping' => [
                        'public_key' => [
                            'type' => 'field',
                            'name' => 'publicKey',
                            'datatype' => 'text',
                        ],
                        'private_key' => [
                            'type' => 'field',
                            'name' => 'privateKey',
                            'datatype' => 'text',
                        ],
                        'encryption_algorithm' => [
                            'type' => 'field',
                            'name' => 'encryptionAlgorithm',
                            'datatype' => 'string',
                        ],
                        'client_id' => [
                            'type' => 'relation',
                            'name' => 'client',
                            'entity_field_name' => 'clientId',
                            'entity' => 'ZF\OAuth2\Doctrine\Entity\Client',
                            'datatype' => 'integer',
                        ],
                    ],
                ],
            ],

        ],
    ],
];