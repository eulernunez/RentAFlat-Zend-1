<?php
class Application_Form_Alquiler extends Zend_Form
{
    protected $decoradores;
    
    public function init( )
    {
        
        // Formulario alta de contacto
        $this->decoradores = array(
                                    'ViewHelper',
                                    array('Errors', 
                                            array('tag' => 'div', 
                                                  'style' => 'color:red;')
                                          ),
                                    'HtmlTag',
                                    'Label'
                            );

        
        
        
        // Cantidad
        
        $this->addElement(
                            'text', 
                            'quantity_persons', 
                            array(
                                    'label' => 'Cantidad de personas (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->quantity_persons->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar cantidad de personas.'
                                                  )
                              ));
        
        $this->quantity_persons->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Ingresar cantidad de personas')));
        $this->quantity_persons->setDecorators($this->decoradores);
        $this->quantity_persons->setAttrib('class','form_input_contact_small');
        //$this->quantity_persons->removeDecorator('Errors');
        $this->quantity_persons->removeDecorator('HtmlTag');
        $this->quantity_persons->removeDecorator('Label');
        

        
        
        
        
        
    }        
    
    
    
    
}