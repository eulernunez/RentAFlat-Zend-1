<?php
class Application_Form_Enlaces extends Zend_Form
{

    protected $decoradores;
    protected $validatorLenghtCP;

    public function init( )
    {
         

        $this->decoradores = array(
                              'ViewHelper',
                              array('Errors', array('tag' => 'div', 'style' => 'color:red;')),
                              'HtmlTag',
                              'Label'
                            );


        $this->validatorLenghtCP = new Zend_Validate_StringLength(5, 5);
        $this->validatorLenghtCP->setMessages(array(
                    Zend_Validate_StringLength::TOO_SHORT => 'El CP es de %min% digitos.',
                    Zend_Validate_StringLength::TOO_LONG => 'El CP es de %max% digitos.',
                ));


        
        

        
        // Operacion
        /*
        $this->addElement(
                                'select', 
                                'operacion', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        $operacion = array('0' => 'Apartamentos en alquiler',
                           '1' => 'Habitación individual en alquiler',
                           '2' => 'Habitación doble en alquiler'
                            );
     
        $this->operacion->addMultiOptions($operacion);  
        #$this->municipio->removeDecorator('Errors');
        $this->operacion->setAttrib('class','form_select_medium');
        $this->operacion->removeDecorator('HtmlTag');
        $this->operacion->removeDecorator('Label');
        */
        
   
        /*
        $this->addElement(
                                'select', 
                                'operacion', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        $operacion = array('0' => 'Alquiler', '1' => 'Venta');

        $this->operacion->addMultiOptions($operacion);  
        //$this->municipio->removeDecorator('Errors');
        $this->operacion->setAttrib('class','form_select_medium');
        $this->operacion->removeDecorator('HtmlTag');
        $this->operacion->removeDecorator('Label');
        */
        
        
        
        
        




        // Tipo vivienda
        /*
        $this->addElement(  'radio', 
                            'tipoVivienda', 
                            array(  'label' => 'Tipo de vivienda (*)',
                                    'multiOptions' => array(
                                                                
                                                                0 => 'Piso',
                                                                1 => 'Dúplex',
                                                                2 => 'Estudio',
                                                                3 => 'Ático',
                                                                4 => 'Loft',
                                                                5 => 'Casa/Chalet'
                                                           )
                                                ));        
        
        $this->tipoVivienda->setValue('Piso');
        $this->tipoVivienda->setAttrib('class','form_input_contact');
        $this->tipoVivienda->removeDecorator('Errors');
        $this->tipoVivienda->removeDecorator('HtmlTag');
        $this->tipoVivienda->removeDecorator('Label');
        */
        
        
        
        


        //Precio / Mes
        
        

        //Precio dia
        /*
        $this->addElement(
                            'text', 
                            'precioDia', 
                            array(
                                    'label' => 'Precio / Mes (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->precioDia->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el precio.'
                                                   )
                              ));
        
        $this->precioDia->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Ingresar cantidad entera')));
        $this->precioDia->setDecorators($this->decoradores);
        $this->precioDia->setAttrib('class','form_input_contact_small');
        //$this->precioDia->removeDecorator('Errors');
        $this->precioDia->removeDecorator('HtmlTag');
        $this->precioDia->removeDecorator('Label');
        */
        
        
        
        
        
        
        
      

        


        // Superficie
        /*
        $this->addElement(
                            'text', 
                            'superficie', 
                            array(
                                    'label' => 'Superficie (m2) (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->superficie->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar la superficie m2.'
                                                  )
                              ));
        
        $this->superficie->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Ingresar cantidad entera')));
        $this->superficie->setDecorators($this->decoradores);
        $this->superficie->setAttrib('class','form_input_contact_small');
        //$this->superficie->removeDecorator('Errors');
        $this->superficie->removeDecorator('HtmlTag');
        $this->superficie->removeDecorator('Label');
        */
          
        
      
        
        // Número de baños
        /*
        $dbBanyo = new Application_Model_DbTable_TipoBanyo( );
        $banyos = $dbBanyo->getBanyosList( );
        $this->addElement(
                                'select', 
                                'numeroBanyos', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        /*   foreach($banyos as $key => $value){
           $this->numeroBanyos->addMultiOption($key,$value);
        }

        $this->numeroBanyos->addMultiOptions($banyos);
        //$this->numeroBanyos->removeDecorator('Errors');
        $this->numeroBanyos->setAttrib('class','form_select_bit');
        $this->numeroBanyos->removeDecorator('HtmlTag');
        $this->numeroBanyos->removeDecorator('Label');
        */
        
        
          
        
        
        
        // OK
        
        /*
         * TITULO 1 => enlace
         * TITULO 2 => Nombre
         * TITULO 3 => Direccion
         * TITULO 4 => Telefono
         * 
         * 
         */
        
        // Titulo enlace
        $this->addElement(
                            'text', 
                            'title', 
                            array(
                                    'label' => 'Titulo (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim'),
                                    'maxlength' => '120'
                              )
                     );

        $this->title->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar enlace.'
                                                   )
                              ));

        $this->title->setDecorators($this->decoradores);
        $this->title->setAttrib('class','form_input_contact');
        //$this->title->removeDecorator('Errors');
        $this->title->removeDecorator('HtmlTag');
        $this->title->removeDecorator('Label');
        

        
        // Titulo nombre
        $this->addElement(
                            'text', 
                            'name', 
                            array(
                                    'label' => 'Name (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim'),
                                    'maxlength' => '120'
                              )
                     );

        $this->name->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar nombre.'
                                                   )
                              ));

        $this->name->setDecorators($this->decoradores);
        $this->name->setAttrib('class','form_input_contact');
        //$this->name->removeDecorator('Errors');
        $this->name->removeDecorator('HtmlTag');
        $this->name->removeDecorator('Label');

        
        
        // Titulo dirección
        $this->addElement(
                            'text', 
                            'address', 
                            array(
                                    'label' => 'Address (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim'),
                                    'maxlength' => '110'
                              )
                     );

        $this->address->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'dirección.'
                                                   )
                              ));

        $this->address->setDecorators($this->decoradores);
        $this->address->setAttrib('class','form_input_contact');
        //$this->address->removeDecorator('Errors');
        $this->address->removeDecorator('HtmlTag');
        $this->address->removeDecorator('Label');


         // Titulo Teléfono  
         $this->addElement(
                                'text', 
                                'telephone', 
                                array(
                                        'label' => 'Teléfono (*)', 
                                        'required' => true, 
                                        'filters' => array('stringTrim')
                                  )
                         );

         $this->telephone->addValidator('NotEmpty',
                             true,
                             array('messages' => array(
                                                        Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar teléfono.'
                                                       )
                                  ));

         $this->telephone->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
         $this->telephone->setDecorators($this->decoradores);
         $this->telephone->setAttrib('class','form_input');
         //$this->telephone->removeDecorator('Errors');
         $this->telephone->removeDecorator('HtmlTag');
         $this->telephone->removeDecorator('Label');

        
        
        
        
        // Titulo precio
        /*
        $this->addElement(
                            'text', 
                            'tituloPrecio', 
                            array(
                                    'label' => 'Titulo (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->tituloPrecio->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar titulo de precio.'
                                                   )
                              ));

        $this->tituloPrecio->setDecorators($this->decoradores);
        $this->tituloPrecio->setAttrib('class','form_input_contact_small');
        //$this->tituloPrecio->removeDecorator('Errors');
        $this->tituloPrecio->removeDecorator('HtmlTag');
        $this->tituloPrecio->removeDecorator('Label');
        */
        
        
        // Cantidad de personas
        /*
        $this->addElement(
                            'text', 
                            'cantidadPersonas', 
                            array(
                                    'label' => 'Nº personas (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->cantidadPersonas->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar nº de personas.'
                                                   )
                              ));

        $this->cantidadPersonas->setDecorators($this->decoradores);
        $this->cantidadPersonas->setAttrib('class','form_input_contact');
        //$this->cantidadPersonas->removeDecorator('Errors');
        $this->cantidadPersonas->removeDecorator('HtmlTag');
        $this->cantidadPersonas->removeDecorator('Label');
        */
        
        
        
        
        
        
        
        
        
        
        // Descripcion completa
        /*
        $this->addElement(
                            'textarea', 
                            'descripcion', 
                            array(
                                    'label' => 'Descripción completa', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->descripcion->setDecorators($this->decoradores);
        $this->descripcion->setAttrib('class','form_input_contact');
        $this->descripcion->removeDecorator('Errors');
        $this->descripcion->removeDecorator('HtmlTag');
        $this->descripcion->removeDecorator('Label');
        */
       
         
        // Alta de suministros
        /* Versión para la web*/
        /*
        $altaSuministros = new Zend_Form_Element_Checkbox('altaSuministros');
        $altaSuministros->setLabel('Alta de suministros')
                ->setRequired(FALSE);
        $altaSuministros->setUncheckedValue(0);
        $altaSuministros->setCheckedValue(1);
        $altaSuministros->setAttrib('class','form_input_contact_very_small');
        $altaSuministros->removeDecorator('Errors');
        $altaSuministros->removeDecorator('HtmlTag');
        $altaSuministros->removeDecorator('Label');
        $this->addElement($altaSuministros);
        */
        
        /*
        $this->addElement(
                            'checkBox',
                            'altaSuministros',
                            array   (
                                        'label' => 'Alta de suministros',
                                        'required' => false,
                                        'checkedValue' => '1',
                                        'uncheckedValue'  => '0',
                                    )
                          ); 
        
        $this->altaSuministros->setAttrib('class','form_input_contact_very_small');
        $this->altaSuministros->removeDecorator('Errors');
        $this->altaSuministros->removeDecorator('HtmlTag');
        $this->altaSuministros->removeDecorator('Label');
        */
        

        // Ascensor
        /*
        $ascensor = new Zend_Form_Element_Checkbox('ascensor');
        $ascensor->setLabel('Ascensor')
                 ->setRequired(FALSE);
        
        $ascensor->setUncheckedValue(0);
        $ascensor->setCheckedValue(1);
        $ascensor->setAttrib('class','form_input_contact_very_small');
        $ascensor->removeDecorator('Errors');
        $ascensor->removeDecorator('HtmlTag');
        $ascensor->removeDecorator('Label');
        $this->addElement($ascensor);
        */
      
        
         
        
      
        
        // Población
        /*
        $this->addElement(
                            'text', 
                            'poblacion', 
                            array(
                                    'label' => 'Población (*)', 
                                    'required' => false, 
                                    'filters' => array('stringTrim'),
                                    'value' => 'Barcelona'
                              )
                     );
        //$this->poblacion->setAttrib('disabled','disabled');
        $this->poblacion->setAttrib('class','form_input_contact_small');
        $this->poblacion->removeDecorator('Errors');
        $this->poblacion->removeDecorator('HtmlTag');
        $this->poblacion->removeDecorator('Label');
        */
        
        
       
      


        

        
        //Nombre de la calle
        /*   
        $this->addElement(
                            'text', 
                            'direccion', 
                            array(
                                    'label' => 'Nombre de la calle (*)', 
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

        $this->direccion->setDecorators($this->decoradores);
        $this->direccion->setAttrib('class','form_input_contact');

        //$this->direccion->removeDecorator('Errors');
        $this->direccion->removeDecorator('HtmlTag');
        $this->direccion->removeDecorator('Label');
        */
        
        
            

        
        
        
        

        
        // Puerta
        /*
        $this->addElement(
                            'text', 
                            'puerta', 
                            array(
                                    'label' => 'Puerta', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );


        $this->puerta->setAttrib('class','form_input_contact_small');
        $this->puerta->removeDecorator('Errors');
        $this->puerta->removeDecorator('HtmlTag');
        $this->puerta->removeDecorator('Label');
        */
        

        // Otra MAS información
        /*
        $this->addElement(
                            'textarea', 
                            'informacion', 
                            array(
                                    'label' => 'Mas información', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        $this->informacion->setAttrib('class','form_input_contact_mas_info');
        $this->informacion->removeDecorator('Errors');
        $this->informacion->removeDecorator('HtmlTag');
        $this->informacion->removeDecorator('Label');
        */
        
        
        
        
        
        
        
        
         $this->addElement(
                            'Submit', 
                            'Grabar'
                          ); 
            
        
        
    }
}