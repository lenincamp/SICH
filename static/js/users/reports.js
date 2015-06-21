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
$.descargarFact = function(){
	window.open("/sich/report/factura_pdf?id="+($("#txtLimitGarant").val()));
}
});