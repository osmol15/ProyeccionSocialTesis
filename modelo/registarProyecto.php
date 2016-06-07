<?php
  require '../db/conexion.php'; 
  session_start();

  $carnetinicial = $_SESSION["carnet"];
  $q="select * from estudiante where carnet ='$carnetinicial'";
  $result=mysql_query($q,$conn) or die("Error: ".mysql_error());

  if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q rediirge para llenar en la misma pagina
  {

    $carnet                    = $_SESSION["carnet"];
    $idtipoinscripcion         = $_POST["idtipoinscripcion"];
    $tipoproyecto              = $_POST["tipoproyecto"];
    $numerodehoras             = $_POST["numerodehoras"];
    $alumnosatendidos          = $_POST["alumnosatendidos"];
    $notamateria               = $_POST["notamateria"];
    $nombreproyecto            = $_POST["nombreproyecto"];
    $institucion               = $_POST["institucion"];
    $direccioninstitucion      = $_POST["direccioninstitucion"];
    $alumnosresponsables       = $_POST["alumnosresponsables"];
    $telfijo                   = $_POST["telfijo"];
    $telmovil                  = $_POST["telmovil"];
    $nombrecontacto            = $_POST["nombrecontacto"];
    $fechaini                  = $_POST["fechaini"];
    $fechafin                  = $_POST["fechafin"];
    //$horario                  = $_POST["horario"];
    $fecha                     = $_POST["fecha"];
    $tutor                     = $_POST["tutor"];
    $firmacoordinador          = $_POST["firmacoordinador"];
    $firmajefe                 = $_POST["firmajefe"];
           

    $inser = "insert into proyecto (
              carnet, idtipoinscripcion, tipoproyecto, numerodehoras, alumnosatendidos, notamateria, nombreproyecto, institucion, direccioninstitucion, alumnosresponsables, telfijo, telmovil, nombrecontacto, fechaini, fechafin, fecha, tutor
              )  "  
              ."values (
                  '$carnet', '$idtipoinscripcion', '$tipoproyecto', '$numerodehoras', '$alumnosatendidos','$notamateria', '$nombreproyecto', '$institucion', '$direccioninstitucion','$alumnosresponsables', '$telfijo', '$telmovil', '$nombrecontacto', '$fechaini', '$fechafin', '$fecha', '$tutor
                ')";

    if(mysql_query($inser)){
            echo "<header>";
            echo "<script language='javascript'>"; 
            echo "alert(':) Proyecto Inscrito Exitosamente.')"; 
            echo "</script>";  
            echo "</header>";               
            exit();
     }
     else{
           echo mysql_error();
     }
  }
  else {
  }
?>

<!DOCTYPE html>
<html>
  <?php      
     while($Rs=mysql_fetch_array($result)) {  //capturamos el arregloo de resultados  
  ?>
  <!--CABECERA -->
  <section class="content-header">
        <h1>
          Page Header
          <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-user"></i>Proyectos</a></li>
          <li class="active">Agregar Proyecto</li>
        </ol>
    </section>
  <!--FIN CABECERA -->
  <!--Contenido-->
    <section class="content">
    <div class="row">
          <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="fa fa-edit"></i>
                  <h3 class="box-title">Ficha de Inscripci&oacute;n</h3>
                </div>
                <div class="box-body">
                    <form role="form" name="form1" class="form-horizontal" enctype="multipart/form-data"  method="post"  action="modelo/registarProyecto.php" >
                          
                          <div class="form-group text-center">
                                <label class="col-sm-6 control-label text-center">Informaci&oacute;n General</label>                                           
                          </div>
                          <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre del Proyecto:</label>
                                <div class="col-sm-9">
                                 
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Apellidos:</label>
                              <div class="col-md-9">
                                   <input id="apellidoestudiante" name="apellidoestudiante" class="form-control" type="letter" pattern="[A-Za-z ]+" value="<?php echo $Rs['apellidoestudiante']; ?>"> 
                              </div>
                           </div> 
                           <div class="form-group">
                                <label class="col-md-3 control-label">Nombre Completo:</label>
                                <div class="col-md-9">
                                    <input id="nombreestudiante" name="nombreestudiante" class="form-control" type="letter"  pattern="[A-Za-z ]+" value="<?php echo $Rs["nombreestudiante"]; ?>"> 
                                </div>
                           </div> 
                           <div class="form-group">
                                 <label class="col-md-3 control-label" style="margin-top: 5px">Sexo:</label>
                                  <div class="col-md-9">
                                        <span>
                                            <select name="sexo" class="form-control"   disabled="true">
                                                  <option value="f"  <?php  if($Rs["sexo"]=="f"){echo' selected';} ?>>Femenino</option>
                                                  <option value="m"  <?php  if($Rs["sexo"]=="m"){echo' selected';} ?>>Masculino</option>
                                            </select>
                                        </span>
                                  </div>                                   
                            </div> 
                            <div class="form-group">
                                  <label class="col-md-3 control-label">Carnet de Estudiante:</label>
                                  <div class="col-md-9">
                                       <input id="carnet" name="carnet" class="form-control" type="text"  maxlength="7" readonly="true" value="<?php echo $Rs["carnet"]; ?>" title="Se necesita el Carnet del Estudiante. Ingrese un formato de carnet valido ej. RH08017"  required="true"  pattern="[a-zA-Z][a-zA-Z]+[0-9][0-9][0-9][0-9][0-9]"> 
                                  </div>
                            </div> 
                            <div class="form-group">
                                  <label class="col-md-3 control-label" style="margin-top: 5px">Carrera:</label>
                                         <div class="col-md-9">
                                              <span>
                                                   <select name="carrera" class="form-control" disabled="true" >
                                                         <option value="1" <?php  if($Rs["carrera"]=="1"){echo' selected';} ?>>I30515 - Ingenier&iacute;a de Sistemas Inform&aacute;ticos</option>
                                                         <option value="2" <?php  if($Rs["carrera"]=="2"){echo' selected';} ?>>Arquitectura</option>
                                                         <option value="3"  <?php  if($Rs["carrera"]=="3"){echo' selected';} ?>>Ingenier&iacute;a Industrial</option>
                                                         <option value="4"  <?php  if($Rs["carrera"]=="4"){echo' selected';} ?>>Ingenier&iacute;a Civil</option>
                                                         <option value="5"  <?php  if($Rs["carrera"]=="5"){echo' selected';} ?>>Ingenier&iacute;a Mec&aacute;nica</option>
                                                         <option value="6"  <?php  if($Rs["carrera"]=="6"){echo' selected';} ?>>Ingenier&iacute;a Qu&iacute;mica</option>
                                                    </select>
                                              </span>
                                          </div>
                            </div> 
                            <div class="form-group">                                          
                                  <label class="col-md-3"  style="text-align: right; color: firebrick; ">Telefonos</label>
                            </div>
                            <div class="form-group">                                          
                                  <label class="col-md-3 control-label">Fijo:</label>
                                  <div class="col-md-9">
                                        <input id="telfijo2" name="telfijo2" class="form-control" type="tel" maxlength="8" value="<?php echo $Rs["telfijo"]; ?>"> 
                                    </div>
                            </div>
                            <div class="form-group">                                          
                                  <label class="col-md-3 control-label">Celular:</label>
                                  <div class="col-md-9">
                                        <input id="telmovil2" name="telmovil2" class="form-control" type="tel" maxlength="8" value="<?php echo $Rs["telmovil"]; ?>"> 
                                    </div>
                            </div>                             
                            <div class="form-group">
                                 <label class="col-md-3 control-label" style="margin-top: 10px"  >Correo:</label>
                                 <div class="col-md-9">
                                      <input id="correo" name="correo" class="form-control" type="email" value="<?php echo $Rs["correo"]; ?>"> 
                                  </div>
                            </div>   
                            <div class="form-group">
                                  <label class="col-md-3 control-label">CUM:</label>
                                  <div class="col-md-9">
                                       <input id="cum" name="cum" class="form-control" type="number" min="7" max="10" step="0.01" value="<?php echo $Rs["cum"]; ?>"> 
                                   </div>
                            </div> 
                            <div class="form-group">
                                 <label class="col-md-3 control-label" for="tipoproyecto">Tipo de Servicio Social: </label>
                                 <div class="col-md-9">
                                      <span>
                                         <select id="tipoproyecto" name="tipoproyecto" required="true" class="form-control" onchange="validarProyecto()">
                                                <option value="1">INTERNO</option>
                                                <option value="2">EXTERNO</option>
                                                 <option value="3">INSTRUCTOR</option>
                                        </select>
                                      </span> 
                                  </div>
                             </div>  
                             <div class="form-group">
                                  <label class="col-md-3 control-label">N&uacute;mero de horas que solicita:</label>
                                  <div class="col-md-9">
                                       <input id="numerodehoras" name="numerodehoras" class="form-control" type="number" min="1" max="500"> 
                                  </div>
                             </div> 
                             <div class="form-group">
                                  <label class="col-md-3 control-label">Nota de la materia que ser&aacute; instructor:</label>
                                  <div class="col-md-9">
                                       <input id="notamateria" name="notamateria" class="form-control" type="number" min="6" max="10" step="0.01"> 
                                  </div>
                             </div>        
                             <div class="form-group">
                                  <label class="col-md-3 control-label">Total de alumnos a atender:</label>
                                  <div class="col-md-9">
                                        <input id="alumnosatendidos" name="alumnosatendidos" class="form-control" type="number"> 
                                  </div>
                             </div> 
                             <div class="form-group">
                                  <label class="col-md-3 control-label">Nombre del Proyecto:</label>
                                  <div class="col-md-9">
                                       <input id="nombreproyecto" name="nombreproyecto" class="form-control" type="text"> 
                                  </div>
                            </div>       
                            <div class="form-group">
                                 <label class="col-md-3 control-label">Nombre de la instituci&oacute;n que demanda el servicio:</label>
                                 <div class="col-md-9">
                                     <input id="institucion" name="institucion" class="form-control" type="text">
                                 </div>
                            </div>     
                            <div class="form-group">
                                  <label class="col-md-3 control-label">Direcci&oacute;n:</label>
                                  <div class="col-md-9">
                                       <input id="direccioninstitucion" name="direccioninstitucion" class="form-control" type="text"> 
                                  </div>
                             </div>  
                             <div class="form-group">
                                  <label class="col-md-3 control-label">N&uacute;mero de estudiantes Responsables:</label>
                                   <div class="col-md-9">
                                        <input id="alumnosresponsables" name="alumnosresponsables" class="form-control" type="number"> 
                                   </div>
                             </div>  
                             <div class="form-group">                                          
                                  <label class="col-md-3"  style="text-align: right; color: firebrick; ">Telefonos de Contacto de la Instituci&oacute;n</label>
                            </div>
                            <div class="form-group">                                          
                                  <label class="col-md-3 control-label">Fijo:</label>
                                  <div class="col-md-9">
                                        <input id="fijoIns" name="telfijo" class="form-control" type="tel" maxlength="8"> 
                                    </div>
                            </div>
                            <div class="form-group">                                          
                                  <label class="col-md-3 control-label">Celular:</label>
                                  <div class="col-md-9">
                                        <input id="celularIns" name="telmovil" class="form-control" type="tel" maxlength="8"> 
                                    </div>
                            </div>            
                            <div class="form-group">
                                 <label class="col-md-3 control-label">Nombre contacto institucional:</label>
                                 <div class="col-md-9">
                                       <input id="nombrecontacto" name="nombrecontacto" class="form-control" type="text" onkeypress="return soloLetras(event)"> 
                                 </div>
                            </div>     
                            <div class="form-group">
                                 <label class="col-md-3 control-label">Fecha Inicio:</label>
                                 <div class="col-md-9">
                                       <input id="fechaini" name="fechaini" class="form-control" type="date"> 
                                 </div>
                            </div>     
                            <div class="form-group">
                                 <label class="col-md-3 control-label">Fecha Fin:</label>
                                 <div class="col-md-9">
                                      <input id="fechafin" name="fechafin" class="form-control" type="date"> 
                                 </div>
                            </div>  
                            <div class="form-group">
                                 <label class="col-md-12 control-label" style="text-align: center">Horario en que se realizar&aacute; el servicio social:</label>
                                              
                            </div>    
                            <div class="form-group">
                                 <label class="col-md-3 control-label" for="tutor">Tutor Asignado al proyecto: </label>
                                 <div class="col-md-9">
                                      <span>
                                         <select name="tutor" required="true" class="form-control">
                                               <option value="4">Ninguno</option>
                                               <option value="3">Edwin Alexander Rosales</option>
                                         </select>
                                      </span> 
                                 </div>
                            </div>   
                            <div class="form-group">
                                  <label class="col-md-3 control-label">Fecha:</label>
                                  <div class="col-md-9" id="datepickerDemo">
                                       <input type="date" name="fecha" class="form-control" step="1" min="<?php echo date("Y-m-d");?>"  value="<?php echo date("Y-m-d");?>">
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