var portaPapelesInput;
function seleccionar(opcion){
	var menu=document.getElementById("css3menu1")
	var opciones = menu.getElementsByTagName("a");
	var i;
	for (i = 0; i < opciones.length; i++) {
		opciones[i].className = "";
	}
	document.getElementById(opcion).className = "selected";
}
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}
function switchTab(tabHref)
{
	$('a[href=#'+tabHref+']').trigger("click");
}
function copiarInputs(idPadre){
	portaPapelesInput=new Array();
	var padre=document.getElementById(idPadre)
	var inputs = padre.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
		portaPapelesInput.push(inputs[i].value);
	}
	new PNotify({
		title: 'Aviso',
		text: "Información copiada correctamente.",
		type: 'success'
	});
}
function pegarInputs(idPadre){
	if(portaPapelesInput!=null)
	{
		var padre=document.getElementById(idPadre)
		var inputs = padre.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) {
			inputs[i].value=portaPapelesInput[i];
		}
		new PNotify({
			title: 'Aviso',
			text: "Información pegada correctamente.",
			type: 'success'
		});
	}
	else{
		new PNotify({
			title: 'Oh No!',
			text: "El portapeles se encuentra vacio.",
			type: 'notice'
		});
	}
}