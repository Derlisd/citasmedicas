var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
}

//Función limpiar
function limpiar()
{
	$("#nombres").val("");
	$("#apellidos").val("");
	$("#fechanac").val("");
//	$("#tipo_documento").val("");
	$("#telefono").val("");
	$("#direccion").val("");
	$("#email").val("");
  // $("#genero").val("");

	$("#num_documento").val("");
	$("#idpaciente").val("");
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
					url: '../ajax/paciente.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	 e.preventDefault(); //No se activará la acción predeterminada del evento
	 $("#btnGuardar").prop("disabled",true);
	 var formData = new FormData($("#formulario")[0]);
   $.ajax({
					 url: "../ajax/paciente.php?op=guardaryeditar",
						 type: "POST",
						 data: formData,
						 contentType: false,
						 processData: false,

						 success: function(datos)
						 {
								swal({
								 title: 'Paciente',
								 type: 'success',
								 text:datos
							 });
									 mostrarform(false);
									 tabla.ajax.reload();
						 }

				 });
	limpiar();
}



function mostrar(idpaciente)
{

	$.post("../ajax/paciente.php?op=mostrar",{idpaciente : idpaciente}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#nombres").val(data.nombres);
		$("#apellidos").val(data.apellidos);
		$("#fechanac").val(data.fechanac);
		$("#tipo_documento").val(data.tipo_documento);
		$('#tipo_documento').selectpicker('refresh');
		$("#num_documento").val(data.num_documento);
		$("#telefono").val(data.telefono);
		$("#direccion").val(data.direccion);
		$("#email").val(data.email);
   	$("#genero").val(data.genero);
		$('#genero').selectpicker('refresh');
 		$("#idpaciente").val(data.idpaciente);

 	})
}

//Función para activar registros
function eliminar(idpaciente)
{
	swal({
		    title: "¿Eliminar?",
		    text: "¿Está seguro Que desea Eliminar el Paciente?",
		    type: "warning",
		    showCancelButton: true,
				confirmButtonColor: '#008df9',
				confirmButtonText: "Si",
		    cancelButtonText: "No",
				cancelButtonColor: '#FF0000',
		    closeOnConfirm: false,
		    closeOnCancel: false,
		    showLoaderOnConfirm: true
		    },function(isConfirm){
		    if (isConfirm){
						$.post("../ajax/paciente.php?op=eliminar", {idpaciente : idpaciente}, function(e){
						swal("!!! Eliminar !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la Eliminacion del Paciente", "error");
			 }
			});
}






init();
