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
if ($_SESSION['medico']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border" id="nuevo">
                          <h1 class="box-title">Medico</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    <div class="box-header with-border" id="mlista">
                          <h1 class="box-title">Nuevo Medico <button id="btnagregar" class="btn btn-success" onclick="mostrarform(true)" title="Nueva especialidad"><i class="fa fa-plus-circle" ></i> </button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" style="height: 700px;" id="listadoregistros">
                      <table id="tbllistado" class="table table-bordered table-striped table-hover">
                        <thead >
                        <th>Accion</th>
                          <th>nombres</th>
                          <th>apellidos</th>
                          <th>especialidad</th>
                          <th>consultorio</th>
                          <th>edad</th>
                          <th>num_documento</th>
                          <th>telefono</th>
                          <th>estado</th>
                          <th>agreado</th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>

                    </div>
                    <div class="panel-body " style="height: 800px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <input type="text" class="form-control" name="nombres" id="nombres" maxlength="50" placeholder="Nombres" required><i class="fas fa-user-check"></i>
                        </div>

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="50" placeholder="Apellidos" required><i class="fas fa-user-check"></i>
                        </div>

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="fechanac" id="fechanac"  placeholder="Fecha de Nacimiento" required><i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        </div>

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <input type="text" class="form-control" name="telefono" id="telefono" maxlength="50" placeholder="telefono" required><i class="fas fa-phone"></i>
                        </div>

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <input type="text" class="form-control" name="direccion" id="direccion" maxlength="50" placeholder="direccion" required><i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        </div>

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <input type="text" class="form-control" name="email" id="email" placeholder="email" required><i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" required>
                         <option  value="" selected disabled>Selecionar tipo_documento</option>
                         <option value="DNI"> DNI</option>
                         <option value="CARNET EXT">CARNET EXT.</option>
                        <option value="RUC" >RUC</option>
                        <option value="PASAPORTE" >PASAPORTE</option>
                        <option value="P. NAC." >P. NAC.</option>
                        </select>
                        </div>

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <input type="text" class="form-control" name="num_documento" id="num_documento" maxlength="50" placeholder="Num Documento" required><i class="fas fa-user-check"></i>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <select  class="form-control selectpicker" name="genero" id="genero"  required>
                         <option  value="" selected disabled>Selecionar genero</option>
                         <option value="Masculino">Masculino</option>
                        <option value="Femenino" >Femenino</option>
                       </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">

                      <select id="idespecialidad" name="idespecialidad" class="form-control selectpicker" data-live-search="true" required>
                      </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">

                      <select id="idconsultorio" name="idconsultorio" class="form-control selectpicker" data-live-search="true" required>

                      </select>
                      </div>

                        <input type="hidden" name="idmedico" id="idmedico">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button" title="Cancelar"><i class="fa fa-arrow-circle-left"></i></button>
                          </div>


                        </form>
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



<script type="text/javascript" src="scripts/medico.js"></script>
<!--datepicker-->
<script>
$(function () {
   $("#fechanac").datepicker({ dateFormat: 'yy-mm-dd' });
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#fechanac").datepicker({ firstDay: 1});
});
</script>
<?php
}
ob_end_flush();
?>
