var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

  $.post("../ajax/medico.php?op=selectEspecialidad", function(r){
            $("#idespecialidad").html(r);
            $('#idespecialidad').selectpicker('refresh');

});

$.post("../ajax/medico.php?op=selectConsultorio", function(r){
            $("#idconsultorio").html(r);
            $('#idconsultorio').selectpicker('refresh');

});

}

//Función limpiar
function limpiar()
{
	$("#nombres").val("");
	$("#apellidos").val("");
	$("#fechanac").val("");
	$("#telefono").val("");
	$("#direccion").val("");
	$("#email").val("");
	$("#num_documento").val("");
	$("#idmedico").val("");
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
					url: '../ajax/medico.php?op=listar',
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
					 url: "../ajax/medico.php?op=guardaryeditar",
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



function mostrar(idmedico)
{

	$.post("../ajax/medico.php?op=mostrar",{idmedico : idmedico}, function(data, status)
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
    $("#idespecialidad").val(data.idespecialidad);
		$('#idespecialidad').selectpicker('refresh');
    $("#idconsultorio").val(data.idconsultorio);
		$('#idconsultorio').selectpicker('refresh');
 		$("#idmedico").val(data.idmedico);

 	})
}

//Función para activar registros
function activar(idmedico)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea activar el Medico?",
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
						$.post("../ajax/medico.php?op=activar", {idmedico : idmedico}, function(e){
						swal("!!! Activar !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del medico", "error");
			 }
			});
}

//Función para activar registros
function desactivar(idmedico)
{
	swal({
		    title: "¿desactivar?",
		    text: "¿Está seguro Que desea desactivar el Medico?",
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
						$.post("../ajax/medico.php?op=desactivar", {idmedico : idmedico}, function(e){
						swal("!!! desactivar !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la desactivacion del medico", "error");
			 }
			});
}






init();
