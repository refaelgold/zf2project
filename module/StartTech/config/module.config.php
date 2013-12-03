<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'StartTech\Controller\Main' => 'StartTech\Controller\MainController',
        ),
    ),


    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'start-tech' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/start-tech[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'StartTech\Controller\Main',
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
            'layout/StartTech'           => __DIR__ . '/../view/layout/layout.phtml',
//            'layout/albumEdit'           => __DIR__ . '/../view/layout/albumEdit.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),

        'template_path_stack' => array(
            'startTech' => __DIR__ . '/../view',
        ),
    ),


//    this for definition the module layout
//    we can define all layout we want here
    'module_layouts' => array(
        'StartTech' => array(
            'default' => 'layout/StartTech',
//            'edit'    => 'layout/albumEdit',
        )
    ),








);