<?php 
require_once "../modelos/Consultas.php";

$consulta=new Consultas();

switch ($_GET["op"]){
	case 'citasfecha':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$consulta->citasfecha($fecha_inicio,$fecha_fin);
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->usuario,
				"1"=>$reg->paciente,
			    "2"=>$reg->medico,
 				"3"=>$reg->fecha.'  '.$reg->hora,
 				"4"=>$reg->precio,
 				"5"=>$reg->observaciones,
 				"6"=>$reg->agregado,
 				"7"=>($reg->estado=='anulado')?'<span class="label bg-red">anulado</span>':
 				'<span class="label bg-green">'.$reg->estado.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'citasfechapaciente':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$idpaciente=$_REQUEST["idpaciente"];

		$rspta=$consulta->citasfechapaciente($fecha_inicio,$fecha_fin,$idpaciente);
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->usuario,
				"1"=>$reg->paciente,
				"2"=>$reg->medico,
 				"3"=>$reg->fecha.'  '.$reg->hora,
 				"4"=>$reg->precio,
 				"5"=>$reg->observaciones,
 				"6"=>$reg->agregado,
 				"7"=>($reg->estado=='anulado')?'<span class="label bg-red">anulado</span>':
 				'<span class="label bg-green">'.$reg->estado.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'citasfechamedico':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$idmedico=$_REQUEST["idmedico"];

		$rspta=$consulta->citasfechamedico($fecha_inicio,$fecha_fin,$idmedico);
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->usuario,
				"1"=>$reg->paciente,
				"2"=>$reg->medico,
 				"3"=>$reg->fecha.'  '.$reg->hora,
 				"4"=>$reg->precio,
 				"5"=>$reg->observaciones,
 				"6"=>$reg->agregado,
 				"7"=>($reg->estado=='anulado')?'<span class="label bg-red">anulado</span>':
 				'<span class="label bg-green">'.$reg->estado.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectMedico':
		$rspta = $consulta->selectMedico();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idmedico . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>