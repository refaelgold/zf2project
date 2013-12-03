<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 10/9/13
 * Time: 10:23 PM
 */ //filename : module/Album/src/Album/Factory/Model/AlbumTableFactory.php


namespace Album\Factory\Model;



/*must be class*/
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\ResultSet\HydratingResultSet;




use Album\Model\TrackTable;
use Album\Model\Track;






class TrackTableFactory implements FactoryInterface
{


//    this function is for accses to the table db
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $db = $serviceLocator->get('Zend\Db\Adapter\Adapter');

        $resultSetPrototype = new HydratingResultSet();
            $resultSetPrototype->setHydrator(new ObjectProperty());
            $resultSetPrototype->setObjectPrototype(new Track());

        $tableGateway       = new TableGateway('track', $db, null, $resultSetPrototype);
        $table              = new TrackTable($tableGateway);

        return $table;
    }
}