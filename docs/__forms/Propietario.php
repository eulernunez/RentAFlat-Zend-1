<?php
class Application_Form_Propietario extends Zend_Form
{
    
    protected $decoradores;
    
    public function init( )
    {

        // Formulario alta de contacto
        $this->decoradores = array(
                              'ViewHelper',
                              array('Errors', array('tag' => 'div', 'style' => 'color:red;')),
                              'HtmlTag',
                              'Label'
                            );

        // Nombre 
        $this->addElement(
                            'text', 
                            'nombre', 
                            array(
                                    'label' => 'Nombre del solicitante (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->nombre->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar nombre.'
                                                   )
                              ));

        $this->nombre->setDecorators($this->decoradores);
        $this->nombre->setAttrib('class','form_input');
        //$this->nombre->removeDecorator('Errors');
        $this->nombre->removeDecorator('HtmlTag');
        $this->nombre->removeDecorator('Label');
                

        
        // Primer apellido
        $this->addElement(
                            'text', 
                            'apellidos', 
                            array(
                                    'label' => 'Primer apellido',
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        $this->apellidos->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar apellido.'
                                                   )
                              ));
        $this->apellidos->setDecorators($this->decoradores);
        
        
        $this->apellidos->setAttrib('class','form_input');
        ////$this->apellidos->removeDecorator('Errors');
        $this->apellidos->removeDecorator('HtmlTag');
        $this->apellidos->removeDecorator('Label');
        
        
        // Segundo apellido
        $this->addElement(
                            'text', 
                            'apellidos2', 
                            array(
                                    'label' => 'Segundo apellido (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->apellidos2->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar apellido.'
                                                   )
                              ));

        $this->apellidos2->setDecorators($this->decoradores);
        $this->apellidos2->setAttrib('class','form_input');
        //$this->apellidos2->removeDecorator('Errors');
        $this->apellidos2->removeDecorator('HtmlTag');
        $this->apellidos2->removeDecorator('Label');
        
        
         // DNI  
         $this->addElement(
                                'text', 
                                'dni', 
                                array(
                                        'label' => 'DNI (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
         $this->dni->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el DNI.'
                                                       )
                                  ));
        
         //$this->dni->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
         $this->dni->setDecorators($this->decoradores);
         $this->dni->setAttrib('class','form_input');
         //$this->dni->removeDecorator('Errors');
         $this->dni->removeDecorator('HtmlTag');
         $this->dni->removeDecorator('Label');

        
        // Pais
        $this->addElement(
                            'text', 
                            'nacionalidad', 
                            array(
                                    'label' => 'Pais (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->nacionalidad->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar pais.'
                                                   )
                              ));

        $this->nacionalidad->setDecorators($this->decoradores);
        $this->nacionalidad->setAttrib('class','form_input');
        //$this->nacionalidad->removeDecorator('Errors');
        $this->nacionalidad->removeDecorator('HtmlTag');
        $this->nacionalidad->removeDecorator('Label');



        // Población
        $this->addElement(
                            'text', 
                            'poblacion', 
                            array(
                                    'label' => 'Población (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->poblacion->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar población.'
                                                   )
                              ));

        $this->poblacion->setDecorators($this->decoradores);
        $this->poblacion->setAttrib('class','form_input');
        //$this->poblacion->removeDecorator('Errors');
        $this->poblacion->removeDecorator('HtmlTag');
        $this->poblacion->removeDecorator('Label');

        
        
        
        
        
        
        
        
        // Direccion
         $this->addElement(
                            'textarea', 
                            'direccion', 
                            array(
                                    'label' => 'Direccion (*)', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );
        
        //$this->direccion->setDecorators($this->decoradores);
        $this->direccion->setAttrib('class','form_textarea_contacto');
        $this->direccion->removeDecorator('Errors');
        $this->direccion->removeDecorator('HtmlTag');
        $this->direccion->removeDecorator('Label');

        
        // Codigo postal
        $this->addElement(
                            'text', 
                            'cpostal', 
                            array(
                                    'label' => 'Código postal (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->cpostal->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el CP.'
                                                   )
                              ));

        $this->cpostal->setDecorators($this->decoradores);
        $this->cpostal->setAttrib('class','form_input');
        //$this->cpostal->removeDecorator('Errors');
        $this->cpostal->removeDecorator('HtmlTag');
        $this->cpostal->removeDecorator('Label');
        



        // Edades de los interesados
         $this->addElement(
                            'textarea', 
                            'edades', 
                            array(
                                    'label' => 'Edades de los interesados (*)', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );
        
        //$this->edades->setDecorators($this->decoradores);
        $this->edades->setAttrib('class','form_textarea_contacto');
        $this->edades->removeDecorator('Errors');
        $this->edades->removeDecorator('HtmlTag');
        $this->edades->removeDecorator('Label');
        
        
        
        
        
        
        
        
        
        
        // Correo
        $this->addElement(
                                'text', 
                                'correo', 
                                array(
                                        'label' => '', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
         
        $this->correo->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Introducir su correo electrónico.'
                                                       )
                                  ));
        
        
        $this->correo->addValidator('EmailAddress',true,
                                                array('messages' => array(
                                                            Zend_Validate_EmailAddress::INVALID => 
                                                                 "El tipo especificado no es válido, el valor debe ser una cadena de texto",
                                                            Zend_Validate_EmailAddress::INVALID_FORMAT => 
                                                                 "'%value%' no es una dirección de correo electrónico válida en el formato local-part@hostname",
                                                            Zend_Validate_EmailAddress::INVALID_HOSTNAME   => "'%hostname%' no es un nombre de host válido para la dirección de correo electrónico '%value%'",
                                                            Zend_Validate_EmailAddress::INVALID_MX_RECORD  => "'%hostname%' no parece tener un registro MX válido para la dirección de correo electrónico '%value%'",
                                                            Zend_Validate_EmailAddress::INVALID_SEGMENT    => "'%hostname%' no esta en un segmento de red ruteable. La dirección de correo electrónico '%value%' no se debe poder resolver desde una red pública.",
                                                            Zend_Validate_EmailAddress::DOT_ATOM           => "'%localPart%' no es igual al formato dot-atom",
                                                            Zend_Validate_EmailAddress::QUOTED_STRING      => "'%localPart%' no es igual al formato quoted-string",
                                                            Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "'%localPart%' no es una parte local válida para la dirección de correo electrónico '%value%'",
                                                            Zend_Validate_EmailAddress::LENGTH_EXCEEDED    => "'%value%' excede la longitud permitida",))); 
            
        $this->correo->setDecorators($this->decoradores);
        $this->correo->setAttrib('class','form_input'); 
        //$this->correo->removeDecorator('Errors');
        $this->correo->removeDecorator('HtmlTag');
        $this->correo->removeDecorator('Label');
        

         // Movil
        /*
         $this->addElement(
                                'text', 
                                'movil', 
                                array(
                                        'label' => 'Móvil (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
         $this->movil->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el número.'
                                                       )
                                  ));
        
         $this->movil->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
         $this->movil->setDecorators($this->decoradores);
         $this->movil->setAttrib('class','form_input');
         //$this->movil->removeDecorator('Errors');
         $this->movil->removeDecorator('HtmlTag');
         $this->movil->removeDecorator('Label');

        */
        
        
         



         // Teléfono  
         $this->addElement(
                                'text', 
                                'telefono', 
                                array(
                                        'label' => 'Teléfono (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
         $this->telefono->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el teléfono.'
                                                       )
                                  ));
        
         $this->telefono->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
         $this->telefono->setDecorators($this->decoradores);
         $this->telefono->setAttrib('class','form_input');
         //$this->telefono->removeDecorator('Errors');
         $this->telefono->removeDecorator('HtmlTag');
         $this->telefono->removeDecorator('Label');
        
        
        
         
         
         
        

         // Mensaje
         /*
         $this->addElement(
                            'textarea', 
                            'mensaje', 
                            array(
                                    'label' => 'Mensaje (*)', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->mensaje->setDecorators($this->decoradores);
        $this->mensaje->setAttrib('class','form_textarea_contacto');
        $this->mensaje->removeDecorator('Errors');
        $this->mensaje->removeDecorator('HtmlTag');
        $this->mensaje->removeDecorator('Label');
        */

        // Enviar
         $this->addElement(
                            'Submit', 
                            'Grabar'
                          ); 
            
        
        
        
        
        
        
    }
    
    
    
}