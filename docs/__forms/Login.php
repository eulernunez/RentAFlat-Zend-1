<?php
class Application_Form_Login extends Zend_Form
{
    //protected $decoradores;
    
    
    public function init()
    {

            // Correo
            $this->addElement(
                                'text', 
                                'correo', 
                                array(
                                        'label' => 'Correo', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                              );
            
            
            //$this->correo->setDecorators($this->decoradores);
            $this->correo->setAttrib('class','form_input');
            $this->correo->removeDecorator('Errors');
            $this->correo->removeDecorator('HtmlTag');
            $this->correo->removeDecorator('Label');
        
        


            // Clave
            $this->addElement(
                                'password', 
                                'clave', 
                                array(
                                        'label' => 'Clave', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                             );
            
    
            
            //$this->clave->setDecorators($this->decoradores);
            $this->clave->setAttrib('class','form_input');
            $this->clave->removeDecorator('Errors');
            $this->clave->removeDecorator('HtmlTag');
            $this->clave->removeDecorator('Label');
            
            
            
            
            $this->addElement(
                                'Submit', 
                                'Grabar'
                            ); 
            
            
        
        
        
    }

    
    
    
}