
        		    // cada vez que se cambia el valor del combo
$("#categorias").change(function() {
                       // obtenemos el combo de subcategorias
                        var $subcategorias = $("#subcategorias");
                       // lo vaciamos
        				///obtengo el id seleccionado
                       var id_categorias = $(this).val();
                       $subcategorias.empty();
                       $subcategorias.append("<option value= " +"0" +" > --TODOS--</option>");
                       if(id_categorias > 0)
                       {
                    	   var datos = {
                    			   id_categorias : $(this).val()
                           };
                    	   $.post("<?php echo $helper->url("subCategorias","devuelveSubcategorias"); ?>", datos, function(resultSub) {
        
                    		 		$.each(resultSub, function(index, value) {
                       		 	    $subcategorias.append("<option value= " +value.id_subcategorias +" >" + value.nombre_subcategorias  + "</option>");	
                               		 });
                    		  }, 'json');
                       }
                       else
                       {
                    	   $.post("<?php echo $helper->url("subCategorias","devuelveAllSubcategorias"); ?>", datos, function(resultSub) {
        
           		 		        $.each(resultSub, function(index, value) {
                  		 	    $subcategorias.append("<option value= " +value.id_subcategorias +" >" + value.nombre_subcategorias  + "</option>");	
                        	  });
             		  		}, 'json');
                       }
                       
 });
        
 $("#subcategorias").change(function() {
        
        	               // obtenemos el combo de categorias
        	                var $categorias = $("#categorias");
        	               
        					///obtengo el id seleccionado
        					var id_subcategorias = $(this).val();
        	               if(id_subcategorias > 0)
        	               {
        	            	   var datos = {
        	            			   id_subcategorias : $(this).val()
        	                   };
        	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
        	                   $.post("<?php echo $helper->url("subCategorias","devuelveSubBySubcategorias"); ?>", datos, function(resultSub) {
                 		 		  $.each(resultSub, function(index, value) {
                 		 			 $('#categorias').val( value.id_categorias );//To select Blue	 
                 		 			//$("'#categorias > option[value="+value.id_categorias"+"]').attr('selected', 'selected'");
        							 });
                 		  		}, 'json');
        	               }
        	               else
        	               {
        
        	          		 $('#categorias').val( 0 );//To select Blue
        
        			        }
 });
 
 $("#fecha_documento_hasta").change(function() {
        		    	var startDate = new Date($('#fecha_documento_desde').val());
        		    	var endDate = new Date($('#fecha_documento_hasta').val());
        
        		    	if (startDate > endDate){
        
        		    		$("#fecha_documento_hasta").val("");
        		    		alert('Fecha documento DESDE mayor a  fecha FINAL');
        		    	}
  });
        

 function myFunction() {
        			    var x = document.getElementById("categorias").value;
                            var subcategorias = document.getElementById("subcategorias");
                            $subcategorias.Empty();
        				    document.getElementById("demo").innerHTML = "You selected: " + x;
 }
 
 
 $("#btnBuscar").click(function(){
        			load_Documentos(1);
        			});
        
        		load_nombre_cliente();
        	
        	});
 function load_Documentos(pagina){
        
        		
        		//iniciar variables
        		 var doc_categorias=$("#categorias").val();
        		 var doc_subcategorias=$("#subcategorias").val();
        		 var doc_ruc_cli=$("#ruc_cliente_proveedor").val();
        		 var doc_nombre_cli=$("#nombre_cliente_proveedor").val();
        		 var doc_tipo_doc=$("#tipo_documentos").val();
        		 var doc_cartones_doc=$("#carton_documentos").val();
        		 var doc_fecha_doc_desde=$("#fecha_documento_desde").val();
        		 var doc_fecha_doc_hasta=$("#fecha_documento_hasta").val();
        		 var doc_year=$("#year").val();
        
        		 	
        		  var con_datos={
        				  categorias:doc_categorias,
        				  subcategorias:doc_subcategorias,
        				  ruc_cliente_proveedor:doc_ruc_cli,
        				  tipo_documentos:doc_tipo_doc,
        				  nombre_cliente_proveedor:doc_nombre_cli,
        				  carton_documentos:doc_cartones_doc,
        				  fecha_documento_desde:doc_fecha_doc_desde,
        				  fecha_documento_hasta:doc_fecha_doc_hasta,
        				  year:doc_year,
        				  action:'ajax',
        				  page:pagina
        				  };
        
        
        		$("#Documentos").fadeIn('slow');
        		$.ajax({
        			url:"<?php echo $helper->url("Documentos","buscar");?>",
                    type : "POST",
                    async: true,			
        			data: con_datos,
        			 beforeSend: function(objeto){
        			$("#Documentos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
        			},
        			success:function(data){
        				$(".Documentos").html(data).fadeIn('slow');
        				$("#Documentos").html("");
        			}
        		})
        	}
        
        	function load_nombre_cliente()
        	{
        		
        	    var _resultCli='';<?php  //echo json_encode($resultCli); ?>
        	    var _sel_nombre_cliente_proveedor = $("#nombre_cliente_proveedor");
        	    _sel_nombre_cliente_proveedor.empty();
        	    _sel_nombre_cliente_proveedor.append("<option value= " +"0" +" > --TODOS--</option>");
        
        	    if(_resultCli.length>0)
        	    {
        		    console.log('hay datos');
        	    	 $.each(_resultCli, function(index, value) {
        
        	    		 _sel_nombre_cliente_proveedor.append("<option value= " +value.id_cliente_proveedor +" >" + value.nombre_cliente_proveedor  + "</option>");	
        	     		
        				 });
        	    }else{
        	    	console.log('no hay datos');
        		    }
        	    
        	}
        
        	</script>
	
	
             <script>
        	$(document).ready(function(){
         	
        	$("#txt_nombre_cliente_proveedor").autocomplete({
        		source: "<?php echo $helper->url("Documentos","AutocompleteNombreCliente"); ?>",
        		minLength: 1,
        		select: function( event, data ) 
        			{
        			 var respueta = data.item.id;
        			 var res = respueta.split(',');
        			 
        			 $("#nombre_cliente_proveedor").val(res[0]);
        			 $("#ruc_cliente_proveedor").val(res[0]);
        			 
                     $("#txt_nombre_cliente_proveedor").val(data.item.value);
                     $("#txt_ruc_cliente_proveedor").val(res[1]);
        	            //alert(data);
        			}
        	 });
        		
        	$("#txt_nombre_cliente_proveedor").focusout(function(){
        
        		if($("#txt_nombre_cliente_proveedor").val()==''||$("#txt_nombre_cliente_proveedor").val()==null)
        		{
        			 $("#nombre_cliente_proveedor").val(0);
        			 $("#ruc_cliente_proveedor").val(0);
        			 $("#txt_nombre_cliente_proveedor").val('');
        	         $("#txt_ruc_cliente_proveedor").val('');
        			 
        		}
        						
        	});
        						
        	});
        		
        					
            </script>
    
            <script>
        	$(document).ready(function(){
         	
        	$("#txt_ruc_cliente_proveedor").autocomplete({
        		source: "<?php echo $helper->url("Documentos","AutocompleteRucCliente"); ?>",
        		minLength: 1,
        		select: function( event, data ) 
        		{
        		 var respueta = data.item.id;
        		 var res = respueta.split(',');
        		 
        		 $("#nombre_cliente_proveedor").val(res[0]);
        		 $("#ruc_cliente_proveedor").val(res[0]);
        		 
                 $("#txt_nombre_cliente_proveedor").val(res[1]);
                 $("#txt_ruc_cliente_proveedor").val(data.item.value);
                    //alert(data);
        		}
        	 });
        		
        	$("#txt_ruc_cliente_proveedor").focusout(function(){
        
        		if($("#txt_ruc_cliente_proveedor").val()==''||$("#txt_ruc_cliente_proveedor").val()==null)
        		{
        			 $("#nombre_cliente_proveedor").val(0);
        			 $("#ruc_cliente_proveedor").val(0);
        			 $("#txt_nombre_cliente_proveedor").val('');
        	         $("#txt_ruc_cliente_proveedor").val('');
        	            //alert(data);
        			 
        		}
        						
        	});
        	});
        		
        					
            </script>
            
            <script>
        	$(document).ready(function(){
         	
        	$("#txt_tipo_documentos").autocomplete({
        		source: "<?php echo $helper->url("Documentos","AutocompleteTipoDoc"); ?>",
        		minLength: 1,
        		select: function( event, data ) 
        		{
        		 var respueta = data.item.id;
        		 $("#tipo_documentos").val(respueta);
        		 
                 $("#txt_tipo_documentos").val(data.item.value);
        		}
        	 });
        		
        	$("#txt_tipo_documentos").focusout(function(){
        
        		if($("#txt_tipo_documentos").val()==''||$("#txt_tipo_documentos").val()==null)
        		{
        			 $("#tipo_documentos").val(0);
        		}
        						
        	});
        	});
        		
        					
            </script>
