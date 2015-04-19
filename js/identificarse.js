$(function() {
	$('#form-identificarse').click(function(e){

		var validacion = validarIdentificacion();

		if (validacion != true){
			$("#formIdentificarseError").html(validacion);
			openObject('formIdentificarseError');
			return false;
		}

		openObject('loading');

	    var postData = $("#formularioIdentificarse").serializeArray();
	    var formURL = $("#formularioIdentificarse").attr("action");
	    $.ajax(
	    {
	        url : formURL,
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR)
	        {
	        	var respuesta = JSON.parse(cleanString(data));
	            if (respuesta.identificarse == "ok"){
	            	location.href = './index.php?seccion=administrar';
	            }else{
					$("#formIdentificarseError").html(respuesta.identificarse);
					openObject('formIdentificarseError');
	            }
				closeObject('loading');	
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            closeObject('loading');
	        }
	    });
	 	
	 	return false;
	});
});


function validarIdentificacion(){
	$("#formIdentificarseMail").removeClass('error');
	$("#formIdentificarseClave").removeClass('error');

	if(!(IsEmail($("#formIdentificarseMail").val()))){
		$("#formIdentificarseMail").focus();
		$("#formIdentificarseMail").addClass('error');
		return 'Completar el campo Mail';
	}	
	if(!($("#formIdentificarseClave").val().length >= 6)){
		$("#formIdentificarseClave").focus();
		$("#formIdentificarseClave").addClass('error');
		return 'Completar el campo Clave. Minimo 6 caracteres';
	}	
	return true;
}