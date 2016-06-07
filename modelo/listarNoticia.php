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
    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM noticias WHERE idnoticias=".$_GET['delete_id'];
        mysql_query($sql_query);
        header("Location: $_SERVER[PHP_SELF]");
        echo "<header>";
        echo "<script language='javascript'>"; 
        echo "alert(':) Noticia Borrada Exitosamente.')"; 
        echo "</script>";  
        echo "</header>";         
        exit();
    }
    //borra la noticia en la tabla noticias
    else
    {
	   echo mysql_error();
    }
?>
<div class="row">
<div class="col-xs-12">
      <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i>Noticias</a></li>
        <li class="active">Listar</li>
      </ol>
    </section>
</div>    
</div>

<br><br>
<div class="row">
    <div class="col-xs-12">
        <?php
            $sql_query="SELECT * FROM noticias";
            $result_set=mysql_query($sql_query);
            while($row=mysql_fetch_row($result_set))
            {
        ?>             
            <div class="col-md-12">
                <div class="box box-success box-solid collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $row[0]; ?>. <?php echo $row[1]; ?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Editar">
                                <i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Eliminar">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                <div class="box-body">
                    <?php echo $row[2]; ?>
                </div>
                <div class="box-footer">
                    <small class="pull-right">Compartida  <?php echo $row[3]; ?></small>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div> 
        <?php
            }
        ?>
</div>
</div>
