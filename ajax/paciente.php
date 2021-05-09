<?php
 require_once "../modelos/Paciente.php";

$paciente=new Paciente();

$idpaciente=isset($_POST["idpaciente"])? limpiarCadena($_POST["idpaciente"]):"";
$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$fechanac=isset($_POST["fechanac"])? limpiarCadena($_POST["fechanac"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$genero=isset($_POST["genero"])? limpiarCadena($_POST["genero"]):"";

switch ($_GET["op"])
{

      case 'guardaryeditar':
      if(empty($idpaciente))
      {
        $rspta=$paciente->insertar($nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero);
       echo  $rspta?"paciente  Se registro con exito":"Paciente no se pudo registrar";
      }
      else
       {
         $rspta=$paciente->editar($idpaciente,$nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero);
         echo  $rspta?"paciente  Se Edito con exito !":"Paciente no se pudo Editar";

        }
        break;


      case 'eliminar':
    		$rspta=$paciente->eliminar($idpaciente);
     		echo $rspta?"Paciente eliminada":"Paciente no se puede eliminar";
    	break;

  case 'mostrar':
       $rspta=$paciente->mostrar($idpaciente);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$paciente->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(
            "0" =>'<div class="btn-group "><button type="button" class="btn btn-info dropdown-toggle"data-toggle="dropdown">
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><button class="btn btn-warning" onclick="mostrar('.$reg->idpaciente.')"><i class="fas fa-pencil-alt"></i></button></li>
                    <li><button class="btn btn-danger" onclick="eliminar('.$reg->idpaciente.')"><i class="fa fa-trash"></i></button></li>
                  </ul>
                </div>',
            "1" =>$reg->nombres,
            "2" =>$reg->apellidos,
            "3" =>$reg->edad,
            "4"=>$reg->num_documento,
            "5" =>$reg->telefono,
            "6" =>$reg->direccion,
            "7" =>$reg->email,
            "8"=>$reg->agregado
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

}
?>
