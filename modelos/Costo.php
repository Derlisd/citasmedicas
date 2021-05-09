<?php
require "../config/Conexion.php";

class Costo
{
    public function __construct()
    {

    }

    public function insertar($idespecialidad,$precio)
    {
         $sql="INSERT INTO costo (idespecialidad,precio,estado)VALUES
         ('$idespecialidad','$precio','1')";
         return ejecutarConsulta($sql);
    }

    public function editar($idcosto,$idespecialidad,$precio)
    {
        $sql="UPDATE costo SET idespecialidad='$idespecialidad',precio='$precio' WHERE idcosto='$idcosto'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar categorías
  	public function desactivar($idcosto)
  	{
  		$sql="UPDATE costo SET estado='0' WHERE idcosto='$idcosto'";
  		return ejecutarConsulta($sql);
  	}

  	//Implementamos un método para activar categorías
  	public function activar($idcosto)
  	{
  		$sql="UPDATE costo SET estado='1' WHERE idcosto='$idcosto'";
  		return ejecutarConsulta($sql);
  	}

    public function mostrar($idcosto)
    {
        $sql="SELECT * FROM costo WHERE idcosto='$idcosto'";
        return ejecutarConsultaSimpleFila($sql);
    }


    public function listar()
    {
        $sql="SELECT c.idcosto,e.nombre as especialidad,c.precio,c.estado FROM costo c INNER JOIN especialidad e on c.idespecialidad=e.idespecialidad";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
      $sql="SELECT * FROM costo WHERE estado=1";
      return ejecutarConsulta($sql);
    }

}
?>
