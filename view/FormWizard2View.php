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
		    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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

			source: "<?php echo $helper->url("Clientes","AutocompleteCedula"); ?>",
			minLength: 4
		});

		$("#cedula_clientes").focusout(function(){
			//alert('hola');
			if(validarcedula()){
    				
    			$.ajax({
    				url:'<?php echo $helper->url("Clientes","AutocompleteDevuelveNombres"); ?>',
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
   				url:'<?php echo $helper->url("Clientes","AutocompleteDevuelveNombres"); ?>',
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
                    <section class="content-header">
                         <small><?php echo $fecha; ?></small>
                         <ol class=" pull-right breadcrumb">
                             <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                             <li class="active">Usuarios</li>
                         </ol>
                     </section>
                   
                   <section>
                   <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                            <p>Step 1</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                            <p>Step 2</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                            <p>Step 3</p>
                        </div>
                    </div>
                </div>
                <form role="form">
                    <div class="row setup-content" id="step-1">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3> Step 1</h3>
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name"  />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" />
                                </div>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-2">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3> Step 2</h3>
                                <div class="form-group">
                                    <label class="control-label">Company Name</label>
                                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Company Address</label>
                                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
                                </div>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-3">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3> Step 3</h3>
                                <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
                            </div>
                        </div>
                    </div>
                </form>
                </section>
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
	<script src="view/js/jquery.inputmask.bundle.js"></script>
	<!-- codigo de las funciones -->
	
	<!-- Custom form wizard-->
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	



 
 <script type="text/javascript">
      function validarcedula() {
        var cad = document.getElementById("cedula_clientes").value.trim();
        var total = 0;
        var longitud = cad.length;
        var longcheck = longitud - 1;

        if (cad !== "" && longitud === 10){
          for(i = 0; i < longcheck; i++){
            if (i%2 === 0) {
              var aux = cad.charAt(i) * 2;
              if (aux > 9) aux -= 9;
              total += aux;
            } else {
              total += parseInt(cad.charAt(i)); // parseInt o concatenarÃ¡ en lugar de sumar
            }
          }

          total = total % 10 ? 10 - total % 10 : 0;

          if (cad.charAt(longitud-1) == total) {
        	  $("#cedula_clientes").val(cad);
        	  return true;
          }else{
			  document.getElementById("cedula_clientes").focus();
        	  $("#cedula_clientes").val("");
        	  return false;
          }
        }
      }
    </script>
 
 <script type="text/javascript">
 $(document).ready(function(){
	 $('#cedula_clientes').inputmask('9999999999',{"placeholder": ""});

	 var form = $("#example-form");
	 form.validate({
	     errorPlacement: function errorPlacement(error, element) { element.before(error); },
	     rules: {
	         confirm: {
	             equalTo: "#password"
	         }
	     }
	 });
	 form.children("div").steps({
	     headerTag: "h3",
	     bodyTag: "section",
	     transitionEffect: "slideLeft",
	     onStepChanging: function (event, currentIndex, newIndex)
	     {
	         form.validate().settings.ignore = ":disabled,:hidden";
	         return form.valid();
	     },
	     onFinishing: function (event, currentIndex)
	     {
	         form.validate().settings.ignore = ":disabled";
	         return form.valid();
	     },
	     onFinished: function (event, currentIndex)
	     {
	         alert("Submitted!");
	     }
	 });
	 
 });

 </script>




	
  </body>
</html>   