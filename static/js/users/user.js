$(function(){
	
	/*
	 * -------------------------------------------------------------------
	 *  Create model submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	$("#frmChangePass").on("submit",function(event){
		event.preventDefault();
		if($("#txtPassConfirm").val()==$("#txtNewPass").val())
		{
			$.ajax({
				type: "POST",
				url: "/SICH/main/updatePass/",
				dataType: 'json',
				data: $(this).serialize(),
				success: function(response) {
				new PNotify({
								title: 'Aviso',
								text: response,
								type: 'error'
							});
					if(response=="noPass")
					{
						new PNotify({
								title: 'Aviso',
								text: 'La constraseña ingresada no es la correcta',
								type: 'error'
							});
					}
					else
					{
						if(response){
						new PNotify({
								title: 'Aviso',
								text: 'Contraseña actulizada.',
								type: 'success'
							});
						new PNotify({
								title: 'Sesion Terminada',
								text: 'Cerrando sesión...',
								type: 'notice'
							});
							window.location.replace("/SICH/main/logout/");
							//salir de sesion
						}else{		
							new PNotify({
								title: 'Oh No!',
								text: 'Error en el registro.',
								type: 'error'
							});
						}
					}	
				}
			});
		}
		else
		{
			new PNotify({
				title: 'Aviso!',
				text: 'La nueva contraseña ingresada no coincide con su confirmación.',
				type: 'error'
			});
		}
	});
	
});