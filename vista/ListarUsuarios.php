<?php
if(session_start()) {
  require_once '../modelo/Usuarios_modelo.php';
  if($_SESSION["idtipousuario"] == 1) {    
    $users = new Usuarios();
    $usuarios = $users->getAll();
  } else if ($_SESSION["idtipousuario"] == 2 OR $_SESSION["idtipousuario"] == 5) {
    $users = new Usuarios();
    $usuarios = $users->getUsuariosDept($_SESSION["iddepartamento"]);
  } else {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('No tienes los privilegios suficientes para cargar la pagina solicitada.')"; 
      echo "</script>";  
      echo "</header>";
      echo "<body>";
      echo "<table ><tr><td>";
      echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='../images/back.png' alt='Atras'/></a>";
      echo "</td></tr><tr><td align=center style='padding-right: 100px;'>";
      echo "<label >Volver</label></td></tr></table>";
      echo "</a>";
      echo "</body> ";
      exit();  
  }
} else {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('No has iniciado sesion')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='index.php'</script>;";
    echo "</header>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../styles/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../styles/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="../styles/dist/css/skins/skin-red.min.css">
    
    <link rel="stylesheet" href="../scripts/datatables/dataTables.bootstrap.css">

  </head>
  <body class="layout-top-nav">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        &nbsp;
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Usuarios</a></li>
          <li><a href="#">RRHH Registrados</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-solid box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Listado de RRHH </h3>
          </div>
          <div class="box-body">
             <table id="example" class="table table-bordered table-striped text-center" >
        <thead>
            <tr class="center aligned">
                <th>idusuario</th>
                <th>idtipousuario</th>
                <th>Nombre</th>
                <th>Apellido</th>   
                <th>Opciones</th>
<!--                <th style="visibility:collapse;display:none">opciones</th>-->
            </tr>
        </thead>
        <tbody>
          <?php
            foreach($usuarios as $usuario) {
          ?>
          <tr class="center aligned">
            <td><?php echo $usuario["idusuario"]; ?></td> 
            <td><?php 
              switch ($usuario["idtipousuario"]) {
                case '2':
                  echo "coordinador";
                  break;
                case '3':
                  echo "tutor";
                  break;
                case '5':
                  echo "auxiliar";
                  break;
                default:
      echo "null";
      break;
              }
            ?></td>
            <td><?php echo $usuario["nombre"]; ?></td>
            <td><?php echo $usuario["apellido"]; ?></td> 
<!--      <td align="center"><a href="EnviarNotificacion"><i class="ion-ios-chatbubble" style="font-size: 25px;" title="Enviar Notificacion"></i></a></td>-->
      <td>
        <a class="btn btn-danger" href="javascript:delete_id('<?php echo $usuario["idusuario"] ?>')">
            <i class="fa fa-trash-o" title="Delete" aria-hidden="true"></i>
            <span class="sr-only">Eliminar Usuario</span>
        </a>
      </td>
          </tr>
        <?php
          }
        ?>
        </tbody>
    </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
  </body>
  <!-- jQuery 2.2.0 -->
  <script src="../scripts/jQuery/jQuery-2.2.0.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../styles/bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../styles/dist/js/app.min.js"></script>
  <script src="../scripts/datatables/jquery.dataTables.min.js"></script>
  <script src="../scripts/datatables/dataTables.bootstrap.min.js"></script>
</html>
<body>
  
  <script>
  $(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",

        }
    } );
} );

  $.extend( true, $.fn.dataTable.defaults, {
      "paging": false,
      "info": false,
} );
</script>
</body>

