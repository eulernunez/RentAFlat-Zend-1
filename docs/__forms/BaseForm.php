<?php
class Application_Form_BaseForm extends Zend_Form
{
    
   
    protected $validatorLenghtCP;
    
    
    public function __construct()
    {
        
        parent::__construct();
        
        
      
        $this->validatorLenghtCP = new Zend_Validate_StringLength(5, 5);
        $this->validatorLenghtCP->setMessages(array(
                    Zend_Validate_StringLength::TOO_SHORT => 'El CP es de %min% digitos.',
                    Zend_Validate_StringLength::TOO_LONG => 'El CP es de %max% digitos.',
                ));
        
    }

    
 
    
    
    
}