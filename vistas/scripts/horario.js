var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
	$.post("../ajax/horario.php?op=horas&id=",function(r){
		        $("#horas").html(r);
		});

  $.post("../ajax/horario.php?op=selectMedico", function(r){
            $("#idmedico").html(r);
            $('#idmedico').selectpicker('refresh');

});



}

//Función limpiar
function limpiar()
{
	$("#idhorario").val("");
	$("#fecha").val("");
	$("#horas :checkbox").attr('checked',false);//  limpiar el checkbox
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
					url: '../ajax/horario.php?op=listar',
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
					 url: "../ajax/horario.php?op=guardaryeditar",
						 type: "POST",
						 data: formData,
						 contentType: false,
						 processData: false,

						 success: function(datos)
						 {
								swal({
								 title: 'Horario',
								 type: 'success',
								 text:datos
							 });
									 mostrarform(false);
									 tabla.ajax.reload();
						 }

				 });
	limpiar();
}



function mostrar(idhorario)
{

	$.post("../ajax/horario.php?op=mostrar",{idhorario : idhorario}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
    $("#idmedico").val(data.idmedico);
		$('#idmedico').selectpicker('refresh');
    $("#fecha").val(data.fecha);
 		$("#idhorario").val(data.idhorario);
 	});
	$.post("../ajax/horario.php?op=horas&id="+idhorario,function(r){
		        $("#horas").html(r);
		});
}

//Función para activar registros
function activar(idhorario)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea activar el horario?",
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
						$.post("../ajax/horario.php?op=activar", {idhorario : idhorario}, function(e){
						swal("!!! Activar !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del horario", "error");
			 }
			});
}

//Función para activar registros
function desactivar(idhorario)
{
	swal({
		    title: "¿desactivar?",
		    text: "¿Está seguro Que desea desactivar el horario?",
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
						$.post("../ajax/horario.php?op=desactivar", {idhorario : idhorario}, function(e){
						swal("!!! desactivar !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la desactivacion del horario", "error");
			 }
			});
}



init();
