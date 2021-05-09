<?php
if (strlen(session_id()) < 1)
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITCitas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="icon" href="../public/img/favicon.ico"type="image/x-icon">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <!--iconos de input-->
<link rel="stylesheet" href="../public/css/fontawesome/css/all.css" type="text/css">
  <link rel="stylesheet" href="../public/css/estilos.css" type="text/css">

<!--calendar datapickit-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>

<!-- sweetalert2 -->
<link rel="stylesheet" href="../public/css/sweetalert.min.css" />

<link rel="stylesheet" href="../public/css/bootstrap-select.min.css"/>

  </head>
  <!--cambiar de color con green a blue-light -->
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">System</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>System</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo  $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo  $_SESSION['nombres']; ?> <?php echo  $_SESSION['apellidos']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo  $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                    <p>

                        <small class=" label pull-right bg-yellow"><?php echo  $_SESSION['nombres']; ?> <?php echo  $_SESSION['apellidos']; ?></small></br>
                        <small class=" label pull-right bg-yellow"><?php echo  $_SESSION['cargo']; ?></small>
                      </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-danger btn-flat"><i class="fa fa-power-off"></i> Salir</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php
             if ($_SESSION['escritorio']==1)
             {
               echo '<li>
                 <a href="escritorio.php">
                   <i class="fa fa-hospital-o"></i> <span>Escritorio</span>
                 </a>
               </li>';
             }
             ?>

             <?php
              if ($_SESSION['cita']==1)
              {
                echo '<li>
                  <a href="cita.php">
                    <i class="far fa-calendar-alt"></i>
                    <span>Citas</span>
                  </a>
                </li>';
              }
              ?>
              <?php
               if ($_SESSION['paciente']==1)
               {
                 echo '<li>
                   <a href="paciente.php">
                     <i class="fa fa-users"></i>
                     <span>Pacientes</span>
                   </a>
                 </li>';
               }
               ?>
               <?php
                if ($_SESSION['medico']==1)
                {
                  echo '<li>
                    <a href="medico.php">
                      <i class="fa fa-user-md"></i>
                      <span>Médicos</span>
                    </a>
                  </li>';
                }
                ?>
                <?php
                 if ($_SESSION['consultorio']==1)
                 {
                   echo '<li>
                     <a href="consultorio.php">
                       <i class="fa fa-laptop"></i>
                       <span>Consultorios</span>
                     </a>
                   </li>';
                 }
                 ?>
                 <?php
                  if($_SESSION['especialidad']==1)
                  {
                    echo '<li>
                      <a href="especialidad.php">
                      <i class="fa fa-stethoscope"></i>
                        <span>Especialidades</span>
                      </a>
                    </li>';
                  }
                  ?>
                  <?php
                   if($_SESSION['costo']==1)
                   {
                     echo '<li>
                       <a href="costo.php">
                       <i class="fas fa-dollar-sign"></i>
                         <span>Costo</span>
                       </a>
                     </li>';
                   }
                   ?>
                  <?php
                   if ($_SESSION['horario']==1)
                   {
                     echo '<li class="treeview">
                       <a href="#">
                         <i class="fa fa-bar-chart"></i>
                         <span>Horarios</span>
                          <i class="fa fa-angle-left pull-right"></i>
                       </a>
                       <ul class="treeview-menu">
                         <li><a href="hora.php"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Hora</a></li>
                         <li><a href="horario.php"><i class="fa fa-cog fa-spin fa-1x fa-fw" ></i> Horario</a></li>
                       </ul>
                     </li>';
                   }
                   ?>
                   <?php
                    if ($_SESSION['consultaG']==1)
                    {
                      echo '<li class="treeview">
                        <a href="#">
                          <i class="fa fa-bar-chart"></i>
                          <span>consultaG</span>
                           <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="citasfechapaciente.php"><i class="fa fa-cog fa-spin fa-1x fa-fw" ></i> Citas Por Pacientes</a></li>
                          <li><a href="citasfechamedico.php"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Citas por médicos</a></li>
                          <li><a href="citasfecha.php"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Citas por Fecha</a></li>
                        </ul>
                      </li>';
                    }
                    ?>
                    <?php
                     if ($_SESSION['acceso']==1)
                     {
                       echo '<li class="treeview">
                         <a href="#">
                           <i class="fa fa-lock"></i> <span>Acceso</span>
                           <i class="fa fa-angle-left pull-right"></i>
                         </a>
                         <ul class="treeview-menu">
                           <li><a href="usuario.php"><i class="fa fa-refresh fa-spin fa-1x fa-fw" aria-hidden="true"></i>Usuarios</a></li>
                           <li><a href="permiso.php"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> Permisos</a></li>

                         </ul>
                       </li>';
                     }
                     ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i> <span>Calendario</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="calendario.php"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" aria-hidden="true"></i> Citas en Calendario</a></li>
              </ul>
            </li>
          <!--  <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>-->

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
