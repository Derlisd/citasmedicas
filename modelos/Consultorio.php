<?php
require "../config/Conexion.php";

class Consultorio
{
    public function __construct()
    {

    }

    public function insertar($nombre)
    {
         $sql="INSERT INTO consultorio (nombre,estado)VALUES
         ('$nombre','1')";
         return ejecutarConsulta($sql);
    }

    public function editar($idconsultorio,$nombre)
    {
        $sql="UPDATE consultorio SET nombre='$nombre' WHERE idconsultorio='$idconsultorio'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar categorías
  	public function desactivar($idconsultorio)
  	{
  		$sql="UPDATE consultorio SET estado='0' WHERE idconsultorio='$idconsultorio'";
  		return ejecutarConsulta($sql);
  	}

  	//Implementamos un método para activar categorías
  	public function activar($idconsultorio)
  	{
  		$sql="UPDATE consultorio SET estado='1' WHERE idconsultorio='$idconsultorio'";
  		return ejecutarConsulta($sql);
  	}

    public function mostrar($idconsultorio)
    {
        $sql="SELECT * FROM consultorio WHERE idconsultorio='$idconsultorio'";
        return ejecutarConsultaSimpleFila($sql);
    }


    public function listar()
    {
        $sql="SELECT * FROM consultorio";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
      $sql="SELECT * FROM consultorio WHERE estado=1";
      return ejecutarConsulta($sql);
    }

}
?>
