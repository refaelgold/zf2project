<?php
namespace Website\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Website\Entity\WebsiteContactUs;
use Website\Form\ContactUsForm;       // <-- Add this import




class WebsiteController extends AbstractActionController
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
        return new ViewModel();
    }

    public function aboutAction()
    {
        return new ViewModel();
    }

    public function contactAction()
    {



                $form = new ContactUsForm();
                $contactUs = new WebsiteContactUs();
                $em = $this->getEntityManager();

                $form->get('submit')->setValue('Send');
                $form->bind($contactUs);

                $request = $this->getRequest();


                   //$request->isPost() -->used for regular call
                if ($request->isXmlHttpRequest()) {
                    // TODO fix the filters
                    //- $form->setInputFilter($authFormFilters->getInputFilter());

                    // Filters have been fixed
                    $form->setData($request->getPost());
                    if ($form->isValid()) {

                        //enter the info to the db
                        $em->persist($contactUs);
                        $em->flush();
                        return $this->redirect()->toRoute('SpotOption', array('controller'=>'customer', 'action'=>'index'));

                    }
                }
                return new ViewModel(array(
                    'form'=> $form,
                ));

    }



    public function zf2ProjectsAction()
    {
        return new ViewModel();
    }



    //after ajax call Actions
    //*****************
    public function afterAjaxContactUsAction()
    {
        return new ViewModel();
    }



    //*****************


}

