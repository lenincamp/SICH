/* global $ */
/* global PNotify */
$(function(){
	
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
			url: "/sich/client/save_client/?tels="+tels,
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				var obj = eval(response);
				response=obj.insert_client;
				if(response=="2")
				{
					$.errorMessage('La C.I./R.U.C. ingresado ya se encuentra registrado.');
				}
				else
				{
					if(response=="1"){
						$.successMessage('Registro Exitoso');
						$("#frmNewClient input[type='text']").val('');
						$("#frmNewClient input[type='email']").val('');
						create = true;
					}else{		
						$.errorMessage('Error en el Registro');
					}
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
	 };
	 
	 var trId;
	 
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
	};
	 
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
	 };
	
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
	
	$.loadTelsCli = function( btn ){
		
		$.post("/sich/client/get_tels_all/", {id:btn}, function( response ) {
			
			if( response.length != 0 ){
				var ol = "<ol>";
				$.each(response, function( index, val ){
					ol += "<li>"+val.tel_num+"</li>";
				});
				ol += "</ol>";
				$("#"+btn).popover({
					html: true,
	                animation: false,
	                content: ol,
				    placement: 'bottom'
				});
			}else{
				
				$("#"+btn).popover({
					html: true,
	                animation: false,
	                content: "El Cliente no tiene registrados número de teléfono",
				    placement: 'bottom'
				});
			}
		},'json');
	};
					  
	$.renderizeRow = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'><button id='"+aData['cli_id']+"' onclick='$.loadTelsCli(this.id);'>ver</button></td><td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['cli_id']);
	};
	
	$.fnTbl('#tbClients',"/sich/client/get_clients_all/",[{ "data": "per_ced"},{"data":"per_nom"},{"data":"per_ape"}],$.renderizeRow);
	
	$("#ltClient").click(function(event){
		if(create){
			$('#tbClients').DataTable().ajax.reload();
			create = false;
		}
	});
	
	var tels = [];
	$("#btnTels").click(function ( event ) {
		if( $("#txtTelefono").val().length === 10 ) {
			tels.push($("#txtTelefono").val());
			$("#tbodyTels").append("<tr><td class='text-center'>"+$("#txtTelefono").val()+"</td></tr>");
			$($("#txtTelefono").val('')).focus();
			$("#divTbTels").fadeIn('fast');
		}
	});
	
	
    
});