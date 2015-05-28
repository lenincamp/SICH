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
					$('.cmbMarkMd').selectpicker('refresh');
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
	   $(nRow).attr('id',aData['mar_id']);
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
			data: {id:trIdMk},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbMarks').DataTable().row( $("#"+trIdMk) ).remove().draw();
					$.loadCmbMarks();
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
	 		$("#spIdMk").attr('data-toggle', trIdMk);
	 		
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteMark, "Si elimina la marca se eliminaran todos sus modelos. <br> ¿Está Seguro De Eliminar La Marca?");
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
			$.loadCmbModels(response.data[0].mar_id);
			$("#cmbMarkAjx").selectpicker('refresh');
		}, 'json');
	}
	
	$.loadCmbMarks();
	
	$("#cmbMarkAjx").change(function(){
		$.loadCmbModels( $(this).val() );
	});
	
	$.loadCmbModels = function( id ){
		$.post( "/sich/car/get_models_for_mark/", {"id":id} ,function(response) {	
			var option = "";
			$.each(response.data, function(index, val){
				option += "<option value='"+val.mod_id+"'>"+val.mod_nom+"</option>";
			});
			$("#cmbModelAjx").html(option);
			$("#cmbModelAjx").selectpicker('refresh');
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
	
	$("#txtCedula").focusout(function(event){
		var number = $.trim($(this).val()).length;
		if( number == 10 ){
			var data = {"ci":$.trim($(this).val())};
			$.post("/sich/client/search_client_by_id/", data, function(response){
				if( response !== null ){
					$.disEnaInputCli(true, response);
				}else{
					$.disEnaInputCli(false);
				}
			}, 'json');
		}

	});
	
	$("#searchClient").click(function(){
		var number = $.trim($("#txtCedula").val()).length;
		if( number == 10 ){
			var data = {"ci":$.trim($("#txtCedula").val())};
			$.post("/sich/client/search_client_by_id/", data, function(response){
				if( response !== null ){
					$.disEnaInputCli(true, response);
				}else{
					$.disEnaInputCli(false);
					$.errorMessage("Cliente No Existe!");
				}
			}, 'json');
		}
	});
	
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
					break;
				case '2':
					$.errorMessage("El Vehiculo Ya Existe!");
					break;
			}	
		}, 'json');
	});

});