<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>ResetUsuarios - Template 2018</title>

	
		
		<link rel="stylesheet" href="view/css/estilos.css">
		

		    <!-- Bootstrap -->
    		<link href="view/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    		<!-- Font Awesome -->
		    <link href="view/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		    <!-- NProgress -->
		    <link href="view/vendors/nprogress/nprogress.css" rel="stylesheet">
		    <!-- iCheck -->
		    <link href="view/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
			
		    <!-- bootstrap-progressbar -->
		    <link href="view/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
		    <!-- JQVMap -->
		    <link href="view/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
		    <!-- bootstrap-daterangepicker -->
		    <link href="view/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		
		    <!-- Custom Theme Style -->
		    <link href="view/build/css/custom.min.css" rel="stylesheet">
				
			
			<!-- Datatables -->
		    <link href="view/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		    <link href="view/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		    <link href="view/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		    <link href="view/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
		    <link href="view/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
					

			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        
        
        <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula_usuarios = $("#cedula_usuarios").val();
		    	
		    	
		    	if (cedula_usuarios == "")
		    	{
			    	
		    		$("#mensaje_cedula_usuarios").text("Introduzca Cedula");
		    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	
		    					    

			}); 


		        $( "#cedula_usuarios" ).focus(function() {
				  $("#mensaje_cedula_usuarios").fadeOut("slow");
			    });
				
			
				    
		}); 

	</script>
        
        
        
        
			        
    </head>
    
    
    <body class="nav-md"  >
    
      <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    
       
    
    
    
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  menu_fixed">
          <div class="left_col scroll-view">
            <?php include("view/modulos/logo.php"); ?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php include("view/modulos/menu_profile.php"); ?>
            <!-- /menu profile quick info -->

            <br />
			<?php include("view/modulos/menu.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php include("view/modulos/head.php"); ?>	
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main">        
            
    <div class="container">
        <section class="content-header">
         <h1>
         <small><?php echo $fecha; ?></small>
         </h1>
         </section>
  	
  	
  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reset<small>Clave Usuario</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


            <form  action="<?php echo $helper->url("Usuarios","resetear_clave"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                               
                               
                    	<?php if ($resultSet == "") {?>
								
						  		<!--   <div class="alert alert-warning" role="alert">Introduzca su número de identificación registrada en el sistema.</div>-->
								
					        <?php    } ?>
                              <?php if (isset($resultSet)) {?>
							<?php if ($resultSet != "") {?>
						
								 <?php if ($error == TRUE) {?>
								    <div class="row">
								    <div class="col-lg-6 col-md-6 col-xs-12">
								 	<div class="alert alert-danger" role="alert"><?php echo $resultSet; ?></div>
								 	</div>
								 	</div>
								 <?php } else {?>
								    <div class="row">		
								    <div class="col-lg-6 col-md-6 col-xs-12">	
								    <div class="alert alert-success" role="alert"><?php echo $resultSet; ?></div>
								    </div>
								    </div>
								 <?php sleep(5); ?>
				     
				     			 <?php }?>
							
					        <?php } ?>
					        <?php } ?>  
                    		   
									                    		   
                    		   
                    		 <div class="row">
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="cedula_usuarios" class="control-label">Cedula</label>
                                                      <input type="number" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value=""  placeholder="cedula..">
                                                      <div id="mensaje_cedula_usuarios" class="errores"></div>
                                </div>
                                </div>
                    		   </div>
                    			   	
                    			<div class="row">
                    		    <div class="col-xs-12 col-md-3 col-lg-3" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Restablecer</button>
                                                      <button type="submit" id="Cancelar" name="Cancelar" class="btn btn-danger">Cancelar</button>
                               
                                </div>
                    		    </div>
                    		    </div>
                    	
              		</form>
  
                  </div>
                </div>
              </div>
		
      </div>
    </div>

</div>
        <!-- jQuery -->
    <script src="view/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="view/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="view/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="view/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="view/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="view/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="view/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="view/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="view/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="view/vendors/jszip/dist/jszip.min.js"></script>
    <script src="view/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="view/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	
	<!-- codigo de las funciones -->
	<script src="view/js/funciones.js"></script> 
	
  </body>
</html>   