function lista_usuarios(){
   $(document).ready( function (){
     $.ajax({
               beforeSend: function(){
                 $("#users_registrados").html("<b>Actualizando Listado...</b>")
               },
               url: 'index.php?controller=Usuarios&action=index10',
               type: 'POST',
               data: null,
               success: function(x){
                 $("#users_registrados").html(x);
                 $("#tabla_usuarios").dataTable({
                     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
                 } );
               },
              error: function(jqXHR,estado,error){
                $("#users_registrados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
              }
            });
   })
}


/********************************************************************/
function NuevoUsuario(){
	 $(document).ready(function(){
	  
		 var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    	  var errores='';
    	  
    	  if($("#nombre_usuario").val()==""){
    		  
    		  var n = noty({
                  text: "Ingrese un Nombre!..",
                  theme: 'relax',
                  layout: 'center',
                  type: 'error',
                  timeout: 2000,
                 });
    		  
    		  errores = 'true';
    		  return false;
    	  }else{
    		  
    		  errores = 'false';
    		  
    	  }
    	  
         if($("#usuario_usuario").val()==""){
    		  
    		  var n = noty({
                  text: "Ingrese un Usuario!..",
                  theme: 'relax',
                  layout: 'center',
                  type: 'error',
                  timeout: 2000,
                 });
    		  
    		  errores = 'true';
    		  return false;
    	  }else{
    		  
    		  errores = 'false';
    		  
    	  }
    	  
         if($("#clave_usuario").val()==""){
   		  
   		  var n = noty({
                 text: "Ingrese una Clave!..",
                 theme: 'relax',
                 layout: 'center',
                 type: 'error',
                 timeout: 2000,
                });
   		  
   		  errores = 'true';
   		  return false;
   	  }else{
   		  
   		  errores = 'false';
   		  
   	  }
         
         
         if($("#clave_usuario_r").val()==""){
      		  
      		  var n = noty({
                    text: "Confirme Clave!..",
                    theme: 'relax',
                    layout: 'center',
                    type: 'error',
                    timeout: 2000,
                   });
      		  
      		  errores = 'true';
      		  return false;
      	  }else{
      		  
      		  errores = 'false';
      		  
      	  } 
         
         
    	  
         
         if($("#clave_usuario").val() != $("#clave_usuario_r").val()){
        	 
        	 var n = noty({
                 text: "Claves no son iguales!..",
                 theme: 'relax',
                 layout: 'center',
                 type: 'error',
                 timeout: 2000,
                });
   		  
   		  errores = 'true';
   		  return false;
   		  
         }else{
     		  
     		  errores = 'false';
     		  
     	  } 
    	  
    	   
 		
	    	if ($("#correo_usuario").val() == "")
	    	{
		    	
	    		 var n = noty({
	                 text: "Ingrese un correo!..",
	                 theme: 'relax',
	                 layout: 'center',
	                 type: 'error',
	                 timeout: 2000,
	                });
	   		  
	   		  errores = 'true';
	          return false;
		    }
	    	else if (regex.test($('#correo_usuario').val().trim()))
	    	{
	    		 errores = 'false';
	            
			}
	    	else 
	    	{
	    		 var n = noty({
	                 text: "Ingrese un correo valido!..",
	                 theme: 'relax',
	                 layout: 'center',
	                 type: 'error',
	                 timeout: 2000,
	                });
	   		  
	   		  errores = 'true';
	          return false;
		    }
	    	
	    	
	        if($("#id_rol").val() == ""){
	        	 
	        	 var n = noty({
	                 text: "Seleccione un Rol!..",
	                 theme: 'relax',
	                 layout: 'center',
	                 type: 'error',
	                 timeout: 2000,
	                });
	   		  
	   		  errores = 'true';
	   		  return false;
	   		  
	         }else{
	     		  
	     		  errores = 'false';
	     		  
	     	  } 
	        
	        if($("#id_estado").val() == ""){
	        	 
	        	 var n = noty({
	                 text: "Seleccione un Estado!..",
	                 theme: 'relax',
	                 layout: 'center',
	                 type: 'error',
	                 timeout: 2000,
	                });
	   		  
	   		  errores = 'true';
	   		  return false;
	   		  
	         }else{
	     		  
	     		  errores = 'false';
	     		  
	     	  } 
         
         
    	  if(errores =='false'){
    		 
    		 
    		  
    		  
    	    	var inf_nombre_usuario=$("#nombre_usuario").val();
    	  	    var inf_clave_usuario=$("#clave_usuario").val();
    	  	    var inf_telefono_usuario=$("#telefono_usuario").val();
    	  	    var inf_celular_usuario=$("#celular_usuario").val();
    	  	    var inf_correo_usuario=$("#correo_usuario").val();
    	  	    var inf_id_rol=$("#id_rol").val();
    	  	    var inf_id_estado=$("#id_estado").val();
    	  	    var inf_usuario_usuario=$("#usuario_usuario").val();    
    	    
    		    var con_datos={
    				  nombre_usuario:inf_nombre_usuario,
    				  clave_usuario:inf_clave_usuario,
    				  telefono_usuario:inf_telefono_usuario,
    				  celular_usuario:inf_celular_usuario,
    				  correo_usuario:inf_correo_usuario,
    				  id_rol:inf_id_rol,
    				  id_estado:inf_id_estado,
    				  usuario_usuario:inf_usuario_usuario
    				 
    				  };
    	    
    	    
    	    
    	      $.ajax({
    	        beforeSend: function(){},
    	        url: 'index.php?controller=Usuarios&action=InsertaUsuarios',
    	        type: 'POST',
    	        data: con_datos,
    	        success: function(x){
    	          if(x==1){
    	           lista_usuarios();
    	           var n = noty({
    	               text: "El Usuario se registro correctamente....",
    	               theme: 'relax',
    	               layout: 'center',
    	               type: 'information',
    	               timeout: 3000,
    	               });
    	           $("#btn-nuevo").prop('disabled', false);  
    	           tabpagina('listado');
    	           CancelaNuevoUsuario();
    	           }
    	           if(x=="error"){
    	           var n = noty({
    	           text: "No se registro el Usuario, verifique los campos...!",
    	           theme: 'relax',
    	           layout: 'center',
    	           type: 'information',
    	           timeout: 3000,
    	           });
    	           $("#btn-nuevo").prop('disabled', false);
    	           
    	          }
    	          }
    	          ,
    	          /**************************/
    	        error: function(jqXHR,estado,error){
    	          var n = noty({
    	           text: "Ocurrio un error al registrar el Usuario!",
    	           theme: 'relax',
    	           layout: 'center',
    	           type: 'information',
    	           });
    	          }
    	       });
    		  
    	  }
    	  
    	  
    
	  });
   }
/*******************************************************************************************/
function CancelaNuevoUsuario(){
    
    $("#nombre_usuario").val("");
    $("#nombre_usuario").focus();
    $("#clave_usuario").val("");
    $("#telefono_usuario").val("");
    $("#celular_usuario").val("");
    $("#correo_usuario").val("");
    $("#id_rol").val("");
    $("#id_estado").val("");
    $("#usuario_usuario").val("");
   
}

/************************************************************************************/
function tabpagina(pagetab){
	
	$('#myTabs a[href="#'+pagetab+'"]').tab('show'); 
}
/************************************************************************************/