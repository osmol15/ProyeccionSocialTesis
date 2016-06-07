<?php
	require '../db/conexion.php';
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
          <li><a href="#"><i class="fa fa-user"></i>Proyectos</a></li>
          <li class="active">Buscar por</li>
        </ol>
    </section>
  <!--FIN CABECERA -->
  <!--Contenido-->
    <section class="content">
    <div class="row">
          <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-edit"></i>
                  <h3 class="box-title">Lista de proyectos</h3>
                </div>
                <div class="box-body">                    

                    <table id="tablaTutor" class="table table-bordered table-hover">
                        <thead>
                            <tr class="center aligned">
                                <th>ID</th>
                                <th>Carnet</th>
                                <th>Tutor</th>
                                <th>Proyecto</th>
                                <th>Instituci&oacute;n</th>
                                <th>Direcci&oacute;n</th>
                                <th>Num. Horas</th>
                                <th>Coordinador</th>
                                <th>Jefe</th>                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_query="SELECT * FROM proyecto";
                                $result_set=mysql_query($sql_query);
                                while($row=mysql_fetch_row($result_set))
                                {
                            ?>
                            <tr class="center aligned">
                                <td><?php echo $row[0]; ?></td> 
                                <td><?php echo $row[18]; ?></td>
                                <td><?php echo $row[19]; ?></td>
                                <td><?php echo $row[4]; ?></td> 
                                <td><?php echo $row[5]; ?></td>  
                                <td><?php echo $row[6]; ?></td>  
                                <td><?php echo $row[1]; ?></td>
                                <td><?php 
                                  switch ($row[14]) {
                                      case '0':
                                          echo "<i class='ion-close-circled'></i>";
                                          break;
                                      case '1':
                                          echo "<i class='ion-checkmark-circled'></i>";
                                          break;
                                      default:
                                          echo "<i class='ion-close-circled'></i>";
                                          break;
                                    }
                                 ?></td>
                                <td><?php 
                                    switch ($row[15]) {
                                        case '0':
                                            echo "<i class='ion-close-circled'></i>";
                                            break;
                                        case '1':
                                            echo "<i class='ion-checkmark-circled'></i>";
                                            break;
                                        default:
                                            echo "<i class='ion-close-circled'></i>";
                                            break;
                                      }
                                    ?>                                      
                                </td>
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
            "sSearch":         "Buscar:",
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