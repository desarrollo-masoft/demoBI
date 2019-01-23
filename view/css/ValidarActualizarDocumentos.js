
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-actualizar-documentos');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	
	        	id_documentos_legal: {
	        		message: 'El Id no es valido',
	                        validators: {
	                                notEmpty: {
	                                        message: 'El Id es Requerido.'
	                                },
	                                regexp: {
	                                	 
	               					 regexp: /^[0-9]+$/,
	                
	               					 message: 'Ingrese números'
	                
	               				 }
	            				 
	                        }
	                }
	        	
	        	
	        	
	        }
	        
	    
	    });
	});
	
