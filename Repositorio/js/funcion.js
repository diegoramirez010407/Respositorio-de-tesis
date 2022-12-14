$(document).ready(function () {
    
    $.fn.dataTable.ext.errMode = 'throw';

	$("#verProfesores").click(function (event) {
		event.preventDefault();
		$("#titleProfesores").show("fast");
		$("#cardProfesores").show("fast");
		$("#titleAlumnos").hide();
		$("#cardAlumnos").hide();
		$("#titleGrupos").hide();
		$("#cardGrupos").hide();
		$("#titleConfiguracion").hide();
		$("#configuraciones_disponibles").hide();
		$("#cardConfiguracion").hide();
	});

	$("#verAlumnos").click(function (event) {
		event.preventDefault();
		$("#titleAlumnos").show("fast");
		$("#cardAlumnos").show("fast");
		$("#titleProfesores").hide();
		$("#cardProfesores").hide();
		$("#titleGrupos").hide();
		$("#cardGrupos").hide();
		$("#titleConfiguracion").hide();
		$("#configuraciones_disponibles").hide();
		$("#cardConfiguracion").hide();
	});

	$("#verGrupos").click(function (event) {
		event.preventDefault();
		$("#titleGrupos").show('fast');
		$("#cardGrupos").show('fast');
		$("#titleProfesores").hide();
		$("#cardProfesores").hide();
		$("#titleAlumnos").hide();
		$("#cardAlumnos").hide();
		$("#titleConfiguracion").hide();
		$("#configuraciones_disponibles").hide();
		$("#cardConfiguracion").hide();
	});

	
	
	$("#verConfiguracion").click(function (event) {
		event.preventDefault();
		$("#titleConfiguracion").show();
		$("#configuraciones_disponibles").show();
		$("#cardConfiguracion").show();
		$("#titleProfesores").hide();
		$("#cardProfesores").hide();
		$("#titleAlumnos").hide();
		$("#cardAlumnos").hide();
		$("#titleGrupos").hide();
		$("#cardGrupos").hide();
	});
	

	
	document.querySelector("#btnGenerar").addEventListener('click', (e) => {
		
		$.ajax({
			url: 'serverside/serversideFaltan.php'
		});

		alertify.alert("Los datos se han solicitado");
	});

	document.querySelector("#btnVerResultado").addEventListener('click', (e) => {
	    
	    $("#tbFaltantes").dataTable().fnDestroy();

		tbFaltantes = $("#tbFaltantes").DataTable({
			responsive: true,
			autoWidth: false,
			lengthMenu: [[5, 10, 25, 100, -1], [5, 10, 25, 100, "All"]],
			dom: 'Bflrtip',    
			buttons: [
				{
					extend: 'excelHtml5',
					text: '<i class="bx bx-spreadsheet bx-tada"></i>',
					titleAttr: 'Exportar a Excel',
					className: 'btn btn-success',
					exportOptions: {
						modifier: {
							search: 'applied',
							order: 'applied'
						}
					}
				},
			],
			"processing": true,
			"serverSide": true,
			"sAjaxSource": "serverside/serversideFaltantes.php",
			"columnDefs": [{
				"targets": -1
			}],
		});
	});

});


