<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Capremci</title>
   <?php include("view/modulos/links.php"); ?>
   
		
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/vendors/table-sorter/themes/blue/style.css">
	
	
	
		    <!-- Bootstrap -->
    		<link href="view/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    		<!-- Font Awesome -->
		    <link href="view/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		    <!-- NProgress -->
		    <link href="view/vendors/nprogress/nprogress.css" rel="stylesheet">
		    
		   
		    <!-- Custom Theme Style -->
		    <link href="view/build/css/custom.min.css" rel="stylesheet">
				
			
			<!-- Datatables -->
		    <link href="view/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		    
		   	
		   	
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script type="text/javascript" src="view/vendors/table-sorter/jquery.tablesorter.js"></script> 
    
    
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
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
          <!-- top tiles -->
          <div class="row tile_count">
            <div id='pone_users'></div>
            <div id='pone_roles'></div>
            <div id='pone_permisos'></div>
            <div id='pone_sesiones'></div>
          </div>
          
          <div class="row tile_count">
            <div id='pone_consulta_documentos'></div>
			 <div id='pone_afiliaciones_recomendadas'></div>
			  <div id='pone_encuestas_realizadas'></div>
          </div>
          
          
         
          <div class="row tile_count">
          <div id='pone_publicidad'></div> 
          </div>
         </div>
         
            
          </div>
          
           
           
       
          
        </div>
   
 
   
    
    <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
   
   
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    
    
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    
    
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	<script src="view/js/jquery.blockUI.js"></script>
	<!-- codigo de las funciones -->
	
	 <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		   $("#mostrarmodal").modal("show");
        		   pone_users();
        		   pone_roles();
        		   pone_permisos_roles();
        		   cargar_sesiones();
        		  
	   			});


        	   function pone_espera(){

        		   $.blockUI({ 
        				message: '<h4><img src="view/images/load.gif" /> Espere por favor, estamos procesando su requerimiento...</h4>',
        				css: { 
        		            border: 'none', 
        		            padding: '15px', 
        		            backgroundColor: '#000', 
        		            '-webkit-border-radius': '10px', 
        		            '-moz-border-radius': '10px', 
        		            opacity: .5, 
        		            color: '#fff',
        		           
        	        		}
        	    });
            	
		        setTimeout($.unblockUI, 1000); 
		        
        	   }
        	   
        	   function pone_users(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_users").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_global_usuarios',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_users").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_users").html("Ocurrio un error al cargar la informacion de usuarios..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function pone_roles(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_roles").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=contar_roles',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_roles").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_roles").html("Ocurrio un error al cargar la informacion de roles..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function pone_permisos_roles(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_permisos").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_permisos_roles',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_permisos").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_permisos").html("Ocurrio un error al cargar la informacion de permisos..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function cargar_sesiones(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_sesiones").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_sesiones',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_sesiones").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_sesiones").html("Ocurrio un error al cargar la informacion de sesiones..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }



 			
        	   function cargar_banner(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_publicidad").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_banner',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_publicidad").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_publicidad").html("Ocurrio un error al cargar la informacion de publicidad..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }



        	 
        	   
        </script>
	
  </body>
</html>
