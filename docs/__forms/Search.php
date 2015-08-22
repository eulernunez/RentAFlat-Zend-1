<?php
class Application_Form_Search extends Zend_Form
{
    //protected $decoradores;
    
    
    public function init( )
    {
        
        
        

        // Municipio
        $dbMunicipio = new Application_Model_DbTable_Municipio( );
        $municipios = $dbMunicipio->getMunicipiosList( );
        
        
        
        $this->addElement('select', 'municipio', 
                          array('label' => '', 'required' => false, 'filters' => array('stringTrim'))
                          );
        
        //die('PRUEBA >> 2 - 3 - 4 - 5');
        

        /* 
          foreach($municipios as $key => $value){
          $this->municipio->addMultiOption($key,$value);
        }
        */

        
        
        $this->municipio->addMultiOptions($municipios);
        
        
        
        //$this->municipio->removeDecorator('Errors');
        $this->municipio->setAttrib('class','form_select_buscador2');
        $this->municipio->removeDecorator('HtmlTag');
        $this->municipio->removeDecorator('Label');
            
        
        
        
        
        $this->addElement(
                                'Submit', 
                                'Grabar'
                            ); 
            
            
        
        
        
    }

    
    
    
}