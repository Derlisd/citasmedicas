var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});
	//Cargamos los items al select paciente
	$.post("../ajax/cita.php?op=selectPaciente", function(r){
	            $("#idpaciente").html(r);
	            $('#idpaciente').selectpicker('refresh');
	});
	//Cargamos los items al select especialidad
	$.post("../ajax/cita.php?op=selectEspecialidad", function(r){
							$("#cbx_especialidad").html(r);
							$('#cbx_especialidad').selectpicker('refresh');
	});

// listar medico
	$(document).ready(function(){
		$("#cbx_especialidad").change(function () {
			$('#iddetalle_horario').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#cbx_fecha').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#idcosto').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$("#cbx_especialidad option:selected").each(function () {
				idespecialidad = $(this).val();
				$.post("../ajax/cita.php?op=selectMedico", { idespecialidad: idespecialidad }, function(data){
					$("#cbx_medico").html(data);
				});
			});
		})
	});

	// listar fecha
		$(document).ready(function(){
			$("#cbx_medico").change(function () {
				$('#iddetalle_horario').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
				$("#cbx_medico option:selected").each(function () {
					idmedico = $(this).val();
					$.post("../ajax/cita.php?op=selectFecha", { idmedico: idmedico }, function(data){
						$("#cbx_fecha").html(data);
					});
				});
			})
		});

// listar hora
	$(document).ready(function(){
		$("#cbx_fecha").change(function () {
			$("#cbx_fecha option:selected").each(function () {
				idhorario = $(this).val();
				$.post("../ajax/cita.php?op=selectHora", { idhorario: idhorario }, function(data){
					$("#iddetalle_horario").html(data);
				});
			});
		})
	});
// listar costo
	$(document).ready(function(){
		$("#cbx_especialidad").change(function () {
			$("#cbx_especialidad option:selected").each(function () {
				idespecialidad = $(this).val();
				$.post("../ajax/cita.php?op=selectcosto", { idespecialidad: idespecialidad }, function(data){
					$("#idcosto").html(data);
				});
			});
		})
	});

}

//Función limpiar
function limpiar()
{
	$("#observaciones").val("");
	$('#cbx_medico').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
	$('#iddetalle_horario').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
	$('#cbx_fecha').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
	$('#idcosto').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
    $("#nuevo").show();
    $("#mlista").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
    $("#nuevo").hide();
    $("#mlista").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/cita.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
				"columns":[
					{"data": "0"},
					{"data": "1"},
					{"data": "2"},
					{"data": "3"},
					{"data": "4"},
					{"data": "5"},
					{"data": "6",
					render: function ( data, type, row ) {
						return accounting.formatMoney(data, "₲ ", 0, ".", ",");
					}},
					{"data": "7"},
					{"data": "8"}
				],
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e)
{
	 e.preventDefault(); //No se activará la acción predeterminada del evento
	 $("#btnGuardar").prop("disabled",true);
	 var formData = new FormData($("#formulario")[0]);
				 $.ajax({
					 url: "../ajax/cita.php?op=guardaryeditar",
						 type: "POST",
						 data: formData,
						 contentType: false,
						 processData: false,

						 success: function(datos)
						 {
								swal({
								 title: 'Cita',
								 type: 'success',
								 text:datos
							 });
									 mostrarform(false);
									 tabla.ajax.reload();
						 }
				 });
	limpiar();
}


function anular(idcita)
{
   	swal({
						    title: "Anular?",
						    text: "¿Está seguro Que Desea Anular la Cita?",
						    type: "warning",
						    showCancelButton: true,
								cancelButtonText: "No",
								cancelButtonColor: '#FF0000',
						    confirmButtonText: "Si",
						    confirmButtonColor: "#008df9",
						    closeOnConfirm: false,
						    closeOnCancel: false,
						    showLoaderOnConfirm: true
						    },function(isConfirm){
						    if (isConfirm){
									$.post("../ajax/cita.php?op=anular", {idcita : idcita}, function(e){
										swal(
											'!!! Anular !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la Anulacion de la Cita", "error");
							 }
							});
}



function pagado(idcita)
{
	swal({
						 title: "¿Pagar?",
						 text: "¿Está seguro Que Desea pagar la Cita?",
						 type: "warning",
						 showCancelButton: true,
						 cancelButtonText: "No",
						 cancelButtonColor: '#FF0000',
						 confirmButtonText: "Si",
						 confirmButtonColor: "#008df9",
						 closeOnConfirm: false,
						 closeOnCancel: false,
						 showLoaderOnConfirm: true
						 },function(isConfirm){
						 if (isConfirm){
							 	$.post("../ajax/cita.php?op=pagado", {idcita : idcita}, function(e){
						 	swal('!!! Pagar !!!',e,'success')
						 			tabla.ajax.reload();
						 	});
						 }else {
						 swal("! Cancelado ¡", "Se Cancelo la Anulacion de la Cita", "error");
						}
					 });
}


init();
