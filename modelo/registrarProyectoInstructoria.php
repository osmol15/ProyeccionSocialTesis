<!DOCTYPE html>

<?php
  require_once 'Proyectos.php'; 
  require_once 'conexion.php';
  session_start();
  
  $carnetinicial = $_SESSION["carnet"];
  $proyecto = new Proyectos();
  $datos = $proyecto->getDatosProyecto($carnetinicial);  
  
  if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q rediirge para llenar en la misma pagina
  {


    $carnet                   = $_SESSION["carnet"];
    $idtipoinscripcion        = $_POST["idtipoinscripcion"];
    $tipoproyecto             = $_POST["tipoproyecto"];
    $numerodehoras            = $_POST["numerodehoras"];
    $alumnosatendidos         = $_POST["alumnosatendidos"];
    $notamateria              = $_POST["notamateria"];
    $nombreproyecto           = $_POST["nombreproyecto"];
    $institucion              = $_POST["institucion"];
    $direccioninstitucion     = $_POST["direccioninstitucion"];
    $telfijo                  = $_POST["telfijo"];
    $telmovil                 = $_POST["telmovil"];
    $nombrecontacto           = $_POST["nombrecontacto"];
    $fechaini                 = $_POST["fechaini"];
    $fechafin                 = $_POST["fechafin"];
    //$horario                  = $_POST["horario"];
    $fecha                    = $_POST["fecha"];
    $tutor                    = $_POST["tutor"];
    $peticioninstructoria     = $_POST["idpeticionesinstructoria"];
   
         $resta = 1;     

        $inser = "insert into 
                  proyecto (carnet, idtipoinscripcion, tipoproyecto, numerodehoras, alumnosatendidos, notamateria, nombreproyecto, institucion, direccioninstitucion, telfijo, telmovil, nombrecontacto, fechaini, fechafin, fecha, tutor, peticioninstructoria)  "      
                    ."values ('$carnet', '$idtipoinscripcion', '$tipoproyecto', '$numerodehoras', '$alumnosatendidos','$notamateria', '$nombreproyecto', '$institucion', '$direccioninstitucion', '$telfijo', '$telmovil', '$nombrecontacto', '$fechaini', '$fechafin', '$fecha', '$tutor', '$peticioninstructoria')";
        
        $update = "UPDATE peticionesinstructoria
                                SET alumnosresponsables = alumnosresponsables-'$resta'
                                WHERE idpeticionesinstructoria = '$peticioninstructoria' "; 
        
        if(mysql_query($inser) and mysql_query($update))
          {
        echo "<header>";
   echo "<script language='javascript'>"; 
    echo "alert('Proyecto Inscrito Exitosamente.')"; 
    
    echo "</script>";  
    echo"<script language='javascript'>window.location='../modelo/cargarPeticionesInstructoria.php'</script>;";
    echo "</header>";
    
    exit();  
          }
        else
          {
	         echo mysql_error();
          }

  }
  else if(isset($_POST["cargar"]))//con isset no necesito dos paginas para la consulta sino q rediirge para llenar en la misma pagina
  {
  
      $nombreproyecto = $_POST["nombreinstructoria"];
      $institucion = $_POST["institucion"];
      $direccion = $_POST["direccioninstitucion"];
      $alumnosresponsables = $_POST["alumnosresponsables"];
      $alumnosatendidos = $_POST["numerodealumnosatender"];
      $nombrecontacto = $_POST["catedratico"];
      $telfijo = $_POST["telfijo"];
      $tipoproyecto = $_POST["tipoproyecto"];
      $idpeticionesinstructoria = $_POST["idpeticionesinstructoria"];
      
      
	  ?>
<html>
    <head>
       <meta charset="utf-8">
	     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	     <meta name="description" content="Proyeccion Social Admin">
	     <meta name="author" content="Giovany Rosales">
	<!-- <base href="/"> -->
	     <title>Proyeccion Social Estudiante</title>
	<!-- Icons -->
       <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
	     <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
	<!-- Plugins -->
	     <link rel="stylesheet" href="../styles/plugins/waves.css">
	     <link rel="stylesheet" href="../styles/plugins/perfect-scrollbar.css">
	     <link rel="stylesheet" href="../styles/plugins/bootstrap-colorpicker.css">
	     <link rel="stylesheet" href="../styles/plugins/bootstrap-slider.css">
	     <link rel="stylesheet" href="../styles/plugins/summernote.css">
	<!-- Css/Less Stylesheets -->
	     <link rel="stylesheet" href="../styles/bootstrap.min.css">
	     <link rel="stylesheet" href="../styles/main.min.css">
 	     <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>
       <script language="javascript" src="../scripts/validar.js"></script>        
       
    </head>
    <body id="app" class="app off-canvas" >

    	     <!-- <div class="content-container" id="content"> -->
	         <!--<div class="page page-forms-elements"> --> 
        
		    <ol class="breadcrumb breadcrumb-small">
			     <li>Peticiones</li>
			     <li class="active"><a>Registrar peticiones de proyecto</a></li>
		    </ol>
		    <div class="page-wrap">
			     <!-- row -->
			     <div class="row">						
              <div class="col-sm-12 col-md-6">
					         <div class="panel panel-default panel-hovered panel-stacked mb30">
						           <div class="panel-heading">Ficha de Inscripci&oacute;n</div>
                            <div class="panel-body" style="padding-right: 30%;">
                                <br><br>
                                <form role="form" name="form1" class="form-horizontal" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" > 
                                <!--<div name="form1" class="form-horizontal" >--> <!-- form horizontal acts as a row -->	
								
                                    <div class="form-group">
                                          <label class="col-md-6 control-label">INFORMACION GENERAL</label>
                                          <br><br>
                                          <div class="col-md-6" style="width: 100%; text-align: right; padding-top: 2em;">
                                                <div class="ui-radio ui-radio-blue">
                                                      <label class="ui-radio-inline">
                                                        <input type="radio" checked name="idtipoinscripcion" value="1"> 
                                                        <span>Inicial</span>
                                                      </label>
                                                      <label class="ui-radio-inline">
                                                        <input type="radio" name="idtipoinscripcion" value="2"> 
                                                        <span>Reincorporaci&oacute;n</span>
                                                      </label>
                                                </div>                                                                                       
                                          </div>    
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Apellidos:</label>
                                        <div class="col-md-9">
                                              <input id="apellidoestudiante" name="apellidoestudiante" class="form-control" type="letter" pattern="[A-Za-z ]+" value="<?php echo $datos["apellidoestudiante"]; ?>" required onkeypress="return soloLetras(event)" onpaste="return false"> 
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                         <label class="col-md-3 control-label">Nombre Completo:</label>
                                         <div class="col-md-9">
                                              <input id="nombreestudiante" name="nombreestudiante" class="form-control" type="letter"  pattern="[A-Za-z ]+" value="<?php echo $datos["nombreestudiante"]; ?>" required onkeypress="return soloLetras(event)" onpaste="return false" > 
                                         </div>
                                    </div> 
                                    <div class="form-group">
                                         <label class="col-md-3 control-label" style="margin-top: 5px">Sexo:</label>
                                         <div class="col-md-9">
                                             <span>
                                               <select name="sexo" class="form-control"   disabled="true">
                                                    <option value="f"  <?php  if($datos["sexo"]=="f"){echo' selected';} ?>>Femenino</option>
                                                    <option value="m"  <?php  if($datos["sexo"]=="m"){echo' selected';} ?>>Masculino</option>
                                               </select>
                                             </span>
                                          </div>
                                   
                                    </div> 
                                    <div class="form-group">
                                          <label class="col-md-3 control-label">Carnet de Estudiante:</label>
                                          <div class="col-md-9">
                                               <input id="carnet" name="carnet" class="form-control" type="text"  maxlength="7" readonly="true" value="<?php echo $datos["carnet"]; ?>" title="Se necesita el Carnet del Estudiante. Ingrese un formato de carnet valido ej. RH08017"  required="true"  pattern="[a-zA-Z][a-zA-Z]+[0-9][0-9][0-9][0-9][0-9]"> 
                                          </div>
                                    </div> 
                                   <div class="form-group">
                                             <label class="col-md-3 control-label" style="margin-top: 5px">Carrera:</label>
                                              <div class="col-md-9">
                                                    <span>
                                                        <select name="carrera" class="form-control" disabled="true" >
                                                            <option value="1" <?php  if($datos["carrera"]=="1"){echo' selected';} ?>>I30515 - Ingenier&iacute;a de Sistemas Inform&aacute;ticos</option>
                                                            <option value="2" <?php  if($datos["carrera"]=="2"){echo' selected';} ?>>Arquitectura</option>
                                                             <option value="3"  <?php  if($datos["carrera"]=="3"){echo' selected';} ?>>Ingenier&iacute;a Industrial</option>
                                                            <option value="4"  <?php  if($datos["carrera"]=="4"){echo' selected';} ?>>Ingenier&iacute;a Civil</option>
                                                            <option value="5"  <?php  if($datos["carrera"]=="5"){echo' selected';} ?>>Ingenier&iacute;a Mec&aacute;nica</option>
                                                            <option value="6"  <?php  if($datos["carrera"]=="6"){echo' selected';} ?>>Ingenier&iacute;a Qu&iacute;mica</option>
                                                        </select>
                                                    </span>
                                              </div>
                                      </div> 
                                     <div class="form-group">
                                          
                                             <label class="col-md-3"  style="text-align: right; color: firebrick; ">Telefonos</label>
                                             <br>
                                             <label class="col-md-9 control-label">&nbsp;</label>
                                             <label class="col-md-3 control-label">Fijo:</label>
                                              <div class="col-md-9">
                                                     <input id="telfijo2" name="telfijo2" class="form-control" type="tel" maxlength="8" value="<?php echo $datos["telfijo"]; ?>" onkeypress="return soloNumeros(event)" onpaste="return false" > 
                                              </div>
                                              <label class="col-md-3 control-label">Celular:</label>
                                              <div class="col-md-9">
                                                     <input id="telmovil2" name="telmovil" class="form-control" type="tel" maxlength="8" value="<?php echo $datos["telmovil"]; ?>" onkeypress="return soloNumeros(event)" onpaste="return false" > 
                                              </div>
                                      </div> 
                                <div class="form-group">
                                              <label class="col-md-3 control-label" style="margin-top: 10px"  >Correo:</label>
                                              <div class="col-md-9">
                                                     <input id="correo" name="correo" class="form-control" type="email" value="<?php echo $datos["correo"]; ?>"> 
                                              </div>
                                      </div>
                                
                                 <div class="form-group">
                                             <label class="col-md-3 control-label">CUM:</label>
                                              <div class="col-md-9">
                                                  <input id="cum" name="cum" class="form-control" type="number" min="7" max="10" step="0.01" value="<?php echo $datos["cum"]; ?>"> 
                                              </div>
                                        </div>
                                
                                       <div class="form-group">
                                                <label class="col-md-3 control-label" for="tipoproyecto">Tipo de Servicio Social: </label>
                                                <div class="col-md-9">
                                                    <span>
                                                        <select id="tipoproyecto" name="tipoproyecto" required="true" class="form-control" >
                                                            <option value="3" <?php  if($tipoproyecto=="3"){echo' selected';} ?>>INSTRUCTOR</option>
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
                                                  <input id="alumnosatendidos" name="alumnosatendidos" class="form-control" type="number" value="<?php echo $alumnosatendidos; ?>"> 
                                              </div>
                                      </div>               
                                      <div class="form-group">
                                             <label class="col-md-3 control-label">Nombre del Proyecto:</label>
                                              <div class="col-md-9">
                                                  <input id="nombreproyecto" name="nombreproyecto" class="form-control" type="text" value="<?php echo $nombreproyecto; ?>"> 
                                              </div>
                                      </div>       
                                      <div class="form-group">
                                             <label class="col-md-3 control-label">Nombre de la instituci&oacute;n que demanda el servicio:</label>
                                              <div class="col-md-9">
                                                     <input id="institucion" name="institucion" class="form-control" type="text" value="<?php echo $institucion; ?>"> 
                                              </div>
                                      </div>     
                                      <div class="form-group">
                                             <label class="col-md-3 control-label">Direcci&oacute;n:</label>
                                              <div class="col-md-9">
                                                     <input id="direccioninstitucion" name="direccioninstitucion" class="form-control" type="text" value="<?php echo $direccion; ?>"> 
                                              </div>
                                      </div>    
                                 <div class="form-group">
                                             <label class="col-md-3 control-label">N&uacute;mero de estudiantes Responsables:</label>
                                              <div class="col-md-9">
                                                  <input id="alumnosresponsables" name="alumnosresponsables" class="form-control" type="number" value="<?php echo $alumnosresponsables; ?>"> 
                                              </div>
                                      </div>  
                                       <div class="form-group">
                                        
                                             <label class="col-md-12 control-label" style="text-align: left; color: firebrick;" >Telefonos de contacto de la instituci&oacute;n</label>
                                                <br>
                                             <label class="col-md-3 control-label">Fijo:</label>
                                              <div class="col-md-9">
                                                     <input id="fijoIns" name="telfijo" class="form-control" type="tel" maxlength="8" value="<?php echo $telfijo; ?>"> 
                                              </div>
                                      </div> 
                                      <div class="form-group">
                                             <label class="col-md-3 control-label">Nombre contacto institucional:</label>
                                              <div class="col-md-9">
                                                     <input id="nombrecontacto" name="nombrecontacto" class="form-control" type="text" value="<?php echo $nombrecontacto; ?>"> 
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
                                                     <input id="idpeticiones" name="idpeticiones"  type="hidden" value="<?php echo $idpeticionesinstructoria;?>"> 
                                              </div>
                                      </div>     
                                      <div class="form-group">
                                             <label class="col-md-12 control-label" style="text-align: center">Horario en que se realizar&aacute; el servicio social:</label>
                                             <table id="horarios" name="horarios" cellspacing="0" width="100%" border="1">
						      <thead>
							<tr>
							  <th style="text-align:center"><b>Horario</b></th>
							  <th style="text-align:center"><b>Lunes</b></th>
							  <th style="text-align:center"><b>Martes</b></th>
							  <th style="text-align:center"><b>Miercoles</b></th>
							  <th style="text-align:center"><b>Jueves</b></th>
							  <th style="text-align:center""><b>Viernes</b></th>
							  <th style="text-align:center"><b>Sabado</b></th>
							</tr>
						      </thead>
						      <tbody>
							<tr>
							  <td align="center" id="hora"><b>Mañana</b></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							</tr>
							<tr>
							  <td align="center" id="hora"><b>Tarde</b></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							  <td contenteditable="true" ></td>
							</tr>
						      </tbody>
						</table>  
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
                                                    <br>
                                              <div class="form-group">
                                                    <label class="col-md-3 control-label">Fecha:</label>
                                                        <div class="col-md-9" id="datepickerDemo">
                                                            <input type="hidden" name="idpeticionesinstructoria" value="<?php echo $idpeticionesinstructoria; ?>">
                                                            <input type="date" id="fecha" name="fecha" class="form-control" step="1" min="<?php echo date("Y-m-d");?>"  value="<?php echo date("Y-m-d");?>">
                                                        </div>
                                                    </div>
                                                    <div class="clearfix right">
                                                            <button class="btn btn-primary mr5" name="submit" id="saveForm" >Guardar</button>
                                                            <button class="btn btn-default">Cancelar</button>
                                                    </div>
									</form>

						</div> <!-- #end panel body -->
                                                
				</div> <!-- #end panel -->
							</div><!-------------->
				</div><!-- row -->
                       </div><!-- #end page-wrap -->

	<!--</div> <!-- #end content-container======= Cierre de los 2 divs comentados al inicio --> 

	<!--    </div> <!-- #end main-container -->
        
        	<!-- Dev only -->   
	<!-- Vendors -->
         <script src="../scripts/vendors.js"></script>
	<script src="../scripts/plugins/screenfull.js"></script>
	<script src="../scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="../scripts/plugins/waves.min.js"></script>
	<script src="../scripts/plugins/bootstrap-colorpicker.min.js"></script>
	<script src="../scripts/plugins/bootstrap-slider.min.js"></script>
	<script src="../scripts/plugins/summernote.min.js"></script>
	<script src="../scripts/app.js"></script>
	<script src="../scripts/form-elements.init.js"></script>
	<script type="text/javascript" src="../scripts/enviarDatos.js"></script>
    </body>
</html>
<?php
          }
