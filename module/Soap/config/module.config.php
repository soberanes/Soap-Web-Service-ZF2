<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'soap' => 'Soap\Controller\SoapController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'soapserver' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/soapserver',
                    'defaults' => array(
                        'controller' => 'soap',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array( 
                    'soap' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/soap',
                            'defaults' => array(
                                'controller' => 'soap',
                                'action'     => 'soap',
                            ),
                        ),
                    ), 
                    'client' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/client',
                            'defaults' => array(
                                'controller' => 'soap',
                                'action'     => 'clientsoap',
                            ),
                        ),
                    ),                      
                ),
            ),
        ),
    ),
);
