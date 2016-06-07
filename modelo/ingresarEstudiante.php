<?php
  session_start();
  require '../db/conexion.php'; 

  if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q redirige para llenar en la misma pagina
  {
      $pass         = $_POST["pass"];
      $carnet       = $_POST["carnet"];
      $departamento = $_SESSION["iddepartamento"];
      $tipousuario	= $_POST["tipousuario"];
  
  $q="select * from estudiante where carnet ='$carnet'";
  $r=mysql_query($q,$conn) or die("Error: ".mysql_error());

  if(mysql_num_rows($r) > 0){
    
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Error: El carnet ingresado ya esta registrado, por favor ingrese otro numero de carnet. Intentelo de Nuevo')"; 
      echo "</script>";  
      echo "</header>";
      echo "<body>";
      echo "<table ><tr><td>";
      echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='../images/back.png' alt='Atras'/></a>";
      echo "</td></tr><tr><td align=center style='padding-right: 100px; color:white;'>";
      echo "<label >Volver</label></td></tr></table>";
      echo "</a>";
      echo "</body> ";
      //header('Location:../indexAdmin.php?error=1');

      exit();    
                
  }
  else{
      $inser = "insert into estudiante(clave, carnet, departamento, tipousuario)
      values('$pass', '$carnet', '$departamento', '$tipousuario')";
      //inserta la informacion de los alumnos en los campos de la tabla usuario
      if(mysql_query($inser))
      {
          echo "<header>";
          echo "<script language='javascript'>"; 
          echo "alert(':) Estudiante Registrado Exitosamente.')"; 
          echo "</script>";  
          echo "</header>";
	        exit;
          
      }
      else{
	       echo mysql_error();
      }
  //aqui termina la condicion de si presiono el boton de agregar el usuario
      }
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
          <li class="active">Agregar Estudiantes</li>
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
                  <h3 class="box-title">Registrar nuevo estudiante</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" name="form1" method="post" action="modelo/ingresarEstudiante.php">
                      <div class="box-body">
                           <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Carnet Estudiante:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="carnet" name="carnet" placeholder="Carnet" maxlength="7" required="true">
                            </div>
                          </div>
                          <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Asignar una clave:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pass" name="pass" placeholder="Clave" value="<?php echo generaPass();?>" >
                                    </div>
                          </div>                       
                      </div>
                    <!-- /.box-body -->
                      <div class="box-footer">
                        <input id="tipousuario" name="tipousuario" class="form-control" type="hidden" value="4" >
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