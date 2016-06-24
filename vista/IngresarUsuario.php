<?php
if (session_start()) {
  require_once '../modelo/Misc_modelo.php';
  if(isset($_GET['usuario'])) {
    $tipousuario = $_GET['usuario'];
    $departamentos = null;
    $dep = $_SESSION["iddepartamento"];
    switch ($tipousuario) {
      case 2:
	$misc = new Miscelaneo();
	$departamentos = $misc->getDepartamentos();
	$title = "Ingreso de nuevo coordinador";
	break;
      case 3:
	$title = "Ingreso de nuevo tutor";
	break;
      case 5:
	$title = "Ingreso de nuevo auxiliar";
	break;
    }
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
    

 <script language="javascript">
    
    function validar_texto(e) 
{
tecla = (document.all) ? e.keyCode : e.which;

//Tecla de retroceso para borrar, siempre la permite
if (tecla===8) return true; 

// Patron de entrada, en este caso solo acepta letras
//patron =/[A-Za-z]/; 
//solo numeros
patron = /\d/;
//no acepta numeros
//patron = /\D/; 

tecla_final = String.fromCharCode(tecla);
return patron.test(tecla_final); 
}
function validar_texto2(e) 
{
tecla = (document.all) ? e.keyCode : e.which;

//Tecla de retroceso para borrar, siempre la permite
if (tecla===8) return true; 

// Patron de entrada, en este caso solo acepta letras
patron =/[A-Za-z]/; 
//solo numeros
//patron = /\d/;
//no acepta numeros
//patron = /\D/; 

tecla_final = String.fromCharCode(tecla);
return patron.test(tecla_final); 
} 
</script> 

 <?php
      function generaPass(){
          $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
          $longitudCadena=strlen($cadena);
          $pass = "";
          $longitudPass=10;     
          for($i=1 ; $i<=$longitudPass ; $i++){
              $pos=rand(0,$longitudCadena-1);    
              $pass .= substr($cadena,$pos,1);
          }
          return $pass;
}        ?>


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
          <li><a href="#"><?php echo $title ?></a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-solid box-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $title ?></h3>
          </div>
          <div class="box-body">
            <form role="form" name="form1" class="form-horizontal" method="post" action="../controlador/Usuarios_controlador.php" > <!-- form horizontal acts as a row -->  
                                      <div class="form-group">
                                          <label class="col-md-3 control-label" >Nombre:</label>
                                             <div class="col-md-9">
                                                  <input id="nombre" name="nombre" class="form-control" type="text" > 
                                             </div>
                                      </div> 
                                      <div class="form-group">
                                            <label class="col-md-3 control-label" >Apellido:</label>
                                            <div class="col-md-9">
                                                 <input id="apellidos" name="apellido" class="form-control" type="text" > 
                                            </div>
                                      </div> 
                                      <div class="form-group">
                                            <label class="col-md-3 control-label" >Usuario:</label>
                                            <div class="col-md-9">
                                                 <input id="usuario" name="usuario" class="form-control" type="text" > 
                                            </div>
                                      </div> 
                                      <div class="form-group">
                                             <label class="col-md-3 control-label" >Clave:</label>
                                              <div class="col-md-9">
                                                     <input id="pass" name="pass" class="form-control" type="text" value="<?php echo generaPass(); ?>" readonly> 
                                              </div>
                                      </div> 
                                     <?php
                                      if ($tipousuario == 2) {
                                        echo ' <div class="form-group"> ';
                                        echo      ' <label class="col-md-3 control-label" style="margin-top: 5px">Departamento:</label> ';
                                        echo      '  <div class="col-md-9"> ';
                                        echo      ' <span> ';
                                        echo         '  <select name="iddepartamento" required="true" class="form-control" > ';
                                                            foreach ($departamentos as $valores ) {
                                                                if($valores['iddepartamento'] != 1) {
                                                                      echo '<option value="'.$valores["iddepartamento"].'">
                                                                             '.$valores["nombredepartamento"].'
                                                                             </option>'; 
                                                                  }    
                                                              }
                                        echo         ' </select> ';
                                        echo      ' </span> ';
                                        echo     ' </div> ';
                                        echo ' </div> ';
                                      }else {
                                        echo '<input type="hidden" name="iddepartamento" value="' .$_SESSION["iddepartamento"]. '">';
                                        }
                                      ?>
                                    <div class="form-group">
                                              <label class="col-md-3 control-label"   >Celular:</label>
                                              <div class="col-md-9">
                                                     <input id="telefono" name="telefono" class="form-control" type="tel" maxlength="8"> 
                                              </div>
                                    </div>
                                    <div class="form-group">
                                              <label class="col-md-3 control-label"   >Correo:</label>
                                              <div class="col-md-9">
                                                     <input id="correo" name="correo" class="form-control" type="email" > 
                                                     <input type="hidden" name="tipousuario" value="<?php echo $tipousuario; ?>"> 
                                              </div>
                                     </div>                                              
                                     <br>                                                                                
                                     <div class="pull-right">
                                            <button class="btn btn-success btn-flat" name="agregar" id="saveForm" type="submit">Guardar</button>
                                            <button class="btn btn-default">Cancelar</button>
                                     </div>
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



        
