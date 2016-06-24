<?php error_reporting (0);?>
<?php
if(isset($_GET['error'])){
$msg=$_GET['error'];
} else if (session_start()) {
  switch ($_SESSION['idtipousuario']) {
    case 1: 
      header('Location: ../vista/indexAdmin.php');
      break;
    case 2:
      header('Location: ../vista/indexCoordinador.php');
      break;
    case 3:
      header('Location: ../vista/indexTutor.php');
      break;
    case 4:
      header('Location: ../vista/indexEstudiante.php');
      break;
    case 5:
      header('Location: ../vista/indexAuxiliar.php');
      break;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Proyecci&oacute;n Social | Log in</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../styles/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../styles/dist/css/AdminLTE.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <a href="#">
      <img src="../minerva.svg" alt="Logo UES" width="200" class="center-block">
    </a>
    <h1 class="text-center">PROYECCION SOCIAL <br> UESFMOCC</h1>
    <p class="login-box-msg">Iniciar Sesi&oacute;n</p>

    <form  name="form-login" id="loginform" method="post" action="../controlador/validateLogin.php">
    <?php
        if ($msg == "1" OR $msg == "2") { 
           echo "<div class='alert alert-danger' >Clave incorrecta</div>"; 
        }else if($msg == "3"){
           echo "<div class='alert alert-danger' >Usuario no Registrado</div>"; 
        }
     ?>      
      <div id="error" class="alert alert-danger" style="display: none">
                                         
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" id="input-username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contrase&ntilde;a" name="pass" id="input-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">        
        <div class="col-xs-12">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Iniciar</button>
        </div>
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

  <!-- jQuery 2.2.0 -->
<script src="../scripts/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../styles/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
