<?php
require "../config/Conexion.php";

class Horario
{
    public function __construct()
    {

    }

    public function insertar($idmedico,$fecha,$horas)
    	{
    		$sql="INSERT INTO horario(idmedico,fecha,estado)VALUES ('$idmedico','$fecha','1')";
    		//return ejecutarConsulta($sql);
    		$idhorarionew=ejecutarConsulta_retornarID($sql);

    		$num_elementos=0;
    		$sw=true;

    		while ($num_elementos < count($horas))
    		{
    			$sql_detalle = "INSERT INTO detalle_horario(idhorario, idhora,estado) VALUES('$idhorarionew', '$horas[$num_elementos]','1')";
    			ejecutarConsulta($sql_detalle) or $sw = false;
    			$num_elementos=$num_elementos + 1;
    		}

    		return $sw;
    	}


      public function editar($idhorario,$idmedico,$fecha,$horas)
      {
        $sql="UPDATE horario SET idmedico='$idmedico',fecha='$fecha' WHERE idhorario='$idhorario'";
        ejecutarConsulta($sql);

        //Eliminamos todos los horas asignados para volverlos a registrar
        $sqldel="DELETE FROM detalle_horario WHERE idhorario='$idhorario'";
        ejecutarConsulta($sqldel);

        $num_elementos=0;
        $sw=true;

        while ($num_elementos < count($horas))
        {
          $sql_detalle = "INSERT INTO detalle_horario(idhorario, idhora,estado) VALUES('$idhorario', '$horas[$num_elementos]','1')";
          ejecutarConsulta($sql_detalle) or $sw = false;
          $num_elementos=$num_elementos + 1;
        }
        return $sw;
      }

    public function mostrar($idhorario)
    {
        $sql="SELECT * FROM horario WHERE idhorario='$idhorario'";
        return ejecutarConsultaSimpleFila($sql);
    }

  	public function activar($idhorario)
  	{
  		$sql="UPDATE horario SET estado='1' WHERE idhorario='$idhorario'";
  		return ejecutarConsulta($sql);
  	}

    public function desactivar($idhorario)
    {
      	$sql="UPDATE horario SET estado='0' WHERE idhorario='$idhorario'";
      return ejecutarConsulta($sql);
    }

    public function listar()
    {
        $sql="SELECT h.idhorario,CONCAT(m.nombres,' ',m.apellidos) as medico, h.fecha, h.estado FROM horario h INNER JOIN medico  m  ON h.idmedico=m.idmedico";
        return ejecutarConsulta($sql);
    }

    public function listarDetalle_Horario($idhorario)
    {
        $sql="SELECT dh.iddetalle_horario,h.fecha,hr.nombre, dh.estado FROM detalle_horario dh INNER JOIN horario  h  ON h.idhorario=dh.idhorario INNER JOIN hora  hr  ON hr.idhora=dh.idhora
WHERE dh.idhorario='$idhorario'";
        return ejecutarConsulta($sql);
    }


    public function select()
    {
      $sql="SELECT * FROM horario";
      return ejecutarConsulta($sql);
    }

    //Implementar un método para listar los horas marcados
	public function listarmarcados($idhorario)
	{
		$sql="SELECT * FROM detalle_horario WHERE idhorario='$idhorario'";
		return ejecutarConsulta($sql);
	}
}
?>
