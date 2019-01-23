<?php
class ProductosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$productos = new ProductosModel();
    	$where_to="";
    	$columnas = "productos.id_productos, 
                      productos.nombre_productos, 
                      productos.valor_productos, 
                      tipo_productos.id_tipo_productos, 
                      tipo_productos.nombre_tipo_productos, 
                      productos.imagen_productos, 
                      usuarios.id_usuarios, 
                      usuarios.cedula_usuarios, 
                      usuarios.nombre_usuarios, 
                      productos.creado, 
                      productos.modificado,
                                  estado.id_estado,
                                  estado.nombre_estado";
    	
    	$tablas   = "public.productos, 
                  public.tipo_productos, 
                  public.usuarios,
                                  public.estado";
    	
    	$id       = "productos.id_productos";
    	
    	
    	$where    = "productos.id_estado = estado.id_estado AND productos.id_usuarios_registra = usuarios.id_usuarios AND
                    tipo_productos.id_tipo_productos = productos.id_tipo_productos AND estado.id_estado=1";
    	
    
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    
    			$where1=" AND (productos.nombre_productos LIKE '".$search."%' OR tipo_productos.nombre_tipo_productos LIKE '".$search."%')";
    
    			$where_to=$where.$where1;
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$productos->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 50; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$productos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
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
    			$html.= "<table id='tabla_productos' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    			$html.= "<thead>";
    			$html.= "<tr>";
    			
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Tipo Producto</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Nombre Producto</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Valor Producto</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Registro</th>';
    		
    			if($id_rol==1){
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				
    				 
    			}else{
    				 
    				 
    				
    			}
    
    			$html.='</tr>';
    			$html.='</thead>';
    			$html.='<tbody>';
    			 
    			$i=0;
    
    
    
    			foreach ($resultSet as $res)
    			{
    				$i++;
    				$html.='<tr>';
    				$html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_productos.'&id_nombre=id_productos&tabla=productos&campo=imagen_productos" width="80" height="60"></td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_tipo_productos.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->valor_productos.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
    				 
    				if($id_rol==1){
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=index&id_productos='.$res->id_productos.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=borrarId&id_productos='.$res->id_productos.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    					 
    					 
    				}else{
    					 
    					 
    				}
    				 
    				$html.='</tr>';
    			}
    
    
    			$html.='</tbody>';
    			$html.='</table>';
    			$html.='</section></div>';
    			$html.='<div class="table-pagination pull-right">';
    			$html.=''. $this->paginate_productos_activos("index.php", $page, $total_pages, $adjacents).'';
    			$html.='</div>';
    
    
    			 
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay productos registrados...</b>';
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
        $productos = new ProductosModel();
        $where_to="";
        $columnas = "productos.id_productos,
                      productos.nombre_productos,
                      productos.valor_productos,
                      tipo_productos.id_tipo_productos,
                      tipo_productos.nombre_tipo_productos,
                      productos.imagen_productos,
                      usuarios.id_usuarios,
                      usuarios.cedula_usuarios,
                      usuarios.nombre_usuarios,
                      productos.creado,
                      productos.modificado,
                                  estado.id_estado,
                                  estado.nombre_estado";
        
        $tablas   = "public.productos,
                  public.tipo_productos,
                  public.usuarios,
                                  public.estado";
        
        $id       = "productos.id_productos";
        
        
        $where    = "productos.id_estado = estado.id_estado AND productos.id_usuarios_registra = usuarios.id_usuarios AND
                    tipo_productos.id_tipo_productos = productos.id_tipo_productos AND estado.id_estado=2";
        
        
        
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        
        
        
        if($action == 'ajax')
        {
            
            if(!empty($search)){
                
                
                $where1=" AND (productos.nombre_productos LIKE '".$search."%' OR tipo_productos.nombre_tipo_productos LIKE '".$search."%')";
                
                $where_to=$where.$where1;
            }else{
                
                $where_to=$where;
                
            }
            
            $html="";
            $resultSet=$productos->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 50; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$productos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
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
                $html.= "<table id='tabla_productos_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
                $html.= "<thead>";
                $html.= "<tr>";
                
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Tipo Producto</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Nombre Producto</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Valor Producto</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Fecha Registro</th>';
                
                if($id_rol==1){
                    
                    $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                  
                    
                    
                }else{
                    
                    
                    
                }
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                $i=0;
                
                
                
                foreach ($resultSet as $res)
                {
                    $i++;
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_productos.'&id_nombre=id_productos&tabla=productos&campo=imagen_productos" width="80" height="60"></td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_tipo_productos.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->valor_productos.'</td>';
                    $html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
                    
                    if($id_rol==1){
                        
                        $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=index&id_productos='.$res->id_productos.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
                        
                        
                    }else{
                        
                        
                    }
                    
                    $html.='</tr>';
                }
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate_productos_inactivos("index.php", $page, $total_pages, $adjacents).'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay productos registrados...</b>';
                $html.='</div>';
                $html.='</div>';
            }
            
            
            echo $html;
            die();
            
        }
        
        
    }
    
    
  
    
		public function index(){
	
		session_start();
		if (isset(  $_SESSION['id_usuarios']) )
		{
		
			
			$tipo_productos = new TipoProductosModel();
			$resultProd = $tipo_productos->getAll("nombre_tipo_productos");
			
			$estado = new EstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
			
			$productos = new ProductosModel();
			
			$nombre_controladores = "Productos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $productos->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				

				$resultEdit="";
				
				if (isset ($_GET["id_productos"]))
				{
						
						
					$_id_productos = $_GET["id_productos"];
					$columnas = " productos.id_productos, 
                                  productos.nombre_productos, 
                                  productos.valor_productos, 
                                  tipo_productos.id_tipo_productos, 
                                  tipo_productos.nombre_tipo_productos, 
                                  productos.imagen_productos, 
                                  usuarios.id_usuarios, 
                                  usuarios.cedula_usuarios, 
                                  usuarios.nombre_usuarios, 
                                  productos.creado, 
                                  productos.modificado,
                                  estado.id_estado,
                                  estado.nombre_estado";
					$tablas   = "public.productos, 
                                  public.tipo_productos, 
                                  public.usuarios,
                                  public.estado";
					$where    = "productos.id_estado = estado.id_estado AND productos.id_usuarios_registra = usuarios.id_usuarios AND
                                 tipo_productos.id_tipo_productos = productos.id_tipo_productos AND id_productos = '$_id_productos' ";
					$id       = "nombre_productos";
						
					$resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						
						
				}
					
				
					
					$this->view("Productos",array(
					    "resultProd" =>$resultProd, "resultEdit" =>$resultEdit, "resultEst"=>$resultEst
					
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Productos"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaProductos(){


		session_start();
		$resultado = null;
		$productos=new ProductosModel();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
		
			if (isset ($_POST["nombre_productos"]))
			{
				$_id_tipo_productos    = $_POST["id_tipo_productos"];
				$_nombre_productos    = $_POST["nombre_productos"];
				$_valor_productos     = $_POST["valor_productos"];
				
				$_id_productos     = $_POST["id_productos"];
				$_id_usuarios_registra = $_SESSION ["id_usuarios"];
				$_id_estado     = $_POST["id_estado"];
				
				if($_id_productos > 0){
				  
				  
					if ($_FILES['imagen_productos']['tmp_name']!="")
					{
				   
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/cevicheria/fotografias_usuarios/';
				   
						$nombre = $_FILES['imagen_productos']['name'];
						$tipo = $_FILES['imagen_productos']['type'];
						$tamano = $_FILES['imagen_productos']['size'];
				   
						move_uploaded_file($_FILES['imagen_productos']['tmp_name'],$directorio.$nombre);
						$data = file_get_contents($directorio.$nombre);
						$imagen_productos = pg_escape_bytea($data);
				   
				   
						$colval = "id_tipo_productos= '$_id_tipo_productos', nombre_productos = '$_nombre_productos',  valor_productos = '$_valor_productos', imagen_productos='$imagen_productos', id_estado='$_id_estado'";
						$tabla = "productos";
						$where = "id_productos = '$_id_productos'";
						$resultado=$productos->UpdateBy($colval, $tabla, $where);
				   
					}
					else
					{
						 
						$colval = "id_tipo_productos= '$_id_tipo_productos', nombre_productos = '$_nombre_productos',  valor_productos = '$_valor_productos', id_estado='$_id_estado'";
						$tabla = "productos";
						$where = "id_productos = '$_id_productos'";
							
						$resultado=$productos->UpdateBy($colval, $tabla, $where);
						 
					}
				  
				  
				  
				}else{
		
				  
				  
				  
					if ($_FILES['imagen_productos']['tmp_name']!="")
					{
		
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/cevicheria/fotografias_usuarios/';
		
						$nombre = $_FILES['imagen_productos']['name'];
						$tipo = $_FILES['imagen_productos']['type'];
						$tamano = $_FILES['imagen_productos']['size'];
						 
						move_uploaded_file($_FILES['imagen_productos']['tmp_name'],$directorio.$nombre);
						$data = file_get_contents($directorio.$nombre);
						$imagen_productos = pg_escape_bytea($data);
		
		
						$funcion = "ins_productos";
						$parametros = "'$_nombre_productos',
						'$_valor_productos',
						'$_id_tipo_productos',
						'$imagen_productos',
						'$_id_usuarios_registra',
                        '$_id_estado'";
						$productos->setFuncion($funcion);
						$productos->setParametros($parametros);
						$resultado=$productos->Insert();
		
					}
					else
					{
		
						$where_TO = "nombre_productos = '$_nombre_productos'";
						$result=$productos->getBy($where_TO);
		
						if ( !empty($result) )
						{
							 
							$colval = "id_tipo_productos= '$_id_tipo_productos', nombre_productos = '$_nombre_productos',  valor_productos = '$_valor_productos', id_estado='$_id_estado'";
							$tabla = "productos";
							$where = "nombre_productos = '$_nombre_productos'";
							
							$resultado=$productos->UpdateBy($colval, $tabla, $where);
						}
						else{
				    
							$imagen_productos="";
				    
							$funcion = "ins_productos";
							$parametros = "'$_nombre_productos',
							'$_valor_productos',
						'$_id_tipo_productos',
						'$imagen_productos',
						'$_id_usuarios_registra',
                        '$_id_estado'";
						
							$productos->setFuncion($funcion);
							$productos->setParametros($parametros);
							$resultado=$productos->Insert();
						}
		
					}
		
				  
				}
		
				 
				$this->redirect("Productos", "index");
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
	
	
	


	
	
	
	
	
	public function borrarId()
	{
		if(isset($_GET["id_productos"]))
		{
			$id_productos=(int)$_GET["id_productos"];
			$productos= new ProductosModel();
			
			
			$productos->UpdateBy("id_estado=2","productos","id_productos='$id_productos'");
			
		}
	
		$this->redirect("Productos", "index");
	}
	
	
	
	
	public function paginate_productos_activos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_productos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_productos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_productos(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_productos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_productos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_productos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_productos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	

	
	public function paginate_productos_inactivos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_inactivos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	
	
	
	

	
	
	
	

	
	
	
	
	
	
	
}
?>
