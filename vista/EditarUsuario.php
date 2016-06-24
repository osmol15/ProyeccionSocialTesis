<?php
if (session_start()) {
require_once '../modelo/Usuarios_modelo.php'; 
  if($_SESSION['idtipousuario'] != 4) {
    $usuario = $_SESSION["idusuario"];
    $user = new Usuarios();
    $datos = $user->getDatosUsuario($usuario);
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
<script language="javascript" src="../scripts/validar.js"></script> 
        
    
<script language="javascript"> 
function comprobarClave(){ 
   clave1 = document.form1.pass.value;
   	clave2 = document.form1.repass.value;

        if (clave1.length < 6 ){
                alert("Error: la clave debe contener por lo menos 6 caracteres!");
        document.form1.pass.focus();    
        return false;
        }
         re = /[A-Z]/;
      if(!re.test(clave1)) {
        alert("Error: la clave debe contener por lo menos una letra mayuscula (A-Z)!");
       document.form1.pass.focus();
        return false;
        
        }
        re = /[0-9]/;
      if(!re.test(clave1)) {
        alert("Error: la clave debe contener por lo menos un numero (0-9)!");
        document.form1.pass.focus();
        return false;
        
        }
        if (clave1 !== clave2) {
        alert(':( Las claves no coinciden por favor vuelva a ingresarlos')
      	return false;
    }
    else {
        
        return true;
    }

} 
</script> 
                                                  
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
          <li><a href="#"><i class="fa fa-dashboard"></i> Usuario</a></li>
          <li><a href="#">Editar Información</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Información</h3>
          </div>
          <div class="box-body">
           <form role="form" name="form1" class="form-horizontal" enctype="multipart/form-data" method="post" action="../controlador/Usuarios_controlador.php" onsubmit="return comprobarClave();"> <!-- form horizontal acts as a row -->  
                                      <div class="form-group">
                                          <label class="col-md-3 control-label" style="margin-top: 10px">Nombre:</label>
                                             <div class="col-md-9">
                                                  <input id="nombre" name="nombre" class="form-control" type="text" value="<?php echo $datos["nombre"]; ?>" onkeypress="return soloLetras(event)" onpaste="return false"> 
                                             </div>
                                      </div> 
                                      <div class="form-group">
                                            <label class="col-md-3 control-label" style="margin-top: 10px">Apellido:</label>
                                            <div class="col-md-9">
                                                 <input id="apellidos" name="apellido" class="form-control" type="text" value="<?php echo $datos["apellido"]; ?>" onkeypress="return soloLetras(event)" onpaste="return false"> 
                                            </div>
                                      </div> 
                                      <div class="form-group">
                                            <label class="col-md-3 control-label" style="margin-top: 10px">Usuario:</label>
                                            <div class="col-md-9">
                                                 <input id="usuario" name="usuario" class="form-control" type="text" value="<?php echo $datos["usuario"]; ?>"> 
                                            </div>
                                      </div> 
                                      <div class="form-group">
                                             <label class="col-md-3 control-label" style="margin-top: 10px">Clave:</label>
                                              <div class="col-md-9">
                                                     <input id="pass" name="pass" class="form-control" type="text" value="<?php echo $datos["clave"]; ?>"> 
                                              </div>
                                      </div>
                                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Repetir clave:</label>
                                   <div class="col-md-9">
                                            <input id="repass" name="repass" class="form-control" type="text" value="<?php echo $datos["clave"]; ?>"> 
                                           </div>
                                       </div> 
                                     
                                      <div class="form-group">
                                             <label class="col-md-3 control-label" style="margin-top: 5px">Departamento:</label>
                                              <div class="col-md-9">
                                                    <span>
                                                        <select name="iddepartamento" required="true" class="form-control" value="<?php echo $datos["iddepartamento"]; ?>" disabled="true">
                                                            <option value="2">Ingenier&iacute;a y Arquitectura</option>
                                                            <option value="3">Ciencias Econ&oacute;micas</option>
                                                            <option value="4">Ciencias Sociales</option>
                                                            <option value="5">Medicina</option>
                                                            <option value="6">Ciencias Jur&iacute;dicas</option>
                                                            <option value="7">Idiomas</option>
                                                            <option value="8">Qu&iacute;mica</option>
                                                            <option value="9">Biolog&iacute;a</option>
                                                            <option value="10">F&iacute;sica</option>
                                                            <option value="11">Matem&aacute;ticas</option>
                                                        </select>
                                                    </span>
                                              </div>
                                      </div> 
                              
                                  <div class="form-group">
                                              <label class="col-md-3 control-label"style="margin-top: 10px"  >Celular:</label>
                                              <div class="col-md-9">
                                                     <input id="telefono" name="telefono" class="form-control" type="tel" maxlength="8" value="<?php echo $datos["telefono"]; ?>" onkeypress="return soloNumeros(event)" onpaste="return false"> 
                                              </div>
                                  </div>
                                  <div class="form-group">
                                              <label class="col-md-3 control-label" style="margin-top: 10px"  >Correo:</label>
                                              <div class="col-md-9">
                                                     <input id="correo" name="correo" class="form-control" type="email" value="<?php echo $datos["correo"]; ?>" > 
                                                     <input id="idusuario" name="idusuario" type="hidden" value="<?php echo $datos["idusuario"]; ?>" > 
                                              </div>
                                      </div> 
                                                    
                                                                                <br><br>
                                                                                
                    <div class="pull-right">
                      <button class="btn btn-primary mr5" name="actualizar" id="saveForm" type="submit">Actualizar</button>
                      <button class="btn btn-default">Cancelar</button>
                    </div>
                  </form>
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