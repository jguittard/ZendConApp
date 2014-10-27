<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

/**
 * Contact Service
 * 
 * @package Phonebook
 * @subpackage Service
 * @version 1.0
 */
class Contact implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;
    
    const EVENT_CONTACT_CREATED = 'contact.created';
    const EVENT_CONTACT_UPDATED = 'contact.updated';
    const EVENT_CONTACT_DELETED = 'contact.deleted';
    
    const EVENT_CONTACT_SAVE_ERROR = 'contact.save.error';
    
    /**
     * Contact table gateway
     * 
     * @var \Phonebook\Model\ContactTable
     */
    protected $contactTable;
    
    /**
     * Constructor
     * 
     * @param \Phonebook\Model\ContactTable $contactTable
     */
    public function __construct(\Phonebook\Model\ContactTable $contactTable)
    {
        $this->contactTable = $contactTable;
    }
    
    /**
     * 
     * @param array $params
     * @param boolean $paginated
     * @return \Zend\Paginator\Paginator|\Zend\Db\ResultSet\ResultSet
     */
    public function listContacts(array $params = array(), $paginated = true)
    {
        return $this->contactTable->fetchAll($params, $paginated);
    }
    
    /**
     * 
     * @param int $id
     * @return \Phonebook\Entity\Contact|boolean
     */
    public function getContact($id)
    {
        return $this->contactTable->fetch($id);
    }
    
    /**
     * 
     * @param \Phonebook\Entity\Contact $contact
     * @return boolean|int
     */
    public function saveContact(\Phonebook\Entity\Contact $contact)
    {
        $new = (int) $contact->getId() == 0;
        $result = $this->contactTable->save($contact);
        
        if (!$result) {
            $this->getEventManager()->trigger(self::EVENT_CONTACT_SAVE_ERROR, $this, array($contact));
            return false;
        }
        
        return $result;
    }
    
    /**
     * 
     * @param int $id
     * @return int
     */
    public function deleteContact($id)
    {
        return $this->contactTable->trash($id);
    }
}
