$(function(){
	
	/* =========================>>> SERVICES <<<========================= */
	/*
	 * -------------------------------------------------------------------
	 *  Create service submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmServices").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/service/save_service/?ctgId="+$("#ctg").attr('data-toggle')+"&arsId="+$("#ars").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					console.log(response);
					var obj=eval(response);
					response=response.insert_service;
					switch(response) {
						case "2":
							$.errorMessage("El Servicio ya ha sido creado con anterioridad.");
							break;
						case "1":
							$.successMessage();
							$("#frmServices input[type='number']").val('0.00');
							create = true;
							break;
						case "0":
							$.errorMessage();
						default:
							console.log(response);
							console.log(typeof response);
					}
				}else{		
					$.errorMessage();
				}
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit service submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $("#frmMdModel").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/edit_model/?trId="+$("#spId").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbModels').DataTable().ajax.reload();
					$("#frmMdModel input[type='text']").val('');
					$('.cmbMarkMd').selectpicker('refresh');
					$("#mdModel").modal('hide');
					$.successMessage();
				}else{		
					$.errorMessage();
				}
			}
		});
	});
	 
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteService(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editModel) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	 $.deleteModel = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/car/delete_model/",
			dataType: 'json',
			data: {id:trIdMd},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbModels').DataTable().row( $("#"+trId) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			}
		});
	 }
	 
	 var trIdMd;
	 $.editDeleteModel = function(btn, edt){
	 	trIdMd = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#mdModel").modal('show');
	 		$("#spId").attr('data-toggle', trIdMd);
	 		$("#frmMdModel input[type='text']").val($($("#"+trIdMd).children('td')[0]).html());
	 		$("#cmbMarkMd").selectpicker('val', $($("#"+trIdMd).children('td')[1]).attr('id'));
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteModel);
	 	} 	
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
						  
	$.renderizeRowTbModels = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['mod_id']);
	   $($(nRow).children('td')[1]).attr('id',aData['mar_id']);
	}
						  
	var flagMd = true;
	$("#ltModel").click(function(event){
		//$("#tbModels").ajax.reload();
		if (flagMd){
			$.fnTbl('#tbModels',"/sich/car/get_models_all/",[{ "data": "mod_nom"},{"data":"mar_nom"}],$.renderizeRowTbModels);
			flagMd = false;		
		}
		else if(create){
			$('#tbModels').DataTable().ajax.reload();
			create = false;
		}
	});
	/*
	 * -------------------------------------------------------------------
	 *  Charge contenido_servicios(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $.renderizeDivContentServices = function() {
		var contenido="";
		var objAreas;
		var areas;
		var ctgid="";
		var arsid="";
		var pasoArsid=true;
		$('#contenedor_servicios').html('<h4 class="text-info">Cargando formulario, por favor espere...</h4>');
		
		$.ajax({
			type: "POST",
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
							contenido+="<fieldset class='scheduler-border' id='fs"+entry.cat_id+"'><legend class='scheduler-border'><ul id='menu1'><li>"+capitalizeFirstLetter(entry.cat_nom)+"<ul><li><a href='#' onclick=\"copiarInputs('fs"+entry.cat_id+"')\"><img src='/sich/static/img/copiar.png' style='width:15%; margin:5px;'>Copiar</a></li><li><a href='#' onclick=\"pegarInputs('fs"+entry.cat_id+"')\"><img src='/sich/static/img/pegar.png' style='width:15%; margin:5px;'>Pegar</a></li></ul></li></ul></legend>";
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
												contenido+="<div class='form-group col-md-6'><label for='txtPrc"+entry.cat_id+"_"+entryArea.art_id+"'>"+capitalizeFirstLetter(entryArea.art_nom)+"</label> <input type='number' step='0.01' class='form-control' id='txtPrc"+entry.cat_id+"_"+entryArea.art_id+"' name='txtPrc"+entry.cat_id+"_"+entryArea.art_id+"' value='0.00'> </div>";
											});
											pasoArsid=false;
										}
										else
										{
											contenido+="<a class='btn btn-info' role='button' onClick=\"switchTab(\'sectionB\')\" href='#'>No cuentas con ningun área de trabajo  disponible. ¡Crealas!</a>";
										}
									//$('#contenedor_servicios').html(contenido);
										//for recorriendo areas de trabajo
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
				$('#contenedor_servicios').html(contenido);
				}else{		
					$.errorMessage();
				}
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
						$("#frmAreaTrab input[type='text']").val('');
						createArea = true;
						break;
					case "0":
						$.errorMessage();
					default:
						console.log(response);
						console.log(typeof response);
				}
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
					$.renderizeDivContentServices();
				}else{		
					$.errorMessage();
				}
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
			$.renderizeDivContentServices();
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
			url: "/sich/car/delete_mark/",
			dataType: 'json',
			data: {id:trIdArea},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbAreaTrab').DataTable().row( $("#"+trIdArea) ).remove().draw();
				}else{		
					$.errorMessage();
				}
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
	 		$.confirmMessage($.deleteMark, "Si elimina la marca se eliminaran todos sus modelos. <br> ¿Está Seguro De Eliminar La Marca?");
	 	} 	
	 }
    
});