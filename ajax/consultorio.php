<?php
 require_once "../modelos/Consultorio.php";

$consultorio=new Consultorio();

$idconsultorio=isset($_POST["idconsultorio"])? limpiarCadena($_POST["idconsultorio"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"])
{
  case 'guardaryeditar':
  if(empty($idconsultorio))
  {
    $rspta=$consultorio->insertar($nombre);
    echo  $rspta?"consultorio  Se registro con exito":"consultorio no se pudo registrar";
  }
  else
   {
     $rspta=$consultorio->editar($idconsultorio,$nombre);
     echo  $rspta?"consultorio se Actualizo con Exito !":"consultorio no se pudo Actualizar";

    }
    break;

  case 'desactivar':
        $rspta=$consultorio->desactivar($idconsultorio);
        echo  $rspta?"consultorio desactivada con Exito!":"consultorio no se pudo desactivar";

      break;

  case 'activar':
           $rspta=$consultorio->activar($idconsultorio);
           echo  $rspta ? "consultorio activada con Exito!":"consultorio no se pudo activar";
      break;
  case 'mostrar':
       $rspta=$consultorio->mostrar($idconsultorio);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$consultorio->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(
            "0" =>($reg->estado)?'<button  type="button" class="btn btn-warning" onclick="mostrar('.$reg->idconsultorio.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-danger" onclick="desactivar('.$reg->idconsultorio.')"><i class="fa fa-close"></i></button>':
                           					'<button type="button" class="btn btn-warning" onclick="mostrar('.$reg->idconsultorio.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-primary" onclick="activar('.$reg->idconsultorio.')"><i class="fa fa-check"></i></button>',
            "1" =>$reg->nombre,
            "2" =>$reg->agregado,
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

}
?>
