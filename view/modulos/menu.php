
<?php 


$controladores=(isset($_SESSION['controladores']))?$_SESSION['controladores']: array();
 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }
 

?>








<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>"  ><a    ><i class="fa fa-users"></i> Administración <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li style="<?php echo getcontrolador("Usuarios",$controladores) ?>"><a href="index.php?controller=Usuarios&action=index">Usuarios</a></li>
                      <li style="<?php echo getcontrolador("Controladores",$controladores) ?>"><a href="index.php?controller=Controladores&action=index">Controladores</a></li>
                      <li style="<?php echo getcontrolador("Roles",$controladores) ?>"><a href="index.php?controller=Roles&action=index">Roles de Usuario</a></li>
                      <li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>"><a href="index.php?controller=PermisosRoles&action=index">Permisos Roles</a></li>
                    </ul>
                    
                  </li>

                  
                  
                  <!--   <li  style="<?php echo getcontrolador("MenuMantenimiento",$controladores) ?>"  ><a    ><i class="fa fa-users"></i> Mantenimiento <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                      <li style="<?php echo getcontrolador("Clientes",$controladores) ?>"><a href="index.php?controller=Clientes&action=index">Clientes</a></li>
                      <li style="<?php echo getcontrolador("Ingredientes",$controladores) ?>"><a href="index.php?controller=Ingredientes&action=index">Ingredientes</a></li>
                      <li style="<?php echo getcontrolador("Productos",$controladores) ?>"><a href="index.php?controller=Productos&action=index">Productos</a></li>
                   </ul>
                  </li>-->
                  
                
                  <li style="<?php echo getcontrolador("MenuProcesos",$controladores) ?>"  ><a    ><i class="fa fa-users"></i> Procesos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li style="<?php echo getcontrolador("Pedidos",$controladores) ?>"><a href="index.php?controller=Procesos&action=index">Datos</a></li>
                       <li style="<?php echo getcontrolador("Pedidos",$controladores) ?>"><a href="index.php?controller=Procesos&action=indexpdf">GenerarPdf</a></li>
                       <li style="<?php echo getcontrolador("ProcesosExportacion",$controladores) ?>"><a href="index.php?controller=ProcesosExportacion&action=index">Procesos Exportacion</a></li>
                       <li style="<?php echo getcontrolador("ProcesosErrores",$controladores) ?>"><a href="index.php?controller=ProcesosErrores&action=index">Errores</a></li>
                       </ul>
                  </li>
                
                
                 <!-- <li style="<?php echo getcontrolador("MenuReportes",$controladores) ?>"  ><a    ><i class="fa fa-users"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li style="<?php echo getcontrolador("Sesiones",$controladores) ?>"><a href="index.php?controller=Sesiones&action=index">Sesiones</a></li>
                       <li style="<?php echo getcontrolador("Actividades",$controladores) ?>"><a href="index.php?controller=Actividades&action=index">Actividades</a></li>
                   </ul>
                  </li>
                  
                  <li style="<?php echo getcontrolador("MenuMesero",$controladores) ?>"  ><a    ><i class="fa fa-bars"></i> Mesero <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li style="<?php echo getcontrolador("Pedidos",$controladores) ?>"><a href="index.php?controller=Pedidos&action=index">Pedidos</a></li>
                     <li style="<?php echo getcontrolador("Clientes",$controladores) ?>"><a href="index.php?controller=Clientes&action=index">Clientes</a></li>
                      </ul>
                  </li>
                  
                  
                   <li  style="<?php echo getcontrolador("MenuCajero",$controladores) ?>"  ><a    ><i class="fa fa-bars"></i> Cajero <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li style="<?php echo getcontrolador("Factura",$controladores) ?>"><a href="index.php?controller=Factura&action=index">Facturar</a></li>
                     <li style="<?php echo getcontrolador("Clientes",$controladores) ?>"><a href="index.php?controller=Clientes&action=index">Clientes</a></li>
                      </ul>
                  </li>
                  
                   <li  style="<?php echo getcontrolador("MenuCocinero",$controladores) ?>"  ><a    ><i class="fa fa-bars"></i> Cocinero <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li style="<?php echo getcontrolador("ConsultaPedidos",$controladores) ?>"><a href="index.php?controller=ConsultaPedidos&action=index">Consulta Pedidos</a></li>
                     <li style="<?php echo getcontrolador("Clientes",$controladores) ?>"><a href="index.php?controller=Clientes&action=index">Clientes</a></li>
                      </ul>
                  </li>-->
                  
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
              
              <a data-toggle="tooltip" data-placement="top" title="Salir" href="index.php?controller=Usuarios&action=Loguear">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
