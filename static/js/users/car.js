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
			}
		});
	 }
	 
	 var trIdMd;
	 $.editDeleteModel = function(btn, edt){
	 	trIdMd = $($($(btn).parent()).parent()).attr('id');
	 	if(edt){
	 		$("#mdModel").modal('show');
	 		$("#spId").attr('data-toggle', trIdMd.replace("Model", ""));
	 		$("#frmMdModel input[type='text']").val($($("#"+trIdMd).children('td')[0]).html());
	 		$("#cmbMarkMd").val(($($("#"+trIdMd).children('td')[1]).attr('id')).replace("Model", ""));
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
	   $($(nRow).children('td')[1]).attr('id',aData['mar_id']+"Model");
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
	
	$.loadCmbCategory = function(){
		$.post("/sich/car/get_categories_all/",function(response){
			var option = "";
			$.each(response.data, function(index, val){
				option += "<option value='"+val.cat_id+"'>"+val.cat_nom+"</option>";
			});
			$("#cmbCat").html(option);
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
	}
						  
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
			}
		});
	}
	 
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
	 }
	 
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
	}
						  
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
			}
		});
	}
	 
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
	 }
	 
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
	}
						  
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
			}
		});
	}
	 
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
	 }
	 
	/* =========================>>> CARS <<<========================= */
	$.loadCmbMarks = function(){
		$.post( "/sich/car/get_marks_all/", function(response) {
			var option = "";
			$.each(response.data, function(index, val){
				option += "<option value='"+val.mar_id+"'>"+val.mar_nom+"</option>";
			});
			$("#cmbMarkAjx").html(option);
			$("#cmbMark").html(option);
			$("#cmbMarkMd").html(option);
			$.loadCmbModels(response.data[0].mar_id);
		}, 'json');
	}
	
	$.loadCmbMarks();
	
	$("#cmbMarkAjx").change(function(){
		$.loadCmbModels( $(this).val() );
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
				$(idCmb).val($.trim($($("#"+trIdCar).children('td')[3]).attr("id")));
			}
			
		}, 'json');
	}
	
	$.disEnaInputCli = function(disEn, response){
		response = typeof response !== 'undefined' ? response : null;
		if(disEn){
			$("#spClient").attr("data-toggle", response.cli_id);
			$($("#txtNombre").val(response.per_nom)).attr('disabled','true');
			$($("#txtApellido").val(response.per_ape)).attr('disabled','true');
			$($("#txtTelefono").val(response.cli_tel)).attr('disabled','true');
			$($("#txtEmail").val(response.cli_eml)).attr('disabled','true');
			$($("#txtDireccion").val(response.cli_dir)).attr('disabled','true');
			
			/*$('#bodyPage').animate({
				scrollTop: $("#fstDataCar").offset().top
			}, 1000);*/
		}else{
			$("#spClient").removeAttr("data-toggle");
			$($($("#txtNombre").val("")).removeAttr('disabled')).focus();
			$($("#txtApellido").val("")).removeAttr('disabled');
			$($("#txtTelefono").val("")).removeAttr('disabled');
			$($("#txtEmail").val("")).removeAttr('disabled');
			$($("#txtDireccion").val("")).removeAttr('disabled');
		}
	}
	
	$.inputsMdCli = function(response){
		$("#mdBdCar #frmCar input").removeAttr('disabled');
		$("#mdBdCar #frmCar #spClient").attr("data-toggle", response.cli_id);
		$($("#mdBdCar #frmCar #txtCedula").val(response.per_ced)).attr('disabled','true');
		$("#mdBdCar #frmCar #txtNombre").val(response.per_nom);
		$("#mdBdCar #frmCar #txtApellido").val(response.per_ape);
		$("#mdBdCar #frmCar #txtTelefono").val(response.cli_tel);
		$("#mdBdCar #frmCar #txtEmail").val(response.cli_eml);
		$("#mdBdCar #frmCar #txtDireccion").val(response.cli_dir);
		$("#mdBdCar #frmCar #cmbMarkAjx").change(function(){
			$.loadCmbModels( $(this).val(), "#mdBdCar #frmCar #cmbModelAjx" );
		});
		$("#mdBdCar #frmCar #cmbMarkAjx").val($.trim($($("#"+trIdCar).children('td')[2]).attr("id")));
		$("#mdBdCar #frmCar #cmbMarkAjx").change();
		
		
	}
	
	$.clearImputCar = function(){
		$("#fstDataCar input").val("");
	}
	
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
	}
	
	$("#txtCedula").focusout(function(event){
		$.searchClientByCi($.trim($(this).val()));
	});
	
	$("#searchClient").click(function(){
		$.searchClientByCi($.trim($("#txtCedula").val()), true);
	});
	
	var createCar = false;
	$("#frmCar").on('submit', function(event){
		event.preventDefault();
		var url = "";
		if(typeof $("#spClient").attr("data-toggle") !== 'undefined'){
			url = "/sich/car/save_car/?id="+$("#spClient").attr("data-toggle");
		}else{
			url = "/sich/car/save_car/?id="+0;
		}
		$.post(url,$(this).serialize(), function(response){	
			switch(response.insert_car) {
				case '0':
					$.errorMessage();
					break;
				case '1':
					$.successMessage();
					$("#txtCedula").val("");
					$.disEnaInputCli(false);
					$.clearImputCar();
					createCar = true;
					break;
				case '2':
					$.errorMessage("El Vehiculo Ya Existe!");
					break;
			}	
		}, 'json');
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
			}
		});
	}
	 
	$('#mdCar').on('shown.bs.modal', function () {
		$("#mdBdCar #frmCar #txtNombre").focus();
	});
	
	var trIdCar;
	$.editDeleteCar = function(btn, edt){
		trIdCar = $.trim($($($(btn).parent()).parent()).attr('id'));
		if(edt){
	 		$("#mdBdCar").html("<span id='spIdCarMd' data-toggle='"+$.trim($($('#'+trIdCar).children('td')[0]).attr('id'))+"'></span>"+$("#divFrmCar").html());
	 		$("#mdBdCar #searchClient").hide();
	 		$.searchClientByCi($.trim($($("#"+trIdCar).children('td')[0]).html()), false, true);
	
	 		$.post("/sich/car/get_car_by_id/", {id:trIdCar.replace("Car","")}, function(response){
	 			$("#mdBdCar #frmCar #txtNChasis").val(response.veh_cha);
	 			$("#mdBdCar #frmCar #txtMotor").val(response.veh_mot);
	 			$("#mdBdCar #frmCar #txtPlaca").val(response.veh_pla);
	 			$("#mdBdCar #frmCar #txtAnio").val(response.veh_yar);
	 			$("#mdBdCar #frmCar #txtColor").val(response.veh_col);
	 			$("#mdBdCar #frmCar #txtCodigo").val(response.veh_cla);
	 			$('.demo2').colorpicker();
	 			console.log(response);
	 		},'json');
	 		
	 		$("#mdCar").modal("show");
	 		
	 		$("#mdBdCar #frmCar").on('submit', function(event){
				event.preventDefault();
				var url = "/sich/car/update_car/?id="+trIdCar.replace("Car","")+"&idCl="+$("#spIdCarMd").attr('data-toggle');
				$.post( url, $(this).serialize(), function(response){
	 			if(response.update_car == '1'){
	 				$('#tbCars').DataTable().ajax.reload();
	 				$("#mdCar").modal("hide");
	 				$.successMessage();
	 			}else{
	 				$.errorMessage();
	 			}
	 			
	 		},'json');
			});
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteCar, "Está Seguro De Eliminar El Vehículo?");
	 	} 	
	 }
	
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
	}
	
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
	
});