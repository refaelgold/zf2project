<?php
namespace AuthDoctrine;

class Module
{


    //get the config from module.config.php
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 100);
    }






    //give autoload
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }




    public function getServiceConfig()
    {
        return array(
//-                        'aliases' => array( // !!! aliases not alias
//-                                'Zend\Authentication\AuthenticationService' => 'doctrine_authenticationservice', // aliases can be overwriten
//-                        ),
            'factories' => array(


                // taken from DoctrineModule on GitHub
                // Please note that Iam using here a Zend\Authentication\AuthenticationService name, but it can be anything else
                // However, using the name Zend\Authentication\AuthenticationService will allow it to be recognised by the ZF2 view helper.
                // the configuration of doctrine.authenticationservice.orm_default is in module.config.php
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {

                        return $serviceManager->get('doctrine.authenticationservice.orm_default');

                    },


                // Add this for SMTP transport
                // ToDo move it ot a separate module CsnMail
                'mail.transport' => function (ServiceManager $serviceManager) {
                        $config = $serviceManager->get('Config');
                        $transport = new Smtp();
                        $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                        return $transport;
                    },
            )
        );
    }
}
