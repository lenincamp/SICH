$(function(){
	
	/* =========================>>> SERVICES <<<========================= */
	/*
	 * -------------------------------------------------------------------
	 *  Create model submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	$("#frmServices").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "/sich/service/save_service/",
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if(response){
					$.successMessage();
					$("#frmServices input[type='text']").val('');
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