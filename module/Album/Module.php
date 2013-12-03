<?php
namespace Album;

// Add these import statements:
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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















//    this is the module of layout
    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');

            $routeMatch = $e->getRouteMatch();
            $actionName = strtolower($routeMatch->getParam('action', 'not-found')); // get the action name

            if (isset($config['module_layouts'][$moduleNamespace][$actionName])) {
                $controller->layout($config['module_layouts'][$moduleNamespace][$actionName]);
            }elseif(isset($config['module_layouts'][$moduleNamespace]['default'])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]['default']);
            }

        }, 100);
    }













    // Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
//                'Album\Model\AlbumTable' =>  function($sm) {
//                    $tableGateway = $sm->get('AlbumTableGateway');
//                    $table = new AlbumTable($tableGateway);
//                    return $table;
//                },
//                'AlbumTableGateway' => function ($sm) {
//                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
//                    $resultSetPrototype = new ResultSet();
//                    $resultSetPrototype->setArrayObjectPrototype(new Album());
//                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
//                },
                'Album\Model\AlbumTable' =>  'Album\Factory\Model\AlbumTableFactory'
                ,
                'Album\Model\TrackTable' =>  'Album\Factory\Model\TrackTableFactory'

            ),
        );
    }
}
