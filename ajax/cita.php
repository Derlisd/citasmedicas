<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Cita.php";

$cita=new Cita();

$idcita=isset($_POST["idcita"])? limpiarCadena($_POST["idcita"]):"";
$idusuario=$_SESSION["idusuario"];
$idpaciente=isset($_POST["idpaciente"])? limpiarCadena($_POST["idpaciente"]):"";
$iddetalle_horario=isset($_POST["iddetalle_horario"])? limpiarCadena($_POST["iddetalle_horario"]):"";
$idcosto=isset($_POST["idcosto"])? limpiarCadena($_POST["idcosto"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcita)){
			$rspta=$cita->insertar($idusuario,$idpaciente,$iddetalle_horario,$idcosto,$observaciones);
			echo $rspta ? "cita registrada" : "No se pudieron registrar todos los datos de la cita";
		}
		else {

		}
	break;

	case 'anular':
		$rspta=$cita->anular($idcita);
 		echo $rspta ? "cita anulada" : "cita no se puede anular";
	break;

  case 'pagado':
		$rspta=$cita->pagado($idcita);
 		echo $rspta ? "cita pagada" : "cita no se puede pagar";
	break;


	case 'listar':
		$rspta=$cita->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$url='../reportes/exTicket.php?id=';
 			$data[]=array(
 				"0"=>($reg->estado=='pendiente')?' <button class="btn btn-success" onclick="pagado('.$reg->idcita.')"><i class="fa fa-money"></i></button>'.'<a target="_blank" href="'.$url.$reg->idcita.'"><button class="btn btn-warning"><i class="fa fa-file-pdf"></i></button></a>' :
 					'<a target="_blank" href="'.$url.$reg->idcita.'"><button class="btn btn-warning"><i class="fa fa-file-pdf"></i></button></a>',

         		 "1"=>($reg->estado!='anulado')?' <button class="btn btn-danger" onclick="anular('.$reg->idcita.')"><i class="fa fa-close"></i></button>':
   					'<span class="label bg-red">Anulado</span>',
				 "2"=>$reg->usuario,
				 "3"=>$reg->medico,
 				"4"=>$reg->paciente,
 				"5"=>$reg->fecha.' - '.$reg->hora,
 				"6"=>$reg->precio,
 				"7"=>$reg->observaciones,
 				"8"=>($reg->estado=='anulado')?'<span class="label bg-red">anulado</span>':
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

	case 'selectPaciente':
		require_once "../modelos/Paciente.php";
		$paciente = new Paciente();

		$rspta = $paciente->select();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idpaciente . '>' . $reg->nombre . '</option>';
				}
	break;

  case 'selectEspecialidad':
    require_once "../modelos/Especialidad.php";
    $especialidad = new Especialidad();
    $rspta = $especialidad->listar();
	echo '<option value=""  selected disabled>seleccione Especialidad</option>';
    while ($reg = $rspta->fetch_object())
        {
        echo '<option value=' . $reg->idespecialidad . '>' . $reg->nombre . '</option>';
        }
  break;


  case 'selectMedico':
      $id_especialidad = $_POST['idespecialidad'];
    		$rspta = $cita->listarmedico($id_especialidad);
    echo '<option value=""  selected disabled>seleccione medico</option>';
    		while ($reg = $rspta->fetch_object())
    				{
    				echo '<option value=' . $reg->idmedico . '>' . $reg->nombres . '</option>';
    				}
	break;


  case 'selectFecha':
        $id_medico = $_POST['idmedico'];
      		$rspta = $cita->listarfecha($id_medico);
      echo '<option value=""  selected disabled>seleccione fecha</option>';
      		while ($reg = $rspta->fetch_object())
      				{
      				echo '<option value=' . $reg->idhorario . '>' . $reg->fecha . '</option>';
      				}
	break;


  case 'selectHora':
    	$id_horario = $_POST['idhorario'];
    		$rspta = $cita->listarhora($id_horario);
    echo '<option value=""  selected disabled>seleccione Hora</option>';
    		while ($reg = $rspta->fetch_object())
    				{
    				echo '<option value=' . $reg->iddetalle_horario . '>' . $reg->nombre . '</option>';
    				}
	break;

  case 'selectcosto':
    $idespecialidad = $_POST['idespecialidad'];
    		$rspta = $cita->listarcosto($idespecialidad);
    		while ($reg = $rspta->fetch_object())
    				{
    				echo '<option value=' . $reg->idcosto . '>' . $reg->precio . '</option>';
    				}
	break;

}
?>
