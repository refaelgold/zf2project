<?php

namespace Kcs\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Kcs\Entity\KcsPoll;




class IndexController extends AbstractActionController
{


    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }




    public function indexAction()
    {



        $em = $this->getEntityManager();
        $pollHeadlineRepository = $em->getRepository('Kcs\Entity\KcsPoll');

        //use the query findAll to fetch all the quries
        $pollHeadline = $pollHeadlineRepository->findAll();//here we use the function findAll().


        $message = $this->params()->fromQuery('message', 'welcome to first question of quiz!');



        return new ViewModel(array(
            'message' => $message,//this is the default message
            'pollHeadline'	=> $pollHeadline,//this is the user details(its like "SELECT *..." query
        ));


        $this->getEntityManager()->persist($pollHeadline);
        $this->getEntityManager()->flush();

    }


}

