$(window).load(function(){
	var menu=document.getElementById("css3menu1")
	var opciones = menu.getElementsByTagName("a");
	var i;
	for (i = 0; i < opciones.length; i++) {
		opciones[i].className = "";
	}
	$("#mn_car").addClass("selected");

});