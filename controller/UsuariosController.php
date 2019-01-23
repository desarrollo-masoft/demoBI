<?php
class UsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    	 
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$usuarios = new UsuariosModel();
    	$where_to="";
    	$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
    		
    	$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
    		
    	$where    = " rol.id_rol = usuarios.id_rol AND
								  estado.id_estado = usuarios.id_estado AND usuarios.id_estado=1";
    		
    	$id       = "usuarios.id_usuarios";
    		
    	
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	
    	
    	
    	
    	if($action == 'ajax')
    	{
    		
    		if(!empty($search)){
    			 
    			 
    			$where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR rol.nombre_rol LIKE '".$search."%' OR estado.nombre_estado LIKE '".$search."%')";
    			 
    			$where_to=$where.$where1;
    		}else{
    		
    			$where_to=$where;
    			 
    		}
    		
    		$html="";
    		$resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    		
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    		
    		$per_page = 50; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    		
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    		
    		$resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    		
    			
    		
    		
    		
    	if($cantidadResult>0)
    	{
    
    		$html.='<div class="pull-left" style="margin-left:11px;">';
    		$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
    		$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
    		$html.='</div>';
    		$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
			$html.='<section style="height:425px; overflow-y:scroll;">';
    		$html.= "<table id='tabla_usuarios' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    		$html.= "<thead>";
    		$html.= "<tr>";
    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Teléfono</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Rol</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
    		
    		if($id_rol==1){
	    		
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
	    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
	    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
	    		
    		}else{
    			
    			
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		}
    		
    		$html.='</tr>';
    		$html.='</thead>';
    		$html.='<tbody>';
    		 
    		$i=0;
    		
    		
    		
    		foreach ($resultSet as $res)
    		{
    			$i++;
    			$html.='<tr>';
    			$html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" width="80" height="60"></td>';
    			$html.='<td style="font-size: 11px;">'.$i.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->telefono_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->celular_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->correo_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->nombre_rol.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->nombre_estado.'</td>';
    			
    			if($id_rol==1){
    			
    				$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=index&id_usuarios='.$res->id_usuarios.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    				$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=borrarId&id_usuarios='.$res->id_usuarios.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    				//$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=search&cedula='.$res->cedula_usuarios.'" target="_blank" class="btn btn-warning" style="font-size:65%;"><i class="glyphicon glyphicon-eye-open"></i></a></span></td>';
    			
    			
    			}else{
    			
    				//$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=search&cedula='.$res->cedula_usuarios.'" target="_blank" class="btn btn-warning" style="font-size:65%;"><i class="glyphicon glyphicon-eye-open"></i></a></span></td>';
    			
    			}
    			
    				$html.='</tr>';
    		}
    		
    		
    		$html.='</tbody>';
    		$html.='</table>';
    		$html.='</section></div>';
    		$html.='<div class="table-pagination pull-right">';
    		$html.=''. $this->paginate_usuarios_activos("index.php", $page, $total_pages, $adjacents).'';
    		$html.='</div>';
    		
    		
    		 
    	}else{
    		$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    		$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    		$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    		$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios activos registrados...</b>';
    		$html.='</div>';
    		$html.='</div>';
    	}
    	
    	
    	echo $html;
    	die();
    	 
    	} 
    	 
    	 
    }
    
    
    
       
    
    

    public function index11(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$usuarios = new UsuariosModel();
    	$where_to="";
    	$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
    
    	$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
    
    	$where    = " rol.id_rol = usuarios.id_rol AND
								  estado.id_estado = usuarios.id_estado AND usuarios.id_estado=2";
    
    	$id       = "usuarios.id_usuarios";
    
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    
    			$where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR rol.nombre_rol LIKE '".$search."%' OR estado.nombre_estado LIKE '".$search."%')";
    
    			$where_to=$where.$where1;
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 50; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    
    		 
    
    
    
    		if($cantidadResult>0)
    		{
    
    			$html.='<div class="pull-left" style="margin-left:11px;">';
    			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
    			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
    			$html.='</div>';
    			$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
    			$html.='<section style="height:425px; overflow-y:scroll;">';
    			$html.= "<table id='tabla_usuarios' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    			$html.= "<thead>";
    			$html.= "<tr>";
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Teléfono</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Rol</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
    
    			if($id_rol==1){
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				 
    			}else{
    				 
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			}
    
    			$html.='</tr>';
    			$html.='</thead>';
    			$html.='<tbody>';
    			 
    			$i=0;
    
    
    
    			foreach ($resultSet as $res)
    			{
    				$i++;
    				$html.='<tr>';
    				$html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" width="80" height="60"></td>';
    				$html.='<td style="font-size: 11px;">'.$i.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->telefono_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->celular_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->correo_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_rol.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_estado.'</td>';
    				 
    				if($id_rol==1){
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=index&id_usuarios='.$res->id_usuarios.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					 
    					 
    				}else{
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Usuarios&action=search&cedula='.$res->cedula_usuarios.'" target="_blank" class="btn btn-warning" style="font-size:65%;"><i class="glyphicon glyphicon-eye-open"></i></a></span></td>';
    					 
    				}
    				 
    				$html.='</tr>';
    			}
    
    
    			$html.='</tbody>';
    			$html.='</table>';
    			$html.='</section></div>';
    			$html.='<div class="table-pagination pull-right">';
    			$html.=''. $this->paginate_usuarios_inactivos("index.php", $page, $total_pages, $adjacents).'';
    			$html.='</div>';
    
    
    			 
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios inactivos registrados...</b>';
    			$html.='</div>';
    			$html.='</div>';
    		}
    		 
    		 
    		echo $html;
    		die();
    
    	}
    
    
    }
       

       
       
    public function cargar_global_usuarios(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$i=0;
    	$usuarios = new UsuariosModel();
    	$columnas = "usuarios.cedula_usuarios";
    	
    	$tablas   = "public.usuarios";
    	
    	$where    = " 1=1";
    	
    	$id       = "usuarios.id_usuarios";
    
    
    
    	$resultSet = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
    
    	$i=count($resultSet);
    
    	$html="";
    	if($i>0)
    	{
    
    		$html .= "<div class='col-lg-3 col-xs-12'>";
    		$html .= "<div class='small-box bg-green'>";
    		$html .= "<div class='inner'>";
    		$html .= "<h3>$i</h3>";
    		$html .= "<p>Usuarios Registrados.</p>";
    		$html .= "</div>";
    
    
    		$html .= "<div class='icon'>";
    		$html .= "<i class='ion ion-person-add'></i>";
    		$html .= "</div>";
    		
    	
    
    		
    		if($id_rol==1){
    		
    		$html .= "<a href='index.php?controller=Usuarios&action=index' class='small-box-footer'>Operaciones con usuarios <i class='fa fa-arrow-circle-right'></i></a>";
    				
    		}else{
    			$html .= "<a href='#' class='small-box-footer'>Operaciones con usuarios <i class='fa fa-arrow-circle-right'></i></a>";
    		
    		}
    

    		$html .= "</div>";
    		$html .= "</div>";
    		
    		
    	}else{
    		 
    		$html = "<b>Actualmente no hay usuarios registrados...</b>";
    	}
    
    	echo $html;
    	die();
    
    
    
    
    
    
    
    }
    
    
    
public function index(){
	
		session_start();
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
				//Creamos el objeto usuario
			$rol=new RolesModel();
			$resultRol = $rol->getAll("nombre_rol");
			$resultSet="";
			$estado = new EstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
			$usuarios = new UsuariosModel();

			$nombre_controladores = "Usuarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					
					$resultEdit = "";
			
					if (isset ($_GET["id_usuarios"])   )
					{
						
						
						$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
						
						$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
						
						$id       = "usuarios.id_usuarios";
						
						$_id_usuarios = $_GET["id_usuarios"];
						$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND usuarios.id_usuarios = '$_id_usuarios' "; 
						$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
					}
			
					
					$this->view("Usuarios",array(
							"resultSet"=>$resultSet, "resultRol"=>$resultRol, "resultEdit" =>$resultEdit, "resultEst"=>$resultEst
				
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Usuarios"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	public function llenar_fotografia_usuarios(){
	
		session_start();
		$resultado = null;
		$usuarios=new UsuariosModel();
	
	
		
		if ($_FILES['fotografia_usuarios']['tmp_name']!="")
		{
	
		$columnas = "usuarios.cedula_usuarios,
	   			     usuarios.pass_sistemas_usuarios";
			
		$tablas   = "public.usuarios";
			
		$where    = "1=1";
			
		$id       = "usuarios.id_usuarios";
			
		$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
	
		$directorio = $_SERVER['DOCUMENT_ROOT'].'/webcapremci/fotografias_usuarios/';
		 
		$nombre = $_FILES['fotografia_usuarios']['name'];
		$tipo = $_FILES['fotografia_usuarios']['type'];
		$tamano = $_FILES['fotografia_usuarios']['size'];
		 
		move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
		$data = file_get_contents($directorio.$nombre);
		$imagen_usuarios = pg_escape_bytea($data);
		 
		 
		
	
		if(!empty($resultSet)){
				
			foreach ($resultSet as $res){
	
				$cedula=$res->cedula_usuarios;
				
				$colval = "fotografia_usuarios='$imagen_usuarios'";
				$tabla = "usuarios";
				$where = "cedula_usuarios = '$cedula'";
				$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
	
	
			}
				
		}
		
		
		
		$this->redirect("Roles", "index");
		
	 }
	 
	 
	 $this->view("SubirFotosUsuarios",array(
	 		"resultSet"=>""
	 
	 ));
	 
	
	}
	
	
	
	
	public function encriptar_maycol_postgres(){
		
		session_start();
		$resultado = null;
		$usuarios=new UsuariosModel();
		
		
		
		$columnas = "usuarios.cedula_usuarios,
	   			     usuarios.pass_sistemas_usuarios";
			
		$tablas   = "public.usuarios";
			
		$where    = "1=1 AND usuarios.cedula_usuarios='1750402859'";
			
		$id       = "usuarios.id_usuarios";
			
		$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		
		if(!empty($resultSet)){
			
			foreach ($resultSet as $res){
				
				$cedula=$res->cedula_usuarios;
				$clave_usuarios = $usuarios->encriptar($res->pass_sistemas_usuarios);
				
				
				$colval = "cedula_usuarios= '$cedula', clave_usuarios='$clave_usuarios'";
				$tabla = "usuarios";
				$where = "cedula_usuarios = '$cedula'";
				$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
				
				
			}
			
		}
		
		$this->redirect("Roles", "index");
		
	}
	
	
	
	public function InsertaUsuarios(){
			
		session_start();
		$resultado = null;
		$usuarios=new UsuariosModel();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
	
		if (isset ($_POST["cedula_usuarios"]))
		{
			$_cedula_usuarios    = $_POST["cedula_usuarios"];
			$_nombre_usuarios     = $_POST["nombre_usuarios"];
			//$_usuario_usuario     = $_POST["usuario_usuario"];
			$_clave_usuarios      = $usuarios->encriptar($_POST["clave_usuarios"]);
			$_pass_sistemas_usuarios      = $_POST["clave_usuarios"];
			$_telefono_usuarios   = $_POST["telefono_usuarios"];
			$_celular_usuarios    = $_POST["celular_usuarios"];
			$_correo_usuarios     = $_POST["correo_usuarios"];
		    $_id_rol             = $_POST["id_rol"];
		    $_id_estado          = $_POST["id_estado"];
		    
		    $_id_usuarios          = $_POST["id_usuarios"];
		    
		    
		    if($_id_usuarios > 0){
		    	
		    	
		    	if ($_FILES['fotografia_usuarios']['tmp_name']!="")
		    	{
		    			
		    		$directorio = $_SERVER['DOCUMENT_ROOT'].'/aguafacturacion/fotografias_usuarios/';
		    			
		    		$nombre = $_FILES['fotografia_usuarios']['name'];
		    		$tipo = $_FILES['fotografia_usuarios']['type'];
		    		$tamano = $_FILES['fotografia_usuarios']['size'];
		    			
		    		move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
		    		$data = file_get_contents($directorio.$nombre);
		    		$imagen_usuarios = pg_escape_bytea($data);
		    			
		    			
		    		$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', id_rol = '$_id_rol', id_estado = '$_id_estado', fotografia_usuarios ='$imagen_usuarios'";
		    		$tabla = "usuarios";
		    		$where = "id_usuarios = '$_id_usuarios'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    			
		    	}
		    	else
		    	{
		    	
		    		$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', id_rol = '$_id_rol', id_estado = '$_id_estado'";
		    		$tabla = "usuarios";
		    		$where = "id_usuarios = '$_id_usuarios'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    	
		    	}
		    	
		    	
		    	
		    }else{
		    
		    	
		    	
		    	
		    if ($_FILES['fotografia_usuarios']['tmp_name']!="")
		    {
		    
		    	$directorio = $_SERVER['DOCUMENT_ROOT'].'/aguafacturacion/fotografias_usuarios/';
		    
		    	$nombre = $_FILES['fotografia_usuarios']['name'];
		    	$tipo = $_FILES['fotografia_usuarios']['type'];
		    	$tamano = $_FILES['fotografia_usuarios']['size'];
		    	
		    	move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
		    	$data = file_get_contents($directorio.$nombre);
		    	$imagen_usuarios = pg_escape_bytea($data);
		    
		    
		    	$funcion = "ins_usuarios";
		    	$parametros = "'$_cedula_usuarios',
		    				   '$_nombre_usuarios',
		    				   '$_clave_usuarios',
		    	               '$_pass_sistemas_usuarios',
		    	               '$_telefono_usuarios',
		    	               '$_celular_usuarios',
		    	               '$_correo_usuarios',
		    	               '$_id_rol',
		    	               '$_id_estado',
		    	               '$imagen_usuarios'";
		    	$usuarios->setFuncion($funcion);
		    	$usuarios->setParametros($parametros);
		    	$resultado=$usuarios->Insert();
		    
		    }
		    else
		    {
		    
		    	$where_TO = "cedula_usuarios = '$_cedula_usuarios'";
		    	$result=$usuarios->getBy($where_TO);
		    	 
		    	if ( !empty($result) )
		    	{
		    		 
		    		$colval = "nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', id_rol = '$_id_rol', id_estado = '$_id_estado'";
		    		$tabla = "usuarios";
		    		$where = "cedula_usuarios = '$_cedula_usuarios'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    	}
		        else{
		        	
		        	$imagen_usuarios="";
		        	
		        	$funcion = "ins_usuarios";
		        	$parametros = "'$_cedula_usuarios',
		        	'$_nombre_usuarios',
		        	'$_clave_usuarios',
		        	'$_pass_sistemas_usuarios',
		        	'$_telefono_usuarios',
		        	'$_celular_usuarios',
		        	'$_correo_usuarios',
		        	'$_id_rol',
		        	'$_id_estado',
		        	'$imagen_usuarios'";
		        	$usuarios->setFuncion($funcion);
		        	$usuarios->setParametros($parametros);
		        	$resultado=$usuarios->Insert();
		    	}
		    
		    }
		
		  	 	
		  }
		  
		   
		    $this->redirect("Usuarios", "index");
		}
		
	   }else{
	   	
	   	$error = TRUE;
	   	$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	   		
	   	$this->view("Login",array(
	   			"resultSet"=>"$mensaje", "error"=>$error
	   	));
	   		
	   		
	   	die();
	   	
	   }
	}
	
	
	


	public function AutocompleteCedula(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new UsuariosModel();
		$numero_cedula = $_GET['term'];
			
		$resultSet=$usuarios->getBy("cedula_usuarios LIKE '$numero_cedula%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_numero_cedula[] = $res->cedula_usuarios;
			}
			echo json_encode($_numero_cedula);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveNombres(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
			
		$usuarios = new UsuariosModel();
			
		$cedula_usuario = $_POST['cedula_usuarios'];
		$resultSet=$usuarios->getBy("cedula_usuarios = '$cedula_usuario'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->cedula_usuarios = $resultSet[0]->cedula_usuarios;
			$respuesta->nombre_usuarios = $resultSet[0]->nombre_usuarios;
			$respuesta->pass_sistemas_usuarios = $resultSet[0]->pass_sistemas_usuarios;
			$respuesta->telefono_usuarios = $resultSet[0]->telefono_usuarios;
			$respuesta->celular_usuarios = $resultSet[0]->celular_usuarios;
			$respuesta->correo_usuarios = $resultSet[0]->correo_usuarios;
			$respuesta->id_rol = $resultSet[0]->id_rol;
			$respuesta->id_estado = $resultSet[0]->id_estado;
				
			echo json_encode($respuesta);
		}
			
	}
	
	
	
	
	
	public function borrarId()
	{
		if(isset($_GET["id_usuarios"]))
		{
			$id_usuario=(int)$_GET["id_usuarios"];
	
			$usuarios=new UsuariosModel();
				
			$usuarios->UpdateBy("id_estado=2","usuarios","id_usuarios='$id_usuario'");
			
		}
	
		$this->redirect("Usuarios", "index");
	}
	
	
	
	
	
	
	public function resetear_clave_inicio()
	{
		session_start();
		$_usuario_usuario = "";
		$_clave_usuario = "";
		$usuarios = new UsuariosModel();
		$error = FALSE;
	
	
		$mensaje = "";
	
		if (isset($_POST['cedula_usuarios']))
		{
			$_cedula_usuarios = $_POST['cedula_usuarios'];
	
			$where = "cedula_usuarios = '$_cedula_usuarios'   ";
			$resultUsu = $usuarios->getBy($where);
				
			if(!empty($resultUsu))
			{
	
				foreach ($resultUsu as $res){
						
					$correo_usuario=$res->correo_usuarios;
					$id_estado=$res->id_estado;
					$nombre_usuario   = $res->nombre_usuarios;
				}
	
	
				$cadena = "1234567890";
				$longitudCadena=strlen($cadena);
				$pass = "";
				$longitudPass=4;
				for($i=1 ; $i<=$longitudPass ; $i++){
					$pos=rand(0,$longitudCadena-1);
					$pass .= substr($cadena,$pos,1);
				}
				$_clave_usuario= $pass;
				$_encryp_pass = $usuarios->encriptar($_clave_usuario);
					
			}
	
			if ($_clave_usuario == "")
			{
				$mensaje = "Este Usuario no existe resgistrado en nuestro sistema.";
	
				$error = TRUE;
	
	
			}
			else
			{
	
				
				if($id_estado==1){
				
				$usuarios->UpdateBy("clave_usuarios = '$_encryp_pass', pass_sistemas_usuarios='$_clave_usuario'", "usuarios", "cedula_usuarios = '$_cedula_usuarios'  ");
					
					
				$cabeceras = "MIME-Version: 1.0 \r\n";
				$cabeceras .= "Content-type: text/html; charset=utf-8 \r\n";
				$cabeceras.= "From: bryan6410@hotmail.com \r\n";
				$destino="$correo_usuario";
				$asunto="Claves de Acceso";
				$fecha=date("d/m/y");
				$hora=date("H:i:s");
	
	
				$resumen="
				<table rules='all'>
				<tr><td WIDTH='1000' HEIGHT='50'><center><img src='http://www.venceremos.com.ve/sites/default/files/logo-gota-a-gota-el-agua-se-agota_0.png' WIDTH='250' HEIGHT='190'/></center></td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b> RECUPERAR CLAVE </b></td></tr></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='justify'>Solicitaste recuperar tu clave de acceso al sistema.</td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF'><td WIDTH='1000' align='center'><b> TUS DATOS DE ACCESO SON: </b></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Usuario:</b> $_cedula_usuarios</td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Clave Temporal:</b> $_clave_usuario </td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background:#1C1C1C'><td WIDTH='1000' HEIGHT='50' align='center'><font color='white'> Copyright © 2018-</font></td></tr>
				</table>
				";
	
	
				if(mail("$destino","Claves de Acceso","$resumen","$cabeceras"))
				{
					$mensaje = "Te hemos enviado un correo electrónico a $correo_usuario con tus datos de acceso.";
						
	
				}else{
					$mensaje = "No se pudo enviar el correo con la informacion. Intentelo nuevamente.";
					$error = TRUE;
	
				}
			
				
				}else{
					
					
					$error = TRUE;
					$mensaje = "Hola $nombre_usuario tu usuario se encuentra inactivo.";
						
						
					$this->view("Login",array(
							"resultSet"=>"$mensaje", "error"=>$error
					));
						
						
					die();
					
				}
				
			}
			 
			$this->view("Login",array(
					"resultSet"=>"$mensaje", "error"=>$error
			));
			 
			 
			die();
			
		}else{
			
			$mensaje = "Ingresa tu cedula para recuperar tu clave.";
			$error = TRUE;
		}
	
	
	
		$this->view("ResetUsuariosInicio",array(
				"resultSet"=>$mensaje , "error"=>$error
		));
	
	}
	
	public function Inicio(){
	
		session_start();
		
		$this->view("Login",array(
				"allusers"=>""
		));
	}
    
    
    public function Login(){
    
    	session_destroy();
    	$usuarios=new UsuariosModel();
    
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	 
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Login",array(
    			"allusers"=>$allusers
    	));
    }
    public function Bienvenida(){
    
    	session_start();
    	
    	if(isset($_SESSION['id_usuarios']))
    	{
    		$_usuario=$_SESSION['nombre_usuarios'];
    		$_id_rol=$_SESSION['id_rol'];
    		
    		if($_id_rol==1){
    				
    		
    			$this->view("BienvenidaAdmin",array(
    					"allusers"=>$_usuario
    			));
    				
    			die();
    				
    		}else{
    				
    			$this->view("Bienvenida",array(
    					"allusers"=>$_usuario
    			));
    		
    			die();
    				
    		}
    		
    		 
    	}else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
    }
    
    
    
    
    public function Loguear(){
    	
    	$error=FALSE;
    	if (isset($_POST["usuario"]) && ($_POST["clave"] ) )
    	{
    	
    		
    		$usuarios=new UsuariosModel();
    		$_usuario = $_POST["usuario"];
    		//$_clave =   $usuarios->encriptar($_POST["clave"]);
    		$_clave =   $_POST["clave"];
    		
    		 
    		
    		$where = "cedula_usuarios = '$_usuario' AND  pass_sistemas_usuarios ='$_clave'";
    	
    		$result=$usuarios->getBy($where);

    		$usuario_usuario = "";
    		$id_rol  = "";
    		$nombre_usuario = "";
    		$correo_usuario = "";
    		$ip_usuario = "";
    		
    		if ( !empty($result) )
    		{ 
    			foreach($result as $res) 
    			{
    				$id_usuario  = $res->id_usuarios;
    			    $id_rol           = $res->id_rol;
	    			$nombre_usuario   = $res->nombre_usuarios;
	    			$correo_usuario   = $res->correo_usuarios;
	    			$id_estado        = $res->id_estado;
	    			$cedula_usuarios        = $res->cedula_usuarios;
	    			
    			}	
    			
    			if($id_estado==1){
    				
    				
    				//obtengo ip
    				$ip_usuario = $usuarios->getRealIP();
    				 
    				 
    				///registro sesion
    				$usuarios->registrarSesion($id_usuario, $id_rol, $nombre_usuario, $correo_usuario, $ip_usuario, $cedula_usuarios);
    				 
    				//inserto en la tabla
    				$_id_usuario = $_SESSION['id_usuarios'];
    				 
    				$sesiones = new SesionesModel();
    				
    				$funcion = "ins_sesiones";
    				 
    				$parametros = " '$_id_usuario' ,'$ip_usuario' ";
    				$sesiones->setFuncion($funcion);
    				
    				$_id_rol=$_SESSION['id_rol'];
    				$usuarios->MenuDinamico($_id_rol);
    				 
    				$sesiones->setParametros($parametros);
    				 
    				 
    				$resultado=$sesiones->Insert();
    				 
    				 
    				
    				if($_id_rol==1){
    					

    					$this->view("BienvenidaAdmin",array(
    							"allusers"=>$_usuario
    					));
    					
    					die();
    					
    				}else{
    					
    					$this->view("Bienvenida",array(
    							"allusers"=>$_usuario
    					));
    						
    					die();
    					
    				}
    				
    				
    			}else{
    				
    				
    				$error = TRUE;
    				$mensaje = "Hola $nombre_usuario tu usuario se encuentra inactivo.";
    				 
    				 
    				$this->view("Login",array(
    						"resultSet"=>"$mensaje", "error"=>$error
    				));
    				 
    				 
    				die();
    			}
    			
    			
    		}
    		else
    		{
    			$error = TRUE;
    			$mensaje = "Este Usuario no existe resgistrado en nuestro sistema.";
    			
    			
	    		$this->view("Login",array(
	    				"resultSet"=>"$mensaje", "error"=>$error
	    		));
	    		
	    		
	    		die();
    		}
    		
    	} 
    	else
    	{
    		    $error = TRUE;
    			$mensaje = "Ingrese su cedula y su clave.";
    			
    			
	    		$this->view("Login",array(
	    				"resultSet"=>"$mensaje", "error"=>$error
	    		));
	    		
	    		
	    		die();
    		
    	}
    	
    }

    
   
    
    
    public function  sesion_caducada()
    {
    	session_start();
    	session_destroy();
    
    	$error = TRUE;
	    $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	    	
	    $this->view("Login",array(
	    		"resultSet"=>"$mensaje", "error"=>$error
	    ));
	    	
	    die();
	    		
    
    }
    
    
	public function  cerrar_sesion ()
	{
		session_start();
		session_destroy();
		
		$error = TRUE;
		$mensaje = "Te has desconectado de nuestro sistema.";
		 
		 
		$this->view("Login",array(
				"resultSet"=>"$mensaje", "error"=>$error
		));
		 
		 
		die();
		
		
	}
	
	
	
	public function  actualizo_perfil ()
	{
		session_start();
		session_destroy();
	
		$error = FALSE;
		$mensaje = "Actualizaste tus datos, vuelve a iniciar sesión.";	
			
		$this->view("Login",array(
				"resultSet"=>"$mensaje", "error"=>$error
		));
			
			
		die();
	
	
	}
	
	
	public function Actualiza()
	{
		session_start();
		
		$rol=new RolesModel();
		$resultRol = $rol->getAll("nombre_rol");
			
		$estado = new EstadoModel();
		$resultEst = $estado->getAll("nombre_estado");
			
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			
			$usuarios = new UsuariosModel();
		
						
					
				$resultEdit = "";
					
				$_id_usuario = $_SESSION['id_usuarios'];
				
				$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
					
					
				$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
					
				$where    = " rol.id_rol = usuarios.id_rol AND
								  estado.id_estado = usuarios.id_estado AND usuarios.id_usuarios = '$_id_usuario'";
					
				$id       = "usuarios.id_usuarios";
				
				$resultEdit=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
				
				

				if ( isset($_POST["cedula_usuarios"]) )
				{
					
					$_cedula_usuarios    = $_POST["cedula_usuarios"];
					$_nombre_usuarios     = $_POST["nombre_usuarios"];
					//$_usuario_usuario     = $_POST["usuario_usuario"];
					$_clave_usuarios      = $usuarios->encriptar($_POST["clave_usuarios"]);
					$_pass_sistemas_usuarios      = $_POST["clave_usuarios"];
					$_telefono_usuarios   = $_POST["telefono_usuarios"];
					$_celular_usuarios    = $_POST["celular_usuarios"];
					$_correo_usuarios     = $_POST["correo_usuarios"];
					$_id_rol             = $_POST["id_rol"];
					$_id_estado          = $_POST["id_estado"];
					
					$_id_usuario = $_SESSION['id_usuarios'];
					
					if ($_FILES['fotografia_usuarios']['tmp_name']!="")
					{
					
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/aguafacturacion/fotografias_usuarios/';
					
						$nombre = $_FILES['fotografia_usuarios']['name'];
						$tipo = $_FILES['fotografia_usuarios']['type'];
						$tamano = $_FILES['fotografia_usuarios']['size'];
						 
						move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
						$data = file_get_contents($directorio.$nombre);
						$imagen_usuarios = pg_escape_bytea($data);
					
					
						    $colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', fotografia_usuarios ='$imagen_usuarios'";
							$tabla = "usuarios";
							$where = "id_usuarios = '$_id_usuario'";
							$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
					
					}
					else
					{
						
						$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios'";
						$tabla = "usuarios";
						$where = "id_usuarios = '$_id_usuario'";
						$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
						
					}
					
				
					
					
					
					
					$this->redirect("Usuarios", "actualizo_perfil");
					 
					 
				}
				else
				{
					$this->view("ActualizarUsuarios",array(
							"resultEdit" =>$resultEdit, "resultRol"=>$resultRol, "resultEst"=>$resultEst
								
					));
					
				}
				

		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	////// lo nuevo
	
	public function contar_roles(){
	
		session_start();
		$id_rol=$_SESSION["id_rol"];
		$i=0;
		$roles=new RolesModel();
		$columnas = " id_rol";
		$tablas   = "rol";
		$where    = "id_rol >0 ";
		$id       = "id_rol";
			
		$resultSet = $roles->getCondiciones($columnas ,$tablas ,$where, $id);
			
	
	
		$i=count($resultSet);
	
		$html="";
		if($i>0)
		{
		
			$html .= "<div class='col-lg-3 col-xs-12'>";
			
			$html .= "<div class='small-box bg-yellow'>";
			$html .= "<div class='inner'>";
			$html .= "<h3>$i</h3>";
			$html .= "<p>Roles Registrados.</p>";
			$html .= "</div>";
	
	
			$html .= "<div class='icon'>";
			$html .= "<i class='ion ion-calendar'></i>";
			$html .= "</div>";
			if($id_rol==1){
				
				$html .= "<a href='index.php?controller=Roles&action=index' class='small-box-footer'>Operaciones con Roles <i class='fa fa-arrow-circle-right'></i></a>";
					
			}else{
				$html .= "<a href='#' class='small-box-footer'>Operaciones con Roles <i class='fa fa-arrow-circle-right'></i></a>";
				
			}
			$html .= "</div>";
			
			
			$html .= "</div>";
			
	
		}else{
	
			$html = "<b>Actualmente no hay permisos registrados...</b>";
		}
	
		echo $html;
		die();
	
	
	}
	
	
	public function cargar_permisos_roles(){
	
		session_start();
		$id_rol=$_SESSION["id_rol"];
		$i=0;
		$permisos_rol = new PermisosRolesModel();
		$columnas = "permisos_rol.id_permisos_rol";
		$tablas   = "public.controladores,  public.permisos_rol, public.rol";
		$where    = " controladores.id_controladores = permisos_rol.id_controladores AND permisos_rol.id_rol = rol.id_rol";
		$id       = " permisos_rol.id_permisos_rol";
		$resultSet = $permisos_rol->getCondiciones($columnas ,$tablas ,$where, $id);
	
		$i=count($resultSet);
	
		$html="";
		if($i>0)
		{
	
			$html .= "<div class='col-lg-3 col-xs-12'>";
			$html .= "<div class='small-box bg-red'>";
			$html .= "<div class='inner'>";
			$html .= "<h3>$i</h3>";
			$html .= "<p>Permisos Registrados.</p>";
			$html .= "</div>";
	
	
			$html .= "<div class='icon'>";
			$html .= "<i class='ion ion-stats-bars'></i>";
			$html .= "</div>";
			if($id_rol==1){
				$html .= "<a href='index.php?controller=PermisosRoles&action=index' class='small-box-footer'>Operaciones con permisos <i class='fa fa-arrow-circle-right'></i></a>";
			}else{
				$html .= "<a href='#' class='small-box-footer'>Operaciones con permisos <i class='fa fa-arrow-circle-right'></i></a>";
			}
		
			$html .= "</div>";
			$html .= "</div>";
	
	
		}else{
	
			$html = "<b>Actualmente no hay permisos registrados...</b>";
		}
	
		echo $html;
		die();
	
	
	}
	

	
	
	public function cargar_sesiones(){
	
		session_start();
		$id_rol=$_SESSION["id_rol"];
		$i=0;
	    $usuarios = new UsuariosModel();
	    $columnas = "sesiones.id_sesiones";
	    $tablas   = "public.sesiones, public.usuarios";
	    $where    = "sesiones.id_usuarios = usuarios.id_usuarios";
	    $id       = "usuarios.nombre_usuarios";
	    $resultSet = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
		$i=count($resultSet);
	
		$html="";
		if($i>0)
		{
	
			$html .= "<div class='col-lg-3 col-xs-12'>";
			$html .= "<div class='small-box bg-aqua'>";
			$html .= "<div class='inner'>";
			$html .= "<h3>$i</h3>";
			$html .= "<p>Sesiones Registradas.</p>";
			$html .= "</div>";
	        $html .= "<div class='icon'>";
			$html .= "<i class='ion ion-stats-bars'></i>";
			$html .= "</div>";
			
			if($id_rol==1){
			$html .= "<a href='index.php?controller=Sesiones&action=index' class='small-box-footer'>Leer Mas<i class='fa fa-arrow-circle-right'></i></a>";
			}else{
				$html .= "<a href='#' class='small-box-footer'>Leer Mas<i class='fa fa-arrow-circle-right'></i></a>";
			}
			$html .= "</div>";
			$html .= "</div>";
	
	
		}else{
	
			$html = "<b>Actualmente no hay sesiones registrados...</b>";
		}
	
		echo $html;
		die();
	
	
	}
	
	
	
	
	
	
	
	public function cargar_banner(){
		
		session_start();
		$publicidad_movil = new PublicidadMovilModel();
		$columnas = "id_publicidad_movil";
		$tablas   = "publicidad_movil";
		$where    = "1=1";
		$id       = "id_publicidad_movil";
		$resultSet = $publicidad_movil->getCondiciones($columnas ,$tablas ,$where, $id);
		/*
		$html="";
		
		$html .= "<div class='container'>";
		
		$html .= "<section id='miSlide' class='carousel slide'>";
		$html .= "<ol class='carousel-indicators'>";
		$html .= "<li data-target='#miSlide' data-slide-to='0' class='active'></li>";
		$html .= "<li data-target='#miSlide' data-slide-to='1'></li>";
		$html .= "<li data-target='#miSlide' data-slide-to='2'></li>";
		$html .= "</ol>";
		
		$html .= "<div class='carousel-inner'>";
		$html .= "<div class='item active'>";
		$html .= "<img src='view/pro/img/img1.jpg' class='adaptar'>";
		$html .= "</div>";
		$html .= "<div class='item'>";
		$html .= "<img src='view/pro/img/img2.jpg' class='adaptar'>";
		$html .= "</div>";
		$html .= "<div class='item'>";
		$html .= "<img src='view/pro/img/img3.jpg' class='adaptar'>";
		$html .= "</div>";
		$html .= "</div>";
		
		$html .= "<a href='#miSlide' class='left carousel-control' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a>";
		$html .= "<a href='#miSlide' class='right carousel-control' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a>";
		$html .= "</section>";
		
		 
		$html .= "</div>";
		
		
		echo $html;
		die();
		
		
		*/
	
		$i=count($resultSet);
		
		$html="";
		if($i>0)
		{
		
		
			$html .= "<div  class='col-xs-12 col-md-12 col-lg-12'>";
			$html .= "<div class='col-xs-12 col-md-4 col-lg-4'>";
			$html .= "</div>";
			$html .= "<div class='col-xs-12 col-md-3 col-lg-3'>";
			$html .= "<div id='miSlide' class='carousel slide'>";
			$html .= "<ol class='carousel-indicators'>";
			$html .= "<li data-target='#miSlide' data-slide-to='0' class='active'></li>";
			$html .= "<li data-target='#miSlide' data-slide-to='1' ></li>";
			$html .= "</ol>";
			
			$html .= "<div class='carousel-inner'>";
			
			
			if(!empty($resultSet)){
				
				$numero=0;
				foreach ($resultSet as $res){
					
					$numero++;
					
					if($numero==1){
						
						
						$html .= "<div class='item active'>";
						$html .= '<img src="view/DevuelveImagenView.php?id_valor='.$res->id_publicidad_movil.'&id_nombre=id_publicidad_movil&tabla=publicidad_movil&campo=imagen_baner" style="width:100%; height:100%; ">';
						$html .= "</div>";
						
					}else{
						
						
						
						$html .= "<div class='item'>";
						$html .= '<img src="view/DevuelveImagenView.php?id_valor='.$res->id_publicidad_movil.'&id_nombre=id_publicidad_movil&tabla=publicidad_movil&campo=imagen_baner" style="width:100%; height:100%;">';
						$html .= "</div>";
						
					}
					
					
				}
				
				
			}
			
			
			
			$html .= "<a class='left carousel-control' href='#miSlide' data-slide='prev'>";
			$html .= "<span class='glyphicon glyphicon-chevron-left'></span>";
			
			$html .= "</a>";
			$html .= "<a class='right carousel-control' href='#miSlide' data-slide='next'>";
			$html .= "<span class='glyphicon glyphicon-chevron-right'></span>";
		
			$html .= "</a>";
			$html .= "</div>";
			$html .= "</div>";
			$html .= "</div>";
			$html .= "<div class='col-xs-12 col-md-4 col-lg-4'>";
			$html .= "</div>";
			$html .= "</div>";
			
			
		
		
		}else{
		
			$html = "<b>Actualmente no hay publicidad registrada...</b>";
		}
		
		echo $html;
		die();
		
		
	}
	
	
	
	
	
	
	
	
	public function paginate_usuarios_activos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_activos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_activos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_activos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	
	public function paginate_usuarios_inactivos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_inactivos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	
	
	
	
	
	

	
	
	
	///////////////////////////////////////////////// informacion de participes ///////
	
	
	
	public function alerta_actualizacion(){
	
		session_start();
		$i=0;
		$usuarios = new UsuariosModel();
	
		
	
		$cedula_usuarios = $_SESSION["cedula_usuarios"];
	
		if(!empty($cedula_usuarios)){
			
			$columnas = "usuarios.id_usuarios, usuarios.cedula_usuarios, usuarios.nombre_usuarios, usuarios.correo_usuarios";
			 
			$tablas   = "public.usuarios";
			 
			$where    = " 1=1 AND usuarios.cedula_usuarios='$cedula_usuarios'";
			 
			$id       = "usuarios.id_usuarios";
			
			
			
			$resultSet = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
			$i=count($resultSet);
				
			$html="";
			if($i>0)
			{
				if (!empty($resultSet)) {
					$_id_usuarios=$resultSet[0]->id_usuarios;
					$_cedula_usuarios=$resultSet[0]->cedula_usuarios;
					$_nombre_usuarios=$resultSet[0]->nombre_usuarios;
					$_correo_usuarios=$resultSet[0]->correo_usuarios;
					
						
				}
	

				$html .= "<div class='col-md-4 col-sm-6 col-xs-12'>";
				$html .= "<div class='info-box'>";
				$html .= "<span class='info-box-icon bg-aqua'><img src='view/DevuelveImagenView.php?id_valor=$_id_usuarios&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios' width='80' height='80'></span>";
				$html .= "<div class='info-box-content'>";
				$html .= "<span class='info-box-text'>Hola <strong>$_nombre_usuarios</strong><br> ayudanos actualizando tu información<br> personal.</span>";
				$html .= "</div>";
				$html .= "</div>";
				$html .= "</div>";
	
	
			}else{
	

				$html .= "<div class='col-md-4 col-sm-6 col-xs-12'>";
				$html .= "<div class='info-box'>";
				$html .= "<span class='info-box-icon bg-aqua'><i class='ion ion-person-add'></i></span>";
				$html .= "<div class='info-box-content'>";
				$html .= "<span class='info-box-text'>Debes iniciar sesión.</span>";
				$html .= "</div>";
				$html .= "</div>";
				$html .= "</div>";
					
			}
	
			echo $html;
			die();
	
		}
		else{
	
	
	
			$this->redirect("Usuarios","sesion_caducada");
	
			die();
	
		}
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	////////////////////////////////////////REPORTES /////////////////////////////////////////////////////////////
	
	
	
	
	public function generar_reporte()
	{
	
		session_start();
		$ordinario_detalle = new Ordinario_DetalleModel();
		$ordinario_solicitud = new Ordinario_SolicitudModel();
		$emergente_solicitud = new Emergente_SolicitudModel();
		$emergente_detalle = new Emergente_DetalleModel();
		$c2x1_solicitud = new C2x1_solicitudModel();
		$c2x1_detalle = new C2x1_detalleModel();
		$app_solicitud = new app_solicitudModel();
		$app_detalle = new app_detalleModel();
		$hipotecario_solicitud = new Hipotecario_SolicitudModel();
		$hipotecario_detalle = new Hipotecario_DetalleModel();
		$afiliado_transacc_cta_ind = new Afiliado_transacc_cta_indModel();
		$afiliado_transacc_cta_desemb = new Afiliado_transacc_cta_desembModel();
		$usuarios= new UsuariosModel();
	
		$refinanciamiento_solicitud = new Refinanciamiento_SolicitudModel();
		$refinanciamiento_detalle = new Refinanciamiento_DetalleModel();
	
		$html="";
	
	
	
		$cedula_usuarios = $_SESSION["cedula_participe"];
		$fechaactual = getdate();
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fechaactual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
		 
		$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/webcapremci';
		$dom=$directorio.'/view/dompdf/dompdf_config.inc.php';
		$domLogo=$directorio.'/view/images/lcaprem.png';
		$logo = '<img src="'.$domLogo.'" alt="Responsive image" width="200" height="50">';
		 
	
	
		if(!empty($cedula_usuarios)){
				
	
			if(isset($_GET["credito"])){
	
				$credito=$_GET["credito"];
	
	
				if($credito=="ordinario"){
						
						
					$columnas_ordi_cabec ="*";
					$tablas_ordi_cabec="ordinario_solicitud";
					$where_ordi_cabec="cedula='$cedula_usuarios'";
					$id_ordi_cabec="cedula";
					$resultCredOrdi_Cabec=$ordinario_solicitud->getCondicionesDesc($columnas_ordi_cabec, $tablas_ordi_cabec, $where_ordi_cabec, $id_ordi_cabec);
	
						
	
					if(!empty($resultCredOrdi_Cabec)){
							
						$_numsol_ordinario=$resultCredOrdi_Cabec[0]->numsol;
						$_cuota_ordinario=$resultCredOrdi_Cabec[0]->cuota;
						$_interes_ordinario=$resultCredOrdi_Cabec[0]->interes;
						$_tipo_ordinario=$resultCredOrdi_Cabec[0]->tipo;
						$_plazo_ordinario=$resultCredOrdi_Cabec[0]->plazo;
						$_fcred_ordinario=$resultCredOrdi_Cabec[0]->fcred;
						$_ffin_ordinario=$resultCredOrdi_Cabec[0]->ffin;
						$_cuenta_ordinario=$resultCredOrdi_Cabec[0]->cuenta;
						$_banco_ordinario=$resultCredOrdi_Cabec[0]->banco;
						$_valor_ordinario= number_format($resultCredOrdi_Cabec[0]->valor, 2, '.', ',');
						$_cedula_ordinario=$resultCredOrdi_Cabec[0]->cedula;
						$_nombres_ordinario=$resultCredOrdi_Cabec[0]->nombres;
							
						if($_numsol_ordinario != ""){
	
							$columnas_ordi_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_ordi_detall="ordinario_detalle";
							$where_ordi_detall="numsol='$_numsol_ordinario'";
							$id_ordi_detall="pago";
							$resultSet=$ordinario_detalle->getCondiciones($columnas_ordi_detall, $tablas_ordi_detall, $where_ordi_detall, $id_ordi_detall);
	
								
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO ORDINARIO</b></p>';
	
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_ordinario.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_ordinario.'</p>';
	
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_ordinario.'</td>';
							$html.='</tr>';
	
	
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_ordinario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_ordinario.'</td>';
							$html.='</tr>';
								
							$html.='</table>';
	
	
	
	
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
								
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
	
							$html.='</tbody>';
							$html.='</table>';
	
						}
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
						
				}elseif ($credito=="emergente"){
						
						
					$columnas_emer_cabec ="*";
					$tablas_emer_cabec="emergente_solicitud";
					$where_emer_cabec="cedula='$cedula_usuarios'";
					$id_emer_cabec="cedula";
					$resultCredEmer_Cabec=$emergente_solicitud->getCondicionesDesc($columnas_emer_cabec, $tablas_emer_cabec, $where_emer_cabec, $id_emer_cabec);
						
						
						
	
						
					if(!empty($resultCredEmer_Cabec)){
							
						$_numsol_emergente=$resultCredEmer_Cabec[0]->numsol;
						$_cuota_emergente=$resultCredEmer_Cabec[0]->cuota;
						$_interes_emergente=$resultCredEmer_Cabec[0]->interes;
						$_tipo_emergente=$resultCredEmer_Cabec[0]->tipo;
						$_plazo_emergente=$resultCredEmer_Cabec[0]->plazo;
						$_fcred_emergente=$resultCredEmer_Cabec[0]->fcred;
						$_ffin_emergente=$resultCredEmer_Cabec[0]->ffin;
						$_cuenta_emergente=$resultCredEmer_Cabec[0]->cuenta;
						$_banco_emergente=$resultCredEmer_Cabec[0]->banco;
						$_valor_emergente= number_format($resultCredEmer_Cabec[0]->valor, 2, '.', ',');
						$_cedula_emergente=$resultCredEmer_Cabec[0]->cedula;
						$_nombres_emergente=$resultCredEmer_Cabec[0]->nombres;
							
						if($_numsol_emergente != ""){
								
							$columnas_emer_detall ="numsol,
										CAST(pago as int),
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
	
							$tablas_emer_detall="emergente_detalle";
							$where_emer_detall="numsol='$_numsol_emergente'";
							$id_emer_detall="pago";
								
							$resultSet=$emergente_detalle->getCondiciones($columnas_emer_detall, $tablas_emer_detall, $where_emer_detall, $id_emer_detall);
								
	
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO EMERGENTE</b></p>';
								
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_emergente.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_emergente.'</p>';
								
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_emergente.'</td>';
							$html.='</tr>';
								
								
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_emergente.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_emergente.'</td>';
							$html.='</tr>';
	
							$html.='</table>';
								
								
								
								
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
	
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
								
							$html.='</tbody>';
							$html.='</table>';
								
						}
							
					}
						
	
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
				}elseif ($credito=="2_x_1"){
						
	
					$columnas_2_x_1_cabec ="*";
					$tablas_2_x_1_cabec="c2x1_solicitud";
					$where_2_x_1_cabec="cedula='$cedula_usuarios'";
					$id_2_x_1_cabec="cedula";
					$resultCred2_x_1_Cabec=$c2x1_solicitud->getCondicionesDesc($columnas_2_x_1_cabec, $tablas_2_x_1_cabec, $where_2_x_1_cabec, $id_2_x_1_cabec);
	
						
	
					if(!empty($resultCred2_x_1_Cabec)){
							
						$_numsol_2x1=$resultCred2_x_1_Cabec[0]->numsol;
						$_cuota_2x1=$resultCred2_x_1_Cabec[0]->cuota;
						$_interes_2x1=$resultCred2_x_1_Cabec[0]->interes;
						$_tipo_2x1=$resultCred2_x_1_Cabec[0]->tipo;
						$_plazo_2x1=$resultCred2_x_1_Cabec[0]->plazo;
						$_fcred_2x1=$resultCred2_x_1_Cabec[0]->fcred;
						$_ffin_2x1=$resultCred2_x_1_Cabec[0]->ffin;
						$_cuenta_2x1=$resultCred2_x_1_Cabec[0]->cuenta;
						$_banco_2x1=$resultCred2_x_1_Cabec[0]->banco;
						$_valor_2x1= number_format($resultCred2_x_1_Cabec[0]->valor, 2, '.', ',');
						$_cedula_2x1=$resultCred2_x_1_Cabec[0]->cedula;
						$_nombres_2x1=$resultCred2_x_1_Cabec[0]->nombres;
							
						if($_numsol_2x1 != ""){
	
	
							$columnas_2_x_1_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
							$tablas_2_x_1_detall="c2x1_detalle";
							$where_2_x_1_detall="numsol='$_numsol_2x1'";
							$id_2_x_1_detall="pago";
							$resultSet=$c2x1_detalle->getCondiciones($columnas_2_x_1_detall, $tablas_2_x_1_detall, $where_2_x_1_detall, $id_2_x_1_detall);
	
								
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO 2 X 1</b></p>';
	
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_2x1.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_2x1.'</p>';
	
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_2x1.'</td>';
							$html.='</tr>';
	
	
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_2x1.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_2x1.'</td>';
							$html.='</tr>';
								
							$html.='</table>';
	
	
	
	
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
								
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
	
							$html.='</tbody>';
							$html.='</table>';
	
						}
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
	
	
	
						
						
						
						
				}elseif ($credito=="acuerdo_pago"){
						
						
					$columnas_app_cabec ="*";
					$tablas_app_cabec="app_solicitud";
					$where_app_cabec="cedula='$cedula_usuarios'";
					$id_app_cabec="cedula";
					$resultCredApp_Cabec=$app_solicitud->getCondicionesDesc($columnas_app_cabec, $tablas_app_cabec, $where_app_cabec, $id_app_cabec);
	
	
	
						
					if(!empty($resultCredApp_Cabec)){
							
						$_numsol_app=$resultCredApp_Cabec[0]->numsol;
						$_cuota_app=$resultCredApp_Cabec[0]->cuota;
						$_interes_app=$resultCredApp_Cabec[0]->interes;
						$_tipo_app=$resultCredApp_Cabec[0]->tipo;
						$_plazo_app=$resultCredApp_Cabec[0]->plazo;
						$_fcred_app=$resultCredApp_Cabec[0]->fcred;
						$_ffin_app=$resultCredApp_Cabec[0]->ffin;
						$_cuenta_app=$resultCredApp_Cabec[0]->cuenta;
						$_banco_app=$resultCredApp_Cabec[0]->banco;
						$_valor_app= number_format($resultCredApp_Cabec[0]->valor, 2, '.', ',');
						$_cedula_app=$resultCredApp_Cabec[0]->cedula;
						$_nombres_app=$resultCredApp_Cabec[0]->nombres;
							
						if($_numsol_app != ""){
								
								
							$columnas_app_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_app_detall="app_detalle";
							$where_app_detall="numsol='$_numsol_app'";
							$id_app_detall="pago";
							$resultSet=$app_detalle->getCondiciones($columnas_app_detall, $tablas_app_detall, $where_app_detall, $id_app_detall);
								
	
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE ACUERDO DE PAGO</b></p>';
								
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_app.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_app.'</p>';
								
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_app.'</td>';
							$html.='</tr>';
								
								
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_app.'</td>';
							$html.='</tr>';
	
							$html.='</table>';
								
								
								
								
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
	
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
								
							$html.='</tbody>';
							$html.='</table>';
								
						}
							
					}
						
	
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
	
						
						
						
						
						
				}elseif ($credito=="hipotecario"){
						
						
	
					$columnas_hipo_cabec ="*";
					$tablas_hipo_cabec="hipotecario_solicitud";
					$where_hipo_cabec="cedula='$cedula_usuarios'";
					$id_hipo_cabec="cedula";
					$resultCredHipo_Cabec=$hipotecario_solicitud->getCondicionesDesc($columnas_hipo_cabec, $tablas_hipo_cabec, $where_hipo_cabec, $id_hipo_cabec);
						
						
						
	
					if(!empty($resultCredHipo_Cabec)){
							
						$_numsol_hipotecario=$resultCredHipo_Cabec[0]->numsol;
						$_cuota_hipotecario=$resultCredHipo_Cabec[0]->cuota;
						$_interes_hipotecario=$resultCredHipo_Cabec[0]->interes;
						$_tipo_hipotecario=$resultCredHipo_Cabec[0]->tipo;
						$_plazo_hipotecario=$resultCredHipo_Cabec[0]->plazo;
						$_fcred_hipotecario=$resultCredHipo_Cabec[0]->fcred;
						$_ffin_hipotecario=$resultCredHipo_Cabec[0]->ffin;
						$_cuenta_hipotecario=$resultCredHipo_Cabec[0]->cuenta;
						$_banco_hipotecario=$resultCredHipo_Cabec[0]->banco;
						$_valor_hipotecario= number_format($resultCredHipo_Cabec[0]->valor, 2, '.', ',');
						$_cedula_hipotecario=$resultCredHipo_Cabec[0]->cedula;
						$_nombres_hipotecario=$resultCredHipo_Cabec[0]->nombres;
							
						if($_numsol_hipotecario != ""){
	
	
							$columnas_hipo_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_hipo_detall="hipotecario_detalle";
							$where_hipo_detall="numsol='$_numsol_hipotecario'";
							$id_hipo_detall="pago";
							$resultSet=$hipotecario_detalle->getCondiciones($columnas_hipo_detall, $tablas_hipo_detall, $where_hipo_detall, $id_hipo_detall);
	
								
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO HIPOTECARIO</b></p>';
	
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_hipotecario.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_hipotecario.'</p>';
	
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_hipotecario.'</td>';
							$html.='</tr>';
	
	
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_hipotecario.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_hipotecario.'</td>';
							$html.='</tr>';
								
							$html.='</table>';
	
	
	
	
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
								
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
	
							$html.='</tbody>';
							$html.='</table>';
	
						}
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
						
						
				}elseif ($credito=="cta_individual"){
						
						
	
					$columnas_ind="afiliado_transacc_cta_ind.id_afiliado_transacc_cta_ind,
							  afiliado_transacc_cta_ind.ordtran,
							  afiliado_transacc_cta_ind.histo_transacsys,
							  afiliado_transacc_cta_ind.cedula,
							  afiliado_transacc_cta_ind.fecha_conta,
							  afiliado_transacc_cta_ind.descripcion,
							  afiliado_transacc_cta_ind.mes_anio,
							  afiliado_transacc_cta_ind.valorper,
							  afiliado_transacc_cta_ind.valorpat,
							  afiliado_transacc_cta_ind.saldoper,
							  afiliado_transacc_cta_ind.saldopat,
							  afiliado_transacc_cta_ind.id_afiliado";
					$tablas_ind="public.afiliado_transacc_cta_ind";
					$where_ind="1=1 AND afiliado_transacc_cta_ind.cedula='$cedula_usuarios'";
					$id_ind="afiliado_transacc_cta_ind.secuencial_saldos";
					$resultSet=$afiliado_transacc_cta_ind->getCondicionesDesc($columnas_ind, $tablas_ind, $where_ind, $id_ind);
						
						
						
	
					if(!empty($resultSet)){
	
	
						$result_par=$usuarios->getBy("cedula_usuarios='$cedula_usuarios'");
	
						if(!empty($result_par)){
							$_cedula_usuarios=$result_par[0]->cedula_usuarios;
							$_nombre_usuarios=$result_par[0]->nombre_usuarios;
								
						}else{
								
							$_cedula_usuarios="";
							$_nombre_usuarios="";
						}
	
	
						$columnas_ind_mayor = "sum(valorper+valorpat) as total, max(fecha_conta) as fecha";
						$tablas_ind_mayor="afiliado_transacc_cta_ind";
						$where_ind_mayor="cedula='$cedula_usuarios'";
						$resultDatosMayor_Cta_individual=$afiliado_transacc_cta_ind->getCondicionesValorMayor($columnas_ind_mayor, $tablas_ind_mayor, $where_ind_mayor);
							
						if (!empty($resultDatosMayor_Cta_individual)) {  foreach($resultDatosMayor_Cta_individual as $res) {
	
							$fecha=$res->fecha;
							$total= number_format($res->total, 2, '.', ',');
						}}else{
	
							$fecha="";
							$total= 0.00;
	
						}
	
	
						$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
						$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
						$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CUENTA INDIVIDUAL</b></p>';
						$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombre_usuarios.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_usuarios.'</p>';
						$html.='<center style="margin-top:5px;"><h4><b>Total Cuenta Individual Actualizada al</b> '.$fecha.' : $'.$total.'</h4></center>';
						$html.= "<table style='margin-top:5px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
						$html.= "<thead>";
						$html.= "<tr style='background-color: #D5D8DC;'>";
							
						$html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Descripción</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Mes/A&ntilde;o</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Patronal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Patronal</th>';
							
						$html.='</tr>';
						$html.='</thead>';
						$html.='<tbody>';
	
						$i=0;
						foreach ($resultSet as $res)
						{
							$i++;
							$html.='<tr>';
							$html.='<td style="font-size: 11px;">'.$res->fecha_conta.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->descripcion.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->mes_anio.'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorpat, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldoper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldopat, 2, '.', ',').'</td>';
							$html.='</tr>';
						}
	
						$html.='</tbody>';
						$html.='</table>';
	
	
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
						
				}elseif ($credito=="cta_desembolsar"){
						
						
	
					$columnas_desemb="afiliado_transacc_cta_desemb.id_afiliado_transacc_cta_desemb,
						  	afiliado_transacc_cta_desemb.ordtran,
						  	afiliado_transacc_cta_desemb.histo_transacsys,
						  	afiliado_transacc_cta_desemb.cedula,
						  	afiliado_transacc_cta_desemb.fecha_conta,
						  	afiliado_transacc_cta_desemb.descripcion,
						  	afiliado_transacc_cta_desemb.mes_anio,
						  	afiliado_transacc_cta_desemb.valorper,
						 	afiliado_transacc_cta_desemb.valorpat,
						  	afiliado_transacc_cta_desemb.saldoper,
						 	afiliado_transacc_cta_desemb.saldopat,
						    afiliado_transacc_cta_desemb.id_afiliado";
					$tablas_desemb="public.afiliado_transacc_cta_desemb";
					$where_desemb="1=1 AND afiliado_transacc_cta_desemb.cedula='$cedula_usuarios'";
					$id_desemb="afiliado_transacc_cta_desemb.secuencial_saldos";
					$resultSet=$afiliado_transacc_cta_ind->getCondicionesDesc($columnas_desemb, $tablas_desemb, $where_desemb, $id_desemb);
						
						
						
	
					if(!empty($resultSet)){
	
	
						$result_par=$usuarios->getBy("cedula_usuarios='$cedula_usuarios'");
	
						if(!empty($result_par)){
							$_cedula_usuarios=$result_par[0]->cedula_usuarios;
							$_nombre_usuarios=$result_par[0]->nombre_usuarios;
								
						}else{
								
							$_cedula_usuarios="";
							$_nombre_usuarios="";
						}
	
	
						$columnas_desemb_mayor = "sum(valorper+valorpat) as total, max(fecha_conta) as fecha";
						$tablas_desemb_mayor="afiliado_transacc_cta_desemb";
						$where_desemb_mayor="cedula='$cedula_usuarios'";
						$resultDatosMayor_Cta_desembolsar=$afiliado_transacc_cta_ind->getCondicionesValorMayor($columnas_desemb_mayor, $tablas_desemb_mayor, $where_desemb_mayor);
							
						if (!empty($resultDatosMayor_Cta_desembolsar)) {  foreach($resultDatosMayor_Cta_desembolsar as $res) {
	
							$fecha=$res->fecha;
							$total= number_format($res->total, 2, '.', ',');
						}}else{
	
							$fecha="";
							$total= 0.00;
	
						}
	
	
						$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
						$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
						$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CUENTA DESEMBOLSAR</b></p>';
						$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombre_usuarios.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_usuarios.'</p>';
						$html.='<center style="margin-top:5px;"><h4><b>Total Cuenta Individual Actualizada al</b> '.$fecha.' : $'.$total.'</h4></center>';
						$html.= "<table style='margin-top:5px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
						$html.= "<thead>";
						$html.= "<tr style='background-color: #D5D8DC;'>";
							
						$html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Descripción</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Mes/A&ntilde;o</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Valor Patronal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Personal</th>';
						$html.='<th style="text-align: left;  font-size: 12px;">Saldo Patronal</th>';
							
						$html.='</tr>';
						$html.='</thead>';
						$html.='<tbody>';
	
						$i=0;
						foreach ($resultSet as $res)
						{
							$i++;
							$html.='<tr>';
							$html.='<td style="font-size: 11px;">'.$res->fecha_conta.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->descripcion.'</td>';
							$html.='<td style="font-size: 11px;">'.$res->mes_anio.'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->valorpat, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldoper, 2, '.', ',').'</td>';
							$html.='<td style="font-size: 11px;">'.number_format($res->saldopat, 2, '.', ',').'</td>';
							$html.='</tr>';
						}
	
						$html.='</tbody>';
						$html.='</table>';
	
	
							
					}
	
						
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
	
	
	
				}elseif ($credito=="refinanciamiento"){
						
						
						
					$columnas_refi_cabec ="*";
					$tablas_refi_cabec="refinanciamiento_solicitud";
					$where_refi_cabec="cedula='$cedula_usuarios'";
					$id_refi_cabec="cedula";
					$resultCredRefi_Cabec=$refinanciamiento_solicitud->getCondicionesDesc($columnas_refi_cabec, $tablas_refi_cabec, $where_refi_cabec, $id_refi_cabec);
						
						
						
	
						
					if(!empty($resultCredRefi_Cabec)){
							
						$_numsol_app=$resultCredRefi_Cabec[0]->numsol;
						$_cuota_app=$resultCredRefi_Cabec[0]->cuota;
						$_interes_app=$resultCredRefi_Cabec[0]->interes;
						$_tipo_app=$resultCredRefi_Cabec[0]->tipo;
						$_plazo_app=$resultCredRefi_Cabec[0]->plazo;
						$_fcred_app=$resultCredRefi_Cabec[0]->fcred;
						$_ffin_app=$resultCredRefi_Cabec[0]->ffin;
						$_cuenta_app=$resultCredRefi_Cabec[0]->cuenta;
						$_banco_app=$resultCredRefi_Cabec[0]->banco;
						$_valor_app= number_format($resultCredRefi_Cabec[0]->valor, 2, '.', ',');
						$_cedula_app=$resultCredRefi_Cabec[0]->cedula;
						$_nombres_app=$resultCredRefi_Cabec[0]->nombres;
							
						if($_numsol_app != ""){
								
								
							$columnas_app_detall ="numsol,
										pago,
										mes,
										ano,
										fecpag,ROUND(capital,2) as capital,
										ROUND(interes,2) as interes,
										ROUND(intmor,2) as intmor,
										ROUND(seguros,2) as seguros,
										ROUND(total,2) as total,
										ROUND(saldo,2) as saldo,
										estado";
								
							$tablas_app_detall="refinanciamiento_detalle";
							$where_app_detall="numsol='$_numsol_app'";
							$id_app_detall="pago";
							$resultSet=$refinanciamiento_detalle->getCondiciones($columnas_app_detall, $tablas_app_detall, $where_app_detall, $id_app_detall);
	
							$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
							$html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
							$html.='<p style="text-align: center; font-size: 16px;"><b>DETALLE CRÉDITO DE REFINANCIAMIENTO</b></p>';
								
							$html.= '<p style="margin-top:15px; text-align: justify; font-size: 13px;"><b>NOMBRES:</b> '.$_nombres_app.'  <b style="margin-left: 20%; font-size: 13px;">IDENTIFICACIÓN:</b> '.$_cedula_app.'</p>';
								
							$html.= "<table style='width: 100%;' border=1 cellspacing=0 >";
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">No de Solicitud:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Monto Concedido:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuota:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Interes:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Tipo:</th>';
							$html.='</tr>';
								
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_numsol_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_valor_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuota_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_interes_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_tipo_app.'</td>';
							$html.='</tr>';
								
								
							$html.= '<tr style="background-color: #D5D8DC;">';
							$html.='<th style="text-align: left;  font-size: 13px;">PLazo:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Concedido en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Termina en:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Cuenta No:</th>';
							$html.='<th style="text-align: left;  font-size: 13px;">Banco:</th>';
							$html.='</tr>';
	
							$html.= "<tr>";
							$html.='<td style="font-size: 13px;">'.$_plazo_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_fcred_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_ffin_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_cuenta_app.'</td>';
							$html.='<td style="font-size: 13px;">'.$_banco_app.'</td>';
							$html.='</tr>';
	
							$html.='</table>';
								
								
								
								
							$html.= "<table style='margin-top:20px; width: 100%;' border=1 cellspacing=0 cellpadding=2>";
							$html.= "<thead>";
							$html.= "<tr style='background-color: #D5D8DC;'>";
	
							$html.='<th style="text-align: left;  font-size: 12px;">Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Mes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">A&ntilde;o</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Fecha Pago</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Capital</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Interes por Mora</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Seguro Desgr.</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Total</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Saldo</th>';
							$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							$i=0;
							foreach ($resultSet as $res)
							{
								$i++;
								$html.='<tr>';
								$html.='<td style="font-size: 12px;">'.$res->pago.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->mes.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->ano.'</td>';
								$html.='<td style="font-size: 12px;">'.$res->fecpag.'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->capital, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->interes, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->intmor, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->seguros, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->total, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.number_format($res->saldo, 2, '.', ',').'</td>';
								$html.='<td style="font-size: 12px;">'.$res->estado.'</td>';
								$html.='</tr>';
							}
								
							$html.='</tbody>';
							$html.='</table>';
								
						}
							
					}
						
	
					$this->report("Creditos",array( "resultSet"=>$html));
					die();
						
						
						
	
						
						
						
						
						
				}
	
	
	
			}else{
	
				$this->redirect("Usuarios","sesion_caducada");
	
			}
				
	
		}else{
	
			$this->redirect("Usuarios","sesion_caducada");
	
		}
	
	}
	
	
	
	
	
	
	
	
	
}
?>
