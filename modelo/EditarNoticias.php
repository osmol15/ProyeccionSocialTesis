<?php 
 session_start();
 $verifica = $_SESSION["verifica"]; 

 if($_SESSION["verifica"]=="3" || $_SESSION["verifica"]=="4"){
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

 require '../db/conexion.php'; 

 }

 if(isset($_GET['edit_id']))
 {
  $sql_query="SELECT * FROM noticias WHERE idnoticias=".$_GET['edit_id'];
  $result_set=mysql_query($sql_query);
  $fetched_row=mysql_fetch_array($result_set);
 }
 if(isset($_POST['btn-update']))
 {
 // variables for input data
 $titulo    = $_POST['titulo'];
 $detalle   = $_POST['detalle'];
 
 // variables for input data
 
 // sql query for update data into database
 $sql_query = "UPDATE noticias SET titulo='$titulo',detalle='$detalle' WHERE idnoticias=".$_GET['edit_id'];
        mysql_query($sql_query);
 // sql query for update data into database 

 if(mysql_query($sql_query))
  {
   ?>
  <script type="text/javascript">
  alert('Datos Actualizados Exitosamente');
  window.location.href='ListarNoticias.php';
  </script>
  <?php
  }
 else
  {
   ?>
  <script type="text/javascript">
  alert('Ocurrio un error');
  </script>
  <?php
 
 }
 // sql query execution function
 }
 if(isset($_POST['btn-cancel']))
 {
 header("Location: listarNoticia.php");
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
          <li><a href="#"><i class="fa fa-user"></i>Noticias</a></li>
          <li class="active">Editar Noticias</li>
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
                  <h3 class="box-title">Editar Noticia</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" name="form1" method="post" action="modelo/ingresarEstudiante.php">
                      <div class="box-body">
                           <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">T&iacute;tulo:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" maxlength="7" value="<?php echo $fetched_row['titulo']; ?>" required="true">
                                      <!--  <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $fetched_row['titulo']; ?>" required  > -->
                            </div>
                          </div>
                          <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Detalle:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalle" value="<?php echo $fetched_row['detalle']; ?>" required="true" >
                                       <!-- <input id="detalle" name="detalle" class="form-control" type="text" value="<?php echo $fetched_row['detalle']; ?>" required  > -->
                                    </div>
                          </div>                       
                      </div>
                    <!-- /.box-body -->
                      <div class="box-footer">
                        <input id="tipousuario" name="tipousuario" class="form-control" type="hidden" value="4" >
                        <button type="submit" name="submit" id="saveForm" class="btn btn-success pull-right">Actualizar</button>
                        <button class="btn btn-default" name="btn-cancel">Cancelar</button>
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


