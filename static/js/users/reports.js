$(function(){
$.descargarVent = function(){
	if($("#txtDesdeVent").val()==""||$("#txtHastaVent").val()=="")
	{
		$.errorMessage("Primero debe especificar el periodo de tiempo.")
	}
	else
	{
	 	window.open("/sich/report/ventas_pdf?desde="+($("#txtDesdeVent").val())+"&hasta="+($("#txtHastaVent").val())+"&est="+($("#txtEstVent").val()));
	}
}
$.descargarGarant = function(){
	window.open("/sich/report/garantias_pdf?limit="+($("#txtLimitGarant").val())+"&est="+($("#txtEstGarant").val()));
}

var trIdImp;
	$.imprimir = function(btn){
	 	trIdImp = $($($(btn).parent()).parent()).attr('id');
	 	$("#imprimirModal").modal('show');
	}
	
	$.descargar = function(opc){
	 	switch(opc)
		{
			case "1":
				window.open("/sich/report/factura_pdf?id="+trIdImp);
				break;
			case "2":
				window.open("/sich/report/orden_pdf?id="+trIdImp);
				break;
		}
	}

var btnsOpTblModels = "  <button style='border: 0; background: transparent;' onclick='$.imprimir(this);'>"+
							"<img src='/sich/static/img/imprimir.png' title='Imprimir' height=20px>"+
						  "</button>";
						  
	$.renderizeRowTbModels = function( nRow, aData, iDataIndex ) {
	   $(nRow).append("<td class='text-center'>"+btnsOpTblModels+"</td>");
	   $(nRow).attr('id',aData['ord_id']);
	   $($(nRow).children('td')[5]).html($($(nRow).children('td')[5]).html()=="t"?"SI":"NO");
	   $($(nRow).children('td')[7]).css('padding','2px');
	}
$.fnTbl('#tbOrd',"/sich/orden/get_orders_all/",[{ "data": "ord_num"},{"data":"ord_fch"},{"data":"nombre_cliente"},{"data":"ord_fch_ing"},{"data":"ord_fch_ent"},{"data":"ord_rsv"},{"data":"ord_cst"}],$.renderizeRowTbModels);
			
});