$(function(){
	
	/* =========================>>> GARANTIAS <<<========================= */
	/*
	 * -------------------------------------------------------------------
	 *  Create service submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmRevision").on("submit",function(event){
		event.preventDefault();
		if(trIdOrd==null||trIdOrd=="undefinied")
		{
			$.errorMessage("No ha seleccionado ninguna orden del trabajo. Por favor seleccione una.");
		}
		else
		{
			$("#buttonsAction").html('<h4 class="text-primary">Guardando...</h4>');
			$.ajax({
				type: "POST",
				url: "/sich/garantia/save_guarantee/?idOrd="+trIdOrd,
				dataType: 'json',
				data: $(this).serialize(),
				success: function(response) {
					if(response){
							$.successMessage();
							$("#frmRevision input[type='date']").val('');
							$("#frmRevision input[type='text']").val('');
							$("#frmRevision input[type='checkbox']").prop('checked', false);
							$("#frmRevision textarea").val('');
							create = true;
							trIdOrd=null;
							$("#tbOrdenes").find("tr:gt(0)").removeClass("bg-info");
							$("#buttonsAction").html('<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
							$('#tbOblg').DataTable().ajax.reload();
					}else{		
						$.errorMessage();
					}
				},
				error: function(){
					$("#buttonsAction").html('<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
					$.errorMessage();
				},
			});
		}
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
			url: "/sich/garantia/check_guarantee/?id="+trIdMd,
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
			},
			error: function(){
				$.errorMessage();
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
	
	var btnsOpTblServices = "<button style='border: 0; padding:2px; background: transparent' onclick='$.editDeleteModel(this, true);'>"+
							"<img src='/sich/static/img/revisar.png' title='Atender' height='20'>"+
						  "</button>"+
						  "<button style='border: 0; padding:2px; background: transparent' onclick='$.sendMsg(this);'>"+
							"<img src='/sich/static/img/mensaje.png' title='Mensaje' height='20'>"+
						  "</button>"+
						  "<button style='border: 0; padding:2px; background: transparent' onclick='$.editDeleteModel(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar' height='20'>"+
						  "</button>";
						  
	$.renderizeRowTbServices = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblServices+"</td>");
	   $(nRow).attr('id',aData['rev_id']);
	   var clase=""
		if(aData['dias']==0)
		{
			clase="bg-alert2";
		}
		if((aData['dias']<0 && aData['dias']>=-3)||(aData['dias']>0 && aData['dias']<=3))
		{
			clase="bg-alert1";
		}
	   $(nRow).addClass(clase);
	   $($(nRow).children('td')[4]).html(capitalizeFirstLetter($($(nRow).children('td')[4]).html()));
	   $($(nRow).children('td')[5]).html($($(nRow).children('td')[5]).html()=="t"?"Si":"No");
	   $($(nRow).children('td')[6]).css('padding','1px');
	}
	$.fnTbl('#tbOblg',"/sich/garantia/get_guarantee_pending_all/",[{ "data": "rev_fch"},{ "data": "nombre"},{ "data": "auto"},{ "data": "veh_pla"},{ "data": "servs"},{ "data": "rev_obl"}],$.renderizeRowTbServices);
	
	/*
	 * -------------------------------------------------------------------
	 *  Tabla ordenes de trabajo
	 * -------------------------------------------------------------------
	 */
	
	 
	var trIdOrd;
	$.selectOrd=function(btn)
	{
		trIdOrd = $.trim($($($(btn).parent()).parent()).attr('id'));
		$("#tbOrdenes").find("tr:gt(0)").removeClass("bg-info");
		$("#"+trIdOrd).addClass("bg-info");
	}
	
	var btnsOpTblOrders =  "<button style='border: 0; background: transparent' onclick='$.selectOrd(this); return false;'>"+
							"<img src='/sich/static/img/select.png' width='24' title='Seleccionar'>"+
						  "</button>";
	
	$.renderizeRowTbOrdenes = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblOrders+"</td>");
	   $(nRow).attr('id',aData['ord_id']);
	}
	
	var flagMd = true;
	$("#ltCrt").click(function(event){
		if (flagMd){
			$.fnTbl('#tbOrdenes',"/sich/garantia/get_orders_guarantee_all/",[{ "data": "ord_num"},{ "data": "ord_fch"},{ "data": "nombre"},{ "data": "auto"},{ "data": "veh_pla"},{ "data": "servs"}],$.renderizeRowTbOrdenes);
			flagMd = false;		
		}
		else{
			$('#tbOrdenes').DataTable().ajax.reload();
		}
	});
	
	
	/*
	 * -------------------------------------------------------------------
	 *  Tabla todas las garantias
	 * -------------------------------------------------------------------
	 */
	 
	 $.chargeModalEdicion = function(){
	 $("#buttonsActionEdicion").html('<h4 class="text-danger">Cargando información...</h4>');
	 $("#edicionModal input").val("")
	 $("#edicionModal textarea").val("")
	var area=0, precio=0
		$.ajax({
			type: "POST",
			url: "/sich/garantia/get_guarantee_by_id/",
			dataType: 'json',
			data: {id:trIdEd},
			success: function(response) {
				if(response){
					var data=response.data
					$("#txtFechaEdit").val(data.rev_fch)
					$("#txtClienteEdit").val(data.nombre)
					$("#txtVehiculoEdit").val(data.auto)
					$("#txtPlacaEdit").val(data.veh_pla)
					$("#txtServEdit").val(data.servs)
					$("#txtNumEdit").val(data.ord_num)
					$("#txtFchEmiEdit").val(data.ord_fch)
					$("#txtObsEdit").val(data.rev_obs)
					$("#chkOblgEdit").prop("checked",data.rev_obl=="t"?true:false)
					$("#chkPendEdit").prop("checked",data.rev_est=="f"?true:false)
					$("#buttonsActionEdicion").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
					
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#edicionModal").modal('hide');
				$.errorMessage();
			}
		});
	 	
	 }
	 
	 var trIdEd;
	 $.editGarant = function(btn){
	 	trIdEd = $($($(btn).parent()).parent()).attr('id');
		$.chargeModalEdicion();
		$("#edicionModal").modal('show');
		$("#spIdEdicion").attr('data-toggle', trIdEd);
	}
	$.sendMsgAction = function(){
		var data = {"id":trIdEd};
			$.post("/sich/orden/sendMailGmail/", data, function(response){
				console.log(response);
				if(response=="no email")
				{
					$.errorMessage("E-mail del cliente no encontrado!");
				}
				else{
					if(response){	
						$.successMessage();
					}else{
						if(!response){
							$.errorMessage("Error al enviar carta de garantía, por favor intente de nuevo!");
						}
					}
				}
			}, 'json');
	}
	$.sendMsg = function(btn){
	 	trIdEd = $($($(btn).parent()).parent()).attr('id');
		$.confirmMessage($.sendMsgAction,"¿Está seguro de enviar la carta de garantía?");
	}
	var btnsOpTblAllGarant = "<button style='border: 0; padding:2px; background: transparent' onclick='$.editGarant(this);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar' width='20'>"+
						  "</button>"+
						  "<button style='border: 0; padding:2px; background: transparent' onclick='$.sendMsg(this);'>"+
							"<img src='/sich/static/img/mensaje.png' title='Mensaje' width='20'>"+
						  "</button>"+
						  "<button style='border: 0; padding:2px; background: transparent' onclick='$.editDeleteModel(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar' width='20'>"+
						  "</button>";
	$.renderizeRowTbAllGarant = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblAllGarant+"</td>");
	   $(nRow).attr('id',aData['rev_id']);
	   var clase=""
		if(aData['rev_est']=="t")
		{
			clase="bg-success";
		}
	   $(nRow).addClass(clase);
	   $($(nRow).children('td')[4]).html(capitalizeFirstLetter($($(nRow).children('td')[4]).html()));
	   $($(nRow).children('td')[5]).html($($(nRow).children('td')[5]).html()=="t"?"Si":"No");
	   $($(nRow).children('td')[6]).css('padding','1px');
	}
	var flagGr = true;
	$("#ltListGarant").click(function(event){
		if (flagGr){
			$.fnTbl('#tbListRev',"/sich/garantia/get_guarantee_all/",[{ "data": "rev_fch"},{ "data": "nombre"},{ "data": "auto"},{ "data": "veh_pla"},{ "data": "servs"},{ "data": "rev_obl"}],$.renderizeRowTbAllGarant);
			flagGr = false;		
		}
		else if(create){
			$('#tbListRev').DataTable().ajax.reload();
			create = false;
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  EDITAR GARANTIA
	 * -------------------------------------------------------------------
	 */
	 
	$("#frmMdEdicion").on("submit",function(event){
		event.preventDefault();
		$("#buttonsActionEdicion").html('<h4 class="text-primary">Guardando...</h4>');
		$.ajax({
			type: "POST",
			url: "/sich/garantia/edit_guarantee/?id="+trIdEd,
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbOblg').DataTable().ajax.reload();
					$('#tbListRev').DataTable().ajax.reload();
					$("#frmMdEdicion input").val('');
					$("#frmMdEdicion textarea").val('');
					$("#edicionModal").modal('hide');
					$("#buttonsActionEdicion").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
					$.successMessage();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#buttonsActionEdicion").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
				$.errorMessage();
			},
		});
	});
});