<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/30/13
 * Time: 3:18 PM
 */

namespace SpotOption\Controller;



use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;




use SpotOption\Entity\Customers;
use SpotOption\Entity\Calls;

use SpotOption\Form\CallForm;




//doctrine default modules
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;






class CallController extends AbstractActionController
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



        $param = $this->getEvent()->getRouteMatch()->getParams();//this is for the ID


        $em = $this->getEntityManager();


        $callRepository = $em->getRepository('SpotOption\Entity\Calls');
        $calls = $callRepository->findBy(array('CustomerId' => $param['id']));


        $customerRepository = $em->getRepository('SpotOption\Entity\Customers');
        $specificCustomer=$customerRepository->findBy(array('id' => $param['id']));




        $message = $this->params()->fromQuery('message', 'welcome to first question of quiz!');



        return new ViewModel(array(
            'message' => $message,//this is the default message
            'calls'	=> $calls,//this is the user details(its like "SELECT *..." query
            'specificCustomer'=>$specificCustomer
        ));

        $this->getEntityManager()->persist($calls);
        $this->getEntityManager()->flush();
    }





    public function editAction()
    {


        $param = $this->getEvent()->getRouteMatch()->getParams();//this is for the ID
        $call = $this->getEntityManager()->getRepository('SpotOption\Entity\Calls')->find($param['id']);


        $form = new CallForm();
        $form->bind($call);
        $form->get('submit')->setValue('Update');//override doctrine empty values!!


        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $customerId=$form->get('CustomerId')->getValue();



                $em = $this->getEntityManager();
                $em->persist($call);
                $em->flush();


                return $this->redirect()->toRoute('SpotOption', array('controller'=>'call', 'action'=>'index','id'=>$customerId));
            }
        }

        return new ViewModel(array(
            'call' => $call,
            'form' => $form
        ));
    }











    public function newAction()
    {

        $em = $this->getEntityManager();

        $param = $this->getEvent()->getRouteMatch()->getParams();//this is for the ID


        $call = new Calls;
        $form = new CallForm();

        $customerId=$param['id'];



        $form->setHydrator(new DoctrineHydrator($em,'SpotOption\Entity\calls'));
        $form->bind($call);
        $form->get('CustomerId')->setValue($customerId);//override doctrine empty values!!



        $request = $this->getRequest();

       if ($request->isPost()) {
           $form->setData($request->getPost());
        if ($form->isValid()) {


            $customerId=$form->get('CustomerId')->getValue();



            $em->persist($call);
            $em->flush();
            return $this->redirect()->toRoute('SpotOption', array('controller'=>'call', 'action'=>'index','id'=>$customerId));

        }

       }

        return new ViewModel(array(
            'form' => $form
        ));
    }




    public function deleteAction()
    {
        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('SpotOption', array('controller'=>'call', 'action'=>'index'));
        }

        $em = $this->getEntityManager();
        $call = $em->find('SpotOption\Entity\Calls', $id);

        $em->remove($call);
        $em->flush();

        $this->redirect()->toRoute('SpotOption', array('controller'=>'call', 'action'=>'index'));
    }



}//end of CustomerController

