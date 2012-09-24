$(document).ready(function(){
	var description = $('#description').val(),
		re = new RegExp( (description ? "^("+description+")":"" )+"([\\w|\\W]+)")
		amount = parseFloat($('#amount').val() || 1) , 
		sales_stage = $('#sales_stage').val(),
		//values_sales_stage_acepted = ["Identificacion_de_necesidades", "Cita_visita_MDY", "Cotizacion_entregada", "Carta_de_aceptacion", "Contrato_cerrado", "Cliente_perdido", "Proyecto_en_standby"];
		values_sales_stage_acepted = ["Cotizacion_entregada"];

	$('#amount').val(amount);

	submitFunction = $('#SAVE_HEADER').attr('onclick');
	$('#SAVE_HEADER').removeAttr('onclick');
	$('#SAVE_HEADER').on('click', function(e){
		e.preventDefault();
		var errors = 0;
		$('#description').next('div.required').remove();

		if(! re.test($('#description').val())){		
			$('#description').after($('<div>', {
				class: "required validation-message", 
				text: "La descipción debe de contener mas contenido"
			}));			
			errors++;
		}	

		if($.inArray($('#sales_stage').val(), values_sales_stage_acepted) === 0 && amount === 1.0){
			$('#amount').after($('<div>', {
				class: "required validation-message", 
				text: "El monto debe ser mayor que 1"
			}));			
			errors++;
		}
		if(errors) return false;

		eval(submitFunction);		
	});
});
