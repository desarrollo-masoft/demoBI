function lista_documentos(){
   $(document).ready( function (){
     $.ajax({
               beforeSend: function(){
                 $("#documentos_registrados").html("<b>Actualizando Listado...</b>")
               },
               url: 'index.php?controller=Documentos&action=buscar',
               type: 'POST',
               data: null,
               success: function(x){
                 $("#documentos_registrados").html(x);
                 $("#tabla_documentos").dataTable({
                     "lengthMenu": [[50, 100, 1000, -1], [50, 100, 1000, "Todos"]]
                 } );
               },
              error: function(jqXHR,estado,error){
                $("#documentos_registrados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
              }
            });
   })
}




