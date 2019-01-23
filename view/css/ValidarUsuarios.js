
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-usuarios');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {

	        	
	        	
	                
	        	nombre_usuario: {
	                        validators: {
	                                notEmpty: {
	                                        message: 'Este campo es requerido.'
	                                },
	                                regexp: {
	                                	 
		               					 regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
		                
		               					 message: 'Ingrese Letras'
		                
		               				 }
	                        }
	                },
	                usuario_usuario: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                },
                clave_usuario: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                clave_usuario_r: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    },
                        identical: {
                            field: 'clave_usuario',
                            message: 'No coinciden'
                        }
                    }
                },
            
               
                correo_usuario: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    },
                    emailAddress:{
                        message: 'El correo no es valido.'
                      }
                        
                    }
                },

                id_rol: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                id_estado: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                id_ciudad: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                }
	                
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	});
	
