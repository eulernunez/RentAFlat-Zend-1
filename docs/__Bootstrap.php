<?php
//require_once 'library/plugin/Language.php';
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array (
            'namespace' => 'Default',
            'basePath' => APPLICATION_PATH,
        ));
		
	    //$front = Zend_Controller_Front::getInstance();
        //$front->registerPlugin(new Application_Plugin_Language());
	
		
		
		
        return $autoloader;
    }


    protected function _initFrendly()
    {
           //login/
           /*
            $frontController = Zend_Controller_Front::getInstance();

            $router = $frontController->getRouter();
            $router->addRoute( 'wellcome',
                new Zend_Controller_Router_Route_Static( 'for-fun-link',
                    array('module' => 'default', 'controller' => 'login', 'action' => 'index' )
                )
            );
             */
             
            /*
            $router->addRoute( 'myotherroute',
                new Zend_Controller_Router_Route_Static( 'about-product',
                    array( 'controller' => 'page', 'action' => 'about' )
                )
            );
            $router->addRoute( 'justonemore',
                new Zend_Controller_Router_Route_Static( 'another/longer/path',
                    array( 'controller' => 'mycontroller',
                        'action' => 'myaction',
                        'someparameter' => 'foo'
                    )
                )
           );
             * 
             $frontController->dispatch();     
            */
           
    }
    
    // OJO
    //http://stackoverflow.com/questions/6546792/make-friendly-url-in-zend-framework
    
    public function _initUrls()
    {        
        /* OBSOLET
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $detailsRoute = new Zend_Controller_Router_Route("search/detail/:name",
                array(
           'controller' => 'search',
           'action' => 'detail'
        ));

        $router->addRoute('searchDetail', $detailsRoute);    
        */
    
        /* OBSOLET
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $route = new Zend_Controller_Router_Route(
                'url-rewrite-tips',
                array(
                     'module'     => 'blog',
                     'controller' => 'detail',
                     'action'     => 'index',
                     'id'         => '5'
                )
        );
        $router->addRoute('url-rewrite-tips', $route);
        */
        
        
		/* OK FUNCIONA URL AMIGABLE
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $params =  array(
                        'controller' => 'anuncio',
                        'action'     => 'index'
                        );

        $handler = new Application_Model_Repository_Statement();
        $urls = $handler->getCleanUrls();
        foreach($urls as $url){
            $params['id'] = $url['id'];
            $route = new Zend_Controller_Router_Route(
                '/anuncio/'. $url['url'] ,$params
                );
            $router->addRoute('/anuncio/' . $url['url'], $route);
        }
        

        $rentId = $handler->getRentId();
        $params2 =  array(
                            'controller' => 'anuncio',
                            'action'     => 'booking-form',
                            'rent' => $rentId
                        );
        
        $route = new Zend_Controller_Router_Route(
                    '/formulario-alojamiento' ,$params2
                 );

        $router->addRoute('/formulario-alojamiento', $route);
        */
        
        
        /* OBSOLET Para URL AMIGABLE UNICA
        $uniqueId = $handler->getUniqueCleanUrl();
        $params3 =  array(
                            'controller' => 'login',
                            'action'     => 'index',
                            'id' => $uniqueId
                        );
        
        $route2 = new Zend_Controller_Router_Route(
                    '/acceso-directo-anuncio' ,$params3
                 );

        $router->addRoute('/acceso-directo-anuncio', $route2);
        */
         
        

        // NOTA:
        
        //$this->view->baseUrl( ) . '/anuncio/index/?id=' . $publicityId
        //$this->view->baseUrl( ) . '/anuncio/booking-form/?rent=' . $rentId

        // anuncios.panoramico Default 0 and 1 url-unique-friendly
        
        /*
        $params['id'] = '289';
        $route2 = new Zend_Controller_Router_Route(
                '/anuncio/prueba-con-texto-formateado-completo',$params
                );
        $router->addRoute('/anuncio/prueba-con-texto-formateado-completo', $route2);
        
        */
        
    }

    // https://www.youtube.com/watch?v=tAmEHczr3Z0
    // .EL VÍDEO MÁS INSPIRADOR DEL MUNDO
    //OJO
    // http://stackoverflow.com/questions/13457538/zend-framework-url-rewrite-for-seo?rq=1
    
    
    // NOTA:
    // FILES: Statement.php, items2.phtml y this
    
    
    protected function _initLanguage()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Application_Plugin_Language());
    }
    
    
    
    
    
    
    
    public function _initI18n()
    {
        /*
        $bootstrap = $this->getApplication();
        $layout = $bootstrap->getResource('layout');
        $view = $layout->getView();
        */
        
        /* OK
        $translate = new Zend_Translate(
		'array',
		APPLICATION_PATH . '/languages/en.php','en'
                );

        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Translate',$translate);
        $translate->setlocale('en');
        //$view->translate = $translate;        
        */
        
        
        $translate = new Zend_Translate('array', 
                    APPLICATION_PATH . "/languages/en.php", 
                    'en');
        $translate->addTranslation(APPLICATION_PATH . '/languages/es.php', 'es');
        
        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Translate', $translate);
        $translate->setLocale('en');
        
        
    }        


	public function _initRoutes()
    {
        $this->bootstrap('FrontController');
        $this->_frontController = $this->getResource('FrontController');
        $router = $this->_frontController->getRouter();
     
        $langRoute = new Zend_Controller_Router_Route(
            ':lang/',
            array(
                'lang' => 'en',
            )
        );
         
        $defaultRoute = new Zend_Controller_Router_Route(
            ':controller/:action',
            array(
                'module'=>'default',
                'controller'=>'index',
                'action'=>'index'
            )
        );
     
        $defaultRoute = $langRoute->chain($defaultRoute);
     
        $router->addRoute('langRoute', $langRoute);
        $router->addRoute('defaultRoute', $defaultRoute);
    }

// http://www.codeforest.net/multilanguage-support-in-zend-framework
// http://www.maestrosdelweb.com/guia-zend-aplicaciones-multi-idioma-zend-translate/

    
    
}

