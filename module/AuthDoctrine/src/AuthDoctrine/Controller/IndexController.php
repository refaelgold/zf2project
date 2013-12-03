<?php

namespace AuthDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



//this is for session class
use Zend\Session\SessionManager;



use AuthDoctrine\Entity\User; // only for the filters
use AuthDoctrine\Form\LoginForm;       // <-- Add this import
use AuthDoctrine\Form\LoginFilter;


class IndexController extends AbstractActionController
{

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em = null;

    public function getEntityManager()
    {
        if (null === $this->em) {
                    $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                }
                return $this->em;
    }



    public function indexAction()
    {
            $em = $this->getEntityManager();



            //invoke the class of Users.
            $userRepository = $em->getRepository('\AuthDoctrine\Entity\User'); // '\AuthDoctrine\Entity\User' this is the definition


            //use the query findAll to fetch all the queris
            $users = $userRepository->findAll();//here we use the function findAll().


            $message = $this->params()->fromQuery('message', 'ברוכים הבאים לממשק הניהול של SpotOptionQuiz');
            return new ViewModel(array(
                'message' => $message,//this is the default message
                'users'	=> $users,//this is the user details(its like "SELECT *..." query
    //			'myUsers' => $myUsers
            ));
    }








    public function loginAction()
    {
                $form = new LoginForm();
                $form->get('submit')->setValue('Login');
                $messages = null;

                $request = $this->getRequest();

                if ($user = $this->identity()){
                    $this->redirect()->toRoute('SpotOption', array('controller'=>'main', 'action'=>'index'));
                }


                if ($request->isPost()) {
                    //- $authFormFilters = new User(); // we use the Entity for the filters
                    // TODO fix the filters
                    //- $form->setInputFilter($authFormFilters->getInputFilter());

                    // Filters have been fixed
                    $form->setInputFilter(new LoginFilter($this->getServiceLocator()));
                    $form->setData($request->getPost());
                    if ($form->isValid()) {
                        $data = $form->getData();

                        // If you used another name for the authentication service, change it here
                        // it simply returns the Doctrine Auth. This is all it does. lets first create the connection to the DB and the Entity
                        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');



                        // Do the same you did for the ordinar Zend AuthService
                        $adapter = $authService->getAdapter();


                        $adapter->setIdentityValue($data['username']); //$data['usr_name']
                        $adapter->setCredentialValue($data['password']); // $data['usr_password']




                        $authResult = $authService->authenticate();

                        if ($authResult->isValid()) {


                            $identity = $authResult->getIdentity();
                            $authService->getStorage()->write($identity);
                            $time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days


                            //this is for the session
                            if ($data['rememberme']=="1") {
                                $sessionManager = new SessionManager();
                                $sessionManager->rememberMe($time);
                            }



                            $this->redirect()->toRoute('SpotOption', array('controller'=>'main', 'action'=>'index'));
                        }




                        foreach ($authResult->getMessages() as $message) {
                            $messages .= "$message\n";
                        }

                    }
                }
                return new ViewModel(array(
                    'error' => 'Your authentication credentials are not valid',
                    'form'        => $form,
                    'messages' => $messages,
                ));
    }

    public function logoutAction()
    {
        {

            $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');


            if ($auth->hasIdentity()) {
                $identity = $auth->getIdentity();

            }
            $auth->clearIdentity();
//-                $auth->getStorage()->session->getManager()->forgetMe(); // no way to get to the sessionManager from the storage
            $sessionManager = new SessionManager();
            $sessionManager->forgetMe();



            // return $this->redirect()->toRoute('home');
            return $this->redirect()->toRoute('auth-doctrine/default', array('controller' => 'index', 'action' => 'login'));

        }
    }






}

