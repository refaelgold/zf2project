<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/27/13
 * Time: 6:31 PM
 */

//this must for form in AuthDoctrine
namespace Website\Form;

//this is for give the form from zf2
use Zend\Form\Form;

class ContactUsForm extends Form
{
    public function __construct()//this for call the customer id connector
    {
        // we want to ignore the name passed
        parent::__construct('WebsiteContactUs');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'value' =>null,
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'FullName',
            'attributes' => array(
                'id' => 'FullName',
                'type'  => 'text',
                'placeholder'=>'Full Name:',
                'required'=>'required'
            ),

        ));

        $this->add(array(
            'name' => 'PhoneNumber',
            'attributes' => array(
                'id' => 'PhoneNumber',
                'type'  => 'tel',
                'placeholder'=>'Phone Number :',
                'required'=>'required'
            ),
        ));

        $this->add(array(
            'name' => 'Email',
            'attributes' => array(
                'id' => 'Email',
                'type'  => 'email',
                'placeholder'=>'Email :',
                'required'=>'required'
            ),
        ));

        $this->add(array(
            'name' => 'Message',
            'attributes' => array(
                'id' => 'Message',
                'type'  => 'textarea',
                'placeholder'=>'Message :',
                'required'=>'required'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Send',
                'class' => 'btn btn-success btn-small',
                'id' => 'WebsiteContactUsSubmit',
            ),
        ));
    }

}
