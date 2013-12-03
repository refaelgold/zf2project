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

class CustomerForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('customer');
        $this->setAttribute('method', 'post');


//
//        $this->add(array(
//            'name' => 'id',
//            'attributes' => array(
//                'type'  => 'hidden',
//                ),
//
//        ));




        $this->add(array(
            'name' => 'FirstName', // 'First name',
            'attributes' => array(
                'id' => 'firstName',
                'type'  => 'text',
                'placeholder'=>'First name',
                'required'=>'required'
            ),

        ));

        $this->add(array(
            'name' => 'LastName', // 'First name',
            'attributes' => array(
                'id' => 'lastName',
                'type'  => 'text',
                'placeholder'=>'Last name',
                'required'=>'required'
            ),

        ));

        $this->add(array(
            'name' => 'Phone', // 'First name',
            'attributes' => array(
                'id' => 'phoneNumber',
                'type'  => 'text',
                'placeholder'=>'Phone number :',
                'required'=>'required'
            ),

        ));


        $this->add(array(
            'name' => 'Address',
            'attributes' => array(
                'id' => 'address',
                'type'  => 'textarea',
                'placeholder'=>'Address :',
                'required'=>'required'
            ),

        ));



        $this->add(array(
            'type' => 'select',
            'name' => 'Status',
            'attributes' =>  array(
                'id' => 'status',
                'options' => array(
                    1 => 'Business',
                    2 => 'Private',
                    3 => 'VIP',
                ),
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Register',
                'id' => 'submitbutton_customer',
            ),
        ));
    }
}
