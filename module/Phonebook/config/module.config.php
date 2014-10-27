<?php
return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'contact-generate' => array(
                    'options' => array(
                        'route' => 'contact generate [<number>]',
                        'defaults' => array(
                            'controller' => 'Phonebook\Controller\Contact',
                            'action'     => 'generate',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Phonebook\Controller\Index' => 'Phonebook\Controller\IndexController',
        ),
        'factories' => array(
            'Phonebook\Controller\Contact' => 'Phonebook\Factory\ContactControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'phonebook' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/phonebook',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Phonebook\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'contact' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/contacts[/:action][/:id]',
                            'defaults' => array(
                                'controller' => 'Contact',
                                'action' => 'index',
                            ),
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Phonebook\Model\ContactTable' => 'Phonebook\Factory\ContactTableFactory',
            'Phonebook\Model\ContactResultSet' => 'Phonebook\Factory\ContactResultSetFactory',
            'Phonebook\Service\Contact' => 'Phonebook\Factory\ContactServiceFactory',
        ),
    ),
    'input_filters' => array(
        'invokables' => array(
            'Phonebook\Form\ContactFilter' => 'Phonebook\Form\ContactInputFilter',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Phonebook' => __DIR__ . '/../view',
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
            'Phonebook\Form\Search' => 'Phonebook\Form\Search',
        ),
        'factories' => array(
            'Phonebook\Form\Contact' => 'Phonebook\Factory\ContactFormFactory',
        ),
    ),
);
