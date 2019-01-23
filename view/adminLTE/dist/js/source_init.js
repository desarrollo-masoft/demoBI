
/**************************************************************************************/
function pone_users(){
 $(document).ready( function (){
     $.ajax({
               beforeSend: function(){
                 $("#pone_users").html("")
               },
               url: 'index.php?controller=Usuarios&action=index12',
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




/*************************************************************************************/
function pone_roles(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#pone_roles").html("")
	               },
	               url: 'index.php?controller=Roles&action=index12',
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
/*****************************************************************************/
function pone_permisos_roles(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#pone_permisos_roles").html("")
	               },
	               url: 'index.php?controller=PermisosRoles&action=index12',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#pone_permisos_roles").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#pone_permisos_roles").html("Ocurrio un error al cargar la informacion de permisos..."+estado+"    "+error);
	              }
	            });
	   })
	}
 /****************************************************************************/

function revisa_caducidades(){
  $(document).ready(function(){
      $.ajax({
          beforeSend: function(){
              $("#").html("Cargando... <img src='dist/img/default.gif'></img>")
          },
          url: 'analiza_cad_prods.php',
          type: 'POST',
          dataType: 'json',
          data: null,
          success: function(x){
              if (x.length > 0) {
                  $.each(x, function (y, item){
                      $(".arti_caducos").append("<li><a href='#'><i class='fa fa-barcode'></i>El producto "+x[y].codigo+" esta por caducar...!</a></li>");
                  });

                  $(".num_noti").html("");
                  $(".num_noti").html(x.length);
              }
          },
          error: function(jqXHR,estado,error){
          }
      });
  })
}
/******************************************************************************/
