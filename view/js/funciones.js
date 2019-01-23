
/**************************************************************************************/
function contar_user(){
 $(document).ready( function (){
     $.ajax({
               beforeSend: function(){
                 $("#contar_user").html("")
               },
               url: 'index.php?controller=Usuarios&action=contar_user',
               type: 'POST',
               data: null,
               success: function(x){
                 $("#contar_user").html(x);
               },
              error: function(jqXHR,estado,error){
                $("#contar_user").html("Ocurrio un error al cargar la informacion de usuarios..."+estado+"    "+error);
              }
            });
   })
}



function sumar_sesiones(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#sumar_sesiones").html("")
	               },
	               url: 'index.php?controller=Usuarios&action=sumar_sesiones',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#sumar_sesiones").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#sumar_sesiones").html("Ocurrio un error al cargar la informacion de sesiones..."+estado+"    "+error);
	              }
	            });
	   })
	}



function contar_documentos(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#contar_user").html("")
	               },
	               url: 'index.php?controller=Documentos&action=contar_documentos',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#contar_documentos").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#contar_documentos").html("Ocurrio un error al cargar la informacion de documentos..."+estado+"    "+error);
	              }
	            });
	   })
	}

function sumar_paginas(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#sumar_paginas").html("")
	               },
	               url: 'index.php?controller=Documentos&action=sumar_paginas',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#sumar_paginas").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#sumar_paginas").html("Ocurrio un error al cargar la informacion de documentos..."+estado+"    "+error);
	              }
	            });
	   })
	}

function sumar_documentos_categorias(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#sumar_documentos_categorias").html("")
	               },
	               url: 'index.php?controller=Documentos&action=sumar_documentos_categorias',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#sumar_documentos_categorias").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#sumar_documentos_categorias").html("Ocurrio un error al cargar la informacion de documentos..."+estado+"    "+error);
	              }
	            });
	   })
	}


documentos_categorias



function contar_cartones(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#contar_cartones").html("")
	               },
	               url: 'index.php?controller=Documentos&action=contar_cartones',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#contar_cartones").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#contar_cartones").html("Ocurrio un error al cargar la informacion de documentos..."+estado+"    "+error);
	              }
	            });
	   })
	}



function tabla_usuarios(){
	 $(document).ready( function (){
	     $.ajax({
	               beforeSend: function(){
	                 $("#tabla_usuarios").html("")
	               },
	               url: 'index.php?controller=usuarios&action=tabla_usuarios',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#tabla_usuarios").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#tabla_usuarios").html("Ocurrio un error al cargar la informacion de usuarios..."+estado+"    "+error);
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
	               url: 'index.php?controller=Politicas&action=index12',
	               type: 'POST',
	               data: null,
	               success: function(x){
	                 $("#pone_roles").html(x);
	               },
	              error: function(jqXHR,estado,error){
	                $("#pone_roles").html("Ocurrio un error al cargar la informacion de respldos..."+estado+"    "+error);
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
