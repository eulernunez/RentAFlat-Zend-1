<?php
class Application_Form_AnuncioVarios extends Zend_Form
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
        
        // Categoría
        // Select to other category
        
        $dbCategoria = new Application_Model_DbTable_Categoria( );
        $categorias = $dbCategoria->getCategoriasListVarios( );
        $this->addElement(
                                'select', 
                                'categoria', 
                                array(
                                        'label' => ' ', 
                                        'required' => false, 
                                        'filters' => array('stringTrim')
                                     )
                          );

        /*   foreach($municipios as $key => $value){
           $this->municipio->addMultiOption($key,$value);
        }*/

        $this->categoria->addMultiOptions($categorias);  
        //$this->municipio->removeDecorator('Errors');
        $this->categoria->setAttrib('class','form_select_medium');
        $this->categoria->removeDecorator('HtmlTag');
        $this->categoria->removeDecorator('Label');

        //Precio / Mes
        /*
         *  CHECK tomorrow this field
         * 
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
        */
        
        
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
        $this->titulo->setAttrib('class','form_input_contactx');
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
        
        // Submit "GRABAR"
        $this->addElement(
                            'Submit', 
                            'Grabar'
                          ); 
            
        
        
    }
}