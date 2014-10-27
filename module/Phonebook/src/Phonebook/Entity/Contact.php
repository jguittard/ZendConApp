<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Entity;

use Zend\Stdlib\ArraySerializableInterface;

/**
 * Contact entity
 *
 * @package Phonebook
 * @subpackage Entity
 * @version 1.0
 */
class Contact implements ArraySerializableInterface
{
    /**
     * Contact primary key
     *
     * @var int
     */
    protected $id;

    /**
     * Contact title
     *
     * @var string
     */
    protected $title;

    /**
     * Contact firstname
     *
     * @var string
     */
    protected $firstname;

    /**
     * Contact lastname
     *
     * @var string
     */
    protected $lastname;

    /**
     * Contact email
     *
     * @var string
     */
    protected $email;

    /**
     * Contact address
     *
     * @var string
     */
    protected $address;

    /**
     * Contact phone
     *
     * @var string
     */
    protected $phone;

    /**
     * Notes about contact
     *
     * @var string
     */
    protected $notes;

    /**
     * Contact creation datetime
     *
     * @var string
     */
    protected $created_at;

    /**
     * Contact modification datetime
     *
     * @var string
     */
    protected $updated_at;

    /**
     * Get the $id
     *
     * @return number $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the $id
     *
     * @param  number $id
     * @return Contact
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the $title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the $title
     *
     * @param  string  $title
     * @return Contact
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the $firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the $firstname
     *
     * @param  string $firstname
     * @return Contact
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the $lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the $lastname
     *
     * @param  string $lastname
     * @return Contact
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFullname()
    {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }

    /**
     * Get the $email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the $email
     *
     * @param  string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the $address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the $address
     *
     * @param  string $address
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the $phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the $phone
     *
     * @param  string $phone
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the $notes
     *
     * @return string $notes
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set the $notes
     *
     * @param  string $notes
     * @return Contact
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get the $created_at
     *
     * @return string $created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the $created_at
     *
     * @param  string $created_at
     * @return Contact
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the $updated_at
     *
     * @return string $updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the $updated_at
     *
     * @param  string $updated_at
     * @return Contact
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
	 * Exchange internal values from provided array
	 *
	 * @param  array $array
	 * @return void
	 */
    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
	 * Return an array representation of the object
	 *
	 * @return array
	*/
    public function getArrayCopy()
    {
        $properties = get_object_vars($this);
        $properties['id'] = (int) $this->id == 0 ? null : $this->id;

        return $properties;
    }
}
