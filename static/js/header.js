function seleccionar(opcion){
	var menu=document.getElementById("css3menu1")
	var opciones = menu.getElementsByTagName("a");
	var i;
	for (i = 0; i < opciones.length; i++) {
		opciones[i].className = "";
	}
	var menu=document.getElementById(opcion).className = "selected";
}
$(function(){
//$("#mn_home").addClass("selected");
});