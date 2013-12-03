<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/27/13
 * Time: 6:31 PM
 */


//this must for form in AuthDoctrine
namespace SpotOption\Form;


//this is for give the form from zf2
use Zend\Form\Form;

class CallForm extends Form
{
    public function __construct()//this for call the customer id connector
    {
        // we want to ignore the name passed
        parent::__construct('call');
        $this->setAttribute('method', 'post');




        $this->add(array(
            'name' => 'CustomerId',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));






        $this->add(array(
            'name' => 'Subject', // 'First name',
            'attributes' => array(
                'id' => 'subject',
                'type'  => 'text',
                'placeholder'=>'Subject',
                'required'=>'required'
            ),

        ));



        $this->add(array(
            'name' => 'Content',
            'attributes' => array(
                'id' => 'Content',
                'type'  => 'textarea',
                'placeholder'=>'content :',
                'required'=>'required'
            ),

        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Register',
                'id' => 'submitbutton',
            ),
        ));




    }


}
