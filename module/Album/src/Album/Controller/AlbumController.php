<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



//must include the model for calling the create on the db
use Album\Model\Album;          // <-- Add this import
use Album\Model\Track;          // <-- Add this import

use Album\Form\AlbumForm;       // <-- Add this import
use Album\Form\TrackForm;       // <-- Add this import

class AlbumController extends AbstractActionController
{

    protected $albumTable = null;
    protected $trackTable = null;



    /*********/
    /*********/
    /*********/
    public function getAlbumTable()
    {
        if (!$this->albumTable) {
                            $sm = $this->getServiceLocator();
                            $this->albumTable = $sm->get('Album\Model\AlbumTable');
                        }
                        return $this->albumTable;
    }




    public function indexAction()
    {
        return new ViewModel(array(
                            'albums' => $this->getAlbumTable()->fetchAll(),

                    ));
    }



    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
                        if (!$id) {
                            return $this->redirect()->toRoute('album');
                        }

                        $request = $this->getRequest();
                        if ($request->isPost()) {
                            $del = $request->getPost('del', 'No');

                            if ($del == 'Yes') {
                                $id = (int) $request->getPost('id');
                                $this->getAlbumTable()->deleteAlbum($id);
                            }

                            // Redirect to list of albums
                            return $this->redirect()->toRoute('album');
                        }

                        return array(
                            'id'    => $id,
                            'album' => $this->getAlbumTable()->getAlbum($id)
                        );
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);



                        if (!$id) {
                            return $this->redirect()->toRoute('album', array(
                                'action' => 'add'
                            ));
                        }

                        // Get the Album with the specified id.  An exception is thrown
                        // if it cannot be found, in which case go to the index page.
                        try {
                            $album = $this->getAlbumTable()->getAlbum($id);
                        }
                        catch (\Exception $ex) {
                            return $this->redirect()->toRoute('album', array(
                                'action' => 'index'
                            ));
                        }



                        $form  = new AlbumForm();
                            $form->bind($album);
                            $form->get('submit')->setAttribute('value', 'שנה');

                        $request = $this->getRequest();

                        if ($request->isPost()) {
                            $form->setInputFilter($album->getInputFilter());
                            $form->setData($request->getPost());

                            if ($form->isValid()) {
                                $this->getAlbumTable()->saveAlbum($album);

                                // Redirect to list of albums
                                return $this->redirect()->toRoute('album');
                            }
                        }

                        return array(
                            'id' => $id,
                            'form' => $form,
                        );
    }

    public function addAction()
    {
        $form = new AlbumForm();
                        $form->get('submit')->setValue('הוסף');

                        $request = $this->getRequest();
                        if ($request->isPost()) {
                            $album = new Album();
                            $form->setInputFilter($album->getInputFilter());
                            $form->setData($request->getPost());

                            if ($form->isValid()) {
                                $album->exchangeArray($form->getData());
                                $this->getAlbumTable()->saveAlbum($album);

                                // Redirect to list of albums
                                return $this->redirect()->toRoute('album');
                            }
                        }
                        return array('form' => $form);
    }

    /*********/
    /*********/
    /*********/







    /*********/
    /*********/
    /*********/

//    track section
    public function trackPerAlbumAction()
    {


            $id= $this->params('id');//get id of the album-its taking by configuration array.



        //getAlbumTable give us accses to table of album who define in factory
            $tracks=$this->getAlbumTable()->joinFetchAllByAlbum($id);



                //if empty move to page
                        if ($tracks->count()==0){

                            $this->redirect()->toRoute('album',
                                array('action' => 'trackPerAlbum404','id' => $id));
                        }


                            return new ViewModel(array(
                            'tracks' => $tracks,
                            'id' =>$id
                        ));
    }






    public function trackPerAlbum404Action()
    {

        $id= $this->params('id');

              return new ViewModel(array(
                 'albumDetailByID' => $this->getAlbumTable()->fetchAll() ,
                  'id' => $id
               ));
    }






    public function getTrackTable()
    {

        if (!$this->trackTable) {
            $sm = $this->getServiceLocator();
            $this->trackTable = $sm->get('Album\Model\trackTable');
        }
        return $this->trackTable;
    }



    public function addNewTrackAction()
    {

        $id= $this->params('id');/*we get it from route*/

        //create the form object with id

        $form = new TrackForm();
            $form->get('submit')->setValue('הוסף');
            $form->get('album_id')->setValue($id);//set the current id


        $request = $this->getRequest();


        if ($request->isPost()) {

            $track = new Track();
                $form->setInputFilter($track->getInputFilter());
                $form->setData($request->getPost());

            if ($form->isValid()) {

                $track->exchangeArray($form->getData());
                $this->getTrackTable()->saveTrack($track);

                //Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array(
            'form' => $form

        );
    }


}

