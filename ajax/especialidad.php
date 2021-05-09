<?php
 require_once "../modelos/Especialidad.php";

$especialidad=new Especialidad();

$idespecialidad=isset($_POST["idespecialidad"])? limpiarCadena($_POST["idespecialidad"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"])
{
  case 'guardaryeditar':
  if(empty($idespecialidad))
  {
    $rspta=$especialidad->insertar($nombre);
    echo  $rspta?"especialidad  Se registro con exito":"especialidad no se pudo registrar";
  }
  else
   {
     $rspta=$especialidad->editar($idespecialidad,$nombre);
     echo  $rspta?"especialidad se Actualizo con Exito !":"especialidad no se pudo Actualizar";

    }
    break;

  case 'desactivar':
        $rspta=$especialidad->desactivar($idespecialidad);
        echo  $rspta?"especialidad desactivada con Exito!":"especialidad no se pudo desactivar";

      break;

  case 'activar':
           $rspta=$especialidad->activar($idespecialidad);
           echo  $rspta ? "especialidad activada con Exito!":"especialidad no se pudo activar";
      break;
  case 'mostrar':
       $rspta=$especialidad->mostrar($idespecialidad);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$especialidad->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(
            "0" =>($reg->estado)?'<button  type="button" class="btn btn-warning" onclick="mostrar('.$reg->idespecialidad.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-danger" onclick="desactivar('.$reg->idespecialidad.')"><i class="fa fa-close"></i></button>':
                           					'<button type="button" class="btn btn-warning" onclick="mostrar('.$reg->idespecialidad.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-primary" onclick="activar('.$reg->idespecialidad.')"><i class="fa fa-check"></i></button>',
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
