<?php
namespace Website;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();

        $eventManager->attach(array(
                MvcEvent::EVENT_DISPATCH_ERROR,
                MvcEvent::EVENT_RENDER_ERROR,
            ), function(\Zend\Mvc\MvcEvent $event) use ($serviceManager)
            {
                if ($event->getError() === \Zend\Mvc\Application::ERROR_EXCEPTION)
                {
                    $exception = $event->getParam('exception');
                    // Do something with this Exception, like logging in.
                }
            }
        );
    }

}


