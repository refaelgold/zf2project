<?php

namespace StartTech\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MainController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
//
//    public function servicesAction()
//    {
//        return new ViewModel();
//    }
//
//    public function portfolioAction()
//    {
//        return new ViewModel();
//    }
//
//    public function aboutAction()
//    {
//        return new ViewModel();
//    }
//
//    public function writeOnUsAction()
//    {
//        return new ViewModel();
//    }
//
//    public function contactAction()
//    {
//        return new ViewModel();
//    }


}

