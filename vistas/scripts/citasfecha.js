var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();
	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);
}


//Función Listar
function listar()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

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
					url: '../ajax/consultas.php?op=citasfecha',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
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
					{"data": "4",
					render: function ( data, type, row ) {
						return accounting.formatMoney(data, "₲ ", 0, ".", ",");
					}},
					{"data": "5"},
					{"data": "6"},
					{"data": "7"}
				],
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


init();