<?php
class Application_Form_AnuncioRestaurante extends Zend_Form
{

    protected $decoradores;

    public function init( )
    {

        $this->decoradores = array(
                              'ViewHelper',
                              array('Errors', array('tag' => 'div', 'style' => 'color:red;')),
                              'HtmlTag',
                              'Label'
                            );



        // Nombre restaurante
        $this->addElement(
                            'text', 
                            'nombre', 
                            array(
                                    'label' => 'Nombre (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->nombre->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar nombre del restaurante.'
                                                   )
                              ));
        $this->nombre->setDecorators($this->decoradores);
        $this->nombre->setAttrib('class','form_input_contactx');//_motor
        //$this->nombre->removeDecorator('Errors');
        $this->nombre->removeDecorator('HtmlTag');
        $this->nombre->removeDecorator('Label');


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
        $this->telefono->setAttrib('class','form_input_contact_small');
        //$this->telefono->removeDecorator('Errors');
        $this->telefono->removeDecorator('HtmlTag');
        $this->telefono->removeDecorator('Label');


        
        // Nombre especialidad
        $this->addElement(
                            'text', 
                            'especialidad', 
                            array(
                                    'label' => 'Especialidad (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->especialidad->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar la especialidad.'
                                                   )
                              ));
        $this->especialidad->setDecorators($this->decoradores);
        $this->especialidad->setAttrib('class','form_input_contactx');//_motor
        //$this->especialidad->removeDecorator('Errors');
        $this->especialidad->removeDecorator('HtmlTag');
        $this->especialidad->removeDecorator('Label');
        
        
        
        // Direccion
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
        $this->direccion->setDecorators($this->decoradores);
        $this->direccion->setAttrib('class','form_input_contactx');//_motor
        //$this->direccion->removeDecorator('Errors');
        $this->direccion->removeDecorator('HtmlTag');
        $this->direccion->removeDecorator('Label');
        
        
        
        
        // Zona
        $this->addElement(
                            'text', 
                            'zona', 
                            array(
                                    'label' => 'Zona (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                         );

        $this->zona->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar la zona.'
                                                   )
                              ));
        $this->zona->setDecorators($this->decoradores);
        $this->zona->setAttrib('class','form_input_contactx');//_motor
        //$this->zona->removeDecorator('Errors');
        $this->zona->removeDecorator('HtmlTag');
        $this->zona->removeDecorator('Label');
        
        
        
        
        //Precio / Mes
        $this->addElement(
                            'text', 
                            'precio', 
                            array(
                                    'label' => 'Precio (*)', 
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


        
        
        
        
        // Descripcion (parrilla)
        $this->addElement(
                            'textarea', 
                            'descripcion', 
                            array(
                                    'label' => 'Descripción', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->descripcion->setDecorators($this->decoradores);
        $this->descripcion->setAttrib('class','textarea');
        $this->descripcion->removeDecorator('Errors');
        $this->descripcion->removeDecorator('HtmlTag');
        $this->descripcion->removeDecorator('Label');
        
        
        
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
        $this->poblacion->setAttrib('class','form_input_contactx');//_motor
        //$this->poblacion->removeDecorator('Errors');
        $this->poblacion->removeDecorator('HtmlTag');
        $this->poblacion->removeDecorator('Label');
        
        
        // URL
        $this->addElement(
                            'text', 
                            'url', 
                            array(
                                    'label' => 'URL (*)', 
                                    'required' => true, 
                                    'filters' => array('stringTrim')
                              )
                     );

        $this->url->addValidator('NotEmpty',
                         true,
                         array('messages' => array(
                                                    Zend_Validate_NotEmpty::IS_EMPTY => 'Ingresar la especialidad.'
                                                   )
                              ));
        $this->url->setDecorators($this->decoradores);
        $this->url->setAttrib('class','form_input_contactx');//_motor
        //$this->url->removeDecorator('Errors');
        $this->url->removeDecorator('HtmlTag');
        $this->url->removeDecorator('Label');

        
        
        
        
        
        
        // Información 
        $this->addElement(
                            'textarea', 
                            'informacion', 
                            array(
                                    'label' => 'Información', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->informacion->setDecorators($this->decoradores);
        $this->informacion->setAttrib('class','textarea');
        $this->informacion->removeDecorator('Errors');
        $this->informacion->removeDecorator('HtmlTag');
        $this->informacion->removeDecorator('Label');
        
        

        
        

        // Presentación 
        $this->addElement(
                            'textarea', 
                            'presentacion', 
                            array(
                                    'label' => 'Presentación', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->presentacion->setDecorators($this->decoradores);
        $this->presentacion->setAttrib('class','textarea');
        $this->presentacion->removeDecorator('Errors');
        $this->presentacion->removeDecorator('HtmlTag');
        $this->presentacion->removeDecorator('Label');

        
        // Sugerencias 
        $this->addElement(
                            'textarea', 
                            'sugerencia', 
                            array(
                                    'label' => 'Sugerencias', 
                                    'required' => false, 
                                    'filters' => array('stringTrim')
                              )
                     );

        
        //$this->sugerencia->setDecorators($this->decoradores);
        $this->sugerencia->setAttrib('class','textarea');
        $this->sugerencia->removeDecorator('Errors');
        $this->sugerencia->removeDecorator('HtmlTag');
        $this->sugerencia->removeDecorator('Label');


        // Submit "GRABAR"
        $this->addElement(
                            'Submit', 
                            'Grabar'
                          ); 
            
        
        
    }
}