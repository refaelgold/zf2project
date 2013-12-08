<?php


namespace Website;
return array(

    'controllers' => array(
        'invokables' => array(
            'Website\Controller\Website' => 'Website\Controller\WebsiteController',
        ),
    ),


    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'Website' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),







    'view_manager' => array(
        'template_map' => array(
            'website/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
        ),
        'template_path_stack' => array(
            'website' => __DIR__ . '/../view',
        ),
        'layout' => 'website/layout',
        'display_exceptions' => true,
        'exception_template' => 'error/index',
        'display_not_found_reason' => true,
        'not_found_template'       => 'error/404',
    ),





//Doctrine configuration
//must define namespace
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),






);