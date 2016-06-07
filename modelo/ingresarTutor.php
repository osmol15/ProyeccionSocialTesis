<?php
  session_start();
  require '../db/conexion.php'; 

  if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q redirige para llenar en la misma pagina
  {
  $tipousuario    = "3";
  $pass           = $_POST["pass"];
  $usuario        = $_POST["usuario"];
  $nombre         = $_POST["nombre"];
  $apellido       = $_POST["apellido"];     
  $telefono       = $_POST["telefono"];     
  $correo         = $_POST["correo"];  
  $departamento   = $_POST["iddepartamento"];
  
  $q="select * from usuario where nombre ='$nombre' and apellido = '$apellido'  and usuario = '$usuario'";
  $r=mysql_query($q,$conn) or die("Error: ".mysql_error());
   
  if(mysql_num_rows($r) > 0){    
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Error: Ya exite un tutor con este nombre, apellido y usuario, por favor ingrese otro. Intentelo de Nuevo')"; 
      echo "</script>";  
      echo "</header>";
      echo "<body>";
      echo "<table ><tr><td>";
      echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='../images/back.png' alt='Atras'/></a>";
      echo "</td></tr><tr><td align=center style='padding-right: 100px; color:white;'>";
      echo "<label >Volver</label></td></tr></table>";
      echo "</a>";
      echo "</body> ";     
      exit();  
  }
  else{
      $inser = "insert into usuario(idtipousuario, clave, usuario, nombre, apellido, telefono, correo, iddepartamento)values('$tipousuario','$pass','$usuario','$nombre','$apellido','$telefono','$correo','$departamento')";
      //inserta la informacion de los alumnos en los campos de la tabla usuario
      if(mysql_query($inser))
      {
          echo "<header>";
          echo "<script language='javascript'>"; 
          echo "alert(':) Tutor Registrado Exitosamente.')"; 
          echo "</script>";  
          echo "</header>";
          exit();
      }
      else{ 
          echo mysql_error();
      }
    }
  } 
  else {    
    $qu="select * from departamento";
    $re=mysql_query($qu,$conn) or die("Error: ".mysql_error());
  }
?>
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
      }
?>
<!DOCTYPE html>
<html>
  <!--CABECERA -->
  <section class="content-header">
        <h1>
          Page Header
          <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-user"></i>Usuarios</a></li>
          <li class="active">Agregar Tutor</li>
        </ol>
    </section>
  <!--FIN CABECERA -->
  <!--Contenido-->
    <section class="content">
    <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-edit"></i>
                  <h3 class="box-title">Registrar nuevo tutor</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" name="form1" method="post" action="modelo/ingresarTutor.php">
                      <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Tutor" required="true">
                                </div>
                            </div>     
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Apellido:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="apellidos" name="apellido" placeholder="Apellido Tutor"  required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Usuario:</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario Tutor"  required="true">
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-2 control-label">Asignar clave:</label>
                                  <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pass" name="pass" placeholder="Clave" value="<?php echo generaPass();?>" >
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Departamento:</label>
                                  <div class="col-sm-10">
                                      <select class="form-control" name="iddepartamento" required="true" onselect="<?php ?>">
                                          <?php while($Rs3=mysql_fetch_array($re)) { 
                                              echo '<option value="'.$Rs3["iddepartamento"].'"> '.$Rs3["nombredepartamento"].' </option>';
                                                }
                                          ?>
                                      </select>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Telefono:</label>
                                  <div class="col-sm-10">
                                        <input type="text" class="form-control" data-inputmask="mask": "(999) 999-9999" data-mask id="telefono" name="telefono" type="tel" maxlength="8">
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Correo:</label>
                                  <div class="col-sm-10">
                                      <input type="email" class="form-control" id="correo" placeholder="Email" name="correo">
                                  </div>
                            </div>           
                      </div>
                    <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" name="submit" id="saveForm" class="btn btn-success pull-right">Guardar</button>
                      </div>
                      <!-- /.box-footer -->
                  </form>             
                </div>
                <!-- /.box -->
              </div>
          </div>
          <!-- /.col -->
        </div>
    </section>
    <!--Fin Contenido-->
</html>