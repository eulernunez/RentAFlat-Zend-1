<?php
class SandboxEulerController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        //$now = new DateTime();
        //die('<pre>' . print_r($now,true) . '</pre>');
        // 2015-04-04 20:17:09
        
        
        try {
                $handler = new Application_Model_Util_Date('2015-04-01 13:00:00');
                $result = $handler->diff()->days;
                
                echo('<pre>' . print_r($result,true) . '</pre>');                
                
                if($result < 4 ) {
                    
                    throw new Exception ('Tiene un valor que no supera el limite minimo');
                }
                
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        return true;
        
    }
    
    /**
     *@param void
     *@return void  
     */
    
    public function handlingErrorAction()
    {
        
        $this->view->layout( )->disableLayout( );
        $this->_helper->viewRenderer->setNoRender(true);
        
        echo('Handling Error <br/>');
        
        try {
            
            throw new Exception(' Upps !!');
        
            
        } catch (Exception $e) {
            
            echo ('Exception::getMessage() ' . print_r($e->getMessage(),true)); 
            
        }

        return true;

    }        
            
    /*
     * 
     * 
     */
    
    public function testingAction()
    {
        
        $this->view->layout( )->disableLayout( );
        $this->_helper->viewRenderer->setNoRender(true);
        
        echo('Testing <br/>');
        $session = new Zend_Session_Namespace('favorites');
        
        echo('<pre>' . print_r($session,true) . '</pre>');
        $session->setExpirationSeconds(2592000);
        $session->favorites = new ArrayObject(array());
        
        die('<pre>' . print_r($session->favorites,true) . '</pre>');
        
        $results = Misc_Utils::getFavorites();
        echo('<pre>' . print_r($results,true) . '</pre>');
        
        return true;
        
    }        
    
    
    
    public function fetchPropertyAction()
    {

        $this->view->layout( )->disableLayout( );
        $this->_helper->viewRenderer->setNoRender(true);

        $handler = new Application_Model_Repository_Statement();
        $results = $handler->fetchProperty();

        Zend_Debug::dump($results, 'Application_Model_Repository_Statement::fetchProperty()', true);

        return true;

    }
    
    
    
    public function dbZendAction()
    {
        $this->view->layout( )->disableLayout( );
        $this->_helper->viewRenderer->setNoRender(true);

        $parameters = array(
                            'host'     => '127.0.0.1',
                            'username' => 'root',
                            'password' => 'demo',
                            'dbname'   => 'rentaflat');
        
        
        try {
            $db = Zend_Db::factory('Pdo_Mysql', $parameters);
            $db->getConnection();
            $version = $db->getServerVersion();
            $db->setFetchMode(Zend_Db::FETCH_OBJ);
            
            $sql = 'SELECT * FROM property';
            $result = $db->fetchAll($sql);
            
            $name = $db->quote("O'Reilly");
            
            
            Zend_Debug::dump($name, 'Zend_Db::factory', true);
            
        } catch (Zend_Db_Adapter_Exception $e) {
            // perhaps a failed login credential, or perhaps the RDBMS is not running
            Zend_Debug::dump($e, 'Zend_Db_Adapter_Exception', true);
        } catch (Zend_Exception $e) {
            // perhaps factory() failed to load the specified Adapter class
            Zend_Debug::dump($e, 'Zend_Exception', true);
        }        
        
        
    }        

}

