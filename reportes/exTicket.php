<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

  if (!isset($_SESSION["nombres"])||!isset($_SESSION["apellidos"])||!isset($_SESSION["cargo"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el ticket';
}
else
{
if ($_SESSION['cita']==1)
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

//Incluímos la clase Venta
require_once "../modelos/Cita.php";
//Instanaciamos a la clase con el objeto venta
$cita = new Cita();
//En el objeto $rspta Obtenemos los valores devueltos del método citacabecera del modelo
$rspta = $cita->citaticket($_GET["id"]);
//Recorremos todos los valores obtenidos
$reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$empresa = "Dental Paraguay S.A";
$documento = "8000000-5";
$direccion = "Asunción,avd. la victoria 587";
$telefono = "021 555 558";
$email = "derlisdacosta@gmail.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        .:::::<strong> <?php echo $empresa; ?></strong>:::::.<br>
        <?php echo $documento; ?><br>
        <?php echo $direccion .' - '.$telefono; ?><br>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo $reg->agregado; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td><strong>Paciente:</strong> <?php echo $reg->paciente; ?></td>
    </tr>
    <tr>
        <td><strong>Medico:</strong> <?php echo $reg->medico; ?></td>
    </tr>
    <tr>
        <td><strong>Fecha de la Cita:</strong> <?php echo $reg->fecha; ?></td>
    </tr>
    <tr>
        <td><strong>Hora de la Cita:</strong> <?php echo $reg->hora; ?></td>
    </tr>
    <tr>
        <td><?php echo "<strong>Ticket :</strong>"." : 000".$reg->idcita; ?></td>
    </tr>
    <tr>
        <td><strong>Nº de cita :</strong> <?php echo " 000".$reg->idcita ; ?></td>
    </tr>    
</table>
<br>
<!-- Mostramos los detalles de la cita en el documento HTML -->
<table border="0" align="center" width="300px">
   
    
    <!-- Mostramos los totales de la cita en el documento HTML -->
    <tr>
    <td>&nbsp;</td>
    <td align="right"><b><strong>TOTAL:</strong></b></td>
    <td ><b>Gs. <?php echo number_format($reg->precio, 0, ",", "."); ?></b></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="3" align="center">¡Gracias por su preferencia!</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Dental Paraguay S.A</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Asunción,Paraguay</td>
    </tr>
    
</table>
<br>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
else
{
  echo 'No tiene permiso para visualizar el ticket';
}

}
ob_end_flush();

?>