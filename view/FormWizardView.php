<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Procesos</title>


        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
		    
		    <!-- Formwizard  -->
		    <link href="view/css/formwizard/styleformwizard.css" rel="stylesheet">
		   		

			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
        	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script type="text/javascript" src="view/vendors/table-sorter/jquery.tablesorter.js"></script> 
       		 <script src="view/js/jquery.blockUI.js"></script>
            <script src="view/js/jquery.inputmask.bundle.js"></script>
            
            <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
			<script>
			    //webshims.activeLang("en");
			    webshims.setOptions('forms-ext', { datepicker: { dateFormat: 'yy/mm/dd' } });
				webshims.polyfill('forms forms-ext');
			</script>
			
			
			     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
                 
                 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                 
                 <!-- Custom form wizard-->
                <script src="view/js/formwizard/jquery.steps.js"></script>
            	<script src="view/js/formwizard/main.js"></script>
                 
                 
                 
        
        
        
        
<script type="text/javascript">

	   $(document).ready( function (){
		   pone_espera();
		  
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
    	
        setTimeout($.unblockUI, 500); 
        
	   }

</script>

<script type="text/javascript">
$(document).ready(function(){
var cedula_clientes = $("#cedula_clientes").val();
	
	$( "#cedula_clientes" ).autocomplete({

		source: "index.php?controller=Clientes&action=AutocompleteCedula",
		minLength: 4
	});

	$("#cedula_clientes").focusout(function(){
		
		if(validarcedula()){
				
			$.ajax({
				url:'index.php?controller=Clientes&action=AutocompleteDevuelveNombres',
				type:'POST',
				dataType:'json',
				data:{cedula_clientes:$('#cedula_clientes').val()}
			}).done(function(respuesta){

				if(parseInt(respuesta.id_clientes)>0){
					
					$('.nav-tabs a[href="#nivel2"]').tab('show');
					$('#id_clientes').val(respuesta.id_clientes);
				}else{
					 Swal.fire('cliente no se encuentra registrado');
				}
			
			}).fail(function(respuesta) {

				$('#id_clientes').val("");
				
			
			});

		}else{
			Swal.fire('Ingrese un identificación válida');
		}  		
	});
	
	$("#btn_buscar").click(function(){
		   if(validarcedula()){
				
			$.ajax({
				url:'index.php?controller=Clientes&action=AutocompleteDevuelveNombres',
				type:'POST',
				dataType:'json',
				data:{cedula_clientes:$('#cedula_clientes').val()}
			}).done(function(respuesta){

				if(parseInt(respuesta.id_clientes)>0){
					
					$('.nav-tabs a[href="#nivel2"]').tab('show');
					$('#id_clientes').val(respuesta.id_clientes);
				}else{
					 Swal.fire('cliente no se encuentra registrado');
				}
			
			}).fail(function(respuesta) {

				$('#id_clientes').val("");
				
			
			});

			}else{
				Swal.fire('Ingrese un identificación válida');
			}  		
	});

	$(".buscanivel2").click(function(){
		  	//console.log('funciona boton busca nivel');
		  	//console.log($(this).val());
		  	$( "#respuestanivel2" ).remove();
		  	//$('.buscanivel1').removeClass("rojo");
		  	
			$.ajax({
				url:'index.php?controller=Procesos&action=buscanivel2',
				type:'POST',
				/*dataType:'json',*/
				data:{nombre_nivel:$(this).val()}
			}).done(function(respuesta){				
				 try {
					 objeto = JSON.parse(respuesta);
					
					if(parseInt(objeto[0].id_nivel2)>0){	
						var nombre_nivel = 	objeto[0].nombre_nivel2;		
						$('#id_nivel2').val(objeto[0].id_nivel2);
						$('[value="'+nombre_nivel.toLowerCase()+'"]').after('<span id="respuestanivel2" class="glyphicon glyphicon-ok text-success"></span>');

					}

					if(objeto[0].nombre_nivel2.toLowerCase()=='personal'){
							$('.buscanivel1').addClass("btn-info");
						}
					if(objeto[0].nombre_nivel2.toLowerCase()=='corporativo'){
						$('.buscanivel1').addClass("bg-warning");
					}
                     
                     
                 }
                 catch (error) {
                     if(error instanceof SyntaxError) {
                         let mensaje = error.message;
                         console.log('ERROR EN LA SINTAXIS:', mensaje);
                     } else {
                         throw error; // si es otro error, que lo siga lanzando
                     }
                 }
				
			
			}).fail(function(respuesta) {

				$('#id_clientes').val("");
				
			
			});

				
	});

	$(".buscanivel1").click(function(){
		
	  	$( "#respuestanivel1" ).remove();
	  	//$('.buscanivel1').removeClass("rojo");
	  	
		$.ajax({
			url:'index.php?controller=Procesos&action=buscanivel1',
			type:'POST',
			/*dataType:'json',*/
			data:{nombre_nivel:$(this).val(),codigo_nivel2:$("#id_nivel2").val()}
		}).done(function(respuesta){				
			 try {
				 objeto = JSON.parse(respuesta);
				
				if(parseInt(objeto[0].id_nivel1)>0){	
					var nombre_nivel = 	objeto[0].nombre_nivel1;		
					$('#id_nivel1').val(objeto[0].id_nivel1);
					$('[value="'+nombre_nivel.toLowerCase()+'"]').after('<span id="respuestanivel1" class="glyphicon glyphicon-ok text-success"></span>');

				}

				
                 
             }
             catch (error) {
                 if(error instanceof SyntaxError) {
                     let mensaje = error.message;
                     console.log('ERROR EN LA SINTAXIS:', mensaje);
                 } else {
                     throw error; // si es otro error, que lo siga lanzando
                 }
             }
			
		
		}).fail(function(respuesta) {

			$('#id_clientes').val("");
			
		
		});

			
});

$(".buscanivel0").click(function(){
		
	  	//console.log($(this).val());
	  	//$('.buscanivel1').removeClass("rojo");
	  	$( "#respuestanivel0" ).remove();
	  	
		
		$.ajax({
			url:'index.php?controller=Procesos&action=buscanivel0',
			type:'POST',
			/*dataType:'json',*/
			data:{nombre_nivel:$(this).val()}
		}).done(function(respuesta){				
			 try {
				 //console.log(respuesta);
				 objeto = JSON.parse(respuesta);
				
				if(parseInt(objeto[0].id_nivel0)>0){	
					var nombre_nivel = 	objeto[0].nombre_nivel0;		
					$('#id_nivel0').val(objeto[0].id_nivel0);
					$('[value="'+nombre_nivel.toLowerCase()+'"]').after('<span id="respuestanivel0" class="glyphicon glyphicon-ok text-success"></span>');

				}

                 
             }
             catch (error) {
                 if(error instanceof SyntaxError) {
                     let mensaje = error.message;
                     console.log('ERROR EN LA SINTAXIS:', mensaje);
                 } else {
                     throw error; // si es otro error, que lo siga lanzando
                 }
             }
			
		
		}).fail(function(respuesta) {

			$('#id_clientes').val("");
			
		
		});
			
});

$( "#wizard" ).submit(function( event ) {

	var dataString = $('#wizard').serialize();

	  $.ajax({
        beforeSend: function(objeto){
          
        },
        url: 'index.php?controller=Procesos&action=generapdf',
        type: 'POST',
        data: {id_usuario:_id_usuario,razon_solicitud:observacion},
        success: function(x){
          console.log(x);
          
        },
       error: function(jqXHR,estado,error){
         //$("#resultados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
       }
     });
	  event.preventDefault();
	  
	});
	
});
</script>

			        
    </head>
    
    
    <body class="nav-md">
    
      <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","SÃ¡bado");
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
          
                 <!--   <section class="content-header">
                         <small><?php echo $fecha; ?></small>
                         <ol class=" pull-right breadcrumb">
                             <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                             <li class="active">Usuarios</li>
                         </ol>
                     </section> --> 
                     
                    <br>
                    <br>
                     <div class="wrapper">
                        <form action="" id="wizard">
                    		<!-- SECTION 1 -->
                            <h4></h4>
                            <section>
                                <h3>Vadidacion Información</h3>
                            	<div class="row">
            						<div class="col-xs-12 col-md-6 col-lg-6 ">
            							<div class="form-group">
            								<label for="cedula_clientes" class="control-label">Cedula:</label>
            								<div class="input-group margin">
            									<input type="text" class="form-control" id="cedula_clientes" name="cedula_clientes" value=""  placeholder="cedula.." >
            									<input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="0" >
            									<div id="mensaje_cedula_clientes" class="errores"></div>
            										<span class="input-group-btn">
            										<button type="button" id="btn_buscar" class="btn btn-info btn-flat">Buscar</button>
            										</span>
            								</div>
            															
            							</div>
            						</div>            						
            					</div> 
            					<br>
            					<br>
                            </section>
            
            				<!-- SECTION 2 -->
                            <h4></h4>
                            <section>
                            	<h3>Nivel2</h3>
                            	<div class="row">
                					<div class="col-lg-4">
                						 <button class="buscanivel2" type="button" value="corporativo" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> CORPORATIVO
                                        </button> 
                					</div>
                				</div>
                				
                				<div class="row">
                					<div class="col-lg-4">
                						 <button class="buscanivel2"  type="button" value="personal" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> PERSONAL
                                        </button>
                					</div>
                				</div>
                				
                				<input type="hidden" id="id_nivel2" value="0" />
                            	
                            	
                            </section>
            
                            <!-- SECTION 3 -->
                            <h4></h4>
                            <section>
                                <h3 di="titulonivel1" style="margin-bottom: 16px;">NIVEL 1</h3>
                                <div  >
                                <div class="row">
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="analisis" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> ANALISIS
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="garantia" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> GARANTIA
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="seguros" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> SEGUROS
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="desembolso" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> DESEMBOLSO
                                        </button>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="avaluos" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> AVALUOS
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="codeudor" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> CODEUDOR
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="garante" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> GARANTE
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel1"  type="button" value="actualizaciones" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> ACTUALIZACIONES
                                        </button>
                					</div>
                				</div>
                				</div>
                				
                				                				
                				<input type="hidden" id="id_nivel1" value="0" />
                                
                            </section>
            
                            <!-- SECTION 4 -->
                            <h4></h4>
                            <section>
                                <h3>Nivel 0</h3>
                                
                                <div class="row">
                                	<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel0"  type="button" value="informacion basica" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> Informacion Basica
                                        </button>
                					</div>
                					<div class="col-lg-3 col-md-3">
                						 <button class="buscanivel0"  type="button" value="seleccione interviniente" class="btn  btn-block btn-default">
                                          <span class="glyphicon glyphicon-folder-open"></span> Seleccione Interviniente
                                        </button>
                					</div>
                                </div>
                                
                                <input type="hidden" id="id_nivel0" value="0" />
                            </section>
       					 </form>
					</div>
					
					
					<div>
					<a id="linkrespuesta" href="#">respuesta
					</a>
					</div>
            
            </div>

	</div>
	
	</div>
	</div>
	
    
     <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
       
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	<script src="view/js/jquery.inputmask.bundle.js"></script>
	<!-- codigo de las funciones -->
	
	
    
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	



 <script type="text/javascript">
 $(document).ready(function(){
	 $('#cedula_clientes').inputmask('9999999999',{"placeholder": ""});
	 
 });

 </script>
 
 




	
  </body>
</html>   