/* global $ */
$(function(){
	
	/* =========================>>> MODELS <<<========================= */
	/*
	 * -------------------------------------------------------------------
	 *  Create model submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmModel").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/save_model/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$.successMessage();
					$("#frmModel input[type='text']").val('');
					create = true;
					$.loadCmbMarks();
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
	 *  Edit model submit(Ajax) --- modal form
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
					$("#mdModel").modal('hide');
					$.successMessage();
					$.loadCmbMarks();
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
	 *  function editDeleteModel(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editModel) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	 $.deleteModel = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/car/delete_model/",
			dataType: 'json',
			data: {id:trIdMd.replace("Model", "")},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbModels').DataTable().row( $("#"+trIdMd) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	 };
	 
	 var trIdMd;
	 $.editDeleteModel = function(btn, edt){
	 	trIdMd = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#mdModel").modal('show');
	 		$("#spId").attr('data-toggle', trIdMd.replace("Model", ""));
	 		$("#frmMdModel input[type='text']").val($($("#"+trIdMd).children('td')[0]).html());
	 		$("#cmbMarkMd").val(($($("#"+trIdMd).children('td')[1]).attr('id')).replace("Model", ""));
			$("#cmbCatMd").val(($($("#"+trIdMd).children('td')[0]).attr('id')).replace("Category", ""));
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteModel);
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
						  
	$.renderizeRowTbModels = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['mod_id']);
	   $($(nRow).children('td')[0]).attr('id',aData['cat_id']+"Category");
	   $($(nRow).children('td')[1]).attr('id',aData['mar_id']+"Model");
	};
						  
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
	
	$.loadCmbCategory = function(){
		$.post("/sich/car/get_categories_all/",function(response){
			var option = "";
			$.each(response.data, function(index, val){
				option += "<option value='"+val.cat_id+"'>"+val.cat_nom+"</option>";
			});
			$("#cmbCat").html(option);
			$("#cmbCatMd").html(option);
		},"json");
	};
	$.loadCmbCategory();
	
	/* =========================>>> MARKS <<<========================= */
	
	/*
	 * -------------------------------------------------------------------
	 *  Create mark submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var createMark = false;
	$("#frmMark").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/save_mark/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				switch(response) {
					case 0:
						$.errorMessage("La Marca Ya Está Creada");
						break;
					case 1:
						$.successMessage();
						$("#txtNameMark").val('');
						createMark = true;
						$.loadCmbMarks();
						break;
					case 2:
						$.errorMessage();
						break;
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit mark submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 
	 $("#frmMdMark").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/edit_mark/?trId="+$("#spIdMk").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbMarks').DataTable().ajax.reload();
					$("#frmMdMark input[type='text']").val('');
					$("#markModal").modal('hide');
					$.successMessage();
					$.loadCmbMarks();
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
	var btnsOpTblMark = "<button style='border: 0; background: transparent' onclick='$.editDeleteMark(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteMark(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
						  
	$.renderizeRowTbMarks = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblMark+"</td>");
	   $(nRow).attr('id',aData['mar_id']+"Mark");
	};
						  
	var flagMk = true;
	$("#ltMark").click(function(event){
		if (flagMk){
			$.fnTbl('#tbMarks',"/sich/car/get_marks_all/",[{"data":"mar_nom"}],$.renderizeRowTbMarks);
			flagMk = false;		
		}
		else if(createMark){
			$('#tbMarks').DataTable().ajax.reload();
			createMark = false;
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteMark(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editMark) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	$.deleteMark = function(){
		$.ajax({
			type: "POST",
			url: "/sich/car/delete_mark/",
			dataType: 'json',
			data: {id:trIdMk.replace("Mark", "")},
			success: function(response) {
				if(response){
					$.successMessage("Se ha Eliminado el Registro");
					$('#tbMarks').DataTable().row( $("#"+trIdMk) ).remove().draw();
					$.loadCmbMarks();
					$('#tbModels').DataTable().ajax.reload();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	};
	 
	 var trIdMk;
	 $.editDeleteMark = function(btn, edt){
	 	trIdMk = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#txtNameMarkEdit").val($($("#"+trIdMk).children('td')[0]).html());
	 		$("#markModal").modal('show');
	 		$("#spIdMk").attr('data-toggle', trIdMk.replace("Mark", ""));
	 		
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteMark, "Si elimina la marca se eliminaran todos sus modelos. <br> ¿Está Seguro De Eliminar La Marca?");
	 	} 	
	 };
	 
	 /* =========================>>> DETAILS INVENTARY <<<========================= */
	
	/*
	 * -------------------------------------------------------------------
	 *  Create inventario submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var createInventario = false;
	$("#frmInventario").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/save_inventary/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				switch(response) {
					case 0:
						$.errorMessage("El Detalle de Inventario ya ha sido registrado anteriormente.");
						break;
					case 1:
						$.successMessage();
						$("#txtNameInventario").val('');
						createInventario = true;
						$.loadCmbInventarios();
						break;
					case 2:
						$.errorMessage();
						break;
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit inventario submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 
	 $("#frmMdInventario").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/edit_inventary/?trIdInv="+$("#spIdInv").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbInventarios').DataTable().ajax.reload();
					$("#frmMdInventario input[type='text']").val('');
					$("#inventarioModal").modal('hide');
					$.successMessage();
					$.loadCmbInventarios();
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
	 *  Generate Table inventarios list
	 *	function renderizeRow renderize tr, td for table
	 *	@param : btnsOpTblInventarios => variable(string): buttons for dateTable
	 * -------------------------------------------------------------------
	 */
	var btnsOpTblInventario = "<button style='border: 0; background: transparent' onclick='$.editDeleteInventario(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteInventario(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
						  
	$.renderizeRowTbInventarios = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblInventario+"</td>");
	   $(nRow).attr('id',aData['pie_id']+"Inventario");
	};
						  
	var flagInv = true;
	$("#ltInventario").click(function(event){
		if (flagInv){
			$.fnTbl('#tbInventarios',"/sich/car/get_inventary_all/",[{"data":"pie_nom"}],$.renderizeRowTbInventarios);
			flagInv = false;		
		}
		else if(createInventario){
			$('#tbInventarios').DataTable().ajax.reload();
			createInventario = false;
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteInventario(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editInventario) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	$.deleteInventario = function(){
		$.ajax({
			type: "POST",
			url: "/sich/car/delete_inventary/",
			dataType: 'json',
			data: {id:trIdInv.replace("Inventario", "")},
			success: function(response) {
				if(response){
					$.successMessage("Se ha Eliminado el Registro");
					$('#tbInventarios').DataTable().row( $("#"+trIdInv) ).remove().draw();
					$.loadCmbInventarios();
					$('#tbModels').DataTable().ajax.reload();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	};
	 
	 var trIdInv;
	 $.editDeleteInventario = function(btn, edt){
	 	trIdInv = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#txtNameInventarioEdit").val($($("#"+trIdInv).children('td')[0]).html());
	 		$("#inventarioModal").modal('show');
	 		$("#spIdInv").attr('data-toggle', trIdInv.replace("Inventario", ""));
	 		
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteInventario, "Si elimina la marca se eliminaran todos sus modelos. <br> ¿Está Seguro De Eliminar La Marca?");
	 	} 	
	 };
	 
	/* =========================>>> CATEGORIES <<<========================= */
	
	/*
	 * -------------------------------------------------------------------
	 *  Create CATEGORY submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var createCategory = false;
	$("#frmCateg").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/save_category/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				switch(response) {
					case 0:
						$.errorMessage("La Categoría Ya Está Creada");
						break;
					case 1:
						$.successMessage();
						$("#txtNameCateg").val('');
						createCategory = true;
						$.loadCmbCategory();
						break;
					case 2:
						$.errorMessage();
						break;
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit mark submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 
	 $("#frmMdCateg").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/car/edit_category?trId="+$("#spIdCateg").attr('data-toggle'),
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$('#tbCateg').DataTable().ajax.reload();
					$("#frmMdCateg input[type='text']").val('');
					$("#categModal").modal('hide');
					$.successMessage();
					$.loadCmbCategory();
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
	var btnsOpTblCateg = "<button style='border: 0; background: transparent' onclick='$.editDeleteCateg(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteCateg(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
						  
	$.renderizeRowTbCateg = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblCateg+"</td>");
	   $(nRow).attr('id',aData['cat_id']);
	};
						  
	var flagCateg = true;
	$("#ltCateg").click(function(event){
		if (flagCateg){
			$.fnTbl('#tbCateg',"/sich/car/get_categories_all/",[{"data":"cat_nom"}],$.renderizeRowTbCateg);
			flagCateg = false;		
		}
		else if(createCategory){
			$('#tbCateg').DataTable().ajax.reload();
			createCategory = false;
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteCateg(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editMark) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	$.deleteCateg = function(){
		$.ajax({
			type: "POST",
			url: "/sich/car/delete_category/",
			dataType: 'json',
			data: {id:trIdCateg},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbCateg').DataTable().row( $("#"+trIdCateg) ).remove().draw();
					$.loadCmbCategory();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	};
	 
	 var trIdCateg;
	 $.editDeleteCateg = function(btn, edt){
	 	trIdCateg = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#txtNameCategEdit").val($($("#"+trIdCateg).children('td')[0]).html());
	 		$("#categModal").modal('show');
	 		$("#spIdCateg").attr('data-toggle', trIdCateg);
	 		
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteCateg, "Está Seguro De Eliminar La Categoría?");
	 	} 	
	 };
	 
	/* =========================>>> CARS <<<========================= */
	$.txtCodigo = function(){
		if( $("#cmbMarkAjx option:selected").text().toUpperCase() == "CHEVROLET" ){
			$("#divTxtCodigo").html("<label for='txtCodigo'>Código:</label><input type='text' required='true' class='form-control' id='txtCodigo' name='txtCodigo' placeholder='Ingrese Código'/>");
		}else{
			$("#divTxtCodigo").html("");
		}
	};
	
	$.txtCodigoMd = function(){
		if( $("#cmbMarkAjxMd option:selected").text().toUpperCase() == "CHEVROLET" ){
			$("#divTxtCodigoMd").html("<label for='txtCodigoMd'>Código:</label><input type='text' required='true' class='form-control' id='txtCodigoMd' name='txtCodigoMd' placeholder='Ingrese Código'/>");
		}else{
			$("#divTxtCodigoMd").html("");
		}
	};
	
	$.loadCmbMarks = function(){
		$.post( "/sich/car/get_marks_all/", function(response) {
			var option = "";
			$.each(response.data, function(index, val){
				option += "<option value='"+val.mar_id+"'>"+val.mar_nom+"</option>";
			});
			$("#cmbMarkAjx").html(option);
			$("#cmbMarkAjxMd").html(option);
			$("#cmbMark").html(option);
			$("#cmbMarkMd").html(option);
			$.txtCodigo();
			$.loadCmbModels(response.data[0].mar_id);
		}, 'json');
	};
	
	$.loadCmbMarks();
	
	$("#cmbMarkAjx").change(function(){
		$.loadCmbModels( $(this).val() );
		$.txtCodigo();
	});
	
	$("#cmbMarkAjxMd").change(function(){
		$.loadCmbModels( $(this).val(), "#cmbModelAjxMd" );
		$.txtCodigoMd();
	});
	
	$.loadCmbModels = function( id, idCmb ){
		idCmb = typeof idCmb !== 'undefined' ? idCmb : "#cmbModelAjx";
		$.post( "/sich/car/get_models_for_mark/", {"id":id} ,function(response) {	
			var option = "";
			$.each(response.data, function(index, val){
				option += "<option value='"+val.mod_id+"'>"+val.mod_nom+"</option>";
			});
			$(idCmb).html(option);
			if(idCmb !== "#cmbModelAjx"){
				$(idCmb).val($($("#"+trIdCar).children('td')[3]).attr("id"));
			}
			
		}, 'json');
	};
	
	$.disEnaInputCli = function(disEn, response){
		response = typeof response !== 'undefined' ? response : null;
		if(disEn){
			$("#spClient").attr("data-toggle", response.cli_id);
			$($("#txtNombre").val(response.per_nom)).attr('disabled','true');
			$($("#txtApellido").val(response.per_ape)).attr('disabled','true');
			$($("#txtEmail").val(response.cli_eml)).attr('disabled','true');
			$($("#txtDireccion").val(response.cli_dir)).attr('disabled','true');
			$($("#txtTelefono").val("")).attr('disabled','true');
			var telefonos = response.cli_tel.replace("{","").replace("}","").split(',');
			if ( $.trim(telefonos[0]) != ''){
				$("#tbodyTels").html("");
				$.each(telefonos, function( i, val) {	
					$("#tbodyTels").append("<tr><td class='text-center'>"+val+"</td><td class='text-center'>--</td></tr>");
					$("#divTbTels").fadeIn('fast');
				});
			}
			/*$('#bodyPage').animate({
				scrollTop: $("#fstDataCar").offset().top
			}, 1000);*/
		}else{
			$("#spClient").removeAttr("data-toggle");
			$($($("#txtNombre").val("")).removeAttr('disabled')).focus();
			$($("#txtApellido").val("")).removeAttr('disabled');
			$($("#txtEmail").val("")).removeAttr('disabled');
			$($("#txtDireccion").val("")).removeAttr('disabled');
			$($("#txtTelefono").val("")).removeAttr('disabled');
			$("#tbodyTels").html("");
			$("#divTbTels").fadeOut('fast');
		}
	};
	
	$.inputsMdCli = function(response){
		$("#frmMdCar input").removeAttr('disabled');
		$("#spMdClient").attr("data-toggle", response.cli_id);
		$($("#txtCedulaMd").val(response.per_ced)).attr('disabled','true');
		$("#txtNombreMd").val(response.per_nom);
		$("#txtApellidoMd").val(response.per_ape);
		var telefonos = response.cli_tel.replace("{","").replace("}","").split(',');
		
		if ( $.trim(telefonos[0]) != ''){
			$("#tbodyTelsMd").html("");
			$.each(telefonos, function( i, val) {	
				$("#tbodyTelsMd").append("<tr><td class='text-center'>"+val+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
				$("#divTbTelsMd").fadeIn('fast');
			});
		}

		$("#txtEmailMd").val(response.cli_eml);
		$("#txtDireccionMd").val(response.cli_dir);
		$("#cmbMarkAjxMd").val($.trim($($("#"+trIdCar).children('td')[2]).attr("id")));
		$("#cmbMarkAjxMd").change();
	};
	
	$.clearImputCar = function(){
		$("#fstDataCar input").val("");
		$("#fstDataCarMd input").val("");
		$(".fileinput-remove-button").click();
	};
	
	$.searchClientByCi = function(ci, msg, mdl){
		msg = typeof msg !== 'undefined' ? msg : false;
		mdl = typeof mdl !== 'undefined' ? mdl : false;
		var number = ci.length;
		if( number == 10 ){
			var data = {"ci":ci};
			$.post("/sich/client/search_client_by_id/", data, function(response){
				if( response !== null ){	
					if(mdl){
						$.inputsMdCli(response);
					}else{
						$.disEnaInputCli(true, response);
					}
				}else{
					if(!mdl){
						$.disEnaInputCli(false);
					}
					if(msg){
						$.errorMessage("Cliente No Existe!");
					}
				}
			}, 'json');
		}
	};
	
	$("#txtCedula").focusout(function(event){
		$.searchClientByCi($.trim($(this).val()));
	});
	
	$("#searchClient").click(function(){
		$.searchClientByCi($.trim($("#txtCedula").val()), true);
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  SAVE CARS
	 * -------------------------------------------------------------------
	 */
	var createCar = false;
	var tels = [];
	$("#frmCar").on('submit', function(event){
		var formData = new FormData($("#frmCar")[0]);
		event.preventDefault();
		$("#tbodyTels tr").each(function(){
		    $(this).find('td').each(function( index ){ 
				if( index == 0 ){
					tels.push($.trim($(this).html()));
				}
			});
		});
		if(tels.length > 0){
			var url = "";
			if(typeof $("#spClient").attr("data-toggle") !== 'undefined'){
				url = "/sich/car/save_car/?id="+$("#spClient").attr("data-toggle")+"&tels="+tels;
			}else{
				url = "/sich/car/save_car/?id="+0+"&tels="+tels;
			}
			
			$.ajax({
	        	url: url,  
	            type: 'POST',
	            data: formData,
				dataType:'json',
	            //necesario para subir archivos via ajax
	            cache: false,
	            contentType: false,
	            processData: false,
	            // mientras se envia el archivo
	            beforeSend: function(){               
	               $.infoMressage();
	            },
	            //si finalizo correctamente
	            success: function(response){
					switch(response.insert_car) {
						case '0':
							$.errorMessage();
							break;
						case '1':
							$.successMessage();
							$($("#txtCedula").val("")).focus();
							$.disEnaInputCli(false);
							$.clearImputCar();
							createCar = true;
							tels.length = 0;
							break;
						case '2':
							$.errorMessage("El Vehiculo Ya Existe!");
							break;

					}	
				},
	            //si ocurrido un error
	            error: function(){
	                $.errorMessage("");
	            }
	        });
		}else{
			$.errorMessage("Debe tener al menos un teléfono!!");
		}
	});
	
	$.deleteCar = function(){
		$.ajax({
			type: "POST",
			url: "/sich/car/delete_car/",
			dataType: 'json',
			data: {id:trIdCar.replace("Car","")},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbCars').DataTable().row( $("#"+trIdCar) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	};
	 
	$('#mdCar').on('shown.bs.modal', function () {
		$("#txtNombreMd").focus();
	});
	
	var trIdCar;
	$.editDeleteCar = function(btn, edt){
		trIdCar = $.trim($($($(btn).parent()).parent()).attr('id'));
		if(edt){
	 		$("#spMdCar").attr("data-toggle",$.trim($($('#'+trIdCar).children('td')[0]).attr('id')));
			$.searchClientByCi($.trim($($("#"+trIdCar).children('td')[0]).html()), false, true);
			$.post("/sich/car/get_car_by_id/", {id:trIdCar.replace("Car","")}, function(response){
	 			$("#txtNChasisMd").val(response.veh_cha);
	 			$("#txtMotorMd").val(response.veh_mot);
	 			$("#txtPlacaMd").val(response.veh_pla);
	 			$("#txtAnioMd").val(response.veh_yar);
	 			$("#txtColorMd").val(response.veh_col);
				$('.demo2').colorpicker();
	 		},'json');
	 		
	 		$("#mdCar").modal("show");
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteCar, "Está Seguro De Eliminar El Vehículo?");
	 	} 	
	 };
	
	/*
	 * -------------------------------------------------------------------
	 *  EDIT CARS
	 * -------------------------------------------------------------------
	 */
	var telsMd = [];
	$("#frmMdCar").on('submit', function(event){
		event.preventDefault();
		$("#tbodyTelsMd tr").each(function(){
		    $(this).find('td').each(function( index ){ 
				if( index == 0 ){
					telsMd.push($.trim($(this).html()));
				}
			});
		});
		if(telsMd.length > 0){
			var url = "/sich/car/update_car/?id="+trIdCar.replace("Car","")+"&idCl="+$("#spMdCar").attr('data-toggle')+"&tels="+telsMd;
			$.post( url, $(this).serialize(), function(response){
	 			if(response.update_car == '1'){
	 				$('#tbCars').DataTable().ajax.reload();
	 				$("#mdCar").modal("hide");
	 				$.successMessage();
					telsMd.length = 0;
	 			}else{
	 				$.errorMessage();
	 			}
	 			
	 		},'json');
		}else{
			$.errorMessage("Debe tener al menos un teléfono!!");
		}
	});
	
	var btnsOpTblCars = "<button style='border: 0; background: transparent' onclick='$.editDeleteCar(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteCar(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
	
	$.renderizeRowTbCars = function( nRow, aData, iDataIndex ) {
		$(nRow).append("<td id='"+aData['veh_col']+"'><div style='border:1px solid #ccc;margin:auto;width:24px;height:24px;background-color:"+aData['veh_col']+";'></div></td><td class='text-center'>"+btnsOpTblCars+"</td>");
		$(nRow).attr('id',aData['veh_id']+"Car");
		$($(nRow).children('td')[0]).attr("id",aData['cli_id']);
		$($(nRow).children('td')[2]).attr("id",aData['mar_id']);
		$($(nRow).children('td')[3]).attr("id",aData['mod_id']);
	};
	
	var flagCar = true;
	$("#ltCar").click(function(event){
		if (flagCar){
		//'cli_id, per_ced, per_nom, per_ape, marca.*, modelo.*, veh_pla, veh_col, veh_id'
			var data = [
				{"data":"per_ced"},
				{"data":"nombres"},
				{"data":"mar_nom"},
				{"data":"mod_nom"},
				{"data":"veh_pla"}
				//{"data":"veh_col"}
			];
			$.fnTbl('#tbCars',"/sich/car/get_cars_all/",data,$.renderizeRowTbCars);
			flagCar = false;		
		}
		else if(createCar){
			$('#tbCars').DataTable().ajax.reload();
			createCar = false;
		}
	});
	
	$.cancelEditTel = function( btn ){
		var tr = $($(btn).parent()).parent();
		var tel = $.trim($($($(btn).parent()).children('input')[0]).val());
		if( tel.length >= 7 && tel.length<=10 ){
			$($(tr).children('td')[0]).html(tel);
		}else{
			$.errorMessage("El número de teléfono debe ser de 7 a 10 dígitos");
			 $($($(tr).children('td')[0]).children('input')).focus();
		}
	};
	
	//op = true --> edit; else delete
	$.editDeleteTel = function( btn, op ){
		event.preventDefault();
		var tr = $($(btn).parent()).parent();
		var telTb = $.trim($($(tr).children('td')[0]).html());
		if( op ){
			 $($(tr).children('td')[0]).html("<input maxlength='10' value='"+telTb+"' onfocus='this.value = this.value;' onkeyup='if(event.keyCode == 27 || event.keyCode == 13){$.cancelEditTel(this);}'><button type='button' onclick='$.cancelEditTel(this);'>x</button>");
			 $($($(tr).children('td')[0]).children('input')).focus();
		}else{
			$(tr).fadeOut('fast', function(){
				$(this).remove();
			});
		}
	};
	
	var btnsOpTblTels = "<button style='border: 0; background: transparent' onclick='$.editDeleteTel(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteTel(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
	
	
	$("#btnTels").click(function(){
		var num =  $.trim($("#txtTelefono").val()).length;
		if( num >= 7 && num <= 10 ) {
			$("#tbodyTels").append("<tr><td class='text-center'>"+$("#txtTelefono").val()+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
			$($("#txtTelefono").val('')).focus();
			$("#divTbTels").fadeIn('fast');
		}else{
			$.errorMessage("El número de teléfono debe ser de 7 a 10 dígitos");
		}
	});
	
	$("#btnTelsMd").click(function(){
		var num =  $.trim($("#txtTelefonoMd").val()).length;
		if( num >= 7 && num <= 10 ) {
			$("#tbodyTelsMd").append("<tr><td class='text-center'>"+$("#txtTelefonoMd").val()+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
			$($("#txtTelefonoMd").val('')).focus();
			$("#divTbTelsMd").fadeIn('fast');
		}else{
			$.errorMessage("El número de teléfono debe ser de 7 a 10 dígitos");
		}
	});
	
	$("#txtTelefono").keyup( function( event ){
		if( event.keyCode == 13 ){
			$("#btnTels").click();
		}
	});
	
	$("#txtTelefonoMd").keyup( function( event ){
		if( event.keyCode == 13 ){
			$("#btnTelsMd").click();
		}
	});
	
	$("#images").fileinput({
		showCaption: false, maxFileCount: 2, language: "es",
    	//uploadUrl: "http://localhost/site/file-upload-batch",
   		allowedFileExtensions: ["jpg", "png"],showUpload: false
	});
	
});