$(function(){
	
	/* =========================>>> GARANTIAS <<<========================= */
	/*
	 * -------------------------------------------------------------------
	 *  Create service submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmServices").on("submit",function(event){
		$("#buttonsAction").html('<h4 class="text-primary">Guardando...</h4>');
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/service/save_service/?ctgId="+$("#ctg").attr('data-toggle')+"&arsId="+$("#ars").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					response=response.insert_service;
					switch(response) {
						case "2":
							$.errorMessage("El Servicio ya ha sido creado con anterioridad.");
							break;
						case "1":
							$.successMessage();
							$("#frmServices input[type='number']").val('0.00');
							$("#frmServices input[type='text']").val('');
							$("#frmMdArea input[type='checkbox']").prop('checked', false);
							create = true;
							$("#buttonsAction").html('<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
							break;
						case "0":
							$.errorMessage();
					}
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#buttonsAction").html('<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
				$.errorMessage();
			},
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit service submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $("#frmMdRevision").on("submit",function(event){
		event.preventDefault();
		$("#buttonsActionEdit").html('<h4 class="text-primary">Guardando...</h4>');
		$.ajax({
			type: "POST",
			url: "/sich/garantia/edit_guarantee/?id="+trIdMd,
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbOblg').DataTable().ajax.reload();
					$("#frmMdRevision input").val('');
					$("#frmMdRevision textarea").val('');
					$("#revisionModal").modal('hide');
					$("#buttonsActionEdit").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
					$.successMessage();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#buttonsActionEdit").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
				$.errorMessage();
			},
		});
	});
	 
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteService(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editModel) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	 $.deleteService = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/service/delete_service/",
			dataType: 'json',
			data: {id:trIdMd},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbService').DataTable().row( $("#"+trIdMd) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			}
		});
	 }
	 
	 $.chargeModalRevision = function(){
	 $("#buttonsActionEdit").html('<h4 class="text-danger">Cargando información...</h4>');
	 $("#revisionModal input").val("")
	 $("#revisionModal textarea").val("")
	var area=0, precio=0
		$.ajax({
			type: "POST",
			url: "/sich/garantia/get_guarantee_by_id/",
			dataType: 'json',
			data: {id:trIdMd},
			success: function(response) {
				if(response){
					var data=response.data
					$("#txtFechaRev").val(data.rev_fch)
					$("#txtClienteRev").val(data.nombre)
					$("#txtVehiculoRev").val(data.auto)
					$("#txtPlacaRev").val(data.veh_pla)
					$("#txtServRev").val(data.servs)
					$("#txtNumRev").val(data.ord_num)
					$("#txtFchEmiRev").val(data.ord_fch)
					$("#buttonsActionEdit").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
					
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#revisionModal").modal('hide');
				$.errorMessage();
			}
		});
	 	
	 }
	 
	 var trIdMd;
	 $.editDeleteModel = function(btn, edt){
	 	trIdMd = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
			$.chargeModalRevision();
			$("#revisionModal").modal('show');
	 		$("#spIdRevision").attr('data-toggle', trIdMd);
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteService);
	 	} 	
	 }
	
	/*
	 * -------------------------------------------------------------------
	 *  Generate Table models list
	 *	function renderizeRow renderize tr, td for table
	 *	@param : btnsOpTblServices => variable(string): buttons for dateTable
	 * -------------------------------------------------------------------
	 */
	
	var btnsOpTblServices = "<button style='border: 0; background: transparent' onclick='$.editDeleteModel(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteModel(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
						  
	$.renderizeRowTbServices = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblServices+"</td>");
	   $(nRow).attr('id',aData['rev_id']);
	   var clase=""
		if(aData['dias']==0)
		{
			clase="bg-alter2";
		}
		if((aData['dias']<0 && aData['dias']>=-3)||(aData['dias']>0 && aData['dias']<=3))
		{
			clase="bg-alert1";
		}
	   $(nRow).addClass(clase);
	   $($(nRow).children('td')[4]).html(capitalizeFirstLetter($($(nRow).children('td')[4]).html()));
	}
	$.fnTbl('#tbOblg',"/sich/garantia/get_guarantee_all/",[{ "data": "rev_fch"},{ "data": "nombre"},{ "data": "auto"},{ "data": "veh_pla"},{ "data": "servs"}],$.renderizeRowTbServices);
								  
	var flagMd = false;
	$("#ltOblg").click(function(event){
		//$("#tbService").ajax.reload();
		if (flagMd){
			$.fnTbl('#tbOblg',"/sich/garantia/get_guarantee_all/",[{ "data": "rev_fch"},{ "data": "nombre"},{ "data": "auto"},{ "data": "veh_pla"},{ "data": "servs"},{ "data": "ord_num"},{ "data": "ord_fch"}],$.renderizeRowTbServices);
			flagMd = false;		
		}
		else if(create){
			$('#tbOblg').DataTable().ajax.reload();
			create = false;
		}
	});
	
});