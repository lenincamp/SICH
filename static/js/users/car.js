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
						break;
					case 2:
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
    
});