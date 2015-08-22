<?php
class Application_Model_Repository_Statement 
{

    protected $system;

    public function __construct() 
    {
        $this->system = Application_Model_System_System::getInstance( );
    }



    public function fetchServiceDirectorySubCategory($categorySystemName) 
    {

        $select = $this->system->getDbObject( )
                ->select(array(''))
                ->from(array('service_category_2' => 'service_category'))
                ->joinLeft(array('service_category' => 'service_category'), 'service_category_2.parent = service_category.id ', array())
                ->where('service_category.system_name = ?', $categorySystemName);

        $stmt = $select->query( );

        $results = $stmt->fetchAll( );

        return $results;
    }


/*
 * Primera Query para el listado de anuncios pagina de inicio
 * 
 */
    public function fetchAnuncios( ) 
    {
        $query = "SELECT        anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.direccion, anuncios.precio, anuncios.mcuadrado,
				tipo_vivienda.nombre AS vivienda, anuncios.tipo_dormitorio_id AS dormitorio, anuncios.fecha_publicacion,
                                anuncios.tipo_banyo_id AS banyo, anuncios.usuarios_id AS usuarios_id, tipo_planta.nombre AS planta,
                                tipo_anuncio.nombre AS tipoanuncio, provincia.nombre AS provincia,
                                municipio.nombre AS municipio, usuarios.nombre_comercial,
                                usuarios.correo_electronico, fotos.file_name, anuncios.tipo As tipoVisualizacion,
                                anuncios.precio_por_dia, anuncios.numero_personas, anuncios.url  
				FROM anuncios
				LEFT JOIN tipo_vivienda ON anuncios.tipo_vivienda_id = tipo_vivienda.id
				LEFT JOIN tipo_planta ON anuncios.tipo_planta_id = tipo_planta.id
				LEFT JOIN tipo_anuncio ON anuncios.tipo_anuncio_id = tipo_anuncio.id
				LEFT JOIN provincia ON anuncios.provincia_id = provincia.id
				LEFT JOIN municipio ON anuncios.municipio_id = municipio.id
                                LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
				INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                                WHERE fotos.orden = 1    
                                ORDER BY anuncios.fecha_publicacion DESC";
        
        $stmt = $this->system->getDbObject( )->query( $query );
        return $stmt->fetchAll( );
    }
    
    
    public function fetchDateAnuncio()
    {
        $query = "SELECT rent_date FROM anuncios WHERE NOT ISNULL(rent_date)";
        $stmt = $this->system->getDbObject( )->query( $query );
        $results = $stmt->fetchAll( );
        $dates = array();
        foreach($results as $date){
            //$dates = array('rentDate' => date("d m Y",strtotime($date['rent_date'])));
            $dates[] = date("d m Y",strtotime($date['rent_date']));
        }
        
        return $dates;
    }        
    
    
    
 /*
  * Second query get un anuncio by ID anuncio
  * 
  */   
    
    public function fetchAnuncio( $id )
    {

        $query = "SELECT        anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.informacion,
                                anuncios.direccion, anuncios.precio, anuncios.mcuadrado, anuncios.usuarios_id AS userId,
				tipo_vivienda.nombre AS vivienda, anuncios.tipo_dormitorio_id AS dormitorio,
                                anuncios.alta_suministros as altaSuministro, anuncios.ascensor,
                                anuncios.piso_exterior As pisoExterior, anuncios.balcon,
                                anuncios.operacion, anuncios.amueblado, anuncios.codigo_postal As codigoPostal, 
                                anuncios.tipo_banyo_id AS banyo, tipo_planta.nombre AS planta,
                                tipo_anuncio.nombre AS tipoanuncio, provincia.nombre AS provincia,
                                municipio.nombre AS municipio, usuarios.nombre_comercial,
                                usuarios.correo_electronico, usuarios.telefono, fotos.file_name, fotos.orden,
                                tipo_via.nombre AS nombreVia, anuncios.tipo As tipoVisualizacion,
                                anuncios.numero_personas, anuncios.precio_por_dia
				FROM anuncios
				LEFT JOIN tipo_vivienda ON anuncios.tipo_vivienda_id = tipo_vivienda.id
				LEFT JOIN tipo_planta ON anuncios.tipo_planta_id = tipo_planta.id
				LEFT JOIN tipo_anuncio ON anuncios.tipo_anuncio_id = tipo_anuncio.id
				LEFT JOIN provincia ON anuncios.provincia_id = provincia.id
				LEFT JOIN municipio ON anuncios.municipio_id = municipio.id
                                LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
                                LEFT JOIN tipo_via ON anuncios.tipo_via_id = tipo_via.id
				INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id 
                                WHERE anuncios.id = '". $id ."'";
        // AND fotos.orden = 1
        
        
        $stmt = $this->system->getDbObject( )->query( $query );
        
        return $stmt->fetchAll( );
        

        
    }        
    
    
    
    public function fetchAnunciosByInmobiliaria( $id )
    {
        
        $query = "SELECT        anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.direccion, anuncios.precio, anuncios.mcuadrado,
				tipo_vivienda.nombre AS vivienda, anuncios.tipo_dormitorio_id AS dormitorio, anuncios.fecha_publicacion,
                                anuncios.tipo_banyo_id AS banyo, tipo_planta.nombre AS planta,
                                tipo_anuncio.nombre AS tipoanuncio, provincia.nombre AS provincia,
                                municipio.nombre AS municipio, usuarios.nombre_comercial,
                                usuarios.correo_electronico, fotos.file_name, anuncios.usuarios_id AS usuarios_id
				FROM anuncios
				LEFT JOIN tipo_vivienda ON anuncios.tipo_vivienda_id = tipo_vivienda.id
				LEFT JOIN tipo_planta ON anuncios.tipo_planta_id = tipo_planta.id
				LEFT JOIN tipo_anuncio ON anuncios.tipo_anuncio_id = tipo_anuncio.id
				LEFT JOIN provincia ON anuncios.provincia_id = provincia.id
				LEFT JOIN municipio ON anuncios.municipio_id = municipio.id
                                LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
				INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                                WHERE anuncios.usuarios_id = '" . $id . "' AND fotos.orden = 1 ORDER BY anuncios.fecha_publicacion DESC";
        
        
        $stmt = $this->system->getDbObject( )->query( $query );
        return $stmt->fetchAll( );

        
    }
    
    
    public function fetchAnunciosByBusqueda( $municipioId )
    {
        
        $query = "SELECT        anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.direccion, anuncios.precio, anuncios.mcuadrado,
				tipo_vivienda.nombre AS vivienda, anuncios.tipo_dormitorio_id AS dormitorio, anuncios.fecha_publicacion,
                                anuncios.tipo_banyo_id AS banyo, tipo_planta.nombre AS planta,
                                tipo_anuncio.nombre AS tipoanuncio, provincia.nombre AS provincia,
                                municipio.nombre AS municipio, usuarios.nombre_comercial,
                                usuarios.correo_electronico, fotos.file_name, anuncios.usuarios_id AS usuarios_id
				FROM anuncios
				LEFT JOIN tipo_vivienda ON anuncios.tipo_vivienda_id = tipo_vivienda.id
				LEFT JOIN tipo_planta ON anuncios.tipo_planta_id = tipo_planta.id
				LEFT JOIN tipo_anuncio ON anuncios.tipo_anuncio_id = tipo_anuncio.id
				LEFT JOIN provincia ON anuncios.provincia_id = provincia.id
				LEFT JOIN municipio ON anuncios.municipio_id = municipio.id
                                LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
				INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                                WHERE anuncios.municipio_id = '" . $municipioId . "' AND fotos.orden = 1 ORDER BY anuncios.fecha_publicacion DESC";
        
        
        $stmt = $this->system->getDbObject( )->query( $query );
        return $stmt->fetchAll( );

        
    }

    
    
    
    
    
    
    
    


    
    
    
    public function fetchAllUser( )
    {
        $query = "SELECT u.id,
                         u.cif,
                         u.nombre_comercial, 
                         u.contacto, 
                         u.contacto_apellidos,
                         u.correo_electronico,
                         u.codigo_postal, 
                         u.direccion,
                         m.nombre As municipio,
                         p.nombre As provincia,
                         u.telefono,
                         u.movil, 
                         u.web, u.fecha_alta, u.estado, u.tipo_usuario_id
                  FROM usuarios AS u
                            LEFT JOIN municipio AS m ON u.municipio_id = m.id  
                            LEFT JOIN provincia AS p ON u.provincia_id = p.id";

        $this->system->getDbObject( )->setFetchMode(Zend_Db::FETCH_NUM); // Zend_Db::FETCH_ASSOC
        $stmt = $this->system->getDbObject( )->query( $query );
        
        return $stmt->fetchAll( );
    }

    
    public function fetchAnunciosAscensor( $operacion )
    {

        /* USAR para activar el ascensor de inmobiliaria
        $id = (int)$id;
        if( $id > 0) $condicion = "anuncios.usuarios_id = '" . $id . "'";
        else $condicion = "true";
        */

        $this->uncheckTimeAnuncios( );
        $this->checkTimeAnuncios( );
        
        $condicion = "true";
        
        $query = "SELECT anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.direccion, anuncios.precio, anuncios.mcuadrado,
			 anuncios.operacion As operacion, tipo_vivienda.nombre AS vivienda, anuncios.tipo_dormitorio_id AS dormitorio, anuncios.fecha_publicacion,
                         anuncios.tipo_banyo_id AS banyo, anuncios.usuarios_id AS usuarios_id, tipo_planta.nombre AS planta,
                         tipo_anuncio.nombre AS tipoanuncio, provincia.nombre AS provincia,
                         municipio.nombre AS municipio, usuarios.nombre_comercial,
                         usuarios.correo_electronico, fotos.file_name, anuncios.tipo As tipoVisualizacion
			 FROM anuncios
			 LEFT JOIN tipo_vivienda ON anuncios.tipo_vivienda_id = tipo_vivienda.id
			 LEFT JOIN tipo_planta ON anuncios.tipo_planta_id = tipo_planta.id
			 LEFT JOIN tipo_anuncio ON anuncios.tipo_anuncio_id = tipo_anuncio.id
			 LEFT JOIN provincia ON anuncios.provincia_id = provincia.id
			 LEFT JOIN municipio ON anuncios.municipio_id = municipio.id
                         LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
			 INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                         WHERE fotos.orden = 1 AND anuncios.operacion = '" . $operacion . "' AND " . $condicion . " ORDER BY anuncios.orden DESC, anuncios.fecha_publicacion DESC";
        
        $stmt = $this->system->getDbObject( )->query( $query );
        
        return $stmt->fetchAll( );

    }        
    
    /*
     * El intervalo que se mantiene top siempre 3m
     */
    
    public function uncheckTimeAnuncios( )
    {
        $query = "SELECT
                        id AS Identificador,
                        UNIX_TIMESTAMP(fecha_publicacion) AS UnixPublicacion,
                        MINUTE(fecha_publicacion) AS Minutos,
                        fecha_publicacion,
                        NOW( ) AS Ahora,       
                        UNIX_TIMESTAMP(NOW( )) AS ActualUnix,
                        MINUTE(NOW()) AS ActualMinutos,
                        orden AS Ordenamiento,
                        tipo_ascensor AS TipoAscensor
                        FROM anuncios
                        HAVING
                        (
                          MOD(TIMESTAMPDIFF(MINUTE,fecha_publicacion,NOW()),3) = 0 
                        ) AND orden = 1";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        if(isset($resultados['0']['Identificador'])){
                    $idAnuncio = $resultados['0']['Identificador'];
                    $this->setOrdenAnuncios( $idAnuncio, 0 );
        }
        return true;
        
        
        
        
    }        
    
    
    
    
   
    
    
    public function checkTimeAnuncios( )
    {
        $query = "SELECT 
                    id AS Identificador, 
                    UNIX_TIMESTAMP(fecha_publicacion) AS UnixPublicacion, 
                    MINUTE(fecha_publicacion) AS Minutos, 
                    fecha_publicacion,
                    NOW( ) AS Ahora,	
                    UNIX_TIMESTAMP(NOW( )) AS ActualUnix, 
                    MINUTE(NOW()) AS ActualMinutos,
                    orden AS Ordenamiento,
                    tipo_ascensor AS TipoAscensor,
                    tipo_ascensor_inmobiliaria AS TipoEspecial
                    FROM anuncios 
                    HAVING 
                    (
                      (MOD(TIMESTAMPDIFF(MINUTE,fecha_publicacion,NOW()),14) = 0 AND tipo_ascensor = 1) OR
                      (MOD(TIMESTAMPDIFF(MINUTE,fecha_publicacion,NOW()),360) = 0 AND tipo_ascensor_inmobiliaria = 1)
                    ) AND orden = 0";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        if(isset($resultados['0']['Identificador'])){
                    $idAnuncio = $resultados['0']['Identificador'];
                    $this->setOrdenAnuncios( $idAnuncio, 1 );
        }
        return true;
        
    }

    
    
    public function setOrdenAnuncios( $id, $orden )
    {
        $query = "UPDATE anuncios SET orden = '" . $orden .  "' WHERE id = '". $id ."'";
        $this->system->getDbObject( )->query( $query );
        return true;
    }


    public function fetchCoches( )
    {

        $query = "SELECT clasificados.id, clasificados.precio, clasificados.titulo, clasificados.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio, clasificados.usuarios_id,
                         fotos_clasificados.file_name, usuarios.telefono, usuarios.tipo_usuario_id
                         FROM clasificados 
                            LEFT JOIN provincia ON clasificados.provincia_id = provincia.id
                            LEFT JOIN municipio ON clasificados.municipio_id = municipio.id
                            LEFT JOIN fotos_clasificados ON clasificados.id = fotos_clasificados.clasificados_id
                            INNER JOIN categorias ON clasificados.categorias_id = categorias.id
                            INNER JOIN usuarios ON clasificados.usuarios_id = usuarios.id
                            WHERE clasificados.categorias_id = '1' AND fotos_clasificados.orden = 1
                            ORDER BY clasificados.fecha_publicacion DESC";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

    }
    
    public function fetchRestaurantes($side)
    {
        $query = "SELECT restaurantes.id, restaurantes.nombre, restaurantes.telefono,
                         restaurantes.especialidad, restaurantes.direccion, restaurantes.zona,   
                         restaurantes.precio, restaurantes.descripcion, restaurantes.poblacion,
                         restaurantes.informacion, restaurantes.presentacion, restaurantes.sugerencias,
                         restaurantes.fecha_publicacion, restaurantes.url, 
                         restaurantes.usuarios_id,
                         fotos_restaurantes.file_name, usuarios.tipo_usuario_id
                         FROM restaurantes 
                            LEFT JOIN fotos_restaurantes ON restaurantes.id = fotos_restaurantes.restaurantes_id
                            INNER JOIN usuarios ON restaurantes.usuarios_id = usuarios.id
                            WHERE fotos_restaurantes.orden = 1 AND restaurantes.center = $side 
                            ORDER BY RAND()";  
                            // ORDER BY restaurantes.fecha_publicacion DESC" 

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados;
    }    
    
    
    public function countRestaurantes($side)
    {
        $query = "SELECT COUNT(*) AS total FROM restaurantes WHERE center = $side";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados['0']['total'];
        
        
    }        
    
    
    
    public function fetchAnuncioRestaurante( $id )
    {
        $query = "SELECT restaurantes.id, restaurantes.nombre, restaurantes.telefono,
                         restaurantes.especialidad, restaurantes.direccion, restaurantes.zona,   
                         restaurantes.precio, restaurantes.descripcion, restaurantes.poblacion,
                         restaurantes.informacion, restaurantes.presentacion, restaurantes.sugerencias,
                         restaurantes.fecha_publicacion, 
                         restaurantes.usuarios_id,
                         fotos_restaurantes.file_name, usuarios.tipo_usuario_id, fotos_restaurantes.orden
                         FROM restaurantes 
                              LEFT JOIN fotos_restaurantes ON restaurantes.id = fotos_restaurantes.restaurantes_id
                              INNER JOIN usuarios ON restaurantes.usuarios_id = usuarios.id
                              WHERE restaurantes.id = '" . $id ."' 
                              ORDER BY restaurantes.fecha_publicacion DESC";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados;
    }
    
    

    public function fetchModas( )
    {

        $query = "SELECT modas.id, modas.titulo, modas.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio, modas.usuarios_id,
                         fotos_modas.file_name, usuarios.telefono, usuarios.tipo_usuario_id
                         FROM modas 
                            LEFT JOIN provincia ON modas.provincia_id = provincia.id
                            LEFT JOIN municipio ON modas.municipio_id = municipio.id
                            LEFT JOIN fotos_modas ON modas.id = fotos_modas.modas_id
                            INNER JOIN categorias ON modas.categorias_id = categorias.id
                            INNER JOIN usuarios ON modas.usuarios_id = usuarios.id
                            WHERE modas.categorias_id = '8' AND fotos_modas.orden = 1
                            ORDER BY modas.fecha_publicacion DESC";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados;

    }
    
    
    public function fetchMuebles( )
    {

        $query = "SELECT muebles.id, muebles.titulo, muebles.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio, muebles.usuarios_id,
                         fotos_muebles.file_name, usuarios.telefono, usuarios.tipo_usuario_id
                         FROM muebles 
                            LEFT JOIN provincia ON muebles.provincia_id = provincia.id
                            LEFT JOIN municipio ON muebles.municipio_id = municipio.id
                            LEFT JOIN fotos_muebles ON muebles.id = fotos_muebles.muebles_id
                            INNER JOIN categorias ON muebles.categorias_id = categorias.id
                            INNER JOIN usuarios ON muebles.usuarios_id = usuarios.id
                            WHERE muebles.categorias_id = '9' AND fotos_muebles.orden = 1
                            ORDER BY muebles.fecha_publicacion DESC";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados;

    }
    
    
    public function fetchMudanzas( )
    {
       $query = "SELECT mudanzas.id, mudanzas.titulo, mudanzas.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio, mudanzas.usuarios_id,
                         usuarios.telefono, usuarios.tipo_usuario_id
                         FROM mudanzas 
                            LEFT JOIN provincia ON mudanzas.provincia_id = provincia.id
                            LEFT JOIN municipio ON mudanzas.municipio_id = municipio.id
                            INNER JOIN categorias ON mudanzas.categorias_id = categorias.id
                            INNER JOIN usuarios ON mudanzas.usuarios_id = usuarios.id
                            WHERE mudanzas.categorias_id = '12' ORDER BY mudanzas.fecha_publicacion DESC";
       
       $stmt = $this->system->getDbObject( )->query( $query );
       $resultados = $stmt->fetchAll( );
       return $resultados;
    }
    
    
    public function fetchReformas( )
    {
       $query = "SELECT reformas.id, reformas.titulo, reformas.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio, reformas.usuarios_id,
                         usuarios.telefono, usuarios.tipo_usuario_id
                         FROM reformas 
                            LEFT JOIN provincia ON reformas.provincia_id = provincia.id
                            LEFT JOIN municipio ON reformas.municipio_id = municipio.id
                            INNER JOIN categorias ON reformas.categorias_id = categorias.id
                            INNER JOIN usuarios ON reformas.usuarios_id = usuarios.id
                            WHERE reformas.categorias_id = '11' ORDER BY reformas.fecha_publicacion DESC";
       
       $stmt = $this->system->getDbObject( )->query( $query );
       $resultados = $stmt->fetchAll( );
       return $resultados;
    }
    
    
    
    
    
    
        public function fetchEmpleos( )
    {
       $query = "SELECT empleos.id, empleos.titulo, empleos.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio, empleos.usuarios_id,
                         usuarios.telefono, usuarios.tipo_usuario_id
                         FROM empleos 
                            LEFT JOIN provincia ON empleos.provincia_id = provincia.id
                            LEFT JOIN municipio ON empleos.municipio_id = municipio.id
                            INNER JOIN categorias ON empleos.categorias_id = categorias.id
                            INNER JOIN usuarios ON empleos.usuarios_id = usuarios.id
                            WHERE empleos.categorias_id = '2' ORDER BY empleos.fecha_publicacion DESC";
       
       $stmt = $this->system->getDbObject( )->query( $query );
       $resultados = $stmt->fetchAll( );
       return $resultados;
    }
    
    
    
    
    
    
    
    public function fetchClasificados( )
    {

        $query = "SELECT clasificados.precio, clasificados.titulo, clasificados.descripcion,
                         provincia.nombre AS Provincia, municipio.nombre AS Municipio   
                         FROM clasificados 
                                LEFT JOIN provincia ON clasificados.provincia_id = provincia.id
				LEFT JOIN municipio ON clasificados.municipio_id = municipio.id
                                INNER JOIN categorias ON clasificados.categorias_id = categorias.id
                                INNER JOIN usuarios ON clasificados.usuarios_id = usuarios.id
                                WHERE clasificados.categorias_id != '1'
                                ORDER BY clasificados.fecha_publicacion DESC";
        /* LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
				INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                                WHERE fotos.orden = 1    
        */
        
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

    }
    
    
    public function fetchAnunciosByBusqueda2($municipioId)
    {

        $query = "SELECT anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.direccion, anuncios.precio, anuncios.mcuadrado,
                    tipo_vivienda.nombre AS vivienda, anuncios.tipo_dormitorio_id AS dormitorio, anuncios.fecha_publicacion,
                    anuncios.tipo_banyo_id AS banyo, anuncios.usuarios_id AS usuarios_id, tipo_planta.nombre AS planta,
                    tipo_anuncio.nombre AS tipoanuncio, provincia.nombre AS provincia,
                    municipio.nombre AS municipio, usuarios.nombre_comercial,
                    usuarios.correo_electronico, fotos.file_name, anuncios.tipo As tipoVisualizacion
                    FROM anuncios
                    LEFT JOIN tipo_vivienda ON anuncios.tipo_vivienda_id = tipo_vivienda.id
                    LEFT JOIN tipo_planta ON anuncios.tipo_planta_id = tipo_planta.id
                    LEFT JOIN tipo_anuncio ON anuncios.tipo_anuncio_id = tipo_anuncio.id
                    LEFT JOIN provincia ON anuncios.provincia_id = provincia.id
                    LEFT JOIN municipio ON anuncios.municipio_id = municipio.id
                    LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
                    INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                    WHERE fotos.orden = 1 AND anuncios.municipio_id=" . $municipioId . " ORDER BY anuncios.fecha_publicacion DESC";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados;

     }


     
     // TOMO
     public function fetchAnunciosByMunicipio( )
     {
         
         
         // Get the partials
         $html = $this->view->setPartials('partials/item.phtml');
         
         // Render this html to browser
         die('<pre>' . print_r($html,true) . '</pre>');
         
         
         return true;
     }
     
     
     
     public function listAnunciosVarios( )
     {
         
        $query = "SELECT * FROM clasificados_varios"; 
         
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        return $resultados;

     }
     
     
     public function getCategoria( )
     {
      /*   if ( $tipo )
         
         
     */
         
     }        
     
     
     
     public function fetchClasificadosVarios( )
     {

        $query = "SELECT clasificados_varios.id, clasificados_varios.titulo, clasificados_varios.descripcion,
                    provincia.nombre AS Provincia, municipio.nombre AS Municipio   
                    FROM clasificados_varios 
                           LEFT JOIN provincia ON clasificados_varios.provincia_id = provincia.id
                           LEFT JOIN municipio ON clasificados_varios.municipio_id = municipio.id
                           INNER JOIN categorias ON clasificados_varios.categorias_id = categorias.id
                           INNER JOIN usuarios ON clasificados_varios.usuarios_id = usuarios.id
                           WHERE clasificados_varios.categorias_id != '1'
                           ORDER BY clasificados_varios.fecha_publicacion DESC";
        /* LEFT JOIN fotos ON anuncios.id = fotos.anuncios_id
				INNER JOIN usuarios ON anuncios.usuarios_id = usuarios.id
                                WHERE fotos.orden = 1    
        */
        
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;
         
     }        
     
     
     
     public function fetchClasificadosVariosTop( )
     {

         $query="SELECT * FROM clasificados_varios";
         $dbAdapter = $this->system->getDbObject( );
         $statement = $dbAdapter->query($query);
         $resultados = $statement->fetchAll( );

         return $resultados;
     }
     
     public function fetchAnuncioVarios( $id )
     {

        $query = "SELECT clasificados_varios.id as anuncioId, 
                         clasificados_varios.titulo, clasificados_varios.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono
                         FROM clasificados_varios 
                           INNER JOIN provincia ON clasificados_varios.provincia_id = provincia.id
                           INNER JOIN municipio ON clasificados_varios.municipio_id = municipio.id
                           INNER JOIN categorias ON clasificados_varios.categorias_id = categorias.id
                           INNER JOIN usuarios ON clasificados_varios.usuarios_id = usuarios.id
                           WHERE clasificados_varios.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }


     
     public function fetchAnuncioMotor( $id )
     {

        $query = "SELECT clasificados.id as anuncioId, usuarios.id As userId, 
                         clasificados.titulo, clasificados.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono, fotos_clasificados.file_name, fotos_clasificados.orden
                         FROM clasificados
                           INNER JOIN provincia ON clasificados.provincia_id = provincia.id
                           INNER JOIN municipio ON clasificados.municipio_id = municipio.id
                           INNER JOIN categorias ON clasificados.categorias_id = categorias.id
                           INNER JOIN usuarios ON clasificados.usuarios_id = usuarios.id
                           LEFT JOIN fotos_clasificados ON fotos_clasificados.clasificados_id = clasificados.id
                           WHERE clasificados.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }

     
     public function fetchAnuncioModa( $id )
     {

        $query = "SELECT modas.id as anuncioId, usuarios.id As userId, 
                         modas.titulo, modas.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono, fotos_modas.file_name, fotos_modas.orden
                         FROM modas
                           INNER JOIN provincia ON modas.provincia_id = provincia.id
                           INNER JOIN municipio ON modas.municipio_id = municipio.id
                           INNER JOIN categorias ON modas.categorias_id = categorias.id
                           INNER JOIN usuarios ON modas.usuarios_id = usuarios.id
                           LEFT JOIN fotos_modas ON fotos_modas.modas_id = modas.id
                           WHERE modas.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }
     

     public function fetchAnuncioMueble( $id )
     {

        $query = "SELECT muebles.id as anuncioId, usuarios.id As userId, 
                         muebles.titulo, muebles.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono, fotos_muebles.file_name, fotos_muebles.orden
                         FROM muebles
                           INNER JOIN provincia ON muebles.provincia_id = provincia.id
                           INNER JOIN municipio ON muebles.municipio_id = municipio.id
                           INNER JOIN categorias ON muebles.categorias_id = categorias.id
                           INNER JOIN usuarios ON muebles.usuarios_id = usuarios.id
                           LEFT JOIN fotos_muebles ON fotos_muebles.muebles_id = muebles.id
                           WHERE muebles.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }
     
     
     public function fetchAnuncioMudanza( $id )
     {

        $query = "SELECT mudanzas.id as anuncioId, usuarios.id As userId, 
                         mudanzas.titulo, mudanzas.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono
                         FROM mudanzas
                           INNER JOIN provincia ON mudanzas.provincia_id = provincia.id
                           INNER JOIN municipio ON mudanzas.municipio_id = municipio.id
                           INNER JOIN categorias ON mudanzas.categorias_id = categorias.id
                           INNER JOIN usuarios ON mudanzas.usuarios_id = usuarios.id
                           WHERE mudanzas.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }
     
     
     public function fetchAnuncioEmpleo( $id )
     {

        $query = "SELECT empleos.id as anuncioId, usuarios.id As userId, 
                         empleos.titulo, empleos.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono
                         FROM empleos
                           INNER JOIN provincia ON empleos.provincia_id = provincia.id
                           INNER JOIN municipio ON empleos.municipio_id = municipio.id
                           INNER JOIN categorias ON empleos.categorias_id = categorias.id
                           INNER JOIN usuarios ON empleos.usuarios_id = usuarios.id
                           WHERE empleos.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }

     public function fetchAnuncioReforma( $id )
     {

        $query = "SELECT reformas.id as anuncioId, usuarios.id As userId, 
                         reformas.titulo, reformas.descripcion,
                         categorias.name, provincia.nombre AS provinciaName, municipio.nombre AS municipioName,
                         usuarios.correo_electronico, usuarios.nombre_comercial, usuarios.contacto,
                         usuarios.contacto_apellidos, usuarios.telefono
                         FROM reformas
                         INNER JOIN provincia ON reformas.provincia_id = provincia.id
                         INNER JOIN municipio ON reformas.municipio_id = municipio.id
                         INNER JOIN categorias ON reformas.categorias_id = categorias.id
                         INNER JOIN usuarios ON reformas.usuarios_id = usuarios.id
                         WHERE reformas.id='". $id ."'";

        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;

     }
     
     
     
     public function fetchRentInfo($rentId)
     {
        //die('DATOS_2::fetchRentInfo<pre>' . print_r($rentId,true) . '</pre>' ); 
         
        $query = "SELECT * FROM alquileres WHERE id = '" . $rentId . "'";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;
     }
     
     
     public function fetchAdvertInfo($publicityId)
     {
        $query = "SELECT * FROM anuncios WHERE id = '" . $publicityId . "'";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );

        return $resultados;
     }
     
     
     public function getBanner()
     {

        $query = "SELECT id, file_name, description, altmsg FROM banners WHERE estado = '1' ORDER BY rand()";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
       
        return $resultados;;
     }
     
     public function optimizedRand()
     {
         
        $query = "SELECT id, file_name, description FROM banners WHERE estado = '1' ORDER BY rand()";
        $stmt = $this->system->getDbObject( )->query( $query );
        $stmt->fetchAll( );
         
        return true;
     }        
     
     
     
     
     public function incrementCounter($bannerId)
     {
        $query = "UPDATE guests SET counter = (counter+1) WHERE banner_id = '". $bannerId ."'";
        $this->system->getDbObject( )->query( $query );
        return true;
     }        
     
     
     public function actualizated($rentId,$customerId)
     {
        $query = "UPDATE alquileres SET customer_id = $customerId WHERE id = '". $rentId ."'";  
        $this->system->getDbObject( )->query( $query );
        return true;
     }        
     
     /*
      * This must check 
      * 
      * 
      */
     
     
     
     public function fetchAnunciosRestaurantes()
     {
         // POZOR!
         // Insert in the field <<orden>>  a value aleator Then make orden

         $this->db = 'table';
         if (true==$this->insertAleatorio($this->db)) {
            $results =  $this->makeOrden($this->db);
         }

         $list = '';
         foreach($results as $result) {
             $list .= $this->view($this->value,$this->partial,$result);
         }

         return $list;

     }
     
     
     public function makeOrden($string) {
         // Important
         $file = strlen($string);
         return $file;
         
     }
     
     
     public function insertAleatorio($table) {
         // Create the statemente ...
         if(true) {
            $query = "SELECT * FROM $table";
         }
         return $query;
         
     }
     
     
     public function saveDescription($text)
     {
        //$handler = new Application_Model_DbTable_Banner();
        $query = "SELECT id FROM banners ORDER BY id DESC LIMIT 0,1";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        $id = $resultados['0']['id'];
        
        $queryUp = "UPDATE banners SET description = '" . $text . "' WHERE id = '". $id ."'";
        //echo $queryUp; 
        $this->system->getDbObject( )->query( $queryUp );
        
        return true;
     }

     
     
     public function getCleanUrls()
     {

        $query = "SELECT id, url FROM anuncios";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
         
        return $resultados;

     }

     // OBSOLET Para URL AMIGABLE UNICA
     public function getUniqueCleanUrl()
     {

        $query = "SELECT id, url FROM anuncios WHERE panoramico = 1";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
         
        return $resultados;

     }
     
     // OBSOLET Para URL AMIGABLE UNICA
     public function setUniqueCleanUrs($id)
     {
        $query = "UPDATE anuncios SET panoramico = 1 WHERE id = '". $id ."'";  
        $this->system->getDbObject( )->query( $query );
        return true;         
         
     }        
     
     
     public function getRentId()
     {

        $query = "SELECT id FROM alquileres ORDER BY id DESC LIMIT 0,1";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
        $id = $resultados['0']['id'];
        
        return $id;

     }        
     
     
     
    public function fetchLinks()
    {
        $query = "SELECT * FROM enlaces WHERE state = 1";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
         
        return $resultados;
    }        
     
     
    public function fetchProperty()
    {
        $query = "SELECT * FROM property";
        $stmt = $this->system->getDbObject( )->query( $query );
        $resultados = $stmt->fetchAll( );
         
        return $resultados;
    }        
     
     
     
     
     
}

