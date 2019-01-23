
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-documentos');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	
	        	fecha_documento_desde:{
	        		
	        		validators:{
	        			date:{
	        				max: 'fecha_documento_hasta'
	        			}
	        			
	        		}
	        		
	        	},
	        	
	        	fecha_documento_hasta:{
	        		
	        		validators:{
	        			date:{
	        				max: 'fecha_documento_desde'
	        			}
	        			
	        		}
	        		
	        	},
	        	
	        	
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	});
	
