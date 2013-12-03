<?php
namespace Album\Form;

use Zend\Form\Form;

class TrackForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('album');

        $this->add(array(
            'name' => 'album_id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'track_id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'track_number',
            'type' => 'Text',
            'options' => array(
                'label' => 'Song number in album',
            ),
        ));

        $this->add(array(
            'name' => 'track_title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Song name',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }

}