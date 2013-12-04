<?php

namespace SpotOption;
return array(

    'controllers' => array(
        'invokables' => array(
            'Main' => 'SpotOption\Controller\MainController',//give the real path of the files.
            'Rss' => 'SpotOption\Controller\RssController',//give the real path of the files.
            'Customer' => 'SpotOption\Controller\CustomerController',//give the real path of the files.
            'Call' => 'SpotOption\Controller\CallController',//give the real path of the files.
        ),
    ),




    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'SpotOption' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/spot-option/[:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Main',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),






//    in charge to put the manager of the layout
    'view_manager' => array(

        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/SpotOption'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),

        'template_path_stack' => array(
            'SpotOption' => __DIR__ . '/../view',
        ),



        //this is for the ajax call
        'strategies' => array (
            'ViewJsonStrategy'
        )
    ),







    //    this for definition the module layout
//    we can define all layout we want here
    'module_layouts' => array(
        'SpotOption' => array(
            'default' => 'layout/SpotOption',
//            'edit'    => 'layout/albumEdit',
        )
    ),










// Doctrine config
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