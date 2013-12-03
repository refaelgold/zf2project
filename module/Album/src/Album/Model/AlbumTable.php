<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Where;

class AlbumTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }









    /*get the track of specific album Connector function to Track*/
    public function joinFetchAllByAlbum($id)
    {


        $where = new  Where();
        $where->equalTo('track.album_id', $id) ;



        $sqlSelect = $this->tableGateway->getSql()
            ->select()
            ->join('track', 'track.album_id = album.id', array('*'), 'left')
            ->order('track_number ASC')
            ->where($where);




        return $this->tableGateway->selectWith($sqlSelect);

    }





    public function getAlbum($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = array(
            'artist' => $album->artist,
            'title'  => $album->title,
        );

        $id = (int)$album->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Album id does not exist');
            }
        }
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}