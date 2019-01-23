<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;
    
    
    public function __construct($table) {
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();

        $this->fluent=$this->getConetar()->startFluent();
        $this->con=$this->getConetar()->conexion();
     }
    
     
    public function fluent(){
    	return $this->fluent;
    }
    
    public function con(){
    	return $this->con;
    }
    
    
    public function getConetar(){
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }
    
    public function getNuevo($secuencia){
    
    	$query=pg_query($this->con, "SELECT NEXTVAL('$secuencia')");
    	 
    	$resultSet = array();
    	 
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }
    
    public function getAll($id){
        
    	$query=pg_query($this->con, "SELECT * FROM $this->table ORDER BY $id ASC");
    	$resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    
    
    
    public function getContador($contador){
    
    	$query=pg_query($this->con, "SELECT $contador FROM $this->table ");
    	$resultSet = array();
    	 
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }
    
    public function getCantidad($columna,$tabla,$where){
    
    	//parametro $columna puede ser todo (*) o una columna especifica
    	$query=pg_query($this->con, "SELECT COUNT($columna) AS total FROM $tabla WHERE $where ");
    	$resultSet = array();
    
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }    
    
    
    public function getById($id){
    	
    	$query=pg_query($this->con, "SELECT * FROM $this->table WHERE id=$id");
        $resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function getBy($where){
    	
    	$query=pg_query($this->con, "SELECT * FROM $this->table WHERE   $where ");
        $resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function deleteById($id){
    	
        $query=pg_query($this->con,"DELETE FROM $this->table WHERE $id"); 
        return $query;
    }
    
    
   
    
    public function deleteBy($column,$value){

    	try 
    	{
    		$query=pg_query($this->con,"DELETE FROM $this->table WHERE $column='$value' ");
    	}
    	catch (Exeption $Ex)
    	{
    		
    		
    	} 
    	
        return $query;
    }
    

    public function getCondiciones($columnas ,$tablas , $where, $id){
    	
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    public function getCondicionesValorMayor($columnas ,$tablas , $where){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    
    public function getCondicionesDesc($columnas ,$tablas , $where, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  DESC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
   
    
    public function getCondiciones_grupo($columnas ,$tablas , $where, $grupo, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where GROUP BY $grupo ORDER BY $id  ASC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
  
    public function getCondicionesPag($columnas ,$tablas , $where, $id, $limit){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC  $limit");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    public function getCondicionesPagDesc($columnas ,$tablas , $where, $id, $limit){
    
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  DESC  $limit");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    public function UpdateBy($colval ,$tabla , $where){
    	try 
    	{ 
    	     $query=pg_query($this->con, "UPDATE $tabla SET  $colval   WHERE $where ");
    	     
    	}
    	catch (Exeption  $Ex)
    	{
    		
    		
    	}
    }
    
    
    
    public function getByPDF($columnas, $tabla , $where){
    
    	if ($tabla == "")
    	{
    		$query=pg_query($this->con, "SELECT $columnas FROM $this->table WHERE   $where ");
    	}
    	else
    	{
    		$query=pg_query($this->con, "SELECT $columnas FROM $tabla WHERE   $where ");
    	}
    	
    	return $query;
    }
    
    public function getCondicionesPDF($columnas ,$tablas , $where, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
    
    	return $query;
    }
    
    
    
    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    
    public function encriptar($cadena){
    	$key='rominajasonrosabal';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    	return $encrypted; //Devuelve el string encriptado
    
    }
    
    public function desencriptar($cadena){
    	$key='rominajasonrosabal';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    	return $decrypted;  //Devuelve el string desencriptado
    }
    
    public function registrarSesion($id_usuario, $id_rol, $nombre_usuario, $correo_usuario, $ip_usuario, $cedula_usuarios)
    {
    	session_start();
    	$_SESSION["cedula_usuarios"]=$cedula_usuarios;
    	$_SESSION["id_usuarios"]=$id_usuario;
    	$_SESSION["id_rol"]=$id_rol;
    	$_SESSION["nombre_usuarios"]=$nombre_usuario;
    	$_SESSION["correo_usuarios"]=$correo_usuario;
    	$_SESSION["ip_usuarios"]=$ip_usuario; 	

    	if (substr($ip_usuario, 0, 3) == "192" )
    	{
    		$_SESSION["tipo_usuario"]="usuario_local";
    	}
    	else   ///usuarios externo 
    	{
    		
    		$_SESSION["tipo_usuario"]="usuario_externo";
    	}
    		
    	
    }
    
    
    
    public function registrarSesionParticipe($cedula_participe)
    {
    	
    	$_SESSION["cedula_participe"]=$cedula_participe;
    	
    	 
    }
    
    
    public function getPermisosVer($where){
    	 
    	$query=pg_query($this->con, "SELECT permisos_rol.ver_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  ver_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }

    
    public function getPermisosEditar($where){
    
    	$query=pg_query($this->con, "SELECT permisos_rol.editar_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  editar_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    

    public function getPermisosBorrar($where){
    
    	$query=pg_query($this->con, "SELECT permisos_rol.borrar_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  borrar_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    public  function  SendMail($para, $titulo, $lista, $imagen, $asunto)
    {
    
    	 
    
    
    
    	// Varios destinatarios
    
    	$para  = 'maycol@masoft.net' . ', '; // atención a la coma
    	$para .= 'danny@masoft.net' . ', ';
		$para .= 'manuel@masoft.net' . ', ';
		$para .= 'steven@masoft.net';
		
    
    	//$para  = 'desarrollo@masoft.net' . ', '; // atención a la coma
    	//$para .= 'manuel@masoft.net';
    
    	 
    	 
    	// título
    	$título = $asunto;
    	 
    	// mensaje
    	$mensaje_cabeza = '
    
    <html>
		<head>
			<title>INCIDENCIAS</title>
    		<meta charset="UTF-8">
			    </head>
				     <body style="background-color:#d9e3e4">
				   <div style="background-color:#d93e1b">
				<rigth><img src="http://18.221.171.210:80/coactiva_liventy/FrameworkMVC/view/images/logo-coctiva.png" WIDTH="200" HEIGHT="80" /></rigth>
	             </div>
    			<h2><center><b>INCIDENCIAS</b></center></h2>
    
    			<TABLE rules="all" WIDTH="100%">
    
    			<TR>
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Nombre</b>
									</TD>
					
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Correo</b>
									</TD>
    
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Rol</b>
									</TD>
					
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Descripción</b>
									</TD>
    								<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Fecha</b>
									</TD>
    
									
								</TR>
            
								  ';
    
    	$mensaje_detalle = "";
    	
    	foreach($lista as $res)
    	{
    		
    		$mensaje_detalle .=  '<td><center>'. $res->nombre_usuarios .'   </td>' ;
    		$mensaje_detalle .=  '<td><center>'. $res->correo_usuarios .'   </td>' ;
    		$mensaje_detalle .=  '<td><center>'. $res->nombre_rol .'   </td>' ;
    		$mensaje_detalle .=  '<td><justify>'. $res->descripcion_incidencia .'   </td>' ;
    		$mensaje_detalle .=  '<td><center>'. $res->creado .'   </td>' ;
    		
    	}
    	
    	
    	
    
    	$mensaje_pie =  '</table>
    
				<br/>
				<br/>
				<br/>
    			
    			
				</body>
				</html>
				';
    
    	
    	$mensaje_cabeza1 = '
    	
    <html>
			<body>
				
			<TABLE rules="all" WIDTH="100%">
    	
    			
    	
								  ';
    	
    	$mensaje_detalle1 = "";
    	 
    	foreach($lista as $res)
    	{
    	$mensaje_detalle1 .=  '<td><center><input type="image" name="image" src="http://18.221.171.210:80/coactiva_liventy/FrameworkMVC/view/DevuelveImagen.php?id_valor='.$res->id_incidencia.'&id_nombre=id_incidencia&tabla=incidencia&campo=imagen_incidencia" alt="'.$res->id_incidencia.'" width="600" height="550"></td>' ;
    	
    	}
    	 
    	 
    	 
    	
    	$mensaje_pie1 =  '</table>
    	
				<br/>
				<br/>
				<br/>
    
    			<TABLE WIDTH="100%">
				<TR>
                <tr style="background:#1C1C1C"><td WIDTH="1000" HEIGHT="50" align="center"><font color="white">All Coercive - Desarrollado por <a href="http://www.masoft.net">www.masoft.net</a> - Copyright © 2016-</font></td></tr>
    	
				</TR>
                </TABLE>
    			<br/>
				<br/>
				<br/>
				<br/>
				</body>
				</html>
				';
    	
    	$mensaje = $mensaje_cabeza . $mensaje_detalle . $mensaje_pie . $mensaje_cabeza1 . $mensaje_detalle1 . $mensaje_pie1;
    	
    	// Para enviar un corre=o HTML, debe establecerse la cabecera Content-type
    	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    	$cabeceras .= 'Content-type: text/html; utf8_decode' . "\r\n";
    	
    	// Cabeceras adicionales
    	$cabeceras .= 'To: ' . "\r\n";
    	$cabeceras .= 'From: allcoercive <maycol@masoft.net>' . "\r\n";
    	
    	// Enviarlo
    	mail($para,utf8_decode($título),utf8_decode($mensaje),utf8_decode($cabeceras));
    	    	
    	
    }
    
    
    
    
    public  function  SendMailRespuesta($para, $titulo, $lista, $imagen, $asunto)
    {
    
    	$título = 'Respuesta a: '.$asunto;
    
    	// mensaje
    	$mensaje_cabeza = '
    
    <html>
		<head>
			<title>INCIDENCIAS</title>
    		<meta charset="UTF-8">
			    </head>
				     <body style="background-color:#d9e3e4">
				   <div style="background-color:#d93e1b">
				<rigth><img src="http://18.221.171.210:80/coactiva_liventy/FrameworkMVC/view/images/logo-coctiva.png" WIDTH="200" HEIGHT="80" /></rigth>
	             </div>
    			<h2><center><b>RESPUESTA INCIDENCIAS</b></center></h2>
    
    			<TABLE rules="all" WIDTH="100%">
    
    			<TR>
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Responsable</b>
									</TD>
			
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Problema</b>
									</TD>
    		
									<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Descripción Solución</b>
									</TD>
    								<TD WIDTH=200 bgcolor="#A4A4A4">
									  <h4><center><b>Fecha</b>
									</TD>
    
					
								</TR>
    
								  ';
    
    	$mensaje_detalle = "";
    	 
    	foreach($lista as $res)
    	{
    
    		$mensaje_detalle .=  '<td><center>'. $res->nombre_usuarios .'   </td>' ;
    		$mensaje_detalle .=  '<td><center>'. $asunto .'   </td>' ;
    		$mensaje_detalle .=  '<td><justify>'. $res->descripcion_respuesta .'   </td>' ;
    		$mensaje_detalle .=  '<td><center>'. $res->creado .'   </td>' ;
    
    	}
    	 
    	 
    	 
    
    	$mensaje_pie =  '</table>
    
				<br/>
				<br/>
				<br/>
    
    
				</body>
				</html>
				';
    
    	 
    	$mensaje_cabeza1 = '
   
    <html>
			<body>
    
			<TABLE rules="all" WIDTH="100%">
   
    
   
								  ';
    	 
    	$mensaje_detalle1 = "";
    
    	foreach($lista as $res)
    	{
    		$mensaje_detalle1 .=  '<td><center><input type="image" name="image" src="http://18.221.171.210:80/coactiva_liventy/FrameworkMVC/view/DevuelveImagen.php?id_valor='.$res->id_respuesta_incidencia.'&id_nombre=id_respuesta_incidencia&tabla=respuesta_incidencia&campo=image_respuesta" alt="'.$res->id_respuesta_incidencia.'" width="600" height="550"></td>' ;
    		 
    	}
    
    
    
    	 
    	$mensaje_pie1 =  '</table>
   
				<br/>
				<br/>
				<br/>
    
    			<TABLE WIDTH="100%">
				<TR>
                <tr style="background:#1C1C1C"><td WIDTH="1000" HEIGHT="50" align="center"><font color="white">All Coercive - Desarrollado por <a href="http://www.masoft.net">www.masoft.net</a> - Copyright © 2016-</font></td></tr>
   
				</TR>
                </TABLE>
    			<br/>
				<br/>
				<br/>
				<br/>
				</body>
				</html>
				';
    	 
    	$mensaje = $mensaje_cabeza . $mensaje_detalle . $mensaje_pie . $mensaje_cabeza1 . $mensaje_detalle1 . $mensaje_pie1;
    	 
    	// Para enviar un corre=o HTML, debe establecerse la cabecera Content-type
    	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    	$cabeceras .= 'Content-type: text/html; utf8_decode' . "\r\n";
    	 
    	// Cabeceras adicionales
    	$cabeceras .= 'To: ' . "\r\n";
    	$cabeceras .= 'From: allcoercive <maycol@masoft.net>' . "\r\n";
    	 
    	// Enviarlo
    	mail($para,utf8_decode($título),utf8_decode($mensaje),utf8_decode($cabeceras));
    
    	 
    }
    
    function getRealIP() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP']))
    		return $_SERVER['HTTP_CLIENT_IP'];
    	 
    	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    		return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	 
    	return $_SERVER['REMOTE_ADDR'];
    }
    
    
    
    
    
    public function AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador,$id_usario=null)
    {
    
    
    	$traza=new TrazasModel();
    	$funcion = "ins_trazas";
    	$_id_usuarios="";
    
    	if(is_null($id_usario)){
    	$_id_usuarios=$_SESSION['id_usuarios'];
    	}else{
    	$_id_usuarios=$id_usario;
    	}
    	
    	$parametros = "'$_id_usuarios', '$_accion_trazas', '$_parametros_trazas', '$_nombre_controlador'  ";
    	$traza->setFuncion($funcion);
    	$traza->setParametros($parametros);
    	$resultadoT=$traza->Insert();
    
    }
    
    
    public function  InsertaEntidades($nombre_entidades){
    	
    	$entidades = New EntidadesModel();
    	
    	$funcion = "ins_entidades_liventy";
    	$parametros = "'$nombre_entidades'";
    	$entidades->setFuncion($funcion);
    	$entidades->setParametros($parametros);
    	$resultadoT=$entidades->Insert();
    }
    
    
    public function  Inser_Tipo_Notificaciones($descripcion_notificacion, $id_impulsor, $id_secretario){
    	 
    	$cantidad_notificacion=1;
    	$tipo_notificaciones = new TipoNotificacionModel();
    	$funcion = "ins_tipo_notificaciones_liventy";
    	$parametros = "'$descripcion_notificacion', '$cantidad_notificacion', '$id_impulsor', '$id_secretario'  ";
    	$tipo_notificaciones->setFuncion($funcion);
    	$tipo_notificaciones->setParametros($parametros);
    	$resultadoT=$tipo_notificaciones->Insert();
    	 
    }
    
    public function  Inser_Notificaciones($id_juicios, $id_tipo_notificaciones, $nombre_documentos){
    	
    	$notificaciones = new NotificacionesModel();
    	$funcion = "ins_notificaciones_liventy";
    	$parametros = "'$id_juicios', '$id_tipo_notificaciones', '$nombre_documentos'";
    	$notificaciones->setFuncion($funcion);
    	$notificaciones->setParametros($parametros);
    	$resultadoT=$notificaciones->Insert();
    }
    
    
    
    public function InsertaJuicio($id_entidades,$id_juzgado,$juicio_referido_titulo_credito,$id_usuarios,$id_titulo_credito,$id_clientes,$id_etapas_juicios,$id_tipo_juicios,$descipcion_auto_pago_juicios,$id_estados_procesales_juicios,$id_estados_auto_pago_juicios,$nombre_archivado_juicios)
    {
    	//ins_juicios->FUNCION
    	//_id_entidades , _id_ciudad , _juicio_referido_titulo_credito  , _id_usuarios , _id_titulo_credito , _id_clientes , _id_etapas_juicios , _id_tipo_juicios , _descipcion_auto_pago_juicios  , _id_estados_procesales_juicios , _id_estados_auto_pago_juicios , _nombre_archivado_juicios
    	
    	$juicio=new JuiciosModel();
    	$funcion="ins_juicios";
    	$parametros="'$id_entidades','$id_juzgado','$juicio_referido_titulo_credito','$id_usuarios','$id_titulo_credito','$id_clientes','$id_etapas_juicios','$id_tipo_juicios','$descipcion_auto_pago_juicios','$id_estados_procesales_juicios','$id_estados_auto_pago_juicios','$nombre_archivado_juicios'";
    	$juicio->setFuncion($funcion);
    	$juicio->setParametros($parametros);
    	$juicio->Insert();
    	
    	//actualizar los prefijos
    	$prefijos=new PrefijosModel();
    	$colval="consecutivo=consecutivo+1";
    	$tabla="prefijos";
    	$where="id_prefijos='1'";
    	
    	$resultado=$prefijos->UpdateBy($colval, $tabla, $where);
    }
    
 
  

    public function InsertaErroresImportacion( $_origen_errores_importacion , $_error_errores_importacion, $_detalle_errores_importacion)
    {
    
    	//ins_errores_importacion(_origen_errores_importacion , _error_errores_importacion , _detalle_errores_importacion , _id_usuarios)
    
    	$errores_importacion = new ErroresImportacionModel();
    	
    
    	$funcion = "ins_errores_importacion";
    
    	$_id_usuarios=$_SESSION['id_usuarios'];
    
    	 
    	$parametros = " '$_origen_errores_importacion' , '$_error_errores_importacion' , '$_detalle_errores_importacion' ,  '$_id_usuarios'  ";
    
    	$errores_importacion->setFuncion($funcion);
    
    	$errores_importacion->setParametros($parametros);
    
    	$resultadoT=$errores_importacion->Insert();
    
    }
    
    
    function myFunctionErrorHandler($errno, $errstr, $errfile, $errline)
    {
    	/* Según el típo de error, lo procesamos */
    	switch ($errno) {
    		case E_WARNING:
    			echo "Hay un WARNING.<br />\n";
    			echo "El warning es: ". $errstr ."<br />\n";
    			echo "El fichero donde se ha producido el warning es: ". $errfile ."<br />\n";
    			echo "La línea donde se ha producido el warning es: ". $errline ."<br />\n";
    			/* No ejecutar el gestor de errores interno de PHP, hacemos que lo pueda procesar un try catch */
    			return true;
    			break;
    
    		case E_NOTICE:
    			echo "Hay un NOTICE:<br />\n";
    			/* No ejecutar el gestor de errores interno de PHP, hacemos que lo pueda procesar un try catch */
    			return true;
    			break;
    
    		default:
    			/* Ejecuta el gestor de errores interno de PHP */
    			return false;
    			break;
    	}
    }
    
    
    //funciones  de notificaciones anterior
    function verNotificaciones(){
    	//session_start();
    	$id_usuario=$_SESSION['id_usuarios'];
    	$notificaciones=new NotificacionesModel();
    	$where_notificacion = " id_usuarios = '$id_usuario' AND visto_notificaciones=false";
    	$result_notificaciones=$notificaciones->getBy($where_notificacion);
    	
    	return $result_notificaciones;
    }
    
	public function InsertaNotificaciones($id_tipo_notificacion ,$id_usuarios_dirigido_notificacion, $descripcion_notificaciones )
    {
    
    
    	$notificaciones=new NotificacionesModel();
    	
    	$usuarios = new UsuariosModel();
    		
    	$funcion = "ins_notificaciones";
    
    	$id_usuarios=$_SESSION['id_usuarios'];
    	
    	$resultUsuario=$usuarios->getBy("id_usuarios='$id_usuarios'");
    	
    	$descripcion_notificaciones.=" (".$resultUsuario[0]->usuario_usuarios.")";
    
    	
    	$parametros = "'$id_tipo_notificacion','$id_usuarios_dirigido_notificacion', '$descripcion_notificaciones'";
    	
    	    
    	$notificaciones->setFuncion($funcion);
    		
    	$notificaciones->setParametros($parametros);
    		
    	$resultadoN=$notificaciones->Insert();
    	
    
    }
    //termina funciones anteriores notificaciones
    
    
    public function verMacAddress(){
    /*
    	
    	
    	ob_start();
    
    	system('ipconfig /all');
    
    	$mycomsys=ob_get_contents();
    
    	ob_clean();
    		
    	$macaddress="";
    	$find_mac = "Direcci";
    
    	$pmac = strpos($mycomsys, $find_mac);
    		
    	if ($pmac === false) {
    
    	} else {
    		$find_mac = "Fhysical";
    		$macaddress=substr($mycomsys,($pmac+36),17);
    
    	}
    		
    		
    	$macaddress=substr($mycomsys,($pmac+43),23);
    
    	return $macaddress;*/
    	return '1';
    }
    
    
    public function getPermisosFirmar()
    {
    	@@session_start();
    	
    	$resultado="";
    	
    	$id_usuario=$_SESSION['id_usuarios'];
    	
    	$certficados = new CertificadosModel();
    	$resultCertificados=$certficados->getBy("id_usuarios_certificado_digital='$id_usuario'");
    	
    	//verificar si tiene registradso certificado electronico.
    	
    	if(!empty($resultCertificados))
    	{
    		//verficar si se encuentra en la maquina personal del usuario
    		
    		$macLocal=$this->verMacAddress();
    		$resultMac=$certficados->getBy("mac_certificado_digital='$macLocal'");
    		
    		if (!empty($resultMac))
    		{
    			$firmas= new FirmasDigitalesModel();
    			$resultFirmas=$firmas->getBy("id_usuarios='$id_usuario'");
    			
    			
    			if(!empty($resultFirmas))
    			{
    				$resultado="";
    				
    			}else
    			{
    				$resultado="No tiene registrado una firma";
    			}    			
    			
    			
    		}else{
    			
    			$resultado="No tiene permiso para firmar desde esta pc";
    		}
    		
    	}else
    	{
    		$resultado="Tiene que registrar certificado electronico";
    	}
    	
    	return $resultado;
    }
    
    
    
    public function FirmarDocumentos($directorio,$nombrePdf,$id_firma)
    {
    	@@session_start();
    						
    	$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/coactiva_liventy/documentos/';
    	$id_rol=$_SESSION['id_rol'];
    	

		$origen = $directorio . $nombrePdf;
		
		$destino = $directorio . 'firmados/' . $nombrePdf;
		
		$ruta_ejecutable = $directorio . 'firmar/FirmadorElectronico.exe';
		
		$comando = 'start "" /b "' . $ruta_ejecutable . '" ' . $id_firma . ' ' . $origen . ' ' . $destino . ' '.$id_rol.' ';
		
		$comando_esc = escapeshellcmd ( $comando );
		
		exec ( $comando_esc, $resultadoSalida, $ejecucion );
		
		return $resultadoSalida;
		
    }
    
    public function FirmarDocumentoConPosicion($nombre,$id_firma,$destino,$posicion)
    {
    	session_start();
    
    	$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/coactiva_liventy/documentos/';
    
    	$nombre = $_FILES ['imagen_firmas_digitales'] ['name'];
    	$tipo = $_FILES ['imagen_firmas_digitales'] ['type'];
    	$tamano = $_FILES ['imagen_firmas_digitales'] ['size'];
    
    	move_uploaded_file($_FILES['imagen_firmas_digitales']['tmp_name'],$directorio.$nombre);
    	 
    	$origen = $directorio . $nombre;
    
    	$destino = $directorio . 'firmados/' . $nombre;
    
    	$ruta_ejecutable = $directorio . 'firmar/FirmadorElectronico.exe';
    
    	$comando = 'start "" /b "' . $ruta_ejecutable . '" ' . $id_firma . ' ' . $origen . ' ' . $destino . ' ';
    		
    	
    
    	$comando_esc = escapeshellcmd ( $comando );
    
    	exec ( $comando_esc, $resultadoSalida, $ejecucion );
    
    	return $resultadoSalida;
    
    }
    
    //cuando se selecciona archivos a firmar
    
    public function getPermisosFirmarPdfs($id_usuario,$Maclocal=null)
    {
    	$resultado=array('valor'=>0,'error'=>'','estado'=>false);
    	 
    	
    	$certficados = new CertificadosModel();
    	$resultCertificados=$certficados->getBy("id_usuarios_certificado_digital='$id_usuario'");
    	 
    	//verificar si tiene registradso certificado electronico.
    	 
    	if(!empty($resultCertificados))
    	{
    		//verficar si se encuentra en la maquina personal del usuario
    
    		//$macLocal=$this->verMacAddress();
    		$macUsuario=$resultCertificados[0]->mac_certificado_digital;
    		
    		//$resultMac=$certficados->getBy("mac_certificado_digital='$macLocal' AND id_usuarios_certificado_digital='$id_usuario'");
        	//if (!empty($resultMac))
        	
    		if($macUsuario===$Maclocal)
    		{
    			$firmas= new FirmasDigitalesModel();
    			$resultFirmas=$firmas->getBy("id_usuarios='$id_usuario'");
    			 
    			
    			if(!empty($resultFirmas))
    			{
    				$id_firma=$resultFirmas[0]->id_firmas_digitales;
    			
    				$resultado=array('valor'=>$id_firma,'error'=>'','estado'=>true);
    				
    
    			}else
    			{
    				
    				$resultado['error']="No tiene registrado una firma";
    			}
    			 
    			 
    		}else{
    			
    			$resultado['error']="No tiene permiso para firmar desde esta Maquina <br> por favor firmar desde su maquina asignada";
    		}
    
    	}else
    	{
    		
    		$resultado['error']="Tiene que registrar certificado electronico";
    	}
    	 
    	return $resultado;
    }

    public function extraerEspacio($filePath,$addpage)
    {
    	$ruta_exec_extract_line = $_SERVER['DOCUMENT_ROOT'].'/coactiva_liventy/documentos/extraer/VerEspacioPdf.exe';
    	
    	$comando_extraer = 'start "" /b "' . $ruta_exec_extract_line . '" ' . $filePath . ' '. $addpage . ' ';
    	 
    	$comando_esc_extraer = escapeshellcmd ( $comando_extraer );
    	 
    	exec ( $comando_esc_extraer, $resultadoExtraer, $ejecucion_extraer );
    	 
    	$total_espacio=$resultadoExtraer[0];
    	
    	return $total_espacio;
    }
    
    public function FirmarPDFs($destino,$nombrePdf,$id_firma,$id_rol,$id_usuario=null)
    {
    	@@ session_start();
    	//para metodos dentro del framework
    	//$id_usuario=$_SESSION['id_usuarios'];
    	
    	$ruta_ejecutable = $_SERVER['DOCUMENT_ROOT'].'/coactiva_liventy/documentos/firmar/FirmadorElectronico.exe';
    	$tmp = $_SERVER['DOCUMENT_ROOT'].'/coactiva_liventy/documentos/tmp_documentos/';
		
		//$destino =  $_SERVER['DOCUMENT_ROOT'].'/coactiva/documentos/Avoco/';
    	
    	$moveTo = $tmp.$nombrePdf;
    	$moveOf = $destino.$nombrePdf;
		
		
		//var_dump(file_exists ( $moveTo ));
       // var_dump(file_exists ( $moveOf ));
    	
    	rename($moveOf,$moveTo);
		
		
    	
    	$origen=$moveTo;
    	$destino=$moveOf;
		
    	$tipo_pdf="";
    	$add_page="false";
    	$total_espacio=0;
    	//error en la conversion
    	$nombre_pdf_bd = $origen;
    	
    	$conAddPage=$this->getCondiciones("nombre_pdf,tipo_pdf", "pdf", "nombre_pdf='$nombre_pdf_bd'", "id_pdf");
    	
    	if(!empty($conAddPage)){
    		$add_page="true";
    		$total_espacio=$this->extraerEspacio($origen, $add_page);
    	}else {
    		$total_espacio=$this->extraerEspacio($origen, $add_page);
    	}
    	
    	
    	$comando = 'start "" /b "' . $ruta_ejecutable . '" ' . $id_firma . ' ' . $origen . ' ' . $destino . ' '.$id_rol.
    				' '.$id_usuario.' '.$total_espacio.' '.$add_page.' ';
    
    	$comando_esc = escapeshellcmd ( $comando );
    
    	exec ( $comando_esc, $resultadoSalida, $ejecucion );
    
    	return $resultadoSalida;
    
    }
    
    public function MostrarNotificaciones($id_usuario)
    {
    	//session_start();
    	 /*
    	$notificaciones= new NotificacionesModel();
    	 
    	$columnas=" notificaciones.id_notificaciones,
			  notificaciones.descripcion_notificaciones,
			  notificaciones.usuario_destino_notificaciones,
			  notificaciones.usuario_origen_notificaciones,
			  notificaciones.numero_movimiento_notificaciones,
			  notificaciones.cantidad_cartones_notificaciones,
    		  notificaciones.creado,
    		  usuarios.id_usuarios,
			  usuarios.usuario_usuarios,
			  usuarios.nombre_usuarios,
			  notificaciones.visto_notificaciones,
			  tipo_notificacion.controlador_tipo_notificacion,
			  tipo_notificacion.accion_tipo_notificacion,
    		  tipo_notificacion.descripcion_notificacion";
    	 
    	$tablas=" public.notificaciones,
				  public.usuarios,
				  public.tipo_notificacion";
    	 
    	$where="notificaciones.usuario_origen_notificaciones = usuarios.id_usuarios AND
    	tipo_notificacion.id_tipo_notificacion = notificaciones.id_tipo_notificacion
    	AND  notificaciones.visto_notificaciones='FALSE'
    	AND notificaciones.usuario_destino_notificaciones='$id_usuario'";
    	 
    	$resultNotificaciones=$notificaciones->getCondiciones($columnas, $tablas, $where, "notificaciones.id_notificaciones");
    	 
    	$cantidad_notificaciones=count($resultNotificaciones);
    	 
    	 
    	if($cantidad_notificaciones<0)
    	{
    		$cantidad_notificaciones=0;
    		$resultNotificaciones=array();
    	}
    	
    	$contar=array();
    	$result=array();
    	 
    	foreach($resultNotificaciones as $linea=>$value)
    	{
    		
    		 
    		if(isset($contar[$value->descripcion_notificacion]))
    		{
    			 
    			$contar[$value->descripcion_notificacion]+=1;
    			
    			
    		}else{
    			 
    			array_push($result, $resultNotificaciones[$linea]);
    			 
    			$contar[$value->descripcion_notificacion]=1;
    			
    			
    		}
    		
    		
    		 
    	}
    	 
    	
    	$_SESSION['cantidad']=$cantidad_notificaciones;
    	$_SESSION["resultNotificaciones"]=$result;
    	$_SESSION["cantidad_fila_notificaciones"]=$contar;
    	*/
    }
    
    
    public  function CrearNotificacion($id_tipoNotificacion,$usuarioDestino,$descripcion,$numero_movimiento,$cantidad_cartones)
    {
    	$notificaciones = new NotificacionesModel();
    	 
    	$funcion = "ins_notificaciones";
    	 
    	$_usuario_origen=$_SESSION['id_usuarios'];
    	 
    
    	$parametros = "'$id_tipoNotificacion', '$_usuario_origen', '$usuarioDestino', '$descripcion','$numero_movimiento','$cantidad_cartones' ";
    	 
    	$notificaciones->setFuncion($funcion);
    	 
    	$notificaciones->setParametros($parametros);
    	 
    	$resultadoT=$notificaciones->Insert();
    }
    
    
    public function MenuDinamico($_id_rol)
    {
    	$resultPermisos=array();
    	$perimisos_rol = new PermisosRolesModel();
    	 
    	$columnas="controladores.nombre_controladores,
				  permisos_rol.id_rol,
				  permisos_rol.ver_permisos_rol";
    	 
    	$tablas="public.permisos_rol,
  				 public.controladores";
    	 
    	$where="controladores.id_controladores = permisos_rol.id_controladores
    	AND permisos_rol.ver_permisos_rol=TRUE AND permisos_rol.id_rol='$_id_rol'";
    	 
    	$id="controladores.id_controladores";
    	 
    	$resultPermisos = $perimisos_rol->getCondiciones($columnas, $tablas, $where, $id);
    	 
    	$_SESSION['controladores']=$resultPermisos;
    }
    
    //php PHPMailer class
    
    public  function  phpMailerSend()
    {
    	
    	require("PHPMailer/PHPMailerAutoload.php");
    	
    	$mail = new PHPMailer();
    	$mail->IsSMTP();
    	$mail->SMTPDebug = 2;
    	$mail->SMTPAuth = true;
    	$mail->SMTPSecure="ssl";
    	$mail->Host = "smtp.gmail.com";
    	$mail->Port = 465;
    	$mail->Username="hevy.craw@gmail.com";
    	$mail->Password="cr@w19\\";
    	$mail->From="hevy.craw@gmail.com";
    	$mail->FromName="Danny";
    	$mail->addReplyTo("hevy.craw@gmail.com","Danny");
    	$mail->Subject="Envío de email usando SMTP de Gmail";
    	//indico destinatario
    	$address = "steven@masoft.net";
    	$body = "Hola amigo
    	";
    	$body .= "probando PHPMailer.
   
    	";
    	$body .= "Saludos";
    	$mail->Body = $body;
    	$mail->AltBody = "Hola amigo\nprobando PHPMailer\n\nSaludos";
    	$mail->addAddress($address,"Steven");
    	$mail->addAttachment("core/conectar.php", "conectar.php");
    	$exito=$mail->send();
    	
    	die($exito);
    }
    
}
?>
