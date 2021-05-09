<?php
 require_once "../modelos/Horario.php";

$horario=new Horario();

$idhorario=isset($_POST["idhorario"])? limpiarCadena($_POST["idhorario"]):"";
$idmedico=isset($_POST["idmedico"])? limpiarCadena($_POST["idmedico"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

switch ($_GET["op"])
{
  case 'guardaryeditar':
  if(empty($idhorario))
  {
    $rspta=$horario->insertar($idmedico,$fecha,$_POST['hora']);
    echo  $rspta?"Horario  Se registro con exito":"horario no se pudo registrar";
  }
  else
   {
     $rspta=$horario->editar($idhorario,$idmedico,$fecha,$_POST['hora']);
     echo  $rspta?"Horario se Actualizo con Exito !":"Horario no se pudo Actualizar";

    }
    break;

  case 'desactivar':
        $rspta=$horario->desactivar($idhorario);
        echo  $rspta?"Horario desactivada con Exito!":"Horario no se pudo desactivar";

      break;

  case 'activar':
           $rspta=$horario->activar($idhorario);
           echo  $rspta ? "Horario activada con Exito!":"Horario no se pudo activar";
      break;

  case 'mostrar':
       $rspta=$horario->mostrar($idhorario);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$horario->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(
            "0" =>($reg->estado)?'<button  type="button" class="btn btn-warning" onclick="mostrar('.$reg->idhorario.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-danger" onclick="desactivar('.$reg->idhorario.')"><i class="fa fa-close"></i></button>':
                           					'<button type="button" class="btn btn-warning" onclick="mostrar('.$reg->idhorario.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-primary" onclick="activar('.$reg->idhorario.')"><i class="fa fa-check"></i></button>',
            "1" =>$reg->medico,
            "2" =>$reg->fecha,
            "3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
           );
       }
       $results = array(
         "sEcho"=>1,
         "iTotalRecords"=>count($data),
         "iTotalDisplayRecords"=>count($data),
         "aaData"=>$data
       );

          echo json_encode($results);
        break;


      case 'horas':
		//Obtenemos todos los horas de la tabla horas
		require_once "../modelos/Hora.php";
		$hora = new Hora();
		$rspta = $hora->select();

		//Obtener los horas asignados al horario
		$id=$_GET['id'];
		$marcados = $horario->listarmarcados($id);
		//Declaramos el array para almacenar todos los horas marcados
		$valores=array();

		//Almacenar los horas asignados al horario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idhora);
			}

		//Mostramos la lista de horas en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idhora,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="hora[]" value="'.$reg->idhora.'">'.$reg->nombre.'</li>';
				}
	break;


        case "selectMedico":
            require_once "../modelos/Medico.php";
            $medico = new Medico();

            $rspta = $medico->select();

            while ($reg = $rspta->fetch_object())
                {
                  echo '<option value=' . $reg->idmedico . '>' . $reg->medico . '</option>';
                }
          break;

}
?>
