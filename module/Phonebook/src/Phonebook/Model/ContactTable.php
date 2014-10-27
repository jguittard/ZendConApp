<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Select;

/**
 * Contact Table
 * 
 * @package Phonebook
 * @subpackage Model
 * @version 1.0
 */
class ContactTable extends AbstractTableGateway
{
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'contact';

    /**
     * Constructor
     * 
     * @param Adapter $adapter
     * @param ResultSetInterface $resultSet
     */
    public function __construct(Adapter $adapter, ResultSetInterface $resultSet)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = $resultSet;
    }

    /**
     * Fetch contacts
     * 
     * @param array $params
     * @param string $paginated
     * @return \Zend\Paginator\Paginator|\Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($params = array(), $paginated = true)
    {
        if ($paginated) {
            $select = new Select($this->table);
            $select->where($params);
            $select->order(array('lastname ASC'));
            $paginatorAdapter = new DbSelect($select, $this->adapter, $this->resultSetPrototype);
            $paginator = new Paginator($paginatorAdapter);

            return $paginator;
        }

        $resultSet = $this->select($params);

        return $resultSet;
    }

    /**
     * Get a contact row from its id
     * 
     * @param int $id
     * @return boolean|\Phonebook\Entity\Contact
     */
    public function fetch($id)
    {
        $row = $this->select(array('id' => (int) $id))->current();
        if (!$row) {
            return false;
        }
        return $row;
    }

    /**
     * Update contact row
     * 
     * @param \Phonebook\Entity\Contact $contact
     * @return boolean|number
     */
    public function save(\Phonebook\Entity\Contact $contact)
    {
        $id = (int) $contact->getId();

        if ($id == 0) {
            $contact->setCreatedAt(date('Y-m-d H:i:s'));
            try {
                $this->insert($contact->getArrayCopy());
            } catch (\Exception $e) {
                return false;
            }
            return $this->getLastInsertValue();
        } else {
            $contact->setUpdatedAt(date('Y-m-d H:i:s'));
            try {
                $this->update($contact->getArrayCopy(), array('id' => $id));
            } catch (\Exception $e) {
                return false;
            }
            return $id;
        }
    }

    /**
     * Delete contact row
     * 
     * @param int $id
     * @return int
     */
    public function trash($id)
    {
        return $this->delete(array('id' => (int) $id));
    }
}
