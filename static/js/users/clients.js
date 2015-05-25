$(function(){
	
	/*
	 * -------------------------------------------------------------------
	 *  Create model submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmNewClient").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/SICH/client/save_client/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					new PNotify({
						title: 'Notificación',
						text: 'Registro Exitoso',
						type: 'success'
					});
					$("#frmNewClient input[type='text']").val('');
					$("#frmNewClient input[type='email']").val('');
					create = true;
				}else{		
					new PNotify({
						title: 'Oh No!',
						text: 'Error en el registro.',
						type: 'error'
					});
				}
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteModel(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editModel) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	 $.editDeleteModel = function(btn, edt){
	 	var trId = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#mdModel").modal('show');
	 	}
	 	else
	 	{
	 		new PNotify({
				title: 'Confirmación Necesaria',
				text: 'Está Seguro de Eliminar el Modelo?',
				icon: 'glyphicon glyphicon-question-sign',
				hide: false,
				confirm: {
					confirm: true
				},
				buttons: {
					closer: false,
					sticker: false
				},
				history: {
					history: false
				}
			}).get().on('pnotify.confirm', function() {
				
				$.ajax({
					type: "POST",
					url: "/sich/car/delete_model/",
					dataType: 'json',
					data: {id:trId},
					success: function(response) {
						if(response){
							new PNotify({
								title: 'Notificación',
								text: 'El registro se ha eliminado!!',
								type: 'success'
							});
							//$("#"+trId).fadeOut('slow', function(event){$(this).remove();});
							$('#tbModels').DataTable().row( $("#"+trId) )
							.remove()
							.draw();
						}else{		
							new PNotify({
								title: 'Oh No!',
								text: 'Error en la eliminación del registro.',
								type: 'error'
							});
						}
					}
				});
				
			}).on('pnotify.cancel', function() {
				console.log('Oh ok. Chicken, I see.');
			});
	 		
	 	} 	
	 }
	 
	 
	/*
	 * -------------------------------------------------------------------
	 *  Function DataTable(bootrap)  
	 *  @param : id      => id this element dom
	 *	@param : url     => uri for ajax method in controller
	 *	@param : columns => coloumns db for dateTable
	 *	@param : fnc     => function for rederice tr
	 * -------------------------------------------------------------------
	 */
	 var lngEsp = {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		}
	};
	
	$.fnTbl = function(id, url, columns, fnc){
		$(id).dataTable( {
			ordering: true,
			"ajax": url,
			"columns": columns,
			"fnCreatedRow": fnc,
			"language": lngEsp
		} );
	}
	
	/*
	 * -------------------------------------------------------------------
	 *  Generate Table models list
	 *	function renderizeRow renderize tr, td for table
	 *	@param : btnsOpTblModels => variable(string): buttons for dateTable
	 * -------------------------------------------------------------------
	 */
	
	var btnsOpTblModels = "<button style='border: 0; background: transparent' onclick='$.editDeleteModel(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteModel(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
						  
	$.renderizeRow = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['per_ced']);
	}
	
	$.fnTbl('#tbClients',"/SICH/client/get_clients_all/",[{ "data": "per_ced"},{"data":"per_nom"},{"data":"per_ape"},{"data":"cli_tel"}],$.renderizeRow);
	
	$("#ltModel").click(function(event){
		//$("#tbModels").ajax.reload();
		if(create){
			$('#tbClients').DataTable().ajax.reload();
			create = false;
		}
	});
	
	
    
});