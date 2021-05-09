<?php
require "../config/Conexion.php";

class Paciente
{
    public function __construct()
    {

    }

    public function insertar($nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero)
    {
         $sql="INSERT INTO paciente(nombres,apellidos,fechanac,tipo_documento,num_documento,telefono,direccion,email,genero)VALUES('$nombres','$apellidos','$fechanac','$tipo_documento','$num_documento','$telefono','$direccion','$email','$genero')";
         return ejecutarConsulta($sql);
    }

    public function editar($idpaciente,$nombres,$apellidos,$fechanac,$tipo_documento,$num_documento,$telefono,$direccion,$email,$genero)
    {
        $sql="UPDATE paciente SET nombres='$nombres',apellidos='$apellidos',fechanac='$fechanac',tipo_documento='$tipo_documento',num_documento='$num_documento',telefono='$telefono',direccion='$direccion',genero='$genero' WHERE idpaciente='$idpaciente'";
        return ejecutarConsulta($sql);
    }


    public function mostrar($idpaciente)
    {
        $sql="SELECT * FROM paciente WHERE idpaciente='$idpaciente'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Implementamos un método para eliminar categorías
  	public function eliminar($idpaciente)
  	{
  		$sql="DELETE FROM paciente WHERE idpaciente='$idpaciente'";
  		return ejecutarConsulta($sql);
  	}

    public function listar()
    {
        $sql="SELECT idpaciente,nombres,apellidos,TIMESTAMPDIFF(YEAR,fechanac,CURDATE()) AS edad,tipo_documento,num_documento,telefono,direccion,email,genero,agregado FROM paciente";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
      $sql="SELECT idpaciente, CONCAT(nombres,' ',apellidos) as nombre FROM paciente";
      return ejecutarConsulta($sql);
    }

}
?>
