<?php
class Zend_View_Helper_SetBanner extends Zend_View_Helper_Abstract 
{

    // TIP important use http://localhost/barcelonapordias/public/anuncio/images/banner/
    // CHANGE TO on-line
    public function setBanner( )
    {

       $handler = new Application_Model_Repository_Statement();
       $banners = $handler->getBanner();

       
       
       $list = '';
       
       //$onclick = "alert('Hi!')";
       /*
       $list = $list . "<div onclick='calcularVisitas(". $id . ");' ><a href='http://" . $url . 
        "'><img alt='Hoteles' src='http://localhost/barcelonapordias/public/anuncio/images/banner/" . 
        $bannerFinal . "' > /><br/></a></div>";
       */

       
       /*
       $list = $list . "<div onclick='calcularVisitas();' ><img alt='Hoteles' src='http://localhost/barcelonapordias/public/anuncio/images/banner/" . 
                   $bannerFinal . "' > /><br/></div>";
       */

       foreach ($banners as $banner) {
           //$this->incrementCounter($banner['id']);
           $bannerFinal = $banner['file_name'];
           $url = $this->getUrlName($bannerFinal);
           $id = $banner['id'];
           $description = $banner['description'];
           $altmsg = $banner['altmsg'];
           
           /* OK
           $list = $list . "<div onclick='calcularVisitas(". $id . ");' ><img alt='Hoteles' src='http://localhost/barcelonapordias/public/anuncio/images/banner/" . 
                   $bannerFinal . "' > /><br/></div>";
           */
           
           /* OK QUITAR LA CAJA ROJA FINAL
           $list = $list . "<div onclick='calcularVisitas(". $id . ");' ><a href='http://" . $url . 
             "'><img alt='Hoteles' src='http://www.turisdays.com/anuncio/images/slides/" . $bannerFinal . "'> /><br/></a></div>"; // <div style='height:23px;border:1px solid red;'>Testing ... </div>
            * 
            */
           
           // <a href='http://www.guitarthotels.com/'></a>
           
           $className = "masterTooltip";
           $list = $list . "<div data-thumb='http://www.turisdays.com/anuncio/images/thumbs/" . $bannerFinal . "'>
                   <div onclick='calcularVisitas(". $id . ");' ><a href='http://" . $url  .  "'><img class='" . $className . "' alt='" . $altmsg . "' title='" . $altmsg . "' src='http://www.turisdays.com/anuncio/images/slides/" . $bannerFinal . "'/></a></div>
                   <div class='elemHover caption fromLeft' style='bottom:2px; width:auto; -webkit-border-top-right-radius: 6px; -webkit-border-bottom-right-radius: 6px; -moz-border-radius-topright: 6px; -moz-border-radius-bottomright: 6px; border-top-right-radius: 6px; border-bottom-right-radius: 6px;'>"
                   . $description . "</div></div>";
           
           
       }
       
       
       return $list;
       
    }

  
    


    public function getUrlName($bannerFinal)
    {
        $fileParts = pathinfo($bannerFinal);
        $url = $fileParts['filename'];
        return $url;
    }

    
    /* ZMAZIT */
    public function disableUrl( )
    {

        $handler = new Application_Model_Repository_Statement();
        $results = $handler->disableBanner();

        $state = $results['estado'];
        
        if($state==1) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;

    }        
            
    public function incrementCounter($bannerId)
    {
        $handler = new Application_Model_Repository_Statement();
        $handler->incrementCounter($bannerId);
        
        return true;
    }        
    
    
}


