<?php


//basic
namespace AuthDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;





use AuthDoctrine\Entity\User;



// Doctrine Annotations
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
//use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

//// Zend Annotation
//use Zend\Form\Annotation\AnnotationBuilder;
//// for the form


use Zend\Form\Element;



use AuthDoctrine\Form\RegistrationForm;
use AuthDoctrine\Form\RegistrationFilter;
use AuthDoctrine\Form\ForgottenPasswordForm;
use AuthDoctrine\Form\ForgottenPasswordFilter;

use Zend\Mail\Message;

class RegistrationController extends AbstractActionController
{

    public function indexAction()
    {

        //create a new User to use
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $user = new User;



        // 2) Better use a form class
        $form = new RegistrationForm();
        $form->setHydrator(new DoctrineHydrator($entityManager,'AuthDoctrine\Entity\User'));

        $form->bind($user);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new RegistrationFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
            if ($form->isValid()) {



//                $this->prepareData($user);
                //$this->sendConfirmationEmail($user);
                //$this->flashMessenger()->addMessage($user->getUsrEmail());

                $user->setUsrActive(1);
                $user->setUsrEmailConfirmed(1);


                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirect()->toRoute('auth-doctrine', array('controller'=>'index', 'action'=>'login'));

            }
        }
        return new ViewModel(array('form' => $form));
    }



}
