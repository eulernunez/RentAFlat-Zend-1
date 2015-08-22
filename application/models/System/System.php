<?php
class Application_Model_System_System 
{

    private static $instance = null;
    protected $dbObject = null;
    
    
    
    public static function getInstance($class_name = 'Application_Model_System_System') 
    {
        if (!self::$instance) {

            self::$instance = new $class_name( );
        }

        return self::$instance;
    }


    /**
     * @author Euler Nunez <eulernunez@gmail.com>
     * @return Object Zend_Db_Adapter_Pdo_Mysql
     */
    
    public function getDbObject( ) 
    {

        if ($this->dbObject != null) {
            return $this->dbObject;
        }

        $config = $this->getConfig();
        $this->dbObject = Zend_Db::factory( $config->resources->db->adapter,
                                            $config->resources->db->params);

        //die('$this->dbObject <pre>' . print_r($this->dbObject,true) . '</pre>');     
        
        /*   
        $this->dbObject = Zend_Db::factory( $config->resources->db->adapter,
                                                       array(
                                                       'host' => 'localhost',
                                                       'dbname' => 'barcelonapordias_com_inmobiliaria',
                                                       'username' => 'RTC17_bpord',
                                                       'password' => 'Qaz159.')
                                           );
        */

        $this->dbObject->query('SET NAMES UTF8');

         return $this->dbObject;

    }



    static function getConfig( ) 
    {
        
        $options['nestSeparator'] = '.' ;
        
        
        $config = new Zend_Config_Ini(  APPLICATION_PATH . '/configs/application.ini',
                                        constant('APPLICATION_ENV'), $options);

        
        return $config;
    }


    public function sendEmail( $params )
    {

        //$smtp     = "mail.alquilertop.com";  //"authsmtp.barcelonapordias.com";//"smtp.googlemail.com"; //"mail.carandgo.com";  //"smtp.googlemail.com"; // smtp.googlemail.com
        //$smtp = "smtp.googlemail.com";
        $smtp = "mail.turisdays.com";
        
        
        //$smtp = "smtp.mail.com";
        //$usuario    = "info@alquilertop.com"; //"smtp@barcelonapordias.com";//"eulernunez@gmail.com";
        //$usuario = "tutorcen18@ono.com";
        //$usuario = "masterdiez@ono.com";
        
        //$usuario = "turistday@gmail.com";
        $usuario = "info@turisdays.com";
        //$clave    = "0a5g2fxk";
        //$clave = "Rtc_728800";
        $clave = "728800";  
        //$de       = "info@alquilertop.com"; //"smtp@barcelonapordias.com";//"eulernunez@gmail.com"; //"email";
        //$de = "tutorcen18@ono.com";
        
        //$de = "turistday@gmail.com";
        $de = "info@turisdays.com";
        
        //$asunto  = "Interesado en alquiler";
        //$mensagem = "<b>Probando servidor de correo barcelonapordias.com </b> Testeo de envio de email !!.";	 

        try {
                $config = array (
                                    'auth' => 'login',
                                    'username' => $usuario,
                                    'password' => $clave,
                                    'ssl' => 'ssl',
                                    'port' => '465'
                                );
                $mailTransport = new Zend_Mail_Transport_Smtp($smtp, $config);
                //die('<pre>' . print_r($mailTransport,true) . '</pre>');
                $mail = new Zend_Mail();
                $mail->setFrom($de);
                $mail->addTo($params['para']);
                $mail->setBodyHtml($params['mensaje']);
                $mail->setSubject($params['asunto']);
                $mail->send($mailTransport);
            } catch (Exception $e){
                        echo $e->getMessage() ;
             }

   }
    
    
    
    public function logIn( $correo, $clave ) {

        try {
            $result = null;
            
            if (isset( $correo ) && isset( $clave )) {
                $auth = Zend_Auth::getInstance( );
                $systema = Application_Model_System_System::getInstance( );

                $result = $systema->getDbObject( )
                          ->fetchRow('SELECT * FROM usuarios WHERE correo_electronico = ?', $correo );
                
                if (isset($result['clave'])) {
                    $adapter = new Application_Model_Autentificacion_UserAuthenticateAdapter($correo, $clave, $result);
                    
                    $autenticado = $auth->authenticate($adapter);
                    
                    //die('System2: ( Adapter->autenticado ) <pre>' . print_r( $autenticado,true) . '</pre>');
                } 
                
                if ($autenticado != null) {
                    if ($autenticado->isValid() == true) {
                    } else {
                      $this->logOut( );
                      $this->_response->setRedirect( $this->view->baseUrl() . '/index/' )->sendResponse();
                    }
                }
            }
        } 
        catch (exception $e) {
            //$this->catchException($e);
            echo $e->getMessage() ;
        }
    }
 

    
    public function logOut( )
    {
            Zend_Auth::getInstance()->clearIdentity();
    }    
    

    public function getLoggedInUser( ) 
    {
        $identity = null;
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = unserialize($auth->getIdentity());
        }

        return $identity;
    }
    
    
    
    
    

}