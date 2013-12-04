<?php

namespace SpotOption\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class MainController extends AbstractActionController
{








    //need to be on bootstrap or on constructor
    public function routeAction()
    {

        //get the use details CAN CALL FROM ALL MODULES!
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $auth=$authService->getIdentity();
//        var_dump($auth);
        if($auth==null){
            return $this->redirect()->toRoute('SpotOption', array('controller'=>'main', 'action'=>'error'));
        }
        else{

            return $this->redirect()->toRoute('SpotOption', array('controller'=>'main', 'action'=>'index'));

        }

    }




    public function indexAction()
    {



        //get the use details CAN CALL FROM ALL MODULES!
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $auth=$authService->getIdentity();
//        var_dump($auth);
        if($auth==null){
            return $this->redirect()->toRoute('SpotOption', array('controller'=>'main', 'action'=>'error'));
        }
        else{
            return new ViewModel(array(

            ));
        }


    }





    public function errorAction()
    {

        //give  html 404  file
        return new ViewModel(array(

        ));
    }










}

