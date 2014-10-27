<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Form;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Form\Form;

/**
 * Contact form
 *
 * @package Phonebook
 * @subpackage Form
 * @version 1.0
 */
class Contact extends Form
{
    /**
     * Constructor
     */
    public function __construct(\Zend\InputFilter\InputFilter $contactInputFilter)
    {
        parent::__construct('person');
        $this->setHydrator(new ClassMethodsHydrator());
        $this->setAttribute('role', 'form');
        $this->setAttribute('novalidate', 'novalidate');
        $this->setObject(new \Phonebook\Entity\Contact());
        $this->setInputFilter($contactInputFilter);

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'select',
            'options' => array(
                 'value_options' => array(
                    'Mr.' => 'Mr.',
                    'Mrs.' => 'Mrs.',
                    'Ms.' => 'Ms.',
                    'Dr.' => 'Dr.',
                ),
                'label' => 'Title:',
                'column-size' => 'sm-1',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact title',
            ),
        ));

        $this->add(array(
            'name' => 'firstname',
            'type' => 'text',
            'options' => array(
                'label' => 'Firstname:',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact firstname',
            ),
        ));

        $this->add(array(
            'name' => 'lastname',
            'type' => 'text',
            'options' => array(
                'label' => 'Lastname:',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact lastname',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email:',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact email',
            ),
        ));

        $this->add(array(
            'name' => 'address',
            'type' => 'text',
            'options' => array(
                'label' => 'Address:',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact address',
            ),
        ));

        $this->add(array(
            'name' => 'phone',
            'type' => 'text',
            'options' => array(
                'label' => 'Telphone:',
                'column-size' => 'sm-2',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact phone',
            ),
        ));

        $this->add(array(
            'name' => 'notes',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Notes:',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2'),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Contact notes',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'options' => array(
                'column-size' => 'sm-10 col-sm-offset-2',
            ),
            'attributes' => array(
                'value' => 'Save contact',
                'class' => 'btn btn-success',
            )
        ));
    }
}
