$(function(){
	/*
	 * -------------------------------------------------------------------
	 *  Notification Messages
	 * -------------------------------------------------------------------
	 */
	 $.successMessage = function(){
	 	new PNotify({
			title: 'Notificación',
			text : 'Registro Exitoso',
			type : 'success'
		});
	 }
	 
	 $.errorMessage = function(){
	 	new PNotify({
			title: 'Oh No!',
			text: 'Error en el registro.',
			type: 'error'
		});
	 }
	 
	 $.confirmMessage = function(fnc){
	 	new PNotify({
			title: 'Confirmación Necesaria',
			text: 'Está Seguro de Eliminar el Registro?',
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
		}).get().on('pnotify.confirm', fnc).on('pnotify.cancel', function() {
			console.log('Oh ok. Chicken, I see.');
		});
	 }
	/*
	 * -------------------------------------------------------------------
	 *  Create client submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmNewClient").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/client/save_client/",
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
	 *  Edit client submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $("#frmMdClient").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/client/edit_client/?trId="+$("#spId").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbModels').DataTable().ajax.reload();
					$("#frmMdClient input[type='text']").val('');
					$("#frmMdClient input[type='email']").val('');
					$("#mdClient").modal('hide');
					$.successMessage();
					$('#tbClients').DataTable().ajax.reload();
				}else{		
					$.errorMessage();
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
	 
	 
	 $.deleteClient = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/client/delete_client/",
			dataType: 'json',
			data: {id:trId},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbClients').DataTable().row( $("#"+trId) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			}
		});
	 }
	 
	 var trId
	 
	 $.chargeDataModal = function(id){
		$.ajax({
			type: "POST",
			url: "/sich/client/search_client_by_id",
			dataType: 'json',
			data: {id:trId},
			success: function(response) {
				$("#mdClient").modal('show');
				if(response!=null){
					var obj = eval(response);
					$('#txtNombreMd').val(obj.per_nom);
					$('#txtApellidoMd').val(obj.per_ape);
					$('#txtTelefonoMd').val(obj.cli_tel);
					$('#txtDireccionMd').val(obj.cli_dir);
					$('#txtEmailMd').val(obj.cli_eml);
				}else{
					$.errorMessage();
				}
			}
		});
	}
	 
	 $.editDeleteModel = function(btn, edt){
	 	trId = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		
	 		$("#spId").attr('data-toggle', trId);
	 		$.chargeDataModal(trId);
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteClient);
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
	   $(nRow).attr('id',aData['cli_id']);
	}
	
	$.fnTbl('#tbClients',"/sich/client/get_clients_all/",[{ "data": "per_ced"},{"data":"per_nom"},{"data":"per_ape"},{"data":"cli_tel"}],$.renderizeRow);
	
	$("#ltClient").click(function(event){
		//$("#tbModels").ajax.reload();
		if(create){
			$('#tbClients').DataTable().ajax.reload();
			create = false;
		}
	});
	
	
    
});