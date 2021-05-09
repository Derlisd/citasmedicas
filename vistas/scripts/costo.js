var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
	$.post("../ajax/costo.php?op=selectEspecialidad", function(r){
            $("#idespecialidad").html(r);
            $('#idespecialidad').selectpicker('refresh');

});
}

//Función limpiar
function limpiar()
{
	$("#precio").val("");
	$("#idcosto").val("");
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
/**
   columns: [{
            field: 'id_persona',
            title: 'Item ID',
            width: '100',
            visible: false
        }, {
            field: 'operacion',
            title: 'Acciones',
            align: 'center',
            formatter: 'OperationFormatter',
            width: '100'
        }],
        data: data,
    });
}

function OperationFormatter(value, row) {

    var html = '';
    //if(Permisos.EDITAR > 0){
    html += '<button id=' + row.id_persona + ' type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#persona_modal"><i class="far fa-edit"></i></button>&nbsp;&nbsp;';
    //}
    // if(Permisos.ELIMINAR > 0){
    html += '<button id=' + row.id_persona + ' type="button" onclick="openSweetDelete(this.id);" class="btn btn-danger btn-sm deleteregistro" ><i class="far fa-trash-alt"></i></button>';
    // }
    return html;
}

 */

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
					url: '../ajax/costo.php?op=listar',
					type : "get",
					dataType : "json",
					
					error: function(e){
						console.log(e.responseText);
					}
				
				},
				"columns" : [
					{"data": '0'},
					{"data": '1'},
					{"data": '2',
					render: function ( data, type, row ) {
						return accounting.formatMoney(data, "₲ ", 0, ".", ",");
					}},
					{"data": '3'}, 
				],
				
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
					 url: "../ajax/costo.php?op=guardaryeditar",
						 type: "POST",
						 data: formData,
						 contentType: false,
						 processData: false,

						 success: function(datos)
						 {
								swal({
								 title: 'costo',
								 type: 'success',
								 text:datos
							 });
									 mostrarform(false);
									 tabla.ajax.reload();
						 }

				 });



	limpiar();
}

function mostrar(idcosto)
{
	$.post("../ajax/costo.php?op=mostrar",{idcosto : idcosto}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#precio").val(data.precio);
		$("#idespecialidad").val(data.idespecialidad);
		$('#idespecialidad').selectpicker('refresh');
			$("#idcosto").val(data.idcosto);

 	})
}

//Función para desactivar registros
function desactivar(idcosto)
{
   	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro Que Desea Desactivar el costo?",
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
									$.post("../ajax/costo.php?op=desactivar", {idcosto : idcosto}, function(e){
										swal(
											'!!! Desactivada !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la desactivacion de la costo", "error");
							 }
							});

}

//Función para activar registros
function activar(idcosto)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea Activar la costo ?",
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
						$.post("../ajax/costo.php?op=activar", {idcosto : idcosto}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion de la costo", "error");
			 }
			});

}



init();
