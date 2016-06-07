<?php 
    session_start();
    $verifica = $_SESSION["verifica"]; 

    if($_SESSION["verifica"]!="1" AND $_SESSION["verifica"]!="2"){
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
    if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q redirige para llenar en la misma pagina
    {
    //Realmente esto de abajo es lo que se necesita para datos de noticia
        $titulo         = $_POST["titulo"];
        $detalle        = $_POST["detalle"];
        $partes         = explode('/', $_POST['fecha']);
        $fechanueva     = "$partes[2]-$partes[1]-$partes[0]";

        if(mysql_num_rows($r) > 0){   
            echo "<header>";
            echo "<script language='javascript'>"; 
            echo "alert('Error: Ya exite un tutor con este nombre, apellido y usuario, por favor ingrese otro. Intentelo de Nuevo')"; 
            echo "</script>";  
            echo "</header>";
            echo "<body>";
            echo "<table ><tr><td>";
            echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='../images/back.png' alt='Atras'/></a>";
            echo "</td></tr><tr><td align=center style='padding-right: 100px; color:white;'>";
            echo "<label >Volver</label></td></tr></table>";
            echo "</a>";
            echo "</body> ";               
            exit();                               
        }
        else{
            $inser = "insert into noticias(titulo, detalle, fecha)values('$titulo','$detalle','$fechanueva')";
            //inserta la noticia en la tabla noticias
            if(mysql_query($inser))
                {
                echo "<header>";
                echo "<script language='javascript'>"; 
                echo "alert(':) Noticia Agregada Exitosamente.')"; 
                echo "</script>";  
                echo "</header>";    
                exit();
            }           
            else{
                echo mysql_error();
            }           
        }   
    }
?>
<html>
    <div class="col-xs-12">
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
            <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-users"></i> Noticias</a></li>
                    <li class="active">Crear</li>
            </ol>
            </section>
    </div>
    <br><br><br>
    <div class="col-xs-12">
          <div class="box box-danger" id="tema">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Noticias</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="form1" method="post" action="modelo/crearNoticia.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Titulo:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="titulo" name="titulo" required="true">
                                </div>
                            </div>
                             <div class="form-group">                                
                                <div class="col-sm-12">
                                    <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="detalle" name="detalle"></textarea>        
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Fecha:</label>
                                <div class="col-sm-10">
                                    <input id="fecha" name="fecha" class="form-control" type="text" value="<?php date_default_timezone_set('America/El_Salvador'); echo date("d"),"/", date("m"),"/", date("Y")?>" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right" name="submit" id="saveForm">Guardar</button>
                        </div>
                      <!-- /.box-footer -->
                </form>
           </div>
    </div>
    <script>
         $(".textarea").wysihtml5();
    </script>
</html>