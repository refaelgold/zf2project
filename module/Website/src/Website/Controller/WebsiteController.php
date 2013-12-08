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
        $em = $this->getEntityManager();



                $form = new ContactUsForm();
                $contactUs = new WebsiteContactUs();

                $form->get('submit')->setValue('Send');
                $form->bind($contactUs);
                $request = $this->getRequest();



                if ($request->isPost()) {
                    // TODO fix the filters
                    //- $form->setInputFilter($authFormFilters->getInputFilter());

                    // Filters have been fixed
                    $form->setData($request->getPost());

                    if ($form->isValid()) {
                        //enter the info to the db
                        $em = $this->getEntityManager();
                        $em->persist($contactUs);
                        $em->flush();
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

