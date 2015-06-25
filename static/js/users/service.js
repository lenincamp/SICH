$(function(){
	
	/* =========================>>> SERVICES <<<========================= */
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
	 $("#frmMdServicio").on("submit",function(event){
		event.preventDefault();
		$("#buttonsActionEdit").html('<h4 class="text-primary">Guardando...</h4>');
		$.ajax({
			type: "POST",
			url: "/sich/service/edit_service/?trId="+$("#spIdServicio").attr('data-toggle')+"&ctgId="+$("#ctg").attr('data-toggle')+"&arsId="+$("#ars").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbService').DataTable().ajax.reload();
					$("#frmMdServicio input[type='text']").val('');
					$("#servicioModal").modal('hide');
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
	 
	 $.chargeModalService = function(){
	 $("#buttonsActionEdit").html('<h4 class="text-danger">Cargando información...</h4>');
	 var area=0, precio=0
		$.ajax({
			type: "POST",
			url: "/sich/service/search_area_service_by_id/",
			dataType: 'json',
			data: {id:trIdMd},
			success: function(response) {
				if(response){
					var areas=eval(response);
					for (var i = 0; i < areas.length; i++) {
						$("#editcat"+areas[i].art_id).prop('checked', true);
					}
					$.ajax({
						type: "POST",
						url: "/sich/service/search_price_service_by_id/",
						dataType: 'json',
						data: {id:trIdMd},
						success: function(responseP) {
							if(responseP){
								var precios=eval(responseP);
								for (var i = 0; i < precios.length; i++) {
									$("#editprc"+precios[i].cat_id).val(precios[i].dcs_prc)
								}
								$("#buttonsActionEdit").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
							}else{		
								$.errorMessage();
							}
						},
						error: function(){
							$("#servicioModal").modal('hide');
							$.errorMessage();
						}
					});
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#servicioModal").modal('show');
				$.errorMessage();
			}
		});
	 	
	 }
	 
	 var trIdMd;
	 $.editDeleteModel = function(btn, edt){
	 	trIdMd = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
			$("#servicioModal").modal('show');
	 		$("#spIdServicio").attr('data-toggle', trIdMd);
	 		$("#frmMdServicio input[type='text']").val($($("#"+trIdMd).children('td')[0]).html());
	 		$.renderizeDivDetailsService('edit_contenedor_servicios','edit');
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
	   $(nRow).attr('id',aData['srv_id']);
	   $($(nRow).children('td')[1]).attr('id',aData['srv_id']);
	}
						  
	var flagMd = true;
	$("#ltService").click(function(event){
		//$("#tbService").ajax.reload();
		if (flagMd){
			$.fnTbl('#tbService',"/sich/service/get_service_all/",[{ "data": "srv_nom"}],$.renderizeRowTbServices);
			flagMd = false;		
		}
		else if(create){
			$('#tbService').DataTable().ajax.reload();
			create = false;
		}
	});
	/*
	 * -------------------------------------------------------------------
	 *  Charge detalles de trabajo en servicio(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $.renderizeDivDetailsService = function(idCotenedor, prefijo) {
		var contenido="";
		var objAreas;
		var areas;
		var ctgid="";
		var arsid="";
		var pasoArsid=true;
		$('#'+idCotenedor).html('<h4 class="text-info">Cargando formulario, por favor espere...</h4>');
		
		$.ajax({
			type: "POST",
			async:true,
			url: "/sich/service/get_areas_enable/",
			dataType: 'json',
			success: function(response) {
				if(response){
				var obj=eval(response)
				var areas=obj.data;
				var contador=1;
					if(areas.length>0)
					{
						areas.forEach(function(entryArea) {
							var clase = contador%2==0?"":"borderRight"; 
							arsid+=","+entryArea.art_id
							contenido+="<div class='form-group col-md-6 "+clase+"'><label for='"+prefijo+"cat"+entryArea.art_id+"' style='width:90%;'>"+capitalizeFirstLetter(entryArea.art_nom)+"</label> <input type='checkbox' class='form-control' id='"+prefijo+"cat"+entryArea.art_id+"' name='"+prefijo+"cat"+entryArea.art_id+"' value='"+entryArea.art_id+"'  style='display:table-cell; height:auto; width:auto;'> </div>";
							contador++;
						});
					}
					else
					{
						contenido="<a class='btn btn-info' role='button' href='/sich/car/start'>No cuentas con ninguna categoría disponible. ¡Crealas!</a>";
					}
					$("#ars").attr('data-toggle', arsid.substring(1));
					$('#'+idCotenedor).html(contenido);
					if(prefijo=="edit")
					{
						$.chargeModalService();
					}
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	 }
	/*
	 * -------------------------------------------------------------------
	 *  Charge contenido_servicios(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $.renderizeDivContentServices = function(idCotenedor, prefijo) {
		var contenido="";
		var objAreas;
		var areas;
		var ctgid="";
		var arsid="";
		var pasoArsid=true;
		$('#'+idCotenedor).html('<h4 class="text-info">Cargando formulario, por favor espere...</h4>');
		
		$.ajax({
			type: "POST",
			async:true,
			url: "/sich/car/get_categories_all/",
			dataType: 'json',
			success: function(response) {
				if(response){
				var obj=eval(response)
				var categorias=obj.data;
					if(categorias.length>0)
					{
						categorias.forEach(function(entry) {
							ctgid+=","+entry.cat_id
							//contenido+="<fieldset class='scheduler-border'><legend class='scheduler-border'>"+capitalizeFirstLetter(entry.cat_nom)+"</legend>";
							contenido+="<fieldset class='scheduler-border' id='"+prefijo+"fs"+entry.cat_id+"'><legend class='scheduler-border'><ul id='menu1'><li>"+capitalizeFirstLetter(entry.cat_nom)+"<ul><li><a href='#' onclick=\"copiarInputs('"+prefijo+"fs"+entry.cat_id+"')\"><img src='/sich/static/img/copiar.png' style='width:15%; margin:5px;'>Copiar</a></li><li><a href='#' onclick=\"pegarInputs('"+prefijo+"fs"+entry.cat_id+"')\"><img src='/sich/static/img/pegar.png' style='width:15%; margin:5px;'>Pegar</a></li></ul></li></ul></legend>";
							$.ajax({
								type: "POST",
								async:false,  
								url: "/sich/service/get_areas_all/",
								dataType: 'json',
								success: function(responseArea) {
									if(responseArea){
									var objAreas=eval(responseArea)
									var areas=objAreas.data;
										if(areas.length>0)
										{
											areas.forEach(function(entryArea) {
												if(pasoArsid)
												{
													arsid+=","+entryArea.art_id;
												}
												contenido+="<div class='form-group col-md-6'><label for='"+prefijo+"txtPrc"+entry.cat_id+"_"+entryArea.art_id+"'>"+capitalizeFirstLetter(entryArea.art_nom)+"</label> <input type='number' step='0.01' class='form-control' id='"+prefijo+"txtPrc"+entry.cat_id+"_"+entryArea.art_id+"' name='"+prefijo+"txtPrc"+entry.cat_id+"_"+entryArea.art_id+"' value='0.00'> </div>";
											});
											pasoArsid=false;
										}
										else
										{
											contenido+="<a class='btn btn-info' role='button' onClick=\"switchTab(\'sectionB\')\" href='#'>No cuentas con ningun área de trabajo  disponible. ¡Crealas!</a>";
										}
									}else{		
										$.errorMessage();
									}
								}
							});
							contenido+="</fieldset>"
						});
					}
					else
					{
						contenido="<a class='btn btn-info' role='button' href='/sich/car/start'>No cuentas con ninguna categoría disponible. ¡Crealas!</a>";
					}
				$("#ctg").attr('data-toggle', ctgid.substring(1));
				$("#ars").attr('data-toggle', arsid.substring(1));
				$('#'+idCotenedor).html(contenido);
				if(prefijo=="edit")
				{
					$.chargeModalService();
				}
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	 }
	/* =========================>>> AREAS DE TRABAJO <<<========================= */
	
	/*
	 * -------------------------------------------------------------------
	 *  Create AREA submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	 
	var createArea = false;
	$("#frmAreaTrab").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/service/save_area/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
			var obj=eval(response)
			response=obj.insert_area
				switch(response) {
					case "2":
						$.errorMessage("El Área De Trabajo Ya Está Creada");
						break;
					case "1":
						$.successMessage();
						$.renderizeDivDetailsService('contenedor_servicios','');
						$("#frmAreaTrab input[type='text']").val('');
						createArea = true;
						break;
					case "0":
						$.errorMessage();
					default:
						console.log(response);
						console.log(typeof response);
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit area de trabajo submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 
	 $("#frmMdArea").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/service/edit_area/?trId="+$("#spIdArea").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbAreaTrab').DataTable().ajax.reload();
					$("#frmMdArea input[type='text']").val('');
					$("#frmMdArea input[type='checkbox']").prop('checked', false);
					$("#areaModal").modal('hide');
					$.successMessage();
					$.renderizeDivDetailsService('contenedor_servicios','');
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Generate Table marks list
	 *	function renderizeRow renderize tr, td for table
	 *	@param : btnsOpTblMarks => variable(string): buttons for dateTable
	 * -------------------------------------------------------------------
	 */
	var btnsOpTblMark = "<button style='border: 0; background: transparent' onclick='$.editDeleteArea(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteArea(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
						  
	$.renderizeRowTbAreas = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblMark+"</td>");
	   $(nRow).attr('id',aData['art_id']);
	}
						  
	var flagMk = true;
	$("#ltArea").click(function(event){
		if (flagMk){
			$.fnTbl('#tbAreaTrab',"/sich/service/get_areas_all/",[{"data":"art_nom"},{"data":"art_aux"}],$.renderizeRowTbAreas);
			flagMk = false;		
		}
		else if(createArea){
			$('#tbAreaTrab').DataTable().ajax.reload();
			createArea = false;
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteArea(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editMark) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	 $.deleteMark = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/service/delete_area/",
			dataType: 'json',
			data: {id:trIdArea},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbAreaTrab').DataTable().row( $("#"+trIdArea) ).remove().draw();
					$.renderizeDivDetailsService('contenedor_servicios','');
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	 }
	 
	 var trIdArea;
	 $.editDeleteArea = function(btn, edt){
	 	trIdArea = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#txtNameAreaEdit").val($($("#"+trIdArea).children('td')[0]).html());
			$("#chkEstEdit").prop('checked', ($($("#"+trIdArea).children('td')[1]).html()=="SI"));
			$("#areaModal").modal('show');
	 		$("#spIdArea").attr('data-toggle', trIdArea);
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteMark, "¿Está seguro de eliminar el Detalle de Trabajo?");
	 	} 	
	 }
    
});