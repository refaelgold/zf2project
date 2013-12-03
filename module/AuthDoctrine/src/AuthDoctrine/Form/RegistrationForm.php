<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/28/13
 * Time: 12:40 AM
 */

namespace AuthDoctrine\Form;

use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('registration');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'usrName',
            'attributes' => array(
                'type'  => 'text',
                'autofocus'=>'autofocus',
                'required'=>'required'

            ),
            'options' => array(
            ),
        ));

        $this->add(array(
            'name' => 'usrEmail',
            'attributes' => array(
                'type'  => 'email',
                'required'=>'required'

            ),
            'options' => array(
            ),
        ));

        $this->add(array(
            'name' => 'usrPassword',
            'attributes' => array(
                'type'  => 'password',
                'required'=>'required',
                'placeholder'=>'eg. X8df!90EO'

            ),
            'options' => array(
            ),
        ));

        $this->add(array(
            'name' => 'usrPasswordConfirm',
            'attributes' => array(
                'type'  => 'password',
                'placeholder'=>'eg. X8df!90EO'
            ),
            'options' => array(
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'captcha' => new \Zend\Captcha\Figlet(),
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}
