<?php
/**
 * Description of Language
 *
 * @author Eureka
 * @param
 * @return
 */
class Application_Plugin_Language extends Zend_Controller_Plugin_Abstract
{
    
    //put your code here
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $lang = $request->getParam('lang', null);

        $translate = Zend_Registry::get('Zend_Translate');

        if ($translate->isAvailable($lang)) {
            $translate->setLocale($lang);
        } else {
            $translate->setLocale('en');
        }

        // Set language to global param so that our language route can
        // fetch it nicely.
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $router->setGlobalParam('lang', $lang);
    }    
    
	
	public function preDispatch() {
	//	echo 'predispatched action 2';
	}	
    
}
