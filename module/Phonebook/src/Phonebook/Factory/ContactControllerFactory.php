<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phonebook\Controller\ContactController;

/**
 * Phonebook Controller Factory
 * 
 * @package Phonebook
 * @subpackage Factory
 * @version 1.0
 */
class ContactControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $contactService = $serviceLocator->getServiceLocator()->get('Phonebook\Service\Contact');
        $contactForm = $serviceLocator->getServiceLocator()->get('FormElementManager')->get('Phonebook\Form\Contact');
        $searchForm = $serviceLocator->getServiceLocator()->get('FormElementManager')->get('Phonebook\Form\Search');

        return new ContactController($contactService, $contactForm, $searchForm);
    }
}
