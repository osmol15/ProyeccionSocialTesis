<?php
////Modificar los codigos de departamento y carreras falta@ y hacer los select generados
  include '../db/conSegura.php'; 

  if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q rediirge para llenar en la misma pagina
  {
      $tipoproyecto           	         = $_POST["tipoproyecto"];
      $institucion                       = $_POST["institucion"];
      $direccioninstitucion              = $_POST["direccioninstitucion"];
      $telfijo                           = $_POST["telfijo"];
      $telmovil                          = $_POST["telmovil"];
      $fecha                             = $_POST["fecha"];
      $nombreproyecto                    = $_POST["nombreproyecto"];
      $alumnosresponsables               = $_POST["alumnosresponsables"];
      $nombrecontacto                    = $_POST["nombrecontacto"];
      $archivo                           = $_FILES['fichero']['tmp_name'];
      $requisitodepartamento             = $_POST["requisitodepartamento"];
      $requisitocarrera                  = $_POST["requisitocarrera"];
      $nombre                            = $_POST["nombreproyecto"].".pdf";
      
      if(is_uploaded_file($_FILES['fichero']['tmp_name'])) { // verifica haya sido cargado el archivo 
          move_uploaded_file($_FILES['fichero']['tmp_name'], "../peticiones/".$nombre);

      //        if(move_uploaded_file($_FILES['fichero']['tmp_name'], "../Utileria/".$nombre)) { // se coloca en su lugar final 
      //                    echo "<b>Upload exitoso!. Datos:</b><br>"; 
      //                    echo "Nombre: <i><a href=\"../      Utileria/".$_FILES['fichero']['name']."\">".$_FILES['fichero']['name']."</a></i><br>"; 
      //                    echo "Tipo MIME: <i>".$_FILES['fichero']['type']."</i><br>"; 
      //                    echo "Peso: <i>".$_FILES['fichero']['size']." bytes</i><br>"; 
      //                    echo "<br><hr><br>"; 
      //        } 
          $peticion                   = "<a href=\"../peticiones/".$nombre."\">".$nombre."</a>" ;     

          conectar();
          $inser = "insert into peticiones(tipoproyecto, institucion, direccioninstitucion, telfijo, telmovil,"
                  . "  fecha, nombreproyecto, alumnosresponsables, nombrecontacto, peticion, requisitodepartamento, requisitocarrera)"
                  ."  values('$tipoproyecto','$institucion','$direccioninstitucion','$telfijo','$telmovil','$fecha','$nombreproyecto', '$alumnosresponsables', '$nombrecontacto', '$peticion', '$requisitodepartamento', '$requisitocarrera')";

                  //inserta la info en  los campos de la tabla inscripcion

        if(mysql_query($inser))
        {
                echo "<header>";
                echo "<script language='javascript'>"; 
                echo "alert(':) Peticion Registrada Exitosamente.')"; 
                echo "</script>";  
                echo "</header>";                 
	              exit();
        }
        else{
	           echo mysql_error();
        }

      }//archivo upload
      desconectar();
  }
  else { 
?>

<!DOCTYPE html>
  <script language="javascript">  
        function validar_texto(e){
              tecla = (document.all) ? e.keyCode : e.which;

              if (tecla===8) return true; 
              //Tecla de retroceso para borrar, siempre la permite
              // Patron de entrada, en este caso solo acepta letras
              //patron =/[A-Za-z]/; 
              //solo numeros
              patron = /\d/;
              //no acepta numeros
              //patron = /\D/; 
              return patron.test(tecla_final); 
         }
         function validar_texto2(e){
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
<html>

  <!--CABECERA -->
  <section class="content-header">
        <h1>
          Page Header
          <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-user"></i>Peticiones</a></li>
          <li class="active">Agregar Peticiones de Proyectos</li>
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
                  <h3 class="box-title">Editar Informaci&oacute;n</h3>
                </div>
                <div class="box-body">
                    <form role="form" name="form1" class="form-horizontal" enctype="multipart/form-data"  method="post"  action="modelo/AgregarPeticion.php" >
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="tipoproyecto">Tipo de Servicio Social: </label>
                                <div class="col-sm-9">
                                  <span>
                                       <select name="tipoproyecto" required="true" class="form-control">
                                              <option value="1">INTERNO</option>
                                              <option value="2">EXTERNO</option>
                                              <option value="3">INSTRUCTOR</option>
                                       </select>
                                  </span> 
                                </div>
                          </div>
                          <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre del Proyecto:</label>
                                <div class="col-sm-9">
                                      <input id="nombreproyecto" name="nombreproyecto" class="form-control" type="text" > 
                                </div>
                          </div> 
                          <div class="form-group">
                               <label class="col-sm-3 control-label">Lugar de Ejecuci&oacute;n:</label>
                               <div class="col-sm-9">
                                    <input id="institucion" name="institucion" class="form-control" type="text" > 
                               </div>
                          </div> 
                          <div class="form-group">
                               <label class="col-sm-3 control-label">Direccion de la instituci&oacute;n:</label>
                               <div class="col-sm-9">
                                    <input id="direccioninstitucion" name="direccioninstitucion" class="form-control" type="text" > 
                               </div>
                          </div>
                          <div class="form-group">
                               <label class="col-sm-3 control-label">N&uacute;mero de Alumnos Responsables:</label>
                               <div class="col-sm-9">
                                    <input id="alumnosresponsables" name="alumnosresponsables" class="form-control" type="number" > 
                               </div>
                          </div>                                                   
                          <div class="form-group">
                               <label class="col-sm-3 control-label">Nombre de Contacto:</label>
                               <div class="col-sm-9">
                                    <input id="nombrecontacto" name="nombrecontacto" class="form-control" type="text" > 
                               </div>
                          </div> 
                          <div class="form-group">
                               <label class="col-sm-3 control-label">Tel&eacute;fono Fijo:</label>
                               <div class="col-sm-9">
                                    <input id="telfijo" name="telfijo" onkeypress="return validar_texto(event)" class="form-control" maxlength="8" type="text" > 
                               </div>
                          </div> 
                          <div class="form-group">
                               <label class="col-sm-3 control-label">Tel&eacute;fono Movil:</label>
                               <div class="col-sm-9">
                                    <input id="telmovil" name="telmovil" onkeypress="return validar_texto(event)" class="form-control" maxlength="8" type="text" > 
                               </div>
                          </div> 
                          <?php
                              function generadepartamento(){
                                       conectar();
                                       $consulta = mysql_query("SELECT * FROM departamento");
                                       desconectar();
                                       // Voy imprimiendo el primer select compuesto por los departamentos
                                      echo "<select name='requisitodepartamento' id='requisitodepartamento' class='form-control' required='true' onChange='cargaContenido(this.id)'>";
                                      echo "<option value=''>Elige</option>";
                                      while($registro=mysql_fetch_row($consulta)){
                                               echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
                                      }
                                      echo "</select>";
                              }
                          ?>                                             
                          <div class="form-group">
                               <label class="col-sm-3 control-label" style="margin-top: 5px">Departamento Asignado:</label>
                               <div class="col-sm-9">
                                    <span>
                                         <?php generadepartamento(); ?>
                                    </span>
                               </div>
                           </div> 
                           <div class="form-group">
                                <label class="col-sm-3 control-label" style="margin-top: 5px">Carrera:</label>
                                <div class="col-sm-9">
                                     <span>
                                          <select disabled="disabled" name="requisitocarrera"  required="true" class="form-control" id="carrera">
                                                 <option value="">Selecciona opci&oacute;n...</option>
                                          </select>          
                                     </span>
                                </div>
                            </div> 
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">Fecha:</label>
                                 <div class="col-sm-9" id="datepickerDemo">
                                      <input type="date" name="fecha" class="form-control" step="1" min="<?php echo date("Y-m-d");?>"  value="<?php echo date("Y-m-d");?>">
                                 </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">Respaldo de Petici&oacute;n en .PDF:</label>
                                 <div class="col-sm-9">
                                      <input type="file" name="fichero" class="form-control" id="fichero" required="true">
                                 </div>
                            </div> 
                            <div class="box-footer">
                                <button type="submit" name="submit" id="saveForm" class="btn btn-success pull-right col-sm-2">Guardar</button>
                           </div>
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
<?php

}
?>