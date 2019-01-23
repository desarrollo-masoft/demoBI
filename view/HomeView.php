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
        <div class="col-md-3 left_col menu_fixed">
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
            <div id='pone_cta_individual'></div>
            <div id='pone_cta_desembolsar'></div>
            <div id='pone_alerta_actualizacion'></div>
          </div>
          
           <div class="row tile_count">
            <div id='pone_credito_ordinario'></div>
            <div id='pone_credito_emergente'></div>
            <div id='pone_credito_2x1'></div>
           </div>
          
           <div class="row tile_count">
            <div id='pone_credito_hipotecario'></div>
            <div id='pone_acuerdo_pago'></div>
            <div id='pone_credito_refinanciamiento'></div>
	       </div>
	       
	       
	      <div class="row tile_count">
          <div id='pone_publicidad'></div> 
          </div>
          
        </div>
          <!-- /top tiles -->


          <br />

	
                <!-- End to do list -->

                <!-- end of weather widget -->
              
            
          </div>
          
          
          
           <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>BIENVENIDO A CAPREMCI</h3>
           </div>
           <div class="modal-body">
             <img src="view/images/educacion2017.jpg" class="img-rounded" alt="Cinque Terre" style="max-width:100%"/>   
          </div>
           <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
	      </div>
	     </div>
	   </div>
          
          
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
       
    
   
    
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
	
	<!-- codigo de las funciones -->
	
	<script src="view/js/jquery.blockUI.js"></script>
	
	
	
	
	
	 <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		   $("#mostrarmodal").modal("show");
        		   pone_cta_individual();
        		   pone_cta_desembolsar();
        		   pone_alerta_actualizacion();
        		   pone_credito_ordinario();
        		   pone_credito_emergente();
        		   pone_credito_2x1();
        		   pone_credito_hipotecario();
        		   pone_acuerdo_pago();
        		   pone_credito_refinanciamiento();	
        		   cargar_banner();
        		    
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
            	
		        setTimeout($.unblockUI, 1500); 
		        
        	   }
        	   
        	   function pone_cta_individual(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_cta_individual").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_cta_individual',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_cta_individual").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_cta_individual").html("Ocurrio un error al cargar la informacion de cuenta individual..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function pone_cta_desembolsar(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_cta_desembolsar").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_cta_desembolsar',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_cta_desembolsar").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_cta_desembolsar").html("Ocurrio un error al cargar la cuenta desembolsar..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function pone_alerta_actualizacion(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_alerta_actualizacion").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=alerta_actualizacion',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_alerta_actualizacion").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_alerta_actualizacion").html("Ocurrio un error al cargar la alerta de actuaización..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   

        	   

        	   
        	   function pone_credito_ordinario(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_credito_ordinario").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_credito_ordinario',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_credito_ordinario").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_credito_ordinario").html("Ocurrio un error al cargar la informacion de crédito ordinario..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function pone_credito_emergente(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_credito_emergente").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_credito_emergente',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_credito_emergente").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_credito_emergente").html("Ocurrio un error al cargar la informacion de crédito emergente..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }



        	   function pone_credito_2x1(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_credito_2x1").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_credito_2x1',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_credito_2x1").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_credito_2x1").html("Ocurrio un error al cargar la informacion de crédito 2x1..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }





        	   function pone_credito_hipotecario(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_credito_hipotecario").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_credito_hipotecario',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_credito_hipotecario").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_credito_hipotecario").html("Ocurrio un error al cargar la informacion de crédito hipotecario..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }


        	   function pone_acuerdo_pago(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_acuerdo_pago").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_acuerdo_pago',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_acuerdo_pago").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_acuerdo_pago").html("Ocurrio un error al cargar la informacion de acuerdo de pago..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   


        	   function pone_credito_refinanciamiento(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_credito_refinanciamiento").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_credito_refinanciamiento',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_credito_refinanciamiento").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_credito_refinanciamiento").html("Ocurrio un error al cargar la informacion de crédito refinanciamiento..."+estado+"    "+error);
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
