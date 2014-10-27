<?php
namespace Phonebook\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phonebook\Form\Contact;

class ContactFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();
        $contactInputFilter = $services->get('InputFilterManager')->get('Phonebook\Form\ContactFilter');
        return new Contact($contactInputFilter);
    }
}
