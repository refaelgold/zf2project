<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Where;

class TrackTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }





    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select()->order('track_number ASC');
        return $resultSet;
    }







    public function getTrack($id)
    {
        $id  = (int) $id;
        echo $id;
        $rowset = $this->tableGateway->select(array('album_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }






    public function saveTrack(Track $track)
    {
        $data = array(
            'album_id' => $track->album_id,
            'track_number'  => $track->track_number,
            'track_title'  => $track->track_title,
        );



        $id_of_album =$track->album_id;


        if ($id_of_album != 0) {

            $this->tableGateway->insert($data);
        }





//        else {
//            if ($this->getAlbum($id)) {
//                $this->tableGateway->update($data, array('track_id' => $id));
//            } else {
//                throw new \Exception('Album id does not exist');
//            }
//        }


    }

//    public function deleteAlbum($id)
//    {
//        $this->tableGateway->delete(array('id' => $id));
//    }
}