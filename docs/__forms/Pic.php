<?php

class Application_Form_Pic extends Zend_Form
{

    public function init()
    {
        
        
        $this->setAttrib('enctype', 'multipart/form-data');
 
        $this->addElement('text', 'name', array(
                                                    'required'   => true,
                                                    'validators' => array( ),
                                                    'class' => 'sf'
                                                )
                         );
        
        $this->addElement('file', 'logo', array(
                                                    'class' => 'sf',
                                                    'multiple' => true        
                                               )
                         );
        
        
        $this->logo->addValidator( 'Extension', false, 'jpg,png,gif,jpeg' );
        $this->logo->addValidator( 'Size', false, '10024000' );
        $this->logo->setDestination( 'C:\xampp2\tmp' )
                   ->setValueDisabled( true );
 
         $submit = new Zend_Form_Element_Submit('Upload', array(
                                                                            'label' => 'Upload!'
                                                                        )
                                                );
 
        $this->addElements(array(
            $submit
        ));
        
        
        
        
        
    }
    
}    