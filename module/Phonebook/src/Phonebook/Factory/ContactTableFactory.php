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
use Phonebook\Model\ContactTable;

/**
 * Contact Table Gateway Factory
 * 
 * @package Phonebook
 * @subpackage Model
 * @version 1.0
 */
class ContactTableFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('DB\Phonebook');
        $resultSet = $serviceLocator->get('Phonebook\Model\ContactResultSet');

        return new ContactTable($dbAdapter, $resultSet);
    }
}
