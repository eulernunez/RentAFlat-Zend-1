<?php
class Application_Form_Anuncio extends Zend_Form
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


        
        

        
        // Operacion OLD
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
        //$this->municipio->removeDecorator('Errors');
        $this->operacion->setAttrib('class','form_select_medium');
        $this->operacion->removeDecorator('HtmlTag');
        $this->operacion->removeDecorator('Label');

        
        
        
        
        




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
        $this->addElement(
                            'text', 
                            'precio', 
                            array(
                                    'label' => 'Precio / Mes (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->precio->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el precio.'
                                                   )
                              ));
        
        $this->precio->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Ingresar cantidad entera')));
        $this->precio->setDecorators($this->decoradores);
        $this->precio->setAttrib('class','form_input_contact_small');
        //$this->precio->removeDecorator('Errors');
        $this->precio->removeDecorator('HtmlTag');
        $this->precio->removeDecorator('Label');

        

        // Deposito
        $this->addElement(
                            'text', 
                            'deposito', 
                            array(
                                    'label' => 'Deposito', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->deposito->setAttrib('class','form_input_contact_small');
        $this->deposito->removeDecorator('Errors');
        $this->deposito->removeDecorator('HtmlTag');
        $this->deposito->removeDecorator('Label');

        


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
          
        
        // Número de dormitorios
        $dbDormitorio = new Application_Model_DbTable_TipoDormitorio( );
        
        
        
        $dormitorios = $dbDormitorio->getDormitoriosList( );
        
        
        $this->addElement(
                                'select', 
                                'numeroDormitorios', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        /*   foreach($dormitorios as $key => $value){
           $this->numeroDormitorios->addMultiOption($key,$value);
        }*/

        $this->numeroDormitorios->addMultiOptions($dormitorios);
        //$this->numeroDormitorios->removeDecorator('Errors');
        $this->numeroDormitorios->setAttrib('class','form_select_bit');
        $this->numeroDormitorios->removeDecorator('HtmlTag');
        $this->numeroDormitorios->removeDecorator('Label');
     
        
        
        // Número de baños
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
        }*/

        $this->numeroBanyos->addMultiOptions($banyos);
        //$this->numeroBanyos->removeDecorator('Errors');
        $this->numeroBanyos->setAttrib('class','form_select_bit');
        $this->numeroBanyos->removeDecorator('HtmlTag');
        $this->numeroBanyos->removeDecorator('Label');
        
        
        
          
        
        
        
        
        
        // Titulo anuncio
        $this->addElement(
                            'text', 
                            'titulo', 
                            array(
                                    'label' => 'Titulo (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->titulo->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar titulo del anuncio.'
                                                   )
                              ));

        $this->titulo->setDecorators($this->decoradores);
        $this->titulo->setAttrib('class','form_input_contact');
        //$this->titulo->removeDecorator('Errors');
        $this->titulo->removeDecorator('HtmlTag');
        $this->titulo->removeDecorator('Label');
        
        
        
        
        
        
        
        // Descripcion completa
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
        
       
         
        // Alta de suministros
        /* Versión para la web*/
        
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
      
         $this->addElement(
                            'checkBox',
                            'ascensor',
                            array(
                            'label' => 'Ascensor',
                            //'style' =>'margin-left:100px;',
                            'required' => false,
                            'checkedValue' => '1',
                            'uncheckedValue'  => '0',
                            //'checked' => true,    
                            //'validators' => array(array('NotEmpty', true)),
                            )
                          );
        
        $this->ascensor->setAttrib('class','form_input_contact_very_small');
        $this->ascensor->removeDecorator('Errors');
        $this->ascensor->removeDecorator('HtmlTag');
        $this->ascensor->removeDecorator('Label');
        
         
        
        
        // Piso exterior
       
         $this->addElement(
                            'checkBox',
                            'pisoExterior',
                            array(
                            'label' => 'Piso exterior',
                            //'style' =>'margin-left:100px;',
                            'required' => false,
                            'checkedValue' => '1',
                            'uncheckedValue'  => '0',
                            //'checked' => true,    
                            //'validators' => array(array('NotEmpty', true)),
                            )
                          );
        
        $this->pisoExterior->setAttrib('class','form_input_contact_very_small');
        $this->pisoExterior->removeDecorator('Errors');
        $this->pisoExterior->removeDecorator('HtmlTag');
        $this->pisoExterior->removeDecorator('Label');
      
        

        // Balcon
        
        $this->addElement(
                            'checkBox',
                            'balcon',
                            array(
                            'label' => 'Balcón',
                            //'style' =>'margin-left:100px;',
                            'required' => false,
                            'checkedValue' => '1',
                            'uncheckedValue'  => '0',
                            //'checked' => true,    
                            //'validators' => array(array('NotEmpty', true)),
                            )
                          );
        
        $this->balcon->setAttrib('class','form_input_contact_very_small');
        $this->balcon->removeDecorator('Errors');
        $this->balcon->removeDecorator('HtmlTag');
        $this->balcon->removeDecorator('Label');
        
        
        
        
        // Amueblado
        /*
        $this->addElement(  'radio', 
                            'amueblado', 
                            array(  'label' => '¿Amueblado?',
                                    'multiOptions' => array(
                                                                
                                                                1 => 'Si',
                                                                0 => 'No',
                                                           ),
                                                ));        
        
        //$this->amueblado->setAttrib('class','radio-amueblado');
        $this->amueblado->removeDecorator('Errors');
        $this->amueblado->removeDecorator('HtmlTag');
        $this->amueblado->removeDecorator('Label');
        */
        
        
        
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

         $this->codigoPostal->addValidator( $this->validatorLenghtCP );
         $this->codigoPostal->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
         $this->codigoPostal->setDecorators($this->decoradores);
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
        
        
       
        
        // Municipio
        $dbMunicipio = new Application_Model_DbTable_Municipio( );
        $municipios = $dbMunicipio->getMunicipiosList( );
        $this->addElement(
                                'select', 
                                'municipio', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        /*   foreach($municipios as $key => $value){
           $this->municipio->addMultiOption($key,$value);
        }*/

        $this->municipio->addMultiOptions($municipios);  
        //$this->municipio->removeDecorator('Errors');
        $this->municipio->setAttrib('class','form_select_medium');
        $this->municipio->removeDecorator('HtmlTag');
        $this->municipio->removeDecorator('Label');





        // Tipo de via
        $dbVias = new Application_Model_DbTable_TipoVias( );
        $vias = $dbVias->getViasList( );
        $this->addElement(
                                'select', 
                                'tipoVia', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        /*   foreach($vias as $key => $value){
           $this->tipoVia->addMultiOption($key,$value);
        }*/

        $this->tipoVia->addMultiOptions($vias);
        //$this->tipoVia->removeDecorator('Errors');
        $this->tipoVia->setAttrib('class','form_select_medium');
        $this->tipoVia->removeDecorator('HtmlTag');
        $this->tipoVia->removeDecorator('Label');



        

        
        //Nombre de la calle
           
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
        
        

        // Nº
        $this->addElement(
                             'text', 
                             'numero', 
                             array(
                                     'label' => 'Nº (*)', 
                                     'required' => true, 
                                     'filters' => array('stringTrim')
                               )
                      );

         $this->numero->addValidator('NotEmpty',
                          true,
                          array('messages' => array(
                                                     Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar el Nº.'
                                                    )
                               ));

         //$this->numero->addValidator('stringLength', false, array(5, 5));

         //$this->numero->addValidator( $this->validatorLenghtCP );
         $this->numero->addValidator('digits', true, array('messages' => array(Zend_Validate_Digits::NOT_DIGITS => 'Sólo digitos')));
         $this->numero->setDecorators($this->decoradores);
         $this->numero->setAttrib('class','form_input_contact_small');
         //$this->numero->removeDecorator('Errors');
         $this->numero->removeDecorator('HtmlTag');
         $this->numero->removeDecorator('Label');
        
            

        
        
        // Bis
        
        $this->addElement(
                            'checkBox',
                            'bis',
                            array(
                            'label' => 'Bis',
                            //'style' =>'margin-left:100px;',
                            'required' => false,
                            'checkedValue' => '1',
                            'uncheckedValue'  => '0',
                            //'checked' => true,    
                            //'validators' => array(array('NotEmpty', true)),
                            )
                          );
        
        $this->bis->setAttrib('class','form_input_contact_very_small');
        $this->bis->removeDecorator('Errors');
        $this->bis->removeDecorator('HtmlTag');
        $this->bis->removeDecorator('Label');            
           
            
        // S/N
       
        $this->addElement(
                            'checkBox',
                            'sinNumero',
                            array(
                            'label' => 'S/N',
                            //'style' =>'margin-left:100px;',
                            'required' => false,
                            'checkedValue' => '1',
                            'uncheckedValue'  => '0',
                            //'checked' => true,    
                            //'validators' => array(array('NotEmpty', true)),
                            )
                          );
        
        $this->sinNumero->setAttrib('class','form_input_contact_very_small');
        $this->sinNumero->removeDecorator('Errors');
        $this->sinNumero->removeDecorator('HtmlTag');
        $this->sinNumero->removeDecorator('Label');            
      
            
        

        // Escalera
        $this->addElement(
                            'text', 
                            'escalera', 
                            array(
                                    'label' => 'Escalera (*)', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );


        $this->escalera->setAttrib('class','form_input_contact_small');
        $this->escalera->removeDecorator('Errors');
        $this->escalera->removeDecorator('HtmlTag');
        $this->escalera->removeDecorator('Label');
        
        
        
            
        // Piso / Planta
        $dbPlantas = new Application_Model_DbTable_TipoPlanta( );
        $plantas = $dbPlantas->getPlantasList( );
        
        $this->addElement(
                                'select', 
                                'tipoPlanta', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        /*   foreach($plantas as $key => $value){
           $this->tipoPlanta->addMultiOption($key,$value);
        }*/

        $this->tipoPlanta->addMultiOptions($plantas);
        //$this->tipoPlanta->removeDecorator('Errors');
        $this->tipoPlanta->setAttrib('class','form_select_medium');
        $this->tipoPlanta->removeDecorator('HtmlTag');
        $this->tipoPlanta->removeDecorator('Label');

        
        
        
        
        

        
        // Puerta
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
        
        

        // Otra información
        $this->addElement(
                            'textarea', 
                            'informacion', 
                            array(
                                    'label' => 'Otra información', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        $this->informacion->setAttrib('class','form_input_contact');
        $this->informacion->removeDecorator('Errors');
        $this->informacion->removeDecorator('HtmlTag');
        $this->informacion->removeDecorator('Label');
        
        
        
        
        
        
        
        
        
         $this->addElement(
                            'Submit', 
                            'Grabar'
                          ); 
            
        
        
    }
}