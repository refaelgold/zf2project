<?php

namespace AuthDoctrine; // SUPER important for Doctrine othervise can not find the Entities


return array(
    'controllers' => array(
        'invokables' => array(
            'Index' => 'AuthDoctrine\Controller\IndexController',//this is for login and logout
            'Registration' => 'AuthDoctrine\Controller\RegistrationController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'auth-doctrine' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth-doctrine',//this is the path on the url(URL)
                    'defaults' => array(
                        '__NAMESPACE__' => 'AuthDoctrine\Controller',
                        'controller'    => 'Index',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(//this also need to be in url when its run
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),




    //    in charge to put the manager of the layout
    'view_manager' => array(


        'template_path_stack' => array(
             __DIR__ . '/../view',
        ),

        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/Auth-doctrine'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),


    ),






    //    this for definition the module layout
//    we can define all layout we want here
    'module_layouts' => array(
        'AuthDoctrine' => array(
            'default' => 'layout/layout',
        )
    ),









    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                // object_repository can be used instead of the object_manager key
                'identity_class' => 'AuthDoctrine\Entity\User', //'Application\Entity\User',
                'identity_property' => 'usrName', // 'username', // 'email',
                'credential_property' => 'usrPassword', // 'password',


                #todo need to put MD5()
            ),
        ),


        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',

                ),
            ),




            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                )
            )
        )
    ),
);