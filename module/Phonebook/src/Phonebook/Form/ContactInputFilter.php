<?php
namespace Phonebook\Form;

use Zend\InputFilter\InputFilter;

class ContactInputFilter extends InputFilter // implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add(array(
            'name' => 'title',
            'required' => true,
            'message' => 'Value must be either Mr.,Mrs., Ms., Dr.',
            'validators' => array(
                array(
                    'name' => 'InArray',
                    'options' => array(
                        'haystack' => array('Mr.', 'Mrs.', 'Ms.', 'Dr.'),
            
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'firstname',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'StripTags'
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 2,
                        'max' => 45,
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'lastname',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'StripTags'
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 2,
                        'max' => 45,
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'StripTags'
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'message' => 'Email format invalid',
                    )
                ),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 2,
                        'max' => 45,
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'address',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'StripTags'
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 2,
                        'max' => 255,
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'phone',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'StripTags'
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 2,
                        'max' => 20,
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'notes',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'StripTags'
                ),
            ),
        ));
    }
    
    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                
            ),
            'firstname' => array(
                
            ),
            'lastname' => array(
                
            ),
            'email' => array(
                
            ),
            'address' => array(
                
            ),
            'phone' => array(
                
            ),
            'notes' => array(
                
            ),
        );
    }
}
