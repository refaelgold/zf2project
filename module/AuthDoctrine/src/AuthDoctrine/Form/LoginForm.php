<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/27/13
 * Time: 6:31 PM
 */


//this must for form in AuthDoctrine
namespace AuthDoctrine\Form;


//this is for give the form from zf2
use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');
        $this->setAttribute('method', 'post');


//        placeholder="Username" autofocus required

        $this->add(array(
            'name' => 'username', // 'usr_name',
            'attributes' => array(
                'id' => 'username',
                'type'  => 'text',
                'placeholder'=>'myusername',
                'autofocus'=>'autofocus',
                'required'=>'required'
            ),

        ));
        $this->add(array(
            'name' => 'password', // 'usr_password',
            'attributes' => array(
                'id' => 'password',
                'placeholder'=>'eg. X8df!90EO',
                'type'  => 'password',
                'required'=>'required'

            ),
        ));

        $this->add(array(
            'id' => 'loginkeeping',
            'name' => 'rememberme',
            'type' => 'checkbox',
            'value'=>'0',
            'check' => 'check', //without value here will be 1
        ));



        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Login',
                'id' => 'submitbutton',
            ),
        ));
    }
}
