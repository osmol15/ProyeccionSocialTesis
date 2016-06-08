<?php 
  session_start();
  $verifica = $_SESSION["verifica"];  
  if($_SESSION["verifica"]!="1"){
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('No tienes los privilegios suficientes para cargar la pagina solicitada.')"; 
      echo "</script>";  
      echo "</header>";
      echo "<body>";
      echo "<table ><tr><td>";
      echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='images/back.png' alt='Atras'/></a>";
      echo "</td></tr><tr><td align=center style='padding-right: 100px;'>";
      echo "<label >Volver</label></td></tr></table>";
      echo "</a>";
      echo "</body> ";
      exit();  
  }
  else{
      require 'db/conexion.php'; 
  }
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Proyecci&acute;n Social - Administrador</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="vista/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vista/fonts/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vista/fonts/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vista/styles/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="vista/styles/skins/skin-red.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="indexAdmin.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>UES</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UES FMOcc</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="vista/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="vista/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo " ".$_SESSION["nombre"]." ".$_SESSION["apellido"]." "; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="vista/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo " ".$_SESSION["nombre"]." ".$_SESSION["apellido"]." "; ?>
                  <small><?php echo $_SESSION["jefe"];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" onclick="cargar('');" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="controlador/logout.php" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="vista/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo " ".$_SESSION["nombre"]." ".$_SESSION["apellido"]." "; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i><?php echo $_SESSION["jefe"];?></a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span>Noticias</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="cargar('listarNoticia.php')"><i class="fa fa-circle-o"></i>Listar</a></li>
            <li><a href="#" onclick="cargar('crearNoticia.php')"><i class="fa fa-circle-o"></i>Crear</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Editar</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Eliminar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-file-text-o"></i> <span>Proyectos</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="cargar('cargarProyectos.php');"><i class="fa fa-circle-o"></i>Buscar por Estudiante</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Buscar por Lugar</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Buscar por Tutor</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Buscar por Nombre</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Listar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-pushpin"></i> <span>Peticiones</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="cargar('agregarPeticion.php');"><i class="fa fa-circle-o"></i>Cargar Peticion</a></li>
            <li><a href="#" onclick="cargar('');"><i class="fa fa-circle-o"></i>Buscar Nombre</a></li>
            <li><a href="#" onclick="cargar('');"><i class="fa fa-circle-o"></i>Buscar Lugar</a></li>
            <li><a href="#" onclick="cargar('');"><i class="fa fa-circle-o"></i>Editar</a></li>
            <li><a href="#" onclick="cargar('');"><i class="fa fa-circle-o"></i>Eliminar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="cargar('ingresarEstudiante.php');"><i class="fa fa-circle-o"></i>Ingresar Estudiantes</a></li>
            <li><a href="#" onclick="cargar('ingresarTutor.php');"><i class="fa fa-circle-o"></i>Ingresar Tutores</a></li>
            <li><a href="#" onclick="cargar('IngresarCoordinador.php');"><i class="fa fa-circle-o"></i>Ingresar Coordinadores</a></li>
            <li><a href="#" onclick="cargar('');"><i class="fa fa-circle-o"></i>Editar</a></li>
            <li><a href="#" onclick="cargar('');"><i class="fa fa-circle-o"></i>Crear</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-folder-o"></i> <span>Utileria</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Cargar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-pie-chart"></i> <span>Estad&iacute;sticas</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="cargar('bitacora.php');"><i class="fa fa-circle-o"></i>Log</a></li>
          </ul>
      </li>
        <li><a href="#"><i class="fa fa-question-circle"></i> <span>Ayuda</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="vista/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="modelo/js/app.min.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
  <script>
    function cargar(url){
            var url1="modelo/"+url;
            $.ajax({   
                type: "POST",
                url:url1,
                data:{},
                success: function(datos){       
                    $('.content-wrapper').html(datos);
                }
            });

        }
  </script>
  <!--php 
       if ($_GET["error"]=="1") {
            echo "<div>Usuario ya existente</div>";  
            echo "<script> cargar('ingresarEstudiante.php'); </script>"; 
          }
                                        
  ?>-->
</body>
</html>
