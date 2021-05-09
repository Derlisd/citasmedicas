<?php
require "../config/Conexion.php";

class Especialidad
{
    public function __construct()
    {

    }

    public function insertar($nombre)
    {
         $sql="INSERT INTO especialidad (nombre,estado)VALUES
         ('$nombre','1')";
         return ejecutarConsulta($sql);
    }

    public function editar($idespecialidad,$nombre)
    {
        $sql="UPDATE especialidad SET nombre='$nombre' WHERE idespecialidad='$idespecialidad'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar categorías
  	public function desactivar($idespecialidad)
  	{
  		$sql="UPDATE especialidad SET estado='0' WHERE idespecialidad='$idespecialidad'";
  		return ejecutarConsulta($sql);
  	}

  	//Implementamos un método para activar categorías
  	public function activar($idespecialidad)
  	{
  		$sql="UPDATE especialidad SET estado='1' WHERE idespecialidad='$idespecialidad'";
  		return ejecutarConsulta($sql);
  	}

    public function mostrar($idespecialidad)
    {
        $sql="SELECT * FROM especialidad WHERE idespecialidad='$idespecialidad'";
        return ejecutarConsultaSimpleFila($sql);
    }


    public function listar()
    {
        $sql="SELECT * FROM especialidad";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
      $sql="SELECT * FROM especialidad WHERE estado=1";
      return ejecutarConsulta($sql);
    }

}
?>
