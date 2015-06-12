window.combustible="";
var pasoGas=true
$( document ).ready(function() {
	console.log("inicia")
	asignarEventos("canvasInsert")
	asignarEventos("canvasEdit")
});

function asignarEventos(id)
{
	var canvas = document.getElementById(id);
	canvas.addEventListener("touchstart", doTouchStart, true);
	canvas.addEventListener("click", relMouseCoords, true);
}

function dibujar(id, posx, posy)
{
	var canvas = document.getElementById(id);
	var context = canvas.getContext('2d');
	context.beginPath();
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.moveTo(canvas.width/2, canvas.height);
	context.lineWidth = 3;
	context.strokeStyle = '#ff0000';
	context.lineTo(posx,posy);
	context.stroke();
	window.combustible=posx+"-"+posy
	pasoGas=false
	window.combustible
}

function limpiar(btn)
{
	var padre=btn.parentNode;
	var canvas=padre.getElementsByTagName('canvas')
	canvas=canvas[0]
	var context = canvas.getContext('2d');
	context.beginPath();
	context.clearRect(0, 0, canvas.width, canvas.height);
	pasoGas=true
	window.combustible="";
}

function relMouseCoords(event)
{
	if(pasoGas)
	{
		pasoGas=false;
		var totalOffsetX = 0;
		var totalOffsetY = 0;
		var canvasX = 0;
		var canvasY = 0;
		var canvas = this;
		console.log("id::"+this.id)
		do{
			totalOffsetX += canvas.offsetLeft - canvas.scrollLeft;
			totalOffsetY += canvas.offsetTop - canvas.scrollTop;
		}
		while(canvas = canvas.offsetParent)
		canvasX = event.pageX - totalOffsetX;
		canvasY = event.pageY - totalOffsetY;
		var canvas = this;
		var context = canvas.getContext('2d');
		context.beginPath();
		//context.clearRect(0, 0, canvas.width, canvas.height);
		context.moveTo(canvas.width/2, canvas.height);
		context.lineTo(canvasX, canvasY);
		context.lineWidth = 3;
		context.strokeStyle = '#ff0000';
		context.stroke();
		window.combustible=canvasX+"-"+canvasY;
	}
}
	//HTMLCanvasElement.prototype.relMouseCoords = relMouseCoords;
  
  function doTouchStart(event)
  {
	if(pasoGas)
	{
		pasoGas=false;
		event.preventDefault();
		canvas_x = event.targetTouches[0].pageX;
		canvas_y = event.targetTouches[0].pageY;
		var canvas = this;
		var context = canvas.getContext('2d');
		context.beginPath();
		context.moveTo(canvas.width/2, canvas.height);
		context.lineWidth = 3;
		context.strokeStyle = '#ff0000';
		context.lineTo(canvas_x,canvas_y);
		context.stroke();
		window.combustible=canvas_x+"-"+canvas_y
	}
  }