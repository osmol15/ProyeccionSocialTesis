<?php
	require '../db/conexion.php'; 
	session_start();

	$idusuario = $_SESSION["idusuario"];
	$q="select * from usuario where idusuario ='$idusuario'";
	$result=mysql_query($q,$conn) or die("Error: ".mysql_error());

	while($Rs=mysql_fetch_array($result)) {
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
        	<li><a href="#"><i class="fa fa-user"></i>Perfil</a></li>
        	<li class="active">Editar Informaci&oacute;n</li>
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
              			<form class="form-horizontal" role="form" name="form1" enctype="multipart/form-data" method="post" action="editarCoordinador.php">
              				<div class="box-body">
                				<div class="form-group">
                  					<label for="Nombre" class="col-sm-2 control-label">Nombre:</label>
						                <div class="col-sm-10">
                    					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $Rs["nombre"];?>">
                  					</div>
                				</div>
                				<div class="form-group">
                  					<label for="Apellido" class="col-sm-2 control-label">Apellido:</label>
                  					<div class="col-sm-10">
                    					<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $Rs["apellido"]; ?>">
                  					</div>
                				</div>
                				<div class="form-group">
                  					<label for="Usuario" class="col-sm-2 control-label">Usuario:</label>
                  					<div class="col-sm-10">
                    					<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $Rs["usuario"]; ?>">
                  					</div>
                				</div>
                				<div class="form-group">
                  					<label for="Pass" class="col-sm-2 control-label">Clave:</label>
                  					<div class="col-sm-10">
                    					<input type="password" class="form-control" id="pass" name="pass" placeholder="Clave" value="<?php echo $Rs["clave"]; ?>">
                  					</div>
                				</div>
                				<div class="form-group">
                  					<label for="Pass" class="col-sm-2 control-label">Repetir Clave:</label>
                  					<div class="col-sm-10">
                    					<input type="password" class="form-control" id="repass" name="repass" placeholder="Repetir Clave" value="value="<?php echo $Rs["clave"]; ?>">
                  					</div>
                				</div>
                				<div class="form-group">
                  					<label for="departamento" class="col-sm-2 control-label">Departamento:</label>
                  					<div class="col-sm-10">
                    					<span>
                                            <select name="iddepartamento" required="true" class="form-control" disabled="true" value="<?php echo $Rs["clave"]; ?>">
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
                  					<label for="Celular" class="col-sm-2 control-label">Celular:</label>
                  					<div class="col-sm-10">
                    					<input type="phone" class="form-control" id="telefono" name="telefono" placeholder="Celular" value="<?php echo $Rs["telefono"]; ?>">
                  					</div>
                				</div>
                				<div class="form-group">
                  					<label for="Correo" class="col-sm-2 control-label">Correo:</label>
                  					<div class="col-sm-10">
                    					<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="<?php echo $Rs["correo"]; ?>">
                    					<input id="idusuario" name="idusuario" type="hidden" value="<?php echo $Rs["idusuario"]; ?>" > 
                  					</div>
                				</div>
              				</div>
				            <!-- /.box-body -->
              				<div class="box-footer">
                				<button type="submit" name="actualizar" id="saveForm" class="btn btn-success pull-right">Actualizar</button>
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
 	<?php if(isset($_POST["actualizar"])){
 
		$pass           = $_POST["pass"];
		$idusuario 		= $_POST["idusuario"];
		$usuario 		= $_POST["usuario"];
		$nombre 		= $_POST["nombre"];
		$apellido 		= $_POST["apellido"];
		$telefono 		= $_POST["telefono"];
		$correo 		= $_POST["correo"];

		$inser = 	"update usuario set
		  			   nombre 			= '$nombre',
		  			   apellido    	= '$apellido',
		  			   clave       	= '$pass',
              telefono   		= '$telefono',
		  			  correo     		= '$correo',          
             	usuario    		= '$usuario'                     
		  			where idusuario =  '$idusuario' ";
                      
		if(mysql_query($inser))
		{
    		echo "<header>";
   			echo "<script language='javascript'>"; 
    		echo "alert(':) Datos Actualizados Exitosamente.')"; 
		    echo "</script>";  
    		echo"<script language='javascript'>window.location='editarCoordinador.php'</script>;";
    		echo "</header>";
    	    exit();  
		}
		else{
			echo mysql_error();
		}
	}
}