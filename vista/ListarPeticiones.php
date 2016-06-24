<?php
if(session_start()) {
require_once '../modelo/Peticiones_modelo.php';
if($_SESSION['idtipousuario'] == 1 ) {
$pet = new Peticiones();
$peticiones = $pet->getAll();
} else {
$pet = new Peticiones();
$peticiones = $pet->peticionesCarrera(trim($_SESSION['carrera']));
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
    
    <link rel="stylesheet" href="../scripts/datatables/dataTables.bootstrap.css">

    <style>
      a i{
        color: gray;
      }
    </style>
  </head>
  <body class="layout-top-nav">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        &nbsp;
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i>Peticiones</a></li>
          <li><a href="#">Listado de Peticiones</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-solid box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Lista de Peticiones</h3>
          </div>
          <div class="box-body">
            <?php
              if ($peticiones == 0) {
                echo "No hay peticiones";
              }else{
            ?>
            <form  role="form" name="form1" class="form-horizontal" method="post"  action="../vista/registrarProyecto.php" >
              <table id="example" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>Nombre del Proyecto</th>
                    <th>Instituci&oacute;n</th>
                    <th>Nombre de Contacto</th>
                    <th>Direcci&oacute;n</th>
                    <th>Petici&oacute;n</th>
                    <?php
                    if ($_SESSION['idtipousuario'] == 4 ) {
                    echo '<th>Inscripci&oacute;n</th>';
                    } else if ($_SESSION['idtipousuario'] == 2 OR $_SESSION['idtipousuario'] == 5 OR $_SESSION['idtipousuario'] == 1){
                    echo '<th colspan="2">Opciones</th>';
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($peticiones as $peticion) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $peticion["nombreproyecto"]; ?> 
                      <input  name="nombreproyecto" class="form-control" type="hidden" value="<?php echo $peticion["nombreproyecto"];?>" > 
                    </td>
                    <td>
                      <?php echo $peticion["institucion"]; ?> 
                      <input  name="institucion" class="form-control" type="hidden" value="<?php echo $peticion["institucion"];?>" >
                    </td> 
                    <td>
                      <?php echo $peticion["nombrecontacto"]; ?> 
                      <input  name="nombrecontacto" class="form-control" type="hidden" value="<?php echo $peticion["nombrecontacto"];?>" > 
                    </td>
                    <td>
                      <?php echo $peticion["direccioninstitucion"] ?> 
                      <input  name="direccioninstitucion" class="form-control" type="hidden" value="<?php echo $peticion["direccioninstitucion"];?>" > 
                    </td>
                    <td>
                      <a href="<?php echo $peticion["peticion"]; ?>" target="__blank"> Ver Documento </a>
                    </td>
                    <?php
                    if($_SESSION['idtipousuario'] == 4) {
                    ?>
                    <td>
                      <button class='btn btn-primary ' name='cargar' id='saveForm' type='submit'>Inscribir</button>
                      <input  name="telfijo" class="form-control" type="hidden" value="<?php echo $peticion["telfijo"];?>" >
                      <input  name="telmovil" class="form-control" type="hidden" value="<?php echo $peticion["telmovil"];?>" >
                      <input  name="tipoproyecto" class="form-control" type="hidden" value="<?php echo $peticion["tipoproyecto"];?>" >
                      <input  name="idpeticiones" class="form-control" type="hidden" value="<?php echo $peticion["idpeticiones"];?>" >
                    </td>
                    <?php } else if ($_SESSION['idtipousuario'] == 2 OR $_SESSION['idtipousuario'] == 5 OR $_SESSION['idtipousuario'] == 1) { ?>
                    <td>
                      <a href="javascript:edit_id('<?php echo $peticion["idpeticiones"] ?>')">
                          <i class="fa  fa-edit fa-2x" title="Editar"></i>
                      </a>   
                    </td>
                    <td>
                      <a href="javascript:delete_id('<?php echo $peticion["idpeticiones"] ?>')">
                          <i class="fa fa-trash-o fa-2x" title="Eliminar"></i>
                      </a>                      
                    </td>
                  <?php }?>                  
                </tr>                
                <?php
                }
              }
                ?>
              </tbody>
            </table>
            
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
<!--funcion para borrar -->
<script type="text/javascript">
function edit_id(id)
{
if(confirm('Seguro quiere editar ?'))
{
window.location.href='EditarPeticion.php?edit_id='+id;
}
}
function delete_id(id)
{
if(confirm('Seguro que desea borrar ?'))
{
window.location.href='../controlador/Peticiones_controlador.php?delete_id='+id;
}
}
</script>
<script>
$(document).ready(function() {
$('#example').DataTable( {
"language": {
"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
}
} );
} );
</script>
</html>