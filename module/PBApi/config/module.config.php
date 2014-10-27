<?php
return array(
    'router' => array(
        'routes' => array(
            'pb-api.rest.contact' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/contacts[/:contact_id]',
                    'defaults' => array(
                        'controller' => 'PBApi\\V1\\Rest\\Contact\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'pb-api.rest.contact',
        ),
    ),
    'zf-rest' => array(
        'PBApi\\V1\\Rest\\Contact\\Controller' => array(
            'listener' => 'PBApi\\V1\\Rest\\Contact\\ContactResource',
            'route_name' => 'pb-api.rest.contact',
            'route_identifier_name' => 'contact_id',
            'collection_name' => 'contacts',
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
            'page_size' => '10',
            'page_size_param' => 'limit',
            'entity_class' => 'Phonebook\\Entity\\Contact',
            'collection_class' => 'PBApi\\V1\\Rest\\Contact\\ContactCollection',
            'service_name' => 'contact',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'PBApi\\V1\\Rest\\Contact\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'PBApi\\V1\\Rest\\Contact\\Controller' => array(
                0 => 'application/vnd.pb-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'PBApi\\V1\\Rest\\Contact\\Controller' => array(
                0 => 'application/vnd.pb-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'PBApi\\V1\\Rest\\Contact\\ContactEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'pb-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'PBApi\\V1\\Rest\\Contact\\ContactCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'pb-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'is_collection' => true,
            ),
            'Phonebook\\Entity\\Contact' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'pb-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
        ),
    ),
    'zf-apigility' => array(
        'db-connected' => array(
            'PBApi\\V1\\Rest\\Contact\\ContactResource' => array(
                'adapter_name' => 'DB\\Phonebook',
                'table_name' => 'contact',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'PBApi\\V1\\Rest\\Contact\\Controller',
                'entity_identifier_name' => 'id',
                'table_service' => 'PBApi\\V1\\Rest\\Contact\\ContactResource\\Table',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'PBApi\\V1\\Rest\\Contact\\Controller' => array(
            'input_filter' => 'Phonebook\Form\ContactFilter',
        ),
    ),
);
