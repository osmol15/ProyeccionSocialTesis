<?php

include "./db/conexion.php";

if(isset($_GET['msg'])){
$msg=$_GET['msg'];
}
?>
<!DOCTYPE html>
<html>
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<?php header("Content-Type: text/html; charset=utf-8");?>
	<!-- Icons -->
        <link rel="stylesheet" href="vista/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="vista/fonts/font-awesome/css/font-awesome.min.css">

	<!-- Plugins -->
        <link rel="stylesheet" href="vista/styles/plugins/waves.css">
        <link rel="stylesheet" href="vista/styles/plugins/perfect-scrollbar.css">
	
	<!-- Css/Less Stylesheets -->
        <link rel="stylesheet" href="vista/styles/bootstrap.min.css">
        <link rel="stylesheet" href="vista/styles/main.min.css">

<style>
</style>	
</head>
<body id="app" class="app off-canvas body-full  bg">
	

	
	<!-- main-container -->
	<div class="main-container clearfix">
		
		<!-- content-here -->
		<div class="content-container" id="content">
			<div class="page page-auth">
				<div class="auth-container">

					<div class="form-head mb20">
                                            <center><img src="vista/images/imagen.png" width="40%" /></center>
                                            <br>
                                            <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="index.php"><center>UES sdasd</center><center>
                                                                                                                                          Proyeccion Social</center></a></h1>
						<h5 class="text-normal h5 text-center">Iniciar Sesi&#243;n</h5>
					</div>

					<div class="form-container">
                                            <form class="form-horizontal" name="form-login" id="loginform" method="post" action="controlador/validateLogin.php">
                                                    
                                          <?php
							if ($_GET["error"]=="1" OR $_GET["error"]=="2") {  
                                         echo "<div class='alert alert-danger' >Clave incorrecta</div>"; 
                                         }      else if($_GET["error"]=="3"){
                                             echo "<div class='alert alert-danger' >Usuario no Registrado</div>"; 
                                         }
                                         ?>       
                                                    
                        <!-- Alert message -->
                        	<div id="error" class="alert alert-danger" style="display: none">
                                         
                         	</div>
                          <!--/ Alert message -->
							<div class="md-input-container md-float-label">
                                                            <label>Usuario</label>
                                                            <br>
								<input type="text" name="usuario" id="input-username" class="md-input" onkeypress="if(event.keyCode==13){document.form1.pas.focus();}">
								
							</div>

							<div class="md-input-container md-float-label">
                                                            <label>Contrase&ntilde;a</label>
                                                            <br>
								<input type="password" name="pass" id="input-password"  class="md-input" onkeypress="if(event.keyCode==13){}">
								
							</div>

							
							
							<div class="btn-group btn-group-justified mb15">
								<div class="btn-group">
									<button type="submit" class="btn btn-success">Iniciar Sesi&#243;n</button>
								</div>
							</div> 
							
						</form>
					</div>

				</div> <!-- #end signin-container -->
			</div>

<hr/>
<br><br><br><br><br><br>
                    <p class="text-muted text-center">Derechos© Reservados UES FMocc | Universidad de El Salvador |  Facultad Multidisciplinaria de Occidente <br>
            Unidad de Proyeccion Social | telefonos: | Fax: 
      </p>
		</div> 
		<!-- #end content-container -->

	</div> <!-- #end main-container -->




	<!-- Dev only -->
        <script src="modelo/scripts/vendors.js"></script>
    
    <script type="text/javascript">
 $(document).ready(function(){
      $('#input-username').focus();
            $("#loginform").submit(function() {
        if (!$("#input-username").val()) {
          $("#error").text("Ingrese un Usuario").addClass("alert alert-error").fadeIn("Slow");
	  $('#input-username').focus(); 
          return false;
        } else if (!$("#input-password").val()) {
          $("#error").text("Ingrese su Contraseña").addClass("alert alert-error").fadeIn("Slow");
          return false;
        }   else {
          return true;
        }
      });
    });
    
  
</script> 


</body>
    </html>