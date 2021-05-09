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
	$("#nombre").val("");
	$("#idconsultorio").val("");
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
					url: '../ajax/consultorio.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 1,//Paginación
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
					 url: "../ajax/consultorio.php?op=guardaryeditar",
						 type: "POST",
						 data: formData,
						 contentType: false,
						 processData: false,

						 success: function(datos)
						 {
								swal({
								 title: 'consultorio',
								 type: 'success',
								 text:datos
							 });
									 mostrarform(false);
									 tabla.ajax.reload();
						 }

				 });



	limpiar();
}

function mostrar(idconsultorio)
{
	$.post("../ajax/consultorio.php?op=mostrar",{idconsultorio : idconsultorio}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#nombre").val(data.nombre);
 		$("#idconsultorio").val(data.idconsultorio);

 	})
}

//Función para desactivar registros
function desactivar(idconsultorio)
{
   	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro Que Desea Desactivar el consultorio?",
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
									$.post("../ajax/consultorio.php?op=desactivar", {idconsultorio : idconsultorio}, function(e){
										swal(
											'!!! Desactivada !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la desactivacion de la consultorio", "error");
							 }
							});

}

//Función para activar registros
function activar(idconsultorio)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea Activar la consultorio ?",
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
						$.post("../ajax/consultorio.php?op=activar", {idconsultorio : idconsultorio}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion de la consultorio", "error");
			 }
			});

}



init();
