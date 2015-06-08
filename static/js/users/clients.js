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
				if( index == 1 ){
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
							cont=1;
							$("#divTbTels").fadeOut('fast');
							create = true;
						}else{		
							$.errorMessage('Error en el Registro');
						}
					}
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
				if( index == 1 ){
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
						telsMd.length=0;
						contMd=1;
						$("#mdClient").modal('hide');
						$.successMessage();
						$('#tbClients').DataTable().ajax.reload();
					}else{		
						$.errorMessage();
					}
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
			}
		});
	 };
	 
	 var trIdClt;
	 $.editDeleteModel = function(btn, edt){
	 	trIdClt = $.trim($($($(btn).parent()).parent()).attr('id'));
	 	if(edt){
			$("#spIdCliMd").attr('data-toggle',trIdClt);
			$.post("/sich/client/search_client_by_id", {id:trIdClt}, function( response ){
				$("#mdClient").modal('show');
				if( response!=null ){
					$($('#txtCedulaMd').val(response.per_ced)).attr('disabled',true);
					$($('#txtNombreMd').val(response.per_nom)).focus();
					$('#txtApellidoMd').val(response.per_ape);
					$('#txtDireccionMd').val(response.cli_dir);
					$('#txtEmailMd').val(response.cli_eml);
					$.post("/sich/client/get_tels_all/", {id:response.cli_id}, function( resp ){
						$("#tbodyTelsMd").html("");
						$.each(resp, function( i, val) {	
							$("#tbodyTelsMd").append("<tr><td class='text-center'>"+(i+1)+"</td><td class='text-center'>"+val.tel_num+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
							$("#divTbTelsMd").fadeIn('fast');
							contMd = i+2;	
						});
					},'json');
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
	
	$.loadTelsCli = function( btn ){
		
		$.post("/sich/client/get_tels_all/", {id:btn.replace("Btn","")}, function( response ) {
			
			if( response.length != 0 ){
				var ol = "<ol>";
				$.each(response, function( index, val ){
					ol += "<li>"+val.tel_num+"</li>";
				});
				ol += "</ol>";
				$("#"+btn).popover({
					html: true,
	                animation: false,
	                content: ol,
				    placement: 'bottom',
					title :  '<span class="text-info"><strong>Teléfono(s)</strong></span> <button type="button" id="close" class="close" onclick=$("#'+btn+'").popover("hide");> &times;</button>'
				}).popover('show');
			}else{
				
				$("#"+btn).popover({
					html: true,
	                animation: false,
	                content: "El Cliente no tiene registrados número de teléfono",
				    placement: 'bottom',
					title :  '<span class="text-info"><strong>Teléfono(s)</strong></span> <button type="button" id="close" class="close" onclick=$("#'+btn+'").popover("hide");>&times;</button>'
				}).popover('show');
			}
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
			$($(tr).children('td')[1]).html(tel);
		}else{
			$.errorMessage("El número de teléfono debe ser de 7 a 10 dígitos");
			 $($($(tr).children('td')[1]).children('input')).focus();
		}
	};
	
	//op = true --> edit; else delete
	$.editDeleteTel = function( btn, op ){
		event.preventDefault();
		var tr = $($(btn).parent()).parent();
		var telTb = $.trim($($(tr).children('td')[1]).html());
		if( op ){
			 $($(tr).children('td')[1]).html("<input value='"+telTb+"' onfocus='this.value = this.value;' onkeyup='if(event.keyCode == 27 || event.keyCode == 13){$.cancelEditTel(this);}'><button type='button' onclick='$.cancelEditTel(this);'>x</button>");
			 $($($(tr).children('td')[1]).children('input')).focus();
		}else{
			$(tr).fadeOut('fast', function(){
				$(this).remove();
				cont--;
			});
		}
	};
	
	var btnsOpTblTels = "<button style='border: 0; background: transparent' onclick='$.editDeleteTel(this, true);'>"+
							"<img src='/sich/static/img/edit.png' title='Editar'>"+
						  "</button>"+
						  "<button style='border: 0; background: transparent' onclick='$.editDeleteTel(this, false);'>"+
							"<img src='/sich/static/img/delete.png' title='Eliminar'>"+
						  "</button>";
	
	var cont = 1;
	$("#btnTels").click(function(){
		var num =  $.trim($("#txtTelefono").val()).length;
		if( num >= 7 && num <= 10 ) {
			$("#tbodyTels").append("<tr><td class='text-center'>"+(cont++)+"</td><td class='text-center'>"+$("#txtTelefono").val()+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
			$($("#txtTelefono").val('')).focus();
			$("#divTbTels").fadeIn('fast');
		}else{
			$.errorMessage("El número de teléfono debe ser de 7 a 10 dígitos");
		}
	});
	var contMd = 1;
	$("#btnTelsMd").click(function(){
		var num =  $.trim($("#txtTelefonoMd").val()).length;
		if( num >= 7 && num <= 10 ) {
			$("#tbodyTelsMd").append("<tr><td class='text-center'>"+(contMd++)+"</td><td class='text-center'>"+$("#txtTelefonoMd").val()+"</td><td class='text-center'>"+btnsOpTblTels+"</td></tr>");
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