<?php
class Application_Form_Usuario extends Zend_Form
{

    public function init()
    {
        
        //$this->setAction('user/process');
        
        
        /*
        $decoradores = array(
                              'ViewHelper',
                              array('Errors', array('tag' => 'div', 'style' => 'color:red;')),
                              array('HtmlTag', array('tag' => 'div', 'class' => 'formElement')),
                              array('Label', array('tag' => 'div'))
                            );

        
        
        
        
        
        
        // Case 1
        $nombre = new Zend_Form_Element_Text('nombre');
        
        $nombre->setLabel('Nombre :')
                ->setDecorators($decoradores)
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty'); 

        $submit = new Zend_Form_Element_Submit( 'Enviar' );
        $submit->setAttrib('id', 'enviar');

        

        // Case 2
        //StripTags delete las etiquetas HTML
        //StringTrim quita todos los caracteres de espacio en blanco iniciales y finales
        $name = new Zend_Form_Element_Text('name');  
	
        $name->setLabel('* Your Name:')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->setAttrib('size',50)
             ->addValidator('stringLength', false, array(0, 300))
             ->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Introducir su nombre es obligatorio.'
                                                       )
                                    
                                                    
                                  )
                            )
             ->setDecorators($decoradores);
        
        
        // Case 3
        
            $this->addElement(
                                'text', 
                                'userBusinessName', 
                                array(
                                        'label' => 'Nombre comercial (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim'),
                                        'value' => '',
                                        
                                  )
                         );
        
            $this->userBusinessName->setDecorators($decoradores);
            //$this->userBusinessName->removeDecorator('Errors');
            $this->userBusinessName->removeDecorator('HtmlTag');
            $this->userBusinessName->removeDecorator('Label');

        
        
        $this->addElements (array( $nombre, $name, $submit ) );
        
        
        
        
        */
        
         // Formulario alta de usuario  
        
        $decoradores = array(
                              'ViewHelper',
                              array('Errors', array('tag' => 'div', 'style' => 'color:red;')),
                              'HtmlTag',
                              'Label'
                            );
        
         $validatorLenghtClave = new Zend_Validate_StringLength(6, 10);
         $validatorLenghtClave->setMessages(array(
                    Zend_Validate_StringLength::TOO_SHORT => 'La clave es muy corta (min. %min%).',
                    Zend_Validate_StringLength::TOO_LONG => 'La clave es muy large (max. %max%).',
                ));

        
         $validatorLenghtCP = new Zend_Validate_StringLength(5, 5);
         $validatorLenghtCP->setMessages(array(
                    Zend_Validate_StringLength::TOO_SHORT => 'El CP es de %min% digitos.',
                    Zend_Validate_StringLength::TOO_LONG => 'El CP es de %max% digitos.',
                ));
         
     
        
        // Tipo usuario
         /*
         $this->addElement(  'radio', 
                            'tipo', 
                            array(
                                    'value' => '1',
                                    'multiOptions' => array(
                                                                
                                                                0 => 'Particular',
                                                                1 => 'Profesional',
                                                           ),
                                                ));
          * 
          */
         
         
         // Correo electrónico
         
         
         $this->addElement(
                                'text', 
                                'correoElectronico', 
                                array(
                                        'label' => '', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
         
         $this->correoElectronico->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Introducir su correo electrónico.'
                                                       )
                                  ));
           
            $this->correoElectronico->addValidator('EmailAddress',true,
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
           
            $this->correoElectronico->setDecorators($decoradores);
            $this->correoElectronico->setAttrib('class','form_input_contact'); 
            //$this->correoElectronico->removeDecorator('Errors');
            $this->correoElectronico->removeDecorator('HtmlTag');
            $this->correoElectronico->removeDecorator('Label');
        
        
            // Contraseña
            $this->addElement(
                                'password', 
                                'contrasenya', 
                                array(
                                        'label' => 'Contraseña (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
    
            $this->contrasenya->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar su clave.'
                                                       )
                                  ));
            
            //$this->contrasenya->addValidator('stringLength', false, array(6, 10));
            
            $this->contrasenya->addValidator( $validatorLenghtClave  );
            $this->contrasenya->setDecorators($decoradores);
            $this->contrasenya->setAttrib('class','form_input_contact_small');
            //$this->contrasenya->removeDecorator('Errors');
            $this->contrasenya->removeDecorator('HtmlTag');
            $this->contrasenya->removeDecorator('Label');

            // Repetir contraseña
            $this->addElement(
                                'password', 
                                'repetirContrasenya', 
                                array(
                                        'label' => 'Repetir contraseña (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
                        
            $this->repetirContrasenya->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Re-ingresar su clave.'
                                                       )
                                  ));
            
            $this->repetirContrasenya->addValidator( $validatorLenghtClave  );            
            $this->repetirContrasenya->setDecorators($decoradores);
            $this->repetirContrasenya->setAttrib('class','form_input_contact_small');
            //$this->repetirContrasenya->removeDecorator('Errors');
            $this->repetirContrasenya->removeDecorator('HtmlTag');
            $this->repetirContrasenya->removeDecorator('Label');
            
            // Nombre comercial
            $this->addElement(
                                'text', 
                                'nombreComercial', 
                                array(
                                        'label' => 'Nombre de la agencia (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->nombreComercial->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el nombre comercial.'
                                                       )
                                  ));

            $this->nombreComercial->setDecorators($decoradores);
            $this->nombreComercial->setAttrib('class','form_input_contact');
            //$this->nombreComercial->removeDecorator('Errors');
            $this->nombreComercial->removeDecorator('HtmlTag');
            $this->nombreComercial->removeDecorator('Label');
        
        
         // Código postal   
         $this->addElement(
                                'text', 
                                'codigoPostal', 
                                array(
                                        'label' => 'Código Postal (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->codigoPostal->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el CP.'
                                                       )
                                  ));
        
            //$this->codigoPostal->addValidator('stringLength', false, array(5, 5));
            
            $this->codigoPostal->addValidator( $validatorLenghtCP );
            $this->codigoPostal->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
            $this->codigoPostal->setDecorators($decoradores);
            $this->codigoPostal->setAttrib('class','form_input_contact_small');
            //$this->codigoPostal->removeDecorator('Errors');
            $this->codigoPostal->removeDecorator('HtmlTag');
            $this->codigoPostal->removeDecorator('Label');

            

            // Provincia
            $this->addElement(
                                'text', 
                                'provincia', 
                                array(
                                        'label' => 'Provincia (*)', 
                                        'required' => false, 
                                        'filters' => array('stringTrim'),
                                        'value' => 'Barcelona'
                                  )
                         );
            $this->provincia->setAttrib('disabled','disabled');
            $this->provincia->setAttrib('class','form_input_contact_small');
            $this->provincia->removeDecorator('Errors');
            $this->provincia->removeDecorator('HtmlTag');
            $this->provincia->removeDecorator('Label');
            
            
            $modelo = new Application_Model_DbTable_Municipio( );
            $municipios = $modelo->getMunicipiosList( );
            
            
            // Municipio
             $this->addElement(
                                    'select', 
                                    'municipio', 
                                    array(
                                            'label' => ' ', 
                                            'required' => false, 
                                            'filters' => array('stringTrim')
                                         )
                              );
        
           
        
        $this->municipio->addMultiOptions($municipios);
        

        //$this->municipio->removeDecorator('Errors');
        $this->municipio->setAttrib('class','form_select');
        
        $this->municipio->removeDecorator('HtmlTag');
        $this->municipio->removeDecorator('Label');
      
             
             
             
            
            
            
            
            
            
            // Dirección
            $this->addElement(
                                'text', 
                                'direccion', 
                                array(
                                        'label' => 'Dirección (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->direccion->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar la dirección.'
                                                       )
                                  ));

            $this->direccion->setDecorators($decoradores);
            $this->direccion->setAttrib('class','form_input_contact');
            
            //$this->direccion->removeDecorator('Errors');
            $this->direccion->removeDecorator('HtmlTag');
            $this->direccion->removeDecorator('Label');
            
            
            //Nombre contacto
            $this->addElement(
                                'text', 
                                'nombreContacto', 
                                array(
                                        'label' => 'Nombre contacto (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->nombreContacto->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar nombre.'
                                                       )
                                  ));

            $this->nombreContacto->setDecorators($decoradores);
            $this->nombreContacto->setAttrib('class','form_input_contact');
            //$this->nombreContacto->removeDecorator('Errors');
            $this->nombreContacto->removeDecorator('HtmlTag');
            $this->nombreContacto->removeDecorator('Label');


            // Apellido contacto
            $this->addElement(
                                'text', 
                                'apellidoContacto', 
                                array(
                                        'label' => 'Apellido contacto  (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->apellidoContacto->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar apellido.'
                                                       )
                                  ));

            $this->apellidoContacto->setDecorators($decoradores);
            $this->apellidoContacto->setAttrib('class','form_input_contact');
            //$this->apellidoContacto->removeDecorator('Errors');
            $this->apellidoContacto->removeDecorator('HtmlTag');
            $this->apellidoContacto->removeDecorator('Label');
            
            
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
            $this->telefono->setDecorators($decoradores);
            $this->telefono->setAttrib('class','form_input_contact_small');
            //$this->telefono->removeDecorator('Errors');
            $this->telefono->removeDecorator('HtmlTag');
            $this->telefono->removeDecorator('Label');
            
            

            
            // Móvil
            $this->addElement(
                                'text', 
                                'movil', 
                                array(
                                        'label' => 'Móvil', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
        
            $this->movil->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
            $this->movil->setDecorators($decoradores);
            $this->movil->setAttrib('class','form_input_contact_small');
            //$this->movil->removeDecorator('Errors');
            $this->movil->removeDecorator('HtmlTag');
            $this->movil->removeDecorator('Label');
            

            // Web
            $this->addElement(
                                'text', 
                                'web', 
                                array(
                                        'label' => 'Web (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->web->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar web.'
                                                       )
                                  ));

            $this->web->setDecorators($decoradores);
            $this->web->setAttrib('class','form_input_contact_small');
            //$this->web->removeDecorator('Errors');
            $this->web->removeDecorator('HtmlTag');
            $this->web->removeDecorator('Label');

            
            
            
            
            
          // CIF  
         $this->addElement(
                                'text', 
                                'cif', 
                                array(
                                        'label' => 'CIF (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );
            
            $this->cif->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el CIF.'
                                                       )
                                  ));
        
            $this->cif->addValidator('alnum', true, array('messages' => array(Zend_Validate_Alnum::NOT_ALNUM => 'Sólo alfanúmerico')));
            $this->cif->setDecorators($decoradores);
            $this->cif->setAttrib('class','form_input_contact_small');
            //$this->cif->removeDecorator('Errors');
            $this->cif->removeDecorator('HtmlTag');
            $this->cif->removeDecorator('Label');
            
            
            
            
            
            
            
/*        
        
        $this->addElement(
                            'CheckBox',
                            'contract',
                            array(
                            'label' => 'I accept the terms of service',
                            'style' =>'margin-left:100px;',
                            'required' => true,
                            'checkedValue' => '1',
                            'uncheckedValue'  => '0',
                            'checked' => true,    
                            'validators' => array(array('NotEmpty', true)),
                            )
                          );
        
        
        
        $a=new Application_Model_Class_Categories();
        $this->addElement(
                            'Select', 
                            'municipio',
                            array(
                                    'label'       => 'Category:',
                                    'AutoComplete'=> true, 
                                    'MultiOptions'=> $a->GetCategories(),
                                    'required' => true 
                                  )
                          ); 
        
        
        */
        
        
        $this->addElement(
                            'Submit', 
                            'Grabar'
                          ); 
            
            
            
            
    }


}
