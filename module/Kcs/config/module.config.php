<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Kcs\Controller\Index' => 'Kcs\Controller\IndexController',
        ),
    ),


    'view_manager' => array(
        'template_path_stack' => array(
            'kcs' => __DIR__ . '/../view',
        ),


        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/Kcs'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),

    ),


    'module_layouts' => array(
        'Kcs' => array(
            'default' => 'layout/Kcs',
        )
    ),



    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/kcs[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Kcs\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),


);