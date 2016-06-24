<?php

require '../modelo/conexion.php';
 session_start();
 $iddepartamento = $_SESSION["iddepartamento"];
?>
  

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Banco de Peticiones</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/semantic.css">
    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../styles/main.min.css">


  
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
</head>
<body>
    <form  role="form" name="form1" class="form-horizontal" method="post"  action="registrarProyectoInstructoria.php" >
  <table id="example" class="ui striped collapsing selectable celled red table" width="100%" >
        <thead>
            <tr class="center aligned">
                <th>Nombre del Proyecto</th>
                 <th>Instituci&oacute;n</th>
                <th>Alumnos Responsables</th>
                <th>Catedr&aacute;tico</th>
                <th>Materia</th>
                <th>N&uacute;mero de Alumnos a Atender</th>
                <th>Inscripci&oacute;n</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $condicion = '1';
          
            $sql_query="SELECT * FROM peticionesinstructoria where requisitodepartamento= '$iddepartamento' and alumnosresponsables >= '$condicion'";
                $resultado=mysql_query($sql_query,$conn) or die("Error: ".mysql_error());
            while($row=mysql_fetch_row($resultado))
            {
          ?>
            
          <tr class="center aligned">
              
              <td><?php echo $row[1]; ?> <input  name="nombreinstructoria" class="form-control" type="hidden" value="<?php echo $row[1];?>" > </td> 
            <td><?php echo $row[2]; ?> <input  name="institucion" class="form-control" type="hidden" value="<?php echo $row[2];?>" > </td>
            <td><?php echo $row[10]; ?> <input  name="alumnosresponsables" class="form-control" type="hidden" value="<?php echo $row[10];?>" > </td>
            <td><?php echo $row[5]; ?> <input  name="catedratico" class="form-control" type="hidden" value="<?php echo $row[5];?>" > </td> 
            <td><?php echo $row[9]; ?> <input  name="materia" class="form-control" type="hidden" value="<?php echo $row[9];?>" > </td>  
            <td><?php echo $row[3]; ?> <input  name="numerodealumnosatender" class="form-control" type="hidden" value="<?php echo $row[3];?>" ></td>  
            <td><?php 
                  echo " <button class='btn btn-primary ' name='cargar' id='saveForm' type='submit'>Inscribir</button>";
            ?>
            <input  name="telfijo" class="form-control" type="hidden" value="<?php echo $row[4];?>" >
                <input  name="tipoproyecto" class="form-control" type="hidden" value="<?php echo $row[7];?>" >
                <input  name="idpeticionesinstructoria" class="form-control" type="hidden" value="<?php echo $row[0];?>" >
                  <input  name="direccioninstitucion" class="form-control" type="hidden" value="<?php echo $row[11];?>" >
            </td>
         
       
          </tr>
           
        <?php
          }
        ?>
        </tbody>

    </table>
        
     </form>
</body>
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",

        }
    } );
} );

  $.extend( true, $.fn.dataTable.defaults, {
      "paging": false,
      "info": false,
} );


</script>

<script>
/*$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
*/
</script>
</html>

 

