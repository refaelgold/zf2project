<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 10/9/13
 * Time: 10:23 PM
 */ //filename : module/Album/src/Album/Factory/Model/AlbumTableFactory.php


namespace Album\Factory\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\ResultSet\HydratingResultSet;




use Album\Model\AlbumTable;
use Album\Model\Album;



class AlbumTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $db = $serviceLocator->get('Zend\Db\Adapter\Adapter');

        $resultSetPrototype = new HydratingResultSet();
        $resultSetPrototype->setHydrator(new ObjectProperty());
        $resultSetPrototype->setObjectPrototype(new Album());

        $tableGateway       = new TableGateway('album', $db, null, $resultSetPrototype);
        $table              = new AlbumTable($tableGateway);

        return $table;
    }
}