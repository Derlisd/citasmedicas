<?php
 require_once "../modelos/Medico.php";

$medico=new Medico();

$idmedico=isset($_POST["idmedico"])? limpiarCadena($_POST["idmedico"]):"";
$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$fechanac=isset($_POST["fechanac"])? limpiarCadena($_POST["fechanac"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$genero=isset($_POST["genero"])? limpiarCadena($_POST["genero"]):"";
$idespecialidad=isset($_POST["idespecialidad"])? limpiarCadena($_POST["idespecialidad"]):"";
$idconsultorio=isset($_POST["idconsultorio"])? limpiarCadena($_POST["idconsultorio"]):"";

switch ($_GET["op"])
{

      case 'guardaryeditar':
      if(empty($idmedico))
      {
        $rspta=$medico->insertar($nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero,$idespecialidad,$idconsultorio);
       echo  $rspta?"Medico  Se registro con exito":"Medico no se pudo registrar";
      }
      else
       {
         $rspta=$medico->editar($idmedico,$nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero,$idespecialidad,$idconsultorio);
         echo  $rspta?"Medico  Se Edito con exito !":"Medico no se pudo Editar";

        }
        break;


      case 'activar':
    		$rspta=$medico->activar($idmedico);
     		echo $rspta?"Medico activado con Exitoso":"Medico no se puede activar";
    	break;

      case 'desactivar':
    		$rspta=$medico->desactivar($idmedico);
     		echo $rspta?"Medico desactivado con Exitoso":"Medico no se puede desactivar";
    	break;


  case 'mostrar':
       $rspta=$medico->mostrar($idmedico);
          echo  json_encode($rspta);
      break;

  case 'listar':
      $rspta=$medico->listar();
      $data= Array();

      while ($reg=$rspta->fetch_object())
       {
           $data[]= array(


             "0" =>($reg->estado)?'<div class="btn-group "><button type="button" class="btn btn-info dropdown-toggle"data-toggle="dropdown">
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu" role="menu">
                       <li><button  type="button" class="btn btn-warning" onclick="mostrar('.$reg->idmedico.')"><i class="fas fa-pencil-alt"></i> Editar</button></li>'.' <li><button class="btn btn-danger" onclick="desactivar('.$reg->idmedico.')"><i class="fa fa-close"></i> desactivar</button></li>
                   </ul>
                 </div>':
                 '<div class="btn-group "><button type="button" class="btn btn-info dropdown-toggle"data-toggle="dropdown">
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu" role="menu">
                           <li><button type="button" class="btn btn-warning" onclick="mostrar('.$reg->idmedico.')"><i class="fas fa-pencil-alt"></i> Editar</button></li>'.'<li> <button class="btn btn-primary" onclick="activar('.$reg->idmedico.')"><i class="fa fa-check"></i> activar</button></li>
                       </ul>
                     </div>',

            "1" =>$reg->nombres,
            "2" =>$reg->apellidos,
            "3" =>$reg->especialidad,
            "4" =>$reg->consultorio,
            "5" =>$reg->edad,
            "6"=>$reg->num_documento,
            "7" =>$reg->telefono,
            "8"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
              "9"=>$reg->agregado
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

      case "selectConsultorio":
          require_once "../modelos/Consultorio.php";
          $consultorio = new Consultorio();

          $rspta = $consultorio->select();
echo '<option value=""  selected disabled>seleccione consultorio</option>';
          while ($reg = $rspta->fetch_object())
              {
                echo '<option value=' . $reg->idconsultorio . '>' . $reg->nombre . '</option>';

              }
        break;

}
?>
