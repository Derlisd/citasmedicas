
<?php
require 'header.php';
?>
<link href="../public/FullCalendar/css/bootstrap.min.css" rel="stylesheet">

<!-- FullCalendar -->
<link href='../public/FullCalendar/css/fullcalendar.css' rel='stylesheet' />
<?php
require_once('../public/FullCalendar/bdd.php');


$sql = "SELECT ci.idcita,CONCAT(hr.fecha,' ',h.nombre) as fechahora,CONCAT(p.nombres,' ',p.apellidos) as paciente,
ci.observaciones,ci.estado FROM cita as ci  INNER JOIN detalle_horario as dh
 on dh.iddetalle_horario=ci.iddetalle_horario INNER JOIN hora as h on h.idhora=dh.idhora
 INNER JOIN horario as hr on hr.idhorario=dh.idhorario INNER JOIN paciente as p on p.idpaciente=ci.idpaciente";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

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
                          <h1 class="box-title">Calendario de Citas </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div id='calendar'></div>


                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
require 'footer.php';
?>


<!-- FullCalendar -->
<script src='../public/FullCalendar/js/moment.min.js'></script>
<script src='../public/FullCalendar/js/fullcalendar/fullcalendar.min.js'></script>
<script src='../public/FullCalendar/js/fullcalendar/fullcalendar.js'></script>
<script src='../public/FullCalendar/js/fullcalendar/locale/es.js'></script>

<link href='../public/FullCalendar/core/main.css' rel='stylesheet' />
<link href='../public/FullCalendar/daygrid/main.css' rel='stylesheet' />
<link href='../public/FullCalendar/timegrid/main.css' rel='stylesheet' />
<link href='../public/FullCalendar/list/main.css' rel='stylesheet' />
<script>

$(document).ready(function() {

var date = new Date();
   var yyyy = date.getFullYear().toString();
   var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
   var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

$('#calendar').fullCalendar({
   plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
  header: {
     language: 'es',
    left: 'prev,next today',
    center: 'title',
    right: 'month,basicWeek,basicDay,listMonth',

  },
  defaultDate: yyyy+"-"+mm+"-"+dd,
  editable: false,
  buttonIcons: false,
  weekNumbers: true,
  navLinks: true,
  eventLimit: true, // allow "more" link when too many events
  selectable: false,
  selectHelper: false,
  events: [
  <?php foreach($events as $event):
  ?>
    {
      title: '<?php echo $event['paciente']; ?>',
      start: '<?php echo $event['fechahora']; ?>',
    },
  <?php endforeach; ?>
  ]
});
});

</script>
