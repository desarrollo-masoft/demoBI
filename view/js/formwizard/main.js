$(function(){
	
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 300,
        labels: {
            next: "Siguiente",
            previous: "Atras",
            finish: 'Generar Documento'
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
        	
        	//console.log(newIndex);        	
        	/*if(newIndex===1){        		
        		if($("#id_clientes").val()==0){        			
        			return false;
        		}
        	}*/
        	if(newIndex===1){        		
        		if($("#cedula_clientes").val()==""){        			
        			return false;
        		}
        	}
        	
        	if(newIndex===2){        		
        		if($("#id_nivel2").val()==0){        			
        			return false;
        		}
        	}        	
        	if(newIndex===3){        		
        		if($("#id_nivel1").val()==0){        			
        			return false;
        		}
        	}
        	        	
            if ( newIndex >= 1 ) {
                $('.steps ul li:first-child a img').attr('src','view/images/formwizard/p1.png');
            } else {
                $('.steps ul li:first-child a img').attr('src','view/images/formwizard/p1_active.png');
            }

            if ( newIndex === 1 ) {
                $('.steps ul li:nth-child(2) a img').attr('src','view/images/formwizard/p2_active.png');
            } else {
                $('.steps ul li:nth-child(2) a img').attr('src','view/images/formwizard/p2.png');
            }

            if ( newIndex === 2 ) {
                $('.steps ul li:nth-child(3) a img').attr('src','view/images/formwizard/p3_active.png');
            } else {
                $('.steps ul li:nth-child(3) a img').attr('src','view/images/formwizard/p3.png');
            }

            if ( newIndex === 3 ) {
                $('.steps ul li:nth-child(4) a img').attr('src','view/images/formwizard/p4_active.png');
                $('.actions ul').addClass('step-4');
            } else {
                $('.steps ul li:nth-child(4) a img').attr('src','view/images/formwizard/p4.png');
                $('.actions ul').removeClass('step-4');
            }
            
            
            
            return true; 
        },
        onFinished: function (event, currentIndex)
        {
        	$("#wizard").submit();  
           
        }
    });
    // Custom Button Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    })
    // Click to see password 
    $('.password i').click(function(){
        if ( $('.password input').attr('type') === 'password' ) {
            $(this).next().attr('type', 'text');
        } else {
            $('.password input').attr('type', 'password');
        }
    }) 
    // Create Steps Image
    $('.steps ul li:first-child').append('<img src="view/images/formwizard/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="view/images/formwizard/p1_active.png" alt=""> ').append('<span class="step-order">Paso 01</span>');
    $('.steps ul li:nth-child(2').append('<img src="view/images/formwizard/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="view/images/formwizard/p2.png" alt="">').append('<span class="step-order">Paso 02</span>');
    $('.steps ul li:nth-child(3)').append('<img src="view/images/formwizard/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="view/images/formwizard/p3.png" alt="">').append('<span class="step-order">Paso 03</span>');
    $('.steps ul li:last-child a').append('<img src="view/images/formwizard/p4.png" alt="">').append('<span class="step-order">Paso 04</span>');
    // Count input 
    $(".quantity span").on("click", function() {

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.hasClass('plus')) {
          var newVal = parseFloat(oldValue) + 1;
        } else {
           // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
            } else {
            newVal = 0;
          }
        }
        $button.parent().find("input").val(newVal);
    });
    
})

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
