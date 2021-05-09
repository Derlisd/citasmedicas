<?php
require "../config/Conexion.php";

class Hora
{
    public function __construct()
    {

    }

    public function insertar($nombre)
    {
         $sql="INSERT INTO hora (nombre,estado)VALUES
         ('$nombre','1')";
         return ejecutarConsulta($sql);
    }

    public function editar($idhora,$nombre)
    {
        $sql="UPDATE hora SET nombre='$nombre' WHERE idhora='$idhora'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar categorías
  	public function desactivar($idhora)
  	{
  		$sql="UPDATE hora SET estado='0' WHERE idhora='$idhora'";
  		return ejecutarConsulta($sql);
  	}

  	//Implementamos un método para activar categorías
  	public function activar($idhora)
  	{
  		$sql="UPDATE hora SET estado='1' WHERE idhora='$idhora'";
  		return ejecutarConsulta($sql);
  	}

    public function mostrar($idhora)
    {
        $sql="SELECT * FROM hora WHERE idhora='$idhora'";
        return ejecutarConsultaSimpleFila($sql);
    }


    public function listar()
    {
        $sql="SELECT * FROM hora";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
      $sql="SELECT * FROM hora WHERE estado=1";
      return ejecutarConsulta($sql);
    }

}
?>
