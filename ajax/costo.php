<?php
 require_once "../modelos/Costo.php";

$costo=new Costo();

$idcosto=isset($_POST["idcosto"])? limpiarCadena($_POST["idcosto"]):"";
$idespecialidad=isset($_POST["idespecialidad"])? limpiarCadena($_POST["idespecialidad"]):"";
$precio=isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";

switch ($_GET["op"])
{
  case 'guardaryeditar':
  if(empty($idcosto))
  {
    $rspta=$costo->insertar($idespecialidad,$precio);
    echo  $rspta?"costo  Se registro con exito":"costo no se pudo registrar";
  }
  else
   {
     $rspta=$costo->editar($idcosto,$idespecialidad,$precio);
     echo  $rspta?"costo se Actualizo con Exito !":"costo no se pudo Actualizar";

    }
    break;

  case 'desactivar':
        $rspta=$costo->desactivar($idcosto);
        echo  $rspta?"costo desactivada con Exito!":"costo no se pudo desactivar";

      break;

  case 'activar':
           $rspta=$costo->activar($idcosto);
           echo  $rspta ? "costo activada con Exito!":"costo no se pudo activar";
      break;
  case 'mostrar':
       $rspta=$costo->mostrar($idcosto);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$costo->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(
            "0" =>($reg->estado)?'<button  type="button" class="btn btn-warning" onclick="mostrar('.$reg->idcosto.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-danger" onclick="desactivar('.$reg->idcosto.')"><i class="fa fa-close"></i></button>':
                           					'<button type="button" class="btn btn-warning" onclick="mostrar('.$reg->idcosto.')"><i class="fas fa-pencil-alt"></i></button>'.' <button class="btn btn-primary" onclick="activar('.$reg->idcosto.')"><i class="fa fa-check"></i></button>',
            "1" =>$reg->especialidad,
            "2" =>$reg->precio,
            //"2" => accounting.formatNumber($reg->precio,0,'.',','),
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

        case "selectEspecialidad":
            require_once "../modelos/Especialidad.php";
            $especialidad = new Especialidad();

            $rspta = $especialidad->select();
  echo '<option value=""  selected disabled>seleccione especialidad</option>';
            while ($reg = $rspta->fetch_object())
                {
                  echo '<option value=' . $reg->idespecialidad . '>' . $reg->nombre . '</option>';

                }
          break;


}
?>
