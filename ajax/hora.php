<?php
 require_once "../modelos/Hora.php";

$hora=new Hora();

$idhora=isset($_POST["idhora"])? limpiarCadena($_POST["idhora"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"])
{
  case 'guardaryeditar':
  if(empty($idhora))
  {
    $rspta=$hora->insertar($nombre);
    echo  $rspta?"hora  Se registro con exito":"hora no se pudo registrar";
  }
  else
   {
     $rspta=$hora->editar($idhora,$nombre);
     echo  $rspta?"hora se Actualizo con Exito !":"hora no se pudo Actualizar";

    }
    break;

  case 'desactivar':
        $rspta=$hora->desactivar($idhora);
        echo  $rspta?"hora desactivada con Exito!":"hora no se pudo desactivar";

      break;

  case 'activar':
           $rspta=$hora->activar($idhora);
           echo  $rspta ? "hora activada con Exito!":"hora no se pudo activar";
      break;
  case 'mostrar':
       $rspta=$hora->mostrar($idhora);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$hora->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(
            "0" =>($reg->estado)?'<button  type="button" class="btn btn-warning" onclick="mostrar('.$reg->idhora.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-danger" onclick="desactivar('.$reg->idhora.')"><i class="fa fa-close"></i></button>':
                           					'<button type="button" class="btn btn-warning" onclick="mostrar('.$reg->idhora.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-primary" onclick="activar('.$reg->idhora.')"><i class="fa fa-check"></i></button>',
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
