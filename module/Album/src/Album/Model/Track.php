<?php
namespace Album\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Track implements InputFilterAwareInterface
{
    public $track_id;
    public $track_number;
    public $track_title;
    public $album_id;
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->track_id     = (isset($data['track_id']))     ? $data['track_id']     : null;
        $this->track_number = (isset($data['track_number'])) ? $data['track_number'] : null;
        $this->track_title = (isset($data['track_title'])) ? $data['track_title'] : null;
        $this->album_id = (isset($data['album_id'])) ? $data['album_id'] : null;
    }


    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }





    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();



            $inputFilter->add(array(
                'name'     => 'album_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add([
                'name'     => 'track_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),

            ]);



            $inputFilter->add(array(
                'name'     => 'track_number',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                )
            ));



            $inputFilter->add(array(
                'name'     => 'track_title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                        ),
                    ),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}