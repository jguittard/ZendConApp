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
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Db\ResultSet\HydratingResultSet;

/**
 * Phonebook Contact Resultset Factory
 *
 * @package Phonebook
 * @subpackage Factory
 * @version 1.0
 */
class ContactResultSetFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $rowObject = new \Phonebook\Entity\Contact();

        return new HydratingResultSet(new ClassMethodsHydrator(), $rowObject);
    }
}
