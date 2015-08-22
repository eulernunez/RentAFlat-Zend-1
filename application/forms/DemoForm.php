<?php

class Application_Form_DemoForm extends Zend_Form
{
    protected $decoradores;
    /*
    public function init()
    {
        $this->addElement('text', 'name', array(
            'label' => 'What is your name2?',
            'required' => true,
           
            'decorators' => array(
				array('ViewScript', array(
					'viewScript'=>'formElements/property/_nameElement.phtml'
				))
			) 
        ));
 
        $this->addElement('submit', 'submitbutton', array(
            'ignore'=>true,
            'label'=>'Ok!'
        ));
    }
    */
    
    public function init()
    {        
        
        $this->decoradores = array(
                              'ViewHelper',
                              array('Errors', array('tag' => 'div', 'style' => 'color:green;')),
                              'HtmlTag',
                              'Label'
                            );

        /*
        $this->setElementDecorators(
                 array(
                        'ViewHelper',
                        array(
                            array('data' => 'HtmlTag'),
                            array('tag' => 'td', 'class' => 'element')
                            ),
                        
                        array('Label', array('tag' => 'td'))
                      )
        );
        */
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form'
            
        ));
       // array('HtmlTag', array('tag' => 'table')),  
       
        $this->setElementDecorators(array(
                'ViewHelper',
                array(  array('data' => 'HtmlTag'),
                        array('tag' => 'td', 'class' => 'element')
                     ),
                array('Label', array('tag' => 'td'))
        ));
        
        /*
        $this->setElementDecorators(array(
                'ViewHelper',
                'Label',
                'HtmlTag',
                'Errors'
        ));
        */
        
        // array('HtmlTag', array('tag' => 'span', 'class' => 'box-text-title')),
         
         
        
        $this->addElement(
                            'text', 
                            'titulo', 
                            array(
                                    'label' => 'Titulo (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim'),
                                    'maxlength' => '80'
                              )
        );

          
      
          
        $this->titulo->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar titulo del anuncio.'
                                                   )
        ));

       
        /*
        $this->titulo->setDecorators(
                                array(
                                        'ViewHelper',
                                        'Label',
                                        array('HtmlTag', array('tag' => 'span', 'class' => 'box-text-title')),
                                        'Errors'
                                        )
                    );
        */   
     
        //$this->titulo->setDecorators($this->decoradores);
        //$this->titulo->removeDecorator('Errors');
        /* $this->titulo->setAttrib('class','form_input_contact');
        //$this->titulo->removeDecorator('Errors');
        $this->titulo->removeDecorator('HtmlTag');
        $this->titulo->removeDecorator('Label');
        */
        //$this->titulo->removeDecorator('HtmlTag');
        //$this->titulo->removeDecorator('HtmlTag');
         
         
        
        $this->addElement(
                        'select', 
                        'operacion', 
                        array(
                                'label' => 'Sexo', 
                                'required' => true, 
                                'filters' => array('stringTrim'),
                                'multiOptions' => array('' => 'Selleccione ..', 'h' => 'Hombre', 'm' => 'Mujer')
                        )
                );

        /*
        $this->operacion->setDecorators(
                                array(
                                        'ViewHelper',
                                        'Label',
                                        array('HtmlTag', array('tag' => 'span', 'class' => 'box-text-title')),
                                        'Errors'
                                        )
                    );        
        */
       
        
        
        
        /*
        $operacion = array('0' => 'Apartamentos en alquiler',
                           '1' => 'Habitación individual en alquiler',
                           '2' => 'Habitación doble en alquiler'
                            );
        
        $this->operacion->addMultiOptions($operacion); 
         *  
        //$this->municipio->removeDecorator('Errors');
        $this->operacion->setAttrib('class','form_select_medium');
        $this->operacion->removeDecorator('HtmlTag');
        $this->operacion->removeDecorator('Label');
        */
        //$this->operacion->removeDecorator('HtmlTag');
        //$this->operacion->removeDecorator('Label');
        
        
        
        $this->addElement(
                            'textarea', 
                            'descripcion', 
                            array(
                                    'label' => 'Descripción completa', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->descripcion->setDecorators($this->decoradores);
        //$this->descripcion->setAttrib('class','form_input_contact');
        //$this->descripcion->removeDecorator('Errors');
        //$this->descripcion->removeDecorator('HtmlTag');
        //$this->descripcion->removeDecorator('Label');        
        
        
        $this->addElement('submit', 'submitbutton', array(
            'ignore'=>true,
            'label'=>'Ok!'
        ));        
        
        
        
        
    }    
    
    
    
    
    
}