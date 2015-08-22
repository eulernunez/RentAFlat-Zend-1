<?php

class Application_Form_Test extends Zend_Form
{
    public function init()
    {
        $this->addElement('text', 'name', array(
            'label' => 'What is your name2?',
            'required' => true
            /*
            'decorators' => array(
				array('ViewScript', array(
					'viewScript'=>'formElements/property/_nameElement.phtml'
				))
			) */
        ));
 
        $this->addElement('submit', 'submitbutton', array(
            'ignore'=>true,
            'label'=>'Ok!'
        ));
    }

    
}