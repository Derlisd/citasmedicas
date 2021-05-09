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

if ($_SESSION['cita']==1)
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
                          <h1 class="box-title">Cita <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Pagar</th>
                            <th>Anular</th>
                            <th>Usuario</th>
                            <th>medico</th>
                            <th>paciente</th>
                            <th>fecha - hora</th>
                            <th>precio</th>
                            <th>observaciones</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 600px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>paciente(*):</label>
                            <input type="hidden" name="idcita" id="idcita">
                            <select id="idpaciente" name="idpaciente" class="form-control selectpicker" data-live-search="true" required>

                            </select>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Especialidad(*):</label>
                            <select name="cbx_especialidad" id="cbx_especialidad" class="form-control" required>

                            </select>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>medico(*):</label>
                            <select name="cbx_medico" id="cbx_medico" class="form-control " required>
                              </select>
                          </div>


                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha(*):</label>
                            <select name="cbx_fecha" id="cbx_fecha" class="form-control" required>
                              </select>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hora(*):</label>
                            <select name="iddetalle_horario" id="iddetalle_horario" class="form-control " required>
                              </select>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>observaciones:</label>
                            <input type="text" class="form-control" name="observaciones" id="observaciones" required="">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>precio:</label>
                            <select name="idcosto" id="idcosto" class="form-control " required>
                              </select>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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


  <!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/cita.js"></script>
<script src="../public/js/accounting.min.js"></script>
<script src="../public/js/accounting.js"></script>
<?php
}
ob_end_flush();
?>
