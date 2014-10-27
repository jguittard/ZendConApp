<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Phonebook for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Phonebook\Form;

use Zend\Form\Form;

/**
 * Search form
 *
 * @package Phonebook
 * @subpackage Form
 * @version 1.0
 */
class Search extends Form
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('search');
        $this->setAttribute('role', 'search');
        $this->setAttribute('class', 'navbar-form navbar-right');

        $this->add(array(
            'name' => 'query',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Search by...'
            ),
        ));

        $this->add(array(
            'name' => 'field',
            'type' => 'select',
            'options' => array(
                'value_options' => array(
                    'firstname' => 'Firstname',
                    'lastname' => 'Lastname',
                    'email' => 'Email',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'options' => array(
                'glyphicon' => 'search',
                'label' => '',
            ),
            'attributes' => array(
                'class' => 'btn btn-default',
                'type' => 'submit',
            )
        ));
    }
}
