<?php
return array(
    'router' => array(
        'routes' => array(
            'country.rest.country' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/country[/:country_id]',
                    'defaults' => array(
                        'controller' => 'Country\\V1\\Rest\\Country\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(),
    'view_manager' => array(),
    'doctrine' => array(
        'driver' => array(
            'Country_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    0 => __DIR__ . '/../src/Country/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Country\\Entity' => 'Country_driver',
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Country\\V1\\Rest\\Country\\CountryResource' => 'Country\\V1\\Rest\\Country\\CountryResourceFactory',
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'country.rest.country',
        ),
    ),
    'zf-rest' => array(
        'Country\\V1\\Rest\\Country\\Controller' => array(
            'listener' => 'Country\\V1\\Rest\\Country\\CountryResource',
            'route_name' => 'country.rest.country',
            'route_identifier_name' => 'country_id',
            'collection_name' => 'country',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Country\\Entity\\Country',
            'collection_class' => 'Country\\V1\\Rest\\Country\\CountryCollection',
            'service_name' => 'Country',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Country\\V1\\Rest\\Country\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Country\\V1\\Rest\\Country\\Controller' => array(
                0 => 'application/vnd.country.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Country\\V1\\Rest\\Country\\Controller' => array(
                0 => 'application/vnd.country.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Country\\Model\\Country' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'country.rest.country',
                'route_identifier_name' => 'country_id',
                'hydrator' => 'Country\\Hydrator\\Model\\Country',
            ),
            'Country\\V1\\Rest\\Country\\CountryEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'country.rest.country',
                'route_identifier_name' => 'country_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Country\\V1\\Rest\\Country\\CountryCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'country.rest.country',
                'route_identifier_name' => 'country_id',
                'is_collection' => true,
            ),
            'Country\\Entity\\Country' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'country.rest.country',
                'route_identifier_name' => 'country_id',
                'hydrator' => 'Country\\Hydrator\\Model\\Country',
            ),
        ),
    ),
);
