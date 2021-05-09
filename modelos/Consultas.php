<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	public function citasfecha($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT ci.idcita,CONCAT(u.nombres,' ',u.apellidos) as usuario,CONCAT(m.nombres,' ',m.apellidos) as medico,CONCAT(p.nombres,' ',p.apellidos) as paciente,hr.fecha,h.nombre as hora,c.precio,ci.observaciones,ci.agregado,ci.estado FROM cita as ci
		INNER JOIN usuario as u on u.idusuario=ci.idusuario
		INNER JOIN paciente as p on p.idpaciente=ci.idpaciente
		INNER JOIN costo as c on c.idcosto=ci.idcosto
		INNER JOIN detalle_horario as dh on dh.iddetalle_horario=ci.iddetalle_horario
		INNER JOIN hora as h on h.idhora=dh.idhora 
		INNER JOIN horario as hr on hr.idhorario=dh.idhorario 
		INNER JOIN medico as m on m.idmedico=hr.idmedico  WHERE DATE(ci.agregado)>='$fecha_inicio' AND DATE(ci.agregado)<='$fecha_fin'";
		return ejecutarConsulta($sql);
	}
	public function selectMedico()
    {
      $sql="SELECT idmedico,CONCAT(nombres,' ',apellidos) as nombre FROM medico";
      return ejecutarConsulta($sql);
    }

	

	public function citasfechapaciente($fecha_inicio,$fecha_fin,$idpaciente)
	{
		$sql="SELECT ci.idcita,CONCAT(u.nombres,' ',u.apellidos) as usuario,CONCAT(m.nombres,' ',m.apellidos) as medico,CONCAT(p.nombres,' ',p.apellidos) as paciente,hr.fecha,h.nombre as hora,c.precio,ci.observaciones,ci.agregado,ci.estado FROM cita as ci
		INNER JOIN usuario as u on u.idusuario=ci.idusuario
		INNER JOIN paciente as p on p.idpaciente=ci.idpaciente
		INNER JOIN costo as c on c.idcosto=ci.idcosto
		INNER JOIN detalle_horario as dh on dh.iddetalle_horario=ci.iddetalle_horario
		INNER JOIN hora as h on h.idhora=dh.idhora 
		INNER JOIN horario as hr on hr.idhorario=dh.idhorario 
		INNER JOIN medico as m on m.idmedico=hr.idmedico  WHERE DATE(ci.agregado)>='$fecha_inicio' AND DATE(ci.agregado)<='$fecha_fin' AND P.idpaciente='$idpaciente'";
		return ejecutarConsulta($sql);
	}

	public function citasfechamedico($fecha_inicio,$fecha_fin,$idmedico)
	{
		$sql="SELECT ci.idcita,CONCAT(u.nombres,' ',u.apellidos) as usuario,CONCAT(m.nombres,' ',m.apellidos) as medico,CONCAT(p.nombres,' ',p.apellidos) as paciente,hr.fecha,h.nombre as hora,c.precio,ci.observaciones,ci.agregado,ci.estado FROM cita as ci
		INNER JOIN usuario as u on u.idusuario=ci.idusuario
		INNER JOIN paciente as p on p.idpaciente=ci.idpaciente
		INNER JOIN costo as c on c.idcosto=ci.idcosto
		INNER JOIN detalle_horario as dh on dh.iddetalle_horario=ci.iddetalle_horario
		INNER JOIN hora as h on h.idhora=dh.idhora 
		INNER JOIN horario as hr on hr.idhorario=dh.idhorario 
		INNER JOIN medico as m on m.idmedico=hr.idmedico WHERE DATE(ci.agregado)>='$fecha_inicio' AND DATE(ci.agregado)<='$fecha_fin' AND m.idmedico='$idmedico'";
		return ejecutarConsulta($sql);
	}




	public function totalcitahoy()
	{
		$sql="SELECT IFNULL(SUM(c.precio),0) as total_cita FROM cita as ci
		INNER JOIN costo as c on c.idcosto=ci.idcosto
		WHERE DATE(ci.agregado)=curdate() AND ci.estado!='anulado'";
		return ejecutarConsulta($sql);
	}

	public function citasultimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(ci.agregado),' de ',DATE_FORMAT(ci.agregado,'%M')) as fecha,SUM(c.precio) as total FROM cita as ci INNER JOIN costo as c on c.idcosto=ci.idcosto  WHERE ci.estado!='anulado' GROUP by DAY(ci.agregado) ORDER BY ci.agregado DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function citasultimos_12meses()
	{
		$sql="SELECT DATE_FORMAT(ci.agregado,'%M') as fecha,SUM(c.precio) as total FROM
		cita as ci INNER JOIN costo as c on c.idcosto=ci.idcosto WHERE ci.estado!='anulado'
		GROUP by MONTH(ci.agregado)  ORDER BY ci.agregado  desc limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function totalcita()
	{
		$sql="SELECT COUNT(*) as total FROM `cita`";
		return ejecutarConsulta($sql);
	}

	public function totalpaciente()
	{
		$sql="SELECT COUNT(*) as total FROM `paciente`";
		return ejecutarConsulta($sql);
	}

	public function totalmedico()
	{
		$sql="SELECT COUNT(*) as total FROM `medico`";
		return ejecutarConsulta($sql);
	}

	public function totalespecialidad()
	{
		$sql="SELECT COUNT(*) as total FROM `especialidad`";
		return ejecutarConsulta($sql);
	}

	public function totalcosto()
	{
		$sql="SELECT COUNT(*) as total FROM `costo`";
		return ejecutarConsulta($sql);
	}

	public function totalhorario()
	{
		$sql="SELECT COUNT(*) as total FROM `horario`";
		return ejecutarConsulta($sql);
	}

	public function totalusuario()
	{
		$sql="SELECT COUNT(*) as total FROM `usuario`";
		return ejecutarConsulta($sql);
	}

	public function totalconsultorio()
	{
		$sql="SELECT COUNT(*) as total FROM `consultorio`";
		return ejecutarConsulta($sql);
	}

	public function totalpagadas()
	{
		$sql="SELECT COUNT(*) as total FROM `cita` WHERE estado='pagado'";
		return ejecutarConsulta($sql);
	}


	public function totalpendientes()
	{
		$sql="SELECT COUNT(*) as total FROM `cita` WHERE estado='pendiente'";
		return ejecutarConsulta($sql);
	}

	public function totalanuladas()
	{
		$sql="SELECT COUNT(*) as total FROM `cita` WHERE estado='anulado'";
		return ejecutarConsulta($sql);
	}
}

?>
