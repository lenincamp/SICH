$(function(){
	var edicion=false;
	var flagCostos=true
	/* =========================>>> ORDEN DE TRABAJO <<<========================= */
	/*
	 * -------------------------------------------------------------------
	 *  Charge servicios en orden de trabajo(Ajax)
	 * -------------------------------------------------------------------
	 */
	 $.renderizeDivDetailsService = function(idCotenedor, prefijo,idChk) {
		var arrayAreas=new Array();
		var contenido=$('#'+idCotenedor).html();
		//var contenido="";
		var objAreas;
		var areas;
		var ctgid="";
		var arsid="";
		var pasoArsid=true;
		$('#'+idCotenedor).html('<h4 class="text-info">Cargando formulario, por favor espere...</h4>');
		setTimeout(function() {
			$.ajax({
				type: "POST",
				async:true,
				url: "/sich/service/get_das_by_idServ/",
				dataType: 'json',
				data:{id:idChk},
				success: function(response) {
				console.log(response)
					if(response){
					var areas=eval(response)
					var contador=1;
						if(areas.length>0)
						{
							var idServicio;
							if(window.servicios.length==0)
							{
								areas.forEach(function(entryArea) {
									idServicio=entryArea.srv_id;
									var clase = contador%3==0?"":"borderRight"; 
									arsid+=","+entryArea.art_id
									contenido+="<div id='div"+prefijo+"cat"+entryArea.art_id+"' class='form-group col-md-4 "+clase+"'><label for='"+prefijo+"cat"+entryArea.art_id+"' style='width:90%;'>"+capitalizeFirstLetter(entryArea.art_nom)+"</label> <input type='checkbox' checked='true' class='form-control' id='"+prefijo+"cat"+entryArea.art_id+"' name='"+prefijo+"cat"+entryArea.art_id+"' value='"+entryArea.art_id+"'  style='display:table-cell; height:auto; width:auto;'> </div>";
									contador++;
									arrayAreas.push(prefijo+"cat"+entryArea.art_id)
								});
							}
							else
							{
								areas.forEach(function(entryArea) {
									if(!buscarServicio(entryArea.art_id))
									{
										idServicio=entryArea.srv_id;
										var clase = contador%3==0?"":"borderRight"; 
										arsid+=","+entryArea.art_id
										contenido+="<div id='div"+prefijo+"cat"+entryArea.art_id+"' class='form-group col-md-4 "+clase+"'><label for='"+prefijo+"cat"+entryArea.art_id+"' style='width:90%;'>"+capitalizeFirstLetter(entryArea.art_nom)+"</label> <input type='checkbox' checked='true' class='form-control' id='"+prefijo+"cat"+entryArea.art_id+"' name='"+prefijo+"cat"+entryArea.art_id+"' value='"+entryArea.art_id+"'  style='display:table-cell; height:auto; width:auto;'> </div>";
										contador++;
										arrayAreas.push(prefijo+"cat"+entryArea.art_id)
									}
									else
									{
										idServicio=entryArea.srv_id;
										arrayAreas.push(prefijo+"cat"+entryArea.art_id)
									}
									
								});
							}
							 window.servicios[idServicio]=arrayAreas;
							 console.log(window.servicios)
						}
						else
						{
							contenido="<a class='btn btn-info' role='button' href='/sich/car/start'>No cuentas con ninguna categoría disponible. ¡Crealas!</a>";
						}
					$("#ars").attr('data-toggle', arsid.substring(1));
					$('#'+idCotenedor).html($('#'+idCotenedor).html()=='<h4 class="text-info">Cargando formulario, por favor espere...</h4>'?contenido.replace('<h4 class="text-info">Cargando formulario, por favor espere...</h4>',''):($('#'+idCotenedor).html()+contenido).replace('<h4 class="text-info">Cargando formulario, por favor espere...</h4>',''));
					//$('#'+idCotenedor).html(contenido.replace('<h4 class="text-info">Cargando formulario, por favor espere...</h4>',''));
					 bordesDivs("orden")
					 $.cargarCostos();
					 window.flag=true
					}else{		
						$.errorMessage();
					}
				}
			});
		}, 500);
	 }
	 
	 $.createTable=function(id)
	 {
		var extra=edicion?"Edit":"";
		var contenido="<table data-order='[[ 0, \"asc\" ],[ 0, \"asc\" ],[ 0, \"asc\" ],[ 0, \"asc\" ],[ 0, \"asc\" ]]' class=\"table table-hovered table-bordered\" cellspacing=\"0\" width=\"100%\" id=\"tbCars"+id+"\"><thead><tr><th class=\"text-center\">Marca</th><th class=\"text-center\">Modelo</th><th class=\"text-center\">Categoría</th><th class=\"text-center\">Placa</th><th class=\"text-center\">Color</th><th class=\"text-center\">Acción</th></tr></thead></table>";
		$("#tableCars"+extra).html(contenido);
	 }
	 
	$.inputsMdCli = function(response){
		//$('#tbCars').empty();
		var extra=edicion?"Edit":"";
		$("#tableCars"+extra).html("");
		$.createTable(response.cli_id)
		$("#spClient"+extra).attr("data-toggle", response.cli_id);
		$("#txtNombre"+extra).val(response.per_nom+" "+response.per_ape);
		$("#txtTelefono"+extra).val(response.cli_tel);
		$("#txtEmail"+extra).val(response.cli_eml);
		$("#txtDireccion"+extra).val(response.cli_dir);
		$.cargarAutos(response.cli_id)
	}
		
	$.searchClientByCi = function(ci, msg, mdl){
		msg = typeof msg !== 'undefined' ? msg : false;
		mdl = typeof mdl !== 'undefined' ? mdl : false;
		var number = ci.length;
		if( number == 10 ){
			var data = {"ci":ci};
			$.post("/sich/client/search_client_by_id/", data, function(response){
				if( response !== null ){	
						$.inputsMdCli(response);
				}else{
					if(msg){
						$.errorMessage("Cliente No Existe!");
					}
				}
			}, 'json');
		}
	}
	
	$("#txtCedula").focusout(function(event){
		$.searchClientByCi($.trim($(this).val()));
	});
	$("#txtCedulaEdit").focusout(function(event){
		$.searchClientByCi($.trim($(this).val()));
	});
	
	$("#searchClient").click(function(){
		$.searchClientByCi($.trim($("#txtCedula").val()), true);
	});
	$("#searchClientEdit").click(function(){
		$.searchClientByCi($.trim($("#txtCedulaEdit").val()), true);
	});
	var idVeh=""
	$.selectCar=function(btn)
	{
		var extra=edicion?"Edit":"";
		$("#costosServicio"+extra).html("")
		trIdCar = $.trim($($($(btn).parent()).parent()).attr('id'));
		idVeh=trIdCar
		dataTogCar = $.trim($($($(btn).parent()).parent()).attr('data-toggle'));
		$("#tbCars"+dataTogCar).find("tr:gt(0)").removeClass("bg-info");
		$("#"+trIdCar).addClass("bg-info");
		catActual=$("#"+trIdCar+" td:nth-child(3)").attr('id');
		$.cargarCostos();
	}
	 
	 var btnsOpTblCars =  "<button style='border: 0; background: transparent' onclick='$.selectCar(this); return false;'>"+
							"<img src='/sich/static/img/select.png' width='24' title='Seleccionar'>"+
						  "</button>";
	 $.renderizeRowTbCars = function( nRow, aData, iDataIndex ) {
		$(nRow).append("<td id='"+aData['veh_col']+"'><div style='border:1px solid #ccc;margin:auto;width:24px;height:24px;background-color:"+aData['veh_col']+";'></div></td><td class='text-center'>"+btnsOpTblCars+"</td>");
		$(nRow).attr('id',aData['veh_id']+"Car");
		$(nRow).attr('data-toggle',aData['cli_id']);
		$($(nRow).children('td')[0]).attr("id",aData['mar_id']);
		$($(nRow).children('td')[1]).attr("id",aData['mod_id']);
		$($(nRow).children('td')[2]).attr("id",aData['cat_id']);
		$($(nRow).children('td')[2]).html(capitalizeFirstLetter($($(nRow).children('td')[2]).html()));
	}
	
	$.cargarAutos = function(id){
		$("#tbCars"+id).find("tr:gt(0)").remove();
		//'cli_id, per_ced, per_nom, per_ape, marca.*, modelo.*, veh_pla, veh_col, veh_id'
			var data = [
				{"data":"mar_nom"},
				{"data":"mod_nom"},
				{"data":"cat_nom"},
				{"data":"veh_pla"}
				//{"data":"veh_col"}
			];
			$.fnTbl('#tbCars'+id,"/sich/car/get_for_client/?id="+id,data,$.renderizeRowTbCars);
	}
	/*
	 * -------------------------------------------------------------------
	 *  Añadiendo evento change a checkboxes de reserva 
	 * -------------------------------------------------------------------
	 */
	$("#chkReservaEdit").change(function(event){
		if($(this).is(":checked")) {
			$('#divAbonoEdit').show();
		}
		else
		{
			$('#divAbonoEdit').hide();
		}
	});
	$("#chkReserva").change(function(event){
		if($(this).is(":checked")) {
			$('#divAbono').show();
		}
		else
		{
			$('#divAbono').hide();
		}
	});
	/*
	 * -------------------------------------------------------------------
	 *  Añadiendo campos con precios de cada servicio seleccionado 
	 * -------------------------------------------------------------------
	 */
	 var catActual="0";
	function buscarPrecios(element, index, array) {
		if(element.length>0)
		{
			var servTemp=$("#servicios").attr("data-toggle");
			if(servTemp=="")
			{
				servTemp=index;
			}
			else
			{
				servTemp+=","+index;
			}
			$("#servicios").attr("data-toggle",servTemp)
			var extra=edicion?"Edit":"";
			var contenido=$("#costosServicio"+extra).html();
			var data = {"id":index,"cat":catActual};
			//$.post("/sich/service/search_service_by_id_and_cat/", data, function(response){
			$.ajax({
			type: "POST",
			async:false,
			url: "/sich/service/search_service_by_id_and_cat",
			dataType: 'json',
			data:{"id":index,"cat":catActual},
			success: function(response) {
					if( response !== null ){
							response=response.data[0]
							contenido+="<div  class='form-group col-sm-6' id='divCst"+extra+response.srv_id+"'><label for='prc"+extra+response.srv_id+"'>"+response.srv_nom+"</label><input class='form-control' onkeyup='$.calcularTotal()' type='number' step='0.01' id='prc"+extra+response.srv_id+"' name='prc"+extra+response.srv_id+"' value='"+response.dcs_prc+"'></div>" ;
							console.log(contenido)
							if(edicion)
							{
								$("#costosServicioEdit").html(contenido);
							}
							else
							{
								$("#costosServicio").html(contenido);
							}
					}else{
						if(msg){
							$.errorMessage("servicio No Existe!");
						}
					}
				}
				//}, 'json');
			});	
		}
	}
	$.cargarCostos = function(){
		if(catActual!="0")
		{
			$("#servicios").attr("data-toggle","");
			var extra=edicion?"Edit":"";
			$("#costosServicio"+extra).html("")
			//$("#costosServicio").html($("#costosServicio").html()==""?"<h4 class='text-info'>Cargando precios, por favor espere...</h4>":$("#costosServicio").html());
			window.servicios.forEach(buscarPrecios)
			$.calcularTotal()
		}
	}
	/*
	 * -------------------------------------------------------------------
	 *  Calculo del costo total 
	 * -------------------------------------------------------------------
	 */
	$.calcularTotal = function()
	{
		var inputs=edicion?$('#costosServicioEdit').find("input"):$('#costosServicio').find("input");
		var total=0;
		for(var i=0; i<inputs.length; i++)
		{
			total +=Number(inputs[i].value)
		}
		if(edicion)
		{
			$('#txtCostoEdit').val(total)
		}
		else
		{
			$('#txtCosto').val(total)
		}
	}
	/*
	 * -------------------------------------------------------------------
	 *  Create orden submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	 var arrayConcatenado= new Array()
	 function unirArrays(element, index, array) {
		if(arrayConcatenado.lenght==0)
		{
			arrayConcatenado=getIdsArray(element.slice(),3)
		}
		else
		{
			arrayConcatenado=arrayConcatenado.concat(getIdsArray(element.slice(),3))
		}
	}
	function getIdsArray(arr, index)
	{
		for(var i=0; i<arr.length; i++)
		{
			arr[i]=(arr[i].replace("Edit","")).substring(index)
		}
		return arr
	}
	var create = false;
	$("#frmOrd").on("submit",function(event){
		$("#buttonsAction").html('<h4 class="text-primary">Guardando...</h4>');
		event.preventDefault();
		arrayConcatenado= new Array()
		var idsArt=window.servicios
		idsArt.forEach(unirArrays)
		idsArt=eliminateDuplicates(arrayConcatenado)
		console.log("detalles::::"+idsArt)
		var inv=$("#idsInv").attr("data-toggle")
		var srv=$("#servicios").attr("data-toggle")
		$.ajax({
			type: "POST",
			url: "/sich/orden/save_orden/?idsArt="+idsArt+"&idsInv="+inv+"&srv="+srv+"&idVeh="+idVeh+"&cmb="+window.combustible,
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					response=response.insert_orden;
					switch(response) {
					case "0":
						$.errorMessage();
						break;
					default:
						$.successMessage("La orden de trabajo N°"+response+" ha sido guardada de forma correcta.");
						$("#frmOrd input[type='text']").val('');
						$("#frmOrd input[type='number']").val('0.00');
						$("#frmOrd input[type='date']").val('');
						$("#frmOrd input[type='checkbox']").prop("check",false);
						$("#tableCars").html("");
						window.servicios=new Array();
						limpiar($("#limpiaInsert"));
						create = true;
						$("#buttonsAction").html('<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
						console.log(response);
						break;
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
	 *  Generate Table models list
	 *	function renderizeRow renderize tr, td for table
	 *	@param : btnsOpTblModels => variable(string): buttons for dateTable
	 * -------------------------------------------------------------------
	 */
	 $.deleteOrden = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/orden/delete_orden/",
			dataType: 'json',
			data: {id:trIdOrd},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbOrd').DataTable().row( $("#"+trIdOrd) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			}
		});
	 }
	 
	 var trIdOrd;
	 $.editDeleteOrden = function(btn, edt){
	 	trIdOrd = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
			flagCostos=false
	 		$("#mdOrden").modal('show');
			$.chargeOrder(trIdOrd)
			$("#spIdOrden").attr('data-toggle', trIdOrd);
	 		//$.renderizeDivDetailsService('edit_contenedor_servicios','edit');
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteOrden,"¿Está seguro de eliminar la Orden de Trabajo?");
	 	} 	
	 }
	var btnsOpTblModels = "<button style='border: 0; background: transparent' onclick='$.editDeleteOrden(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteOrden(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent;' onclick='$.editDeleteOrden(this, false);'>"+
							"<img src='/sich/static/img/imprimir.png' title='Imprimir' height=24px;>"+
						  "</button>";
						  
	$.renderizeRowTbModels = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['ord_id']);
	   $($(nRow).children('td')[5]).html($($(nRow).children('td')[5]).html()=="t"?"SI":"NO");
	}
	

	$("#ltCrt").click(function(event){
		$("#tableCarsEdit").html("");
		edicion=false;
		flagCostos=true
		window.servicios= new Array()
	});
	var flagMd = true;
	$("#ltOrd").click(function(event){
		$("#tableCars").html("");
		edicion=true
		window.servicios= new Array()
		//$("#tbModels").ajax.reload();
		if (flagMd){
			$.fnTbl('#tbOrd',"/sich/orden/get_orders_all/",[{ "data": "ord_num"},{"data":"ord_fch"},{"data":"nombre_cliente"},{"data":"ord_fch_ing"},{"data":"ord_fch_ent"},{"data":"ord_rsv"},{"data":"ord_cst"}],$.renderizeRowTbModels);
			flagMd = false;		
		}
		else if(create){
			$('#tbOrd').DataTable().ajax.reload();
			create = false;
		}
	});
	/*
	 * -------------------------------------------------------------------
	 *  Carga de informacion en modal de edicion de orden de trabajo
	 * -------------------------------------------------------------------
	 */
	$.chargeOrder = function(id)
	{
		setTimeout(function() {
			$.ajax({
			type: "POST",
			async:true,
			url: "/sich/orden/search_order",
			dataType: 'json',
			data:{"id":id},
			success: function(response) {
					if( response !== null ){
							basico=response.data[0][0]
							invent=response.data[1][0]
							piezas=response.data[2]
							servs=response.data[3]
							details=response.data[4]
							var intervalCst=new Array();
							$("#txtNumeroOrdenEdit").val(basico.ord_num)
							$("#txtFechaEdit").val(basico.ord_fch)
							$("#txtFechaIngresoEdit").val(basico.ord_fch_ing)
							$("#txtFechaEntregaEdit").val(basico.ord_fch_ent)
							$("#txtCostoEdit").val(basico.ord_cst)
							$("#slcFormaPAgoEdit").val(basico.id_fpg)
							$("#txtTarjetaEdit").val(basico.ord_trj)
							$("#chkReservaEdit").prop("checked",basico.ord_rsv=="t"?true:false)
							$("#txtObservacionesGeneralEdit").val(basico.ord_obs)
							$("#txtCedulaEdit").val(basico.per_ced)
							$.searchClientByCi(basico.per_ced, true);
							var timesRun = 0;
							var interval = setInterval(function(){
								timesRun += 1;
								if(timesRun === 25 || $("#"+basico.veh_id+"Car").length){
									console.log("basico")
									clearInterval(interval);
								}
								var btn=$("#"+basico.veh_id+"Car").find("button")
								$.selectCar($(btn[0]));
							}, 1000);
							$("#txtKilometrajeEdit").val(invent.inv_kil)
							$("#txtObservacionInventarioEdit").val(invent.inv_obs)
							for(var k=0; k<piezas.length; k++)
							{
								$("#invEdit"+piezas[k].pie_id).prop("checked",true)
							}
							var coord=invent.inv_com.split("-")
							dibujar("canvasEdit", coord[0], coord[1])
							for(var i=0; i<servs.length; i++)
							{
								$("#srvEdit"+servs[i].srv_id).prop("checked",true)
								$("#srvEdit"+servs[i].srv_id).change();
								var timesCst = 0;
								var arrayServ=servs[i]
								intervalCst[arrayServ.srv_id] = window.setInterval(cargarPrecio, 1000, arrayServ);
								function cargarPrecio(serv){
									timesCst += 1;
									if(timesCst === 25 || $("#prcEdit"+serv.srv_id).length){
										console.log("servicio::"+serv.srv_id)
										$("#prcEdit"+serv.srv_id).val(serv.dso_prc)
										$.calcularTotal();
										$("#detallesTrabajoEdit input:checkbox").prop('checked',false);
										window.clearInterval(intervalCst[serv.srv_id]);
										for(var j=0; j<details.length; j++)
										{
											var timesChk = 0;
											var arrayDet=details[j]
											console.log(arrayDet)
											var intervalChk = setInterval(cargarCasilla, 1000, arrayDet);
											function cargarCasilla(det){
												timesChk += 1;
												if(timesChk === 25 || $("#Editcat"+det.art_id).length){
													if(!$("#Editcat"+det.art_id).prop("checked"))
													{
														console.log("#Editcat"+det.art_id);
														$("#Editcat"+det.art_id).prop("checked",true)
														clearInterval(intervalChk);
													}
												}
											}
										}
									}
								}
								
								
							}
							
					}else{
						if(msg){
							$.errorMessage("servicio No Existe!");
						}
					}
				}
			}, 500);
			//}, 'json');
		});	
	}	
	/*
	 * -------------------------------------------------------------------
	 *  Edit model submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 $("#frmMdOrden").on("submit",function(event){
		$("#buttonsActionEdit").html('<h4 class="text-primary">Guardando...</h4>');
		event.preventDefault();
		arrayConcatenado= new Array()
		var idsArt=window.servicios
		idsArt.forEach(unirArrays)
		idsArt=eliminateDuplicates(arrayConcatenado)
		console.log("detalles::::"+idsArt)
		var inv=$("#idsInvEdit").attr("data-toggle")
		var srv=$("#servicios").attr("data-toggle")
		$.ajax({
			type: "POST",
			url: "/sich/orden/edit_orden/?trId="+$("#spIdOrden").attr('data-toggle')+"&idsArt="+idsArt+"&idsInv="+inv+"&srv="+srv+"&idVeh="+idVeh+"&cmb="+window.combustible,
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					response=response.update_orden;
					switch(response) {
					case "0":
						$.errorMessage();
						break;
					default:
						$("#buttonsActionEdit").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
						$('#tbOrd').DataTable().ajax.reload();
						$("#frmMdOrden input[type='text']").val('');
						$.successMessage("La orden de trabajo N°"+response+" ha sido editada de forma correcta.");
						$("#frmMdOrden input[type='text']").val('');
						$("#frmMdOrden input[type='number']").val('0.00');
						$("#frmMdOrden input[type='date']").val('');
						$("#frmMdOrden input[type='checkbox']").prop("checked",false);
						$("#tableCarsEdit").html("");
						$("#detallesTrabajoEdit").html("");
						$("#costosServicioEdit").html("");
						$("#mdOrden").modal('hide');
						window.servicios=new Array();
						limpiar(document.getElementById('#limpiaEdit'));
						break;
					}
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$("#buttonsActionEdit").html('<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button> <button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>');
				$.errorMessage();
			}
		});
	});
});