<?php
require "../config/Conexion.php";

class Medico
{
    public function __construct()
    {

    }

    public function insertar($nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero,$idespecialidad,$idconsultorio)
    {
         $sql="INSERT INTO medico(nombres,apellidos,fechanac,tipo_documento,num_documento,telefono,direccion,email,genero,idespecialidad,idconsultorio,estado)VALUES
         ('$nombres','$apellidos','$fechanac','$tipo_documento','$num_documento','$telefono','$direccion','$email','$genero','$idespecialidad','$idconsultorio','1')";
         return ejecutarConsulta($sql);
    }

    public function editar($idmedico,$nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero,$idespecialidad,$idconsultorio)
    {
        $sql="UPDATE medico SET nombres='$nombres',apellidos='$apellidos',fechanac='$fechanac',tipo_documento='$tipo_documento',num_documento='$num_documento',telefono='$telefono',direccion='$direccion',email='$email',genero='$genero',idespecialidad='$idespecialidad',idconsultorio='$idconsultorio' WHERE idmedico='$idmedico'";
        return ejecutarConsulta($sql);
    }


    public function mostrar($idmedico)
    {
        $sql="SELECT * FROM medico WHERE idmedico='$idmedico'";
        return ejecutarConsultaSimpleFila($sql);
    }

  	public function activar($idmedico)
  	{
  		$sql="UPDATE medico SET estado='1' WHERE idmedico='$idmedico'";
  		return ejecutarConsulta($sql);
  	}

    public function desactivar($idmedico)
    {
      	$sql="UPDATE medico SET estado='0' WHERE idmedico='$idmedico'";
      return ejecutarConsulta($sql);
    }

    public function listar()
    {
        $sql="SELECT m.idmedico,m.nombres,m.apellidos,e.nombre as especialidad,c.nombre as consultorio,TIMESTAMPDIFF(YEAR,m.fechanac,CURDATE()) AS edad,m.tipo_documento,m.num_documento,m.telefono,m.direccion,m.email,m.genero,m.agregado,m.estado FROM medico m INNER JOIN especialidad  e  ON e.idespecialidad=m.idespecialidad INNER JOIN consultorio  c  ON c.idconsultorio=m.idconsultorio ORDER BY m.idmedico DESC";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
      $sql="SELECT idmedico,CONCAT(nombres,' ',apellidos) as medico FROM medico WHERE estado=1";
      return ejecutarConsulta($sql);
    }

}
?>
