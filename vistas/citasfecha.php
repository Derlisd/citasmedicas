<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombres"])||!isset($_SESSION["apellidos"])||!isset($_SESSION["cargo"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['consultaG']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Consulta de Citas por fecha </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Inicio</label>
                          <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Fin</label>
                          <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>usuario</th>
                            <th>paciente</th>
                            <th>medico</th>
                            <th>fecha - hora</th>
                            <th>precio</th>
                            <th>observaciones</th>
                            <th>fecha agregado</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                    </div>

                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/citasfecha.js"></script>
<script src="../public/js/accounting.min.js"></script>
<script src="../public/js/accounting.js"></script>
<!--datepicker-->
<script>
$(function () {
   $("#fecha_inicio").datepicker({ dateFormat: 'yy-mm-dd' });
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#fecha_inicio").datepicker({ firstDay: 1});
});

$(function () {
   $("#fecha_fin").datepicker({ dateFormat: 'yy-mm-dd' });
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#fecha_fin").datepicker({ firstDay: 1});
});

</script>
<?php
}
ob_end_flush();
?>
