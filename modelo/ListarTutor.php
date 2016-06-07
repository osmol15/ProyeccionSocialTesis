<?php 
    session_start();
    $verifica = $_SESSION["verifica"]; 

    if($_SESSION["verifica"]!="2"){
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
    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM estudiante WHERE carnet=".$_GET['delete_id'];
        mysql_query($sql_query);
        header("Location: $_SERVER[PHP_SELF]");

         echo "<header>";
         echo "<script language='javascript'>"; 
         echo "alert(':) Estudiante Borrado Exitosamente.')"; 
         echo "</script>";  
         echo "</header>";                     
        exit();
    }
    //borra el estudiante de la tabla estudiante
    else
    {
	   echo mysql_error();
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
          <li class="active">Lista de Tutores</li>
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
                  <h3 class="box-title">Lista de tutores</h3>
                </div>
                <div class="box-body">                    

                    <table id="tablaTutor" class="table table-bordered table-hover">
                        <thead>
                            <tr class="center aligned">
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Telefono</th>                     
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_query="SELECT * FROM usuario WHERE idtipousuario = 3";
                                $result_set=mysql_query($sql_query);
                                while($row=mysql_fetch_row($result_set))
                                {
                            ?>
                            <tr class="center aligned">
                                <td><?php echo $row[1]; ?></td><?php $order_id=$row[0]; ?> 
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[6]; ?></td>
                                <td><?php echo $row[5]; ?></td>                                
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                </table>
            </div>
                <!-- /.box -->
        </div>
    </div>
          <!-- /.col -->
    </div>
    </section>
    <!--Fin Contenido-->
    <script>
        $("#tablaTutor").DataTable({
            "language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar Tutor:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
        });
    </script>
</html>