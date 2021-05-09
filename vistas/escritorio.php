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

if ($_SESSION['escritorio']==1)
{
  require_once "../modelos/Consultas.php";
  $consulta = new Consultas();
  $rsptac = $consulta->totalcitahoy();
  $regc=$rsptac->fetch_object();
  $totalc=$regc->total_cita;

// citas
  $rsptacita = $consulta->totalcita();
  $regcita=$rsptacita->fetch_object();
  $totalcita=$regcita->total;

// paciente
  $rsptapaciente = $consulta->totalpaciente();
  $regpaciente=$rsptapaciente->fetch_object();
  $totalpaciente=$regpaciente->total;

// medico
  $rsptamedico = $consulta->totalmedico();
  $regmedico=$rsptamedico->fetch_object();
  $totalmedico=$regmedico->total;

  // especialidad
  $rsptaespecialidad = $consulta->totalespecialidad();
  $regespecialidad=$rsptaespecialidad->fetch_object();
  $totalespecialidad=$regespecialidad->total;

    // costo
  $rsptacosto = $consulta->totalcosto();
  $regcosto=$rsptacosto->fetch_object();
  $totalcosto=$regcosto->total;

  // horario
  $rsptahorario = $consulta->totalhorario();
  $reghorario=$rsptahorario->fetch_object();
  $totalhorario=$reghorario->total;

// usuario
  $rsptausuario = $consulta->totalusuario();
  $regusuario=$rsptausuario->fetch_object();
  $totalusuario=$regusuario->total;

  // consultorio
    $rsptaconsultorio = $consulta->totalconsultorio();
    $regconsultorio=$rsptaconsultorio->fetch_object();
    $totalconsultorio=$regconsultorio->total;

  // citas pagadas
    $rsptapagadas = $consulta->totalpagadas();
    $regpagadas=$rsptapagadas->fetch_object();
    $totalpagada=$regpagadas->total;


  // citas Anuladas
    $rsptaanulada = $consulta->totalanuladas();
    $reganuladas=$rsptaanulada->fetch_object();
    $totalanulada=$reganuladas->total;


  // citas Pendientes
    $rsptapendiente = $consulta->totalpendientes();
    $regpendiente=$rsptapendiente->fetch_object();
    $totalpendiente=$regpendiente->total;



  //Datos para mostrar el grafico de barras de las citas
  $citas10 = $consulta->citasultimos_10dias();
  $fechasc='';
  $totalesc='';
  while ($regfechac= $citas10->fetch_object()) {
    $fechasc=$fechasc.'"'.$regfechac->fecha .'",';
    $totalesc=$totalesc.$regfechac->total .',';
  }
  //Quitamos la ultima coma
  $fechasc=substr($fechasc, 0, -1);
  $totalesc=substr($totalesc, 0, -1);

  //Datos para mostrar el grafico de barras de las citas
  $citas12 = $consulta->citasultimos_12meses();
  $fechasv='';
  $totalesv='';
  while ($regfechav= $citas12->fetch_object()) {
    $fechasv=$fechasv.'"'.$regfechav->fecha .'",';
    $totalesv=$totalesv.$regfechav->total .',';
  }
  //Quitamos la ultima coma
  $fechasv=substr($fechasv, 0, -1);
  $totalesv=substr($totalesv, 0, -1);
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
                          <h1 class="box-title">Escritorio </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-blue">
                              <a href="cita.php" class="small-box-footer"><span class="info-box-icon"><i class="fas fa-coins"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">Citas de Hoy</span>
                                <span class="info-box-number">Gs. <?php echo $totalc; ?></span>
                                <span class="progress-description">
                                    <?php echo $totalcita; ?> Citas
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-green">
                              <a href="medico.php" class="small-box-footer"><span class="info-box-icon"><i class="fas fa-user-md"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">medicos</span>
                                <span class="info-box-number"><?php  echo $totalmedico;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalmedico;?>%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-yellow">
                              <a href="costo.php" class="small-box-footer"><span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">costos</span>
                                <span class="info-box-number"><?php  echo $totalcosto;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalcosto;?>%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-olive">
                              <a href="paciente.php" class="small-box-footer"><span class="info-box-icon"><i class="fa fa-users"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">Pacientes</span>
                                <span class="info-box-number"><?php  echo $totalpaciente;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalpaciente;?>%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-red">
                              <a href="consultorio.php" class="small-box-footer"><span class="info-box-icon"><i class="fa fa-laptop"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">consultorios</span>
                                <span class="info-box-number"><?php  echo $totalconsultorio;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalconsultorio;?>%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-maroon">
                              <a href="especialidad.php" class="small-box-footer"><span class="info-box-icon"><i class="fa fa-stethoscope"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">Especialidad</span>
                                <span class="info-box-number"><?php  echo $totalespecialidad;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalespecialidad;?>%"></div>
                                </div>
                                <span class="progress-description">
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-lime">
                              <a href="usuario.php" class="small-box-footer"><span class="info-box-icon"><i class="fa fa-lock"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">Usuarios</span>
                                <span class="info-box-number"><?php  echo $totalusuario;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalusuario;?>%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="info-box bg-fuchsia">
                              <a href="horario.php" class="small-box-footer"><span class="info-box-icon"><i class="far fa-clock"></i></span></a>
                              <div class="info-box-content">
                                <span class="info-box-text">Horarios</span>
                                <span class="info-box-number"><?php  echo $totalhorario;?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?php  echo $totalhorario;?>%"></div>
                                </div>
                                <span class="progress-description">

                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>

                    </div>

                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                                Citas de los ultimos 10 dias
                            </div>
                            <div class="box-body">
                              <canvas id="citas10dias" width="400" height="300"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                                Citas de los ultimos 12 meses
                            </div>
                            <div class="box-body">
                              <canvas id="citas12" width="400" height="300"></canvas>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                                Cantidad de Registros por Tabla de la base datos
                            </div>
                            <div class="box-body">
                              <canvas id="todosregistros" width="400" height="300"></canvas>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                                Estadistica de Citas Pagadas, Pendientes y Anuladas
                            </div>
                            <div class="box-body">
                              <canvas id="estadisticacitas" width="400" height="300"></canvas>
                            </div>
                          </div>
                        </div>

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
<script src="../public/js/chart.min.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>
<script type="text/javascript">
var ctx = document.getElementById("citas10dias").getContext('2d');
var citas10dias = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasc; ?>],
        datasets: [{
            label: '# Citas en Gs. de los ultimos 10 dias',
            data: [<?php echo $totalesc; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});



var ctx = document.getElementById("citas12").getContext('2d');
var citas12 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasv; ?>],
        datasets: [{
            label: '# Citas en Gs. de los ultimos 12 meses',
            data: [<?php echo $totalesv; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});


var ctx = document.getElementById("todosregistros").getContext('2d');
var todosregistros = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Cita','Paciente','medico','especialidad','costo','horario','usuario','consultorio'],
        datasets: [{
            label: '# Registros',
            data: [<?php echo $totalcita; ?>,<?php echo $totalpaciente; ?>,<?php echo $totalmedico; ?>,<?php echo $totalespecialidad; ?>,<?php echo $totalcosto; ?>,<?php echo $totalhorario; ?>,<?php echo $totalusuario; ?>,<?php echo $totalconsultorio; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});



var ctx = document.getElementById("estadisticacitas").getContext('2d');
var estadisticacitas = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pagada','Anulada','Pendiente'],
        datasets: [{
            label: '# Estadistica',
            data: [<?php echo $totalpagada; ?>,<?php echo $totalanulada; ?>,<?php echo $totalpendiente; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>
</script>
<?php
}
ob_end_flush();
?>
