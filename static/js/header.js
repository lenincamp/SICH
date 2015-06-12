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

var resultSearch=false;
var idBusqueda;
var resultadoDiferencia=new Array();
var arrayActual;
window.arrayGlobal=new Array();
var arrayConcatenado=new Array();
function elementosRepetidos(element, index, array) {
	if(arrayConcatenado.lenght==0)
	{
		arrayConcatenado=element
	}
	else
	{
		arrayConcatenado=arrayConcatenado.concat(element)
	}
}

function buscarElements(element, index, array) {
	if(!resultSearch)
    for(var i=0; i<element.length; i++)
	{
		if(element[i]=="cat"+idBusqueda||element[i]=="Editcat"+idBusqueda)
		{
			resultSearch=true;
		}
	}
	
}

window.servicios= new Array();
window.flag=true
window.lock=true
function loadDetails(idCotenedor, prefijo,idChk)
{
	 
	if($('#srv'+prefijo+idChk).prop('checked'))
	{
		$.renderizeDivDetailsService(idCotenedor, prefijo,idChk);
	}
	else
	{
		arrayConcatenado=new Array();
		if(window.servicios[idChk]==null)
			{console.log("nulo")}
			else{console.log("else")}
		idBusqueda=idChk;
		arrayActual=window.servicios[idChk]
		window.servicios.forEach(elementosRepetidos)
		console.log("diferencia::"+arrayConcatenado)
		var duplicados=getDuplicates(arrayConcatenado)
		console.log("diferenciaFinal::"+duplicados)
		for(var i=0; i<arrayActual.length; i++)
		{
			var paso=true
			for(var j=0; j<duplicados.length; j++)
			{
				if(duplicados[j]==arrayActual[i])
				{	
					paso=false;
					j=duplicados.length
				}
			}
			if(paso)
			{
				$('#div'+arrayActual[i]).remove();
			}
		}
		if (idChk > -1) {
			//window.servicios.splice(idChk, 1);
			window.servicios[idChk]=new Array()
		}
		$("#divCst"+idChk).remove()
		$("#divCstEdit"+idChk).remove()
		$.calcularTotal();
	}
	bordesDivs("header")
}

function bordesDivs(msj)
{
	console.log(msj)
	subBordes("detallesTrabajo")
	subBordes("detallesTrabajoEdit")
}

function subBordes(id)
{
	var menu=document.getElementById(id)
	var opciones = menu.getElementsByTagName("div");
	var arsid="";
		for(var i=0;i<opciones.length;i++)
		{
			$('#'+opciones[i].id).removeClass("borderRight")
			arsid+=","+(opciones[i].id.substring(6))
			if((i+1)%3==0)
			{
				$('#'+opciones[i].id).removeClass("borderRight")
			}
			else
			{
				$('#'+opciones[i].id).addClass("borderRight");
			
			}
			$("#ars").attr('data-toggle', arsid.substring(1));
		}
}

function buscarElemento(idBusq)
{
	var element=window.servicios
	for(var i=0; i<element.length; i++)
	{
		var fila=element[i]
		if(fila!=null)
		{
			for(var j=0; j<fila.length; j++)
			{
				if(fila[j]=="cat"+idBusq||fila[j]=="Editcat"+idBusq)
				{
					return true;
				}
			}
		}
	}
	return false;
}

function buscarServicio(id)
{
	resultSearch=false;
	idBusqueda=id;
	//window.servicios.forEach(buscarElements);
	//return resultSearch;
	return buscarElemento(idBusqueda)
}

function getDuplicates(arr) {
 var i,
	 j,
     len=arr.length,
     out=[],
     obj={};

 var sorted_arr = arr.sort(); // You can define the comparing function here. 
                             // JS by default uses a crappy string compare.
var results = [];
for (var i = 0; i < arr.length - 1; i++) {
    if (sorted_arr[i + 1] == sorted_arr[i]) {
        results.push(sorted_arr[i]);
    }
}
 return results;
}

function eliminateDuplicates(arr) {
 var i,
     len=arr.length,
     out=[],
     obj={};

 for (i=0;i<len;i++) {
    obj[arr[i]]=0;
 }
 for (i in obj) {
    out.push(i);
 }
 return out;
}


function arr_diff(a1, a2)
{
  var a=[], diff=[];
  for(var i=0;i<a1.length;i++)
    a[a1[i]]=true;
  for(var i=0;i<a2.length;i++)
    if(a[a2[i]]) delete a[a2[i]];
    else a[a2[i]]=true;
  for(var k in a)
    diff.push(k);
  return diff;
}