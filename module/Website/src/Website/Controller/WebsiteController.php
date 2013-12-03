<?php

namespace Website\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WebsiteController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function aboutAction()
    {
        return new ViewModel();
    }

    public function contactAction()
    {
        return new ViewModel();
    }

    public function zf2ProjectsAction()
    {
        return new ViewModel();
    }


}

