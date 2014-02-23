<?php
/**
 * Configuration file generated by ZFTool
 * The previous configuration file is stored in application.config.old
 *
 * @see https://github.com/zendframework/ZFTool
 */
return array(
    'modules' => array(
        'Website',
        'StartTech',
        'Album',
        'SpotOption',
//        'ZendDeveloperTools',
        'DoctrineModule',
        'DoctrineORMModule',
        'Kcs',
        'AuthDoctrine',

    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'config_glob_paths' => array('config/autoload/{,*.}{global,local}.php')
        ),
    'doctrine' => array('driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array('/Library/WebServer/Documents/pixub/config/../src/SpotOption/Entity')
                ),
            'orm_default' => array('drivers' => array('SpotOption\Entity' => 'application_entities'))
            ))
    );



