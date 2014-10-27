<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\PhpEnvironment\Response;
use Zend\View\Model\ViewModel;
use Zend\Console\Request as ConsoleRequest;
use Faker\Factory as FakerFactory;

/**
 * Contact Controller
 * 
 * @package Phonebook
 * @subpackage Controller
 * @version 1.0
 */
class ContactController extends AbstractActionController
{
    /**
     * Contact service
     *
     * @var \Phonebook\Service\Contact
     */
    protected $contactService;

    /**
     * Contact form
     *
     * @var \Phonebook\Form\Contact
     */
    protected $contactForm;

    /**
     * Search form
     *
     * @var \Phonebook\Form\Search
     */
    protected $searchForm;

    /**
     * Constructor
     * 
     * @param \Phonebook\Service\Contact $contactService
     * @param \Phonebook\Form\Contact $contactForm
     * @param \Phonebook\Form\Search $searchForm
     */
    public function __construct(\Phonebook\Service\Contact $contactService, \Phonebook\Form\Contact $contactForm, \Phonebook\Form\Search $searchForm)
    {
        $this->contactService = $contactService;
        $this->contactForm = $contactForm;
        $this->searchForm = $searchForm;
    }

    /**
     * Displays contacts list and search form
     * 
     * @return \Zend\Http\Response|array
     */
    public function indexAction()
    {
        $contacts = $this->contactService->listContacts();
        $contacts->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1))
                 ->setItemCountPerPage(10);

        return array('contacts' => $contacts, 'form' => $this->searchForm);
    }

    /**
     * Display contact form and handle create
     * 
     * @return \Zend\Http\Response|array
     */
    public function createAction()
    {
        if (($prg = $this->prg()) instanceof Response) {
            return $prg;
        }
        if (false !== $prg) {
            $this->contactForm->setData($prg);
            if ($this->contactForm->isValid()) {
                if (false !== ($id = $this->contactService->saveContact($this->contactForm->getData()))) {
                    $this->flashMessenger()->addSuccessMessage('Contact successfully created');
                    $this->redirect()->toRoute('phonebook/contact', array('action' => 'view', 'id' => $id))->setStatusCode(303);
                } else {
                    $this->flashMessenger()->addErrorMessage('An error occured when trying to create the contact');
                    $this->redirect()->toRoute('phonebook/contact')->setStatusCode(303);
                }
            }
        }

        return array('form' => $this->contactForm);
    }

    /**
     * Display contact info
     * 
     * @return ViewModel
     */
    public function viewAction()
    {
        $id = $this->params()->fromRoute('id', false);

        if (!$id) {
            return $this->redirect()->toRoute('phonebook/contact');
        }
        $contact = $this->contactService->getContact($id);
        if (! $contact) {
            $this->flashMessenger()->addWarningMessage('Unable to retrieve a contact with ID #' . $id);

            return $this->redirect()->toRoute('phonebook/contact');
        }
        $view = new ViewModel();
        if ($this->getRequest()->isXmlHttpRequest()) {
            $view->setTerminal(true)->setTemplate('phonebook/contact/view-modal.phtml');
        }
        $view->setVariable('contact', $contact);

        return $view;
    }

    /**
     * Display contact form and handle update
     * 
     * @return array
     */
    public function updateAction()
    {
        if (($prg = $this->prg()) instanceof Response ) {
            return $prg;
        }
        $id = $this->params()->fromRoute('id');
        if (false !== ($contact = $this->contactService->getContact($id))) {
            $this->contactForm->bind($contact);
        } else {
            $this->flashMessenger()->addWarningMessage('Unable to retrieve a contact with ID #' . $id);
            $this->redirect()->toRoute('phonebook/contact');
        }
        if (false !== $prg) {
            $this->contactForm->setData($prg);
            if ($this->contactForm->isValid()) {
                $this->contactService->saveContact($this->contactForm->getData());
                $this->flashMessenger()->addSuccessMessage('Contact successfully updated');
                $this->redirect()->toRoute('phonebook/contact')->setStatusCode(303);
            }
        }

        return array('form' => $this->contactForm, 'id' => $id);
    }

    /**
     * Delete contact
     * 
     * @return \Zend\Http\Response|array
     */
    public function deleteAction()
    {
        if (($prg = $this->prg()) instanceof Response ) {
            return $prg;
        }
        $id = $this->params()->fromRoute('id');
        $contact = $this->contactService->getContact($id);
        if (!$contact) {
            $this->flashMessenger()->addWarningMessage('Unable to retrieve a contact with ID #' . $id);
            $this->redirect()->toRoute('phonebook/contact');
        }
        if (false !== $prg) {
            if ($prg['delete'] == 'Yes') {
                $this->contactService->deleteContact($contact->getId());
                $this->flashMessenger()->addWarningMessage(sprintf('Contact %s successfully deleted', $contact->getFullname()));
            }
            $this->redirect()->toRoute('phonebook/contact');
        }

        return compact('contact');
    }

    /**
     * Handle contact search
     * 
     * @return \Zend\Http\Response|array
     */
    public function searchAction()
    {
        if (!$this->getRequest()->isPost() || empty($this->params()->fromPost())) {
            return $this->redirect()->toRoute('phonebook/contact');
        }
        $data = $this->params()->fromPost();
        $params = array($data['field'] => $data['query']);

        $result = $this->contactService->listContacts($params, false);

        return compact('result');
    }
    
    public function generateAction()
    {
        $request = $this->getRequest();
        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException(sprintf(
                '%s can only be executed in a console environment',
                __METHOD__
            ));
        }
        $number = $this->params()->fromRoute('number', 100);
        $faker = FakerFactory::create();
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
        $values = array();
        for ($i=0; $i < $number + 1; $i++) {
            $values []= array(
                'title' => $faker->title,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'notes' => $faker->text(30),
            );
        }
        $i = 0;
        foreach ($values as $data) {
            $contact = new \Phonebook\Entity\Contact();
            $contact->exchangeArray($data);
            if (false !== $this->contactService->saveContact($contact)) {
                $i++;
            }
        }
        return sprintf("%d contacts have been saved", $i);
    }
}
