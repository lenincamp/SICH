/* global $ */
/* global PNotify */
$(function(){
	
	/*
	 * -------------------------------------------------------------------
	 *  Create client submit(Ajax)
	 * -------------------------------------------------------------------
	 */
	var create = false;
	var tels = [];
	$("#frmNewClient").on("submit",function(event){
		event.preventDefault();
		
		$("#tbodyTels tr").each(function(){
		    $(this).find('td').each(function( index ){ 
				if( index == 0 ){
					tels.push($.trim($(this).html()));
				}
			});
		});
		if(tels.length > 0){
			$.ajax({
				type: "POST",
				url: "/sich/client/save_client/?tels="+tels,
				dataType: 'json',
				data: $(this).serialize(),
				success: function(response) {
					if(response.insert_client=="2")
					{
						$.errorMessage('La C.I./R.U.C. ingresado ya se encuentra registrado.');
					}
					else
					{
						if(response.insert_client=="1"){
							$.successMessage('Registro Exitoso');
							$("#frmNewClient input[type='text']").val('');
							$("#frmNewClient input[type='email']").val('');
							tels.length=0;
							$("#divTbTels").fadeOut('fast');
							create = true;
						}else{		
							$.errorMessage('Error en el Registro');
						}
					}
				},
			error: function(){
				$.errorMessage();
			}
			});
		}else{
			$.errorMessage("Debe tener al menos un teléfono!!");
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  Edit client submit(Ajax) --- modal form
	 * -------------------------------------------------------------------
	 */
	 var telsMd = [];
	 $("#frmMdClient").on("submit",function(event){
		event.preventDefault();
		$("#tbodyTelsMd tr").each(function(){
		    $(this).find('td').each(function( index ){ 
				if( index == 0 ){
					telsMd.push($.trim($(this).html()));
				}
			});
		});
		if(telsMd.length > 0){
			$.ajax({
				type: "POST",
				url: "/sich/client/edit_client/?trId="+$("#spIdCliMd").attr('data-toggle')+"&tels="+telsMd,
				dataType: 'json',
				data: $(this).serialize(),
				success: function(response) {
					if(response.update_client == '1'){
						$("#frmMdClient input[type='text']").val('');
						$("#frmMdClient input[type='email']").val('');
						$("#mdClient").modal('hide');
						$.successMessage();
						$('#tbClients').DataTable().ajax.reload();
					}else{		
						$.errorMessage();
					}
<<<<<<< HEAD
<<<<<<< HEAD
				},
				error: function(){
					$.errorMessage();
=======
					telsMd.length=0;
>>>>>>> deploy
=======
					telsMd.length=0;
>>>>>>> deploy
				}
			});
		}
	});
	
	/*
	 * -------------------------------------------------------------------
	 *  function editDeleteModel(btn) -> load modal form edit or delete
	 *	@param : btn => parameter this btn(editModel) onclick
	 *	@param : edt => edit o delete param(true=>edit, false=>delete)
	 * -------------------------------------------------------------------
	 */
	 
	 
	 $.deleteClient = function(){
	 	$.ajax({
			type: "POST",
			url: "/sich/client/delete_client/",
			dataType: 'json',
			data: {id:trIdClt},
			success: function(response) {
				if(response){
					$.successMessage();
					$('#tbClients').DataTable().row( $("#"+trIdClt) ).remove().draw();
				}else{		
					$.errorMessage();
				}
			},
			error: function(){
				$.errorMessage();
			}
		});
	 };
	 
	 $('#mdClient').on('shown.bs.modal', function () {
		$("#txtNombreMd").focus();
	 });
	 
	 $('#mdClient').on('hidden.bs.modal', function () {
		telsMd.length = 0;
	 });
	 
	 var trIdClt;
	 $.editDeleteModel = function(btn, edt){
	 	trIdClt = $.trim($($($(btn).parent()).parent()).attr('id'));
	 	if(edt){
			$("#spIdCliMd").attr('data-toggle',trIdClt);
			$.post("/sich/client/search_client_by_id", {id:trIdClt}, function( response ){
				$("#mdClient").modal('show');
				if( response!=null ){
					$($('#txtCedulaMd').val(response.per_ced)).attr('disabled',true);
					$('#txtNombreMd').val(response.per_nom);
					$('#txtApellidoMd').val(response.per_ape);
					$('#txtDireccionMd').val(response.cli_dir);
					$('#txtEmailMd').val(response.cli_eml);
					if( response.cli_tel !== null){
						var telefonos = response.cli_tel.replace("{","").replace("}","").split(',');
						if ( $.trim(telefonos[0]) != ''){
							$("#tbodyTelsMd").html("");
							$.each(telefonos, function( i, val) {	
								$("#tbodyTelsMd").append("<tr><td class='text-center'>"+val+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
								$("#divTbTelsMd").fadeIn('fast');
							});
						}
					}
				}else{
					$.errorMessage();
				}
			},'json');
	 	}
	 	else
	 	{
	 		$.confirmMessage($.deleteClient);
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
	
	$.popTels = function( btn, cont ){
		return $("#"+btn).popover({
					html: true,
		            animation: false,
		            content: cont,
				    placement: 'bottom',
					title :  '<span class="text-info"><strong>Teléfono(s)</strong></span> <button type="button" id="close" class="close" onclick=$("#'+btn+'").popover("hide");> &times;</button>'
				}).popover('show');
	};
	$.loadTelsCli = function( btn ){
		$.post("/sich/client/search_client_by_id/", {id:btn.replace("Btn","")}, function( response ) {
			if( response.cli_tel !== null ){
				var telefonos = response.cli_tel.replace("{","").replace("}","").split(',');
				if ( $.trim(telefonos[0]) != ''){
					var ol = "<ol>";
					$.each(telefonos, function( index, val ){
						ol += "<li>"+val+"</li>";
					});
					ol += "</ol>";
					$.popTels(btn,ol);
				} else{ $.popTels(btn, "El Cliente no tiene registrados número de teléfono"); }
			} else{ $.popTels(btn, "El Cliente no tiene registrados número de teléfono"); }
			
		},'json');
	};
					  
	$.renderizeRow = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'><button id='"+aData['cli_id']+"Btn' onclick='$.loadTelsCli(this.id);'>ver</button></td><td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['cli_id']);
	};
	
	$.fnTbl('#tbClients',"/sich/client/get_clients_all/",[{ "data": "per_ced"},{"data":"per_nom"},{"data":"per_ape"}],$.renderizeRow);
	
	$("#ltClient").click(function(event){
		if(create){
			$('#tbClients').DataTable().ajax.reload();
			create = false;
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
	
    
});