<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/30/13
 * Time: 3:18 PM
 */

namespace SpotOption\Controller;


use SpotOption\Entity\Customers;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


use Zend\View\Model\JsonModel;


use SpotOption\Form\CustomerForm;



//doctrine default modules
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;



class CustomerController extends AbstractActionController
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
        $customerRepository = $em->getRepository('SpotOption\Entity\Customers');

        //use the query findAll to fetch all the quries
        $costumers = $customerRepository->findAll();//here we use the function findAll().


        $message = $this->params()->fromQuery('message', 'welcome to first question of quiz!');



        return new ViewModel(array(
            'message' => $message,//this is the default message
            'costumers'	=> $costumers,//this is the user details(its like "SELECT *..." query
        ));


        $this->getEntityManager()->persist($customer);
        $this->getEntityManager()->flush();
    }








    public function newAction()
    {

        $em = $this->getEntityManager();


        $customer = new Customers;


        $form = new CustomerForm();
        $form->setHydrator(new DoctrineHydrator($em,'SpotOption\Entity\Customer'));
        $form->bind($customer);
        $form->get('submit')->setValue('Update');//override doctrine empty values!!


        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $em->persist($customer);
                $em->flush();
                return $this->redirect()->toRoute('SpotOption', array('controller'=>'customer', 'action'=>'index'));

            }

        }

        return new ViewModel(array(
            'form' => $form
        ));
    }





    public function editAction()
    {
        $customer = $this->getEntityManager()->getRepository('SpotOption\Entity\Customers')->find($this->params('id'));


        $form = new CustomerForm();
        $form->get('submit')->setValue('UPDATE');//override doctrine empty values!!

        $form->bind($customer);

        $request = $this->getRequest();
        if ($request->isPost()) {


            $form->setData($request->getPost());

            if ($form->isValid()) {


                $em = $this->getEntityManager();
                $em->persist($customer);
                $em->flush();


//
//                $viewModel = new ViewModel();
//                $viewModel->layout('layout/SpotOption');
//                return $viewModel;
//
//
//


                return $this->redirect()->toRoute('SpotOption', array('controller'=>'customer', 'action'=>'index'));
            }
        }

       return new ViewModel(array(
            'customer' => $customer,
            'form' => $form
        ));
    }










    public function deleteAction()
    {
        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('SpotOption', array('controller'=>'customer', 'action'=>'index'));
        }

        $em = $this->getEntityManager();
        $customer = $em->find('SpotOption\Entity\Customers', $id);

        $em->remove($customer);
        $em->flush();

        $this->redirect()->toRoute('SpotOption', array('controller'=>'customer', 'action'=>'index'));
    }


    //global function

    public function jqueryAjaxAction() {
        $viewModel = new ViewModel();
        $viewModel->layout('layout/SpotOption');
        return $viewModel;
    }








}//end of CustomerController





