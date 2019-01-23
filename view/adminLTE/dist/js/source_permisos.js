function lista_permisos(){
   $(document).ready( function (){
     $.ajax({
               beforeSend: function(){
                 $("#permisos_registrados").html("<b>Actualizando Listado...</b>")
               },
               url: 'index.php?controller=PermisosRoles&action=lista_permisos',
               type: 'POST',
               data: null,
               success: function(x){
                 $("#permisos_registrados").html(x);
                 $("#tabla_permisos").dataTable({
                     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
                 } );
               },
              error: function(jqXHR,estado,error){
                $("#permisos_registrados").html("Ocurrio un error al cargar la informacion de Permisos..."+estado+"    "+error);
              }
            });
   })
}


/********************************************************************/
function NuevoPermiso(){
	 $(document).ready(function(){
	  
		  var errores='';
    	  
    	  if($("#nombre_permisos_rol").val()==""){
    		  
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
    	  
    	  if($("#id_rol").val()==""){
    		  
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
    	  
          if($("#id_controladores").val()==""){
    		  
    		  var n = noty({
                  text: "Seleccione un Controlador!..",
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
          
          	if($("#ver_permisos_rol").val()==""){
    		  
    		  var n = noty({
                  text: "Seleccione Ver!..",
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
          	
          	
           	if($("#editar_permisos_rol").val()==""){
      		  
      		  var n = noty({
                    text: "Seleccione Editar!..",
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
           	
        	if($("#borrar_permisos_rol").val()==""){
        		  
        		  var n = noty({
                      text: "Seleccione Borrar!..",
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
    		 
    		 
    	    	var inf_nombre_permisos_rol=$("#nombre_permisos_rol").val();
    	  	    var inf_id_controladores=$("#id_controladores").val();
    	  	    var inf_ver_permisos_rol=$("#ver_permisos_rol").val();
    	  	    var inf_editar_permisos_rol=$("#editar_permisos_rol").val();
    	  	    var inf_borrar_permisos_rol=$("#borrar_permisos_rol").val();
    	  	    var inf_id_rol=$("#id_rol").val();
    	  	    
    	    
    		    var con_datos={
    		    		nombre_permisos_rol:inf_nombre_permisos_rol,
    		    		id_controladores:inf_id_controladores,
    		    		ver_permisos_rol:inf_ver_permisos_rol,
    		    		editar_permisos_rol:inf_editar_permisos_rol,
    		    		borrar_permisos_rol:inf_borrar_permisos_rol,
    				  id_rol:inf_id_rol
    				  };
    	    
    	    
    	    
    	      $.ajax({
    	        beforeSend: function(){},
    	        url: 'index.php?controller=PermisosRoles&action=InsertaPermisosRoles',
    	        type: 'POST',
    	        data: con_datos,
    	        success: function(x){
    	          if(x==1){
    	        	  lista_permisos();
    	           var n = noty({
    	               text: "El Permiso se registro correctamente....",
    	               theme: 'relax',
    	               layout: 'center',
    	               type: 'information',
    	               timeout: 3000,
    	               });
    	           $("#btn-nuevo").prop('disabled', false);  
    	           tabpagina('listado');
    	           CancelaNuevoPermiso();
    	           }
    	           if(x=="error"){
    	           var n = noty({
    	           text: "No se registro el Permiso, verifique los campos...!",
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
    	           text: "Ocurrio un error al registrar el Permiso!",
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
function CancelaNuevoPermiso(){
    
	$("#nombre_permisos_rol").val("");
	 $("#nombre_permisos_rol").focus();
	$("#id_controladores").val("");
	$("#ver_permisos_rol").val("");
	$("#editar_permisos_rol").val("");
	$("#borrar_permisos_rol").val("");
	$("#id_rol").val("");
	
  
   
}

/************************************************************************************/
function tabpagina(pagetab){
	
	$('#myTabs a[href="#'+pagetab+'"]').tab('show'); 
}
/************************************************************************************/