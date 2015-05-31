$(function(){
	/*
	 * -------------------------------------------------------------------
	 *  Notification Messages
	 * -------------------------------------------------------------------
	 */
	 $('.modal').on('shown.bs.modal', function () {
		//$('#txtNameMarkEdit').focus();
		$(this).find('input:text:visible:first').focus();
	 });
	 
	 $.successMessage = function(text){
	 	text = typeof text !== 'undefined' ? text : 'Proceso Exitoso.';
	 	new PNotify({
			title: 'Notificación',
			text : text,
			type : 'success'
		});
	 }
	 
	 $.errorMessage = function(text){
	 	text = typeof text !== 'undefined' ? text : 'Error en el proceso.';
	 	new PNotify({
			title: 'Oh No!',
			text: text,
			type: 'error'
		});
	 }
	 
	 $.confirmMessage = function(fnc, text){
	 	text = typeof text !== 'undefined' ? text : 'Está Seguro de Eliminar el Registro?';
	 	new PNotify({
			title: 'Confirmación Necesaria',
			text: text,
			icon: 'glyphicon glyphicon-question-sign',
			hide: false,
			confirm: {
				confirm: true
			},
			buttons: {
				closer: false,
				sticker: false
			},
			history: {
				history: false
			}
		}).get().on('pnotify.confirm', fnc).on('pnotify.cancel', function() {
			console.log('Oh ok. Chicken, I see.');
		});
	 }
	 
	 /*
	 * -------------------------------------------------------------------
	 *  Function DataTable(bootrap)  
	 *  @param : id      => id this element dom
	 *	@param : url     => uri for ajax method in controller
	 *	@param : columns => coloumns db for dateTable
	 *	@param : fnc     => function for rederice tr
	 * -------------------------------------------------------------------
	 */
	 var lngEsp = {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		}
	};
	
	$.fnTbl = function(id, url, columns, fnc){
		$(id).dataTable( {
			ordering: true,
			"ajax": url,
			"columns": columns,
			"fnCreatedRow": fnc,
			"language": lngEsp
		} );
	}
	
});