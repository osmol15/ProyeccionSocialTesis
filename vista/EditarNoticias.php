<?php 
if (session_start()) {
  if($_SESSION["idtipousuario"]=="3" || $_SESSION["idtipousuario"]=="4"){
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
 require '../modelo/Noticias_modelo.php'; 
 if(isset($_GET['edit_id'])) {
  $noti = new Noticias();
  $noticia = $noti->getNoticia($_GET['edit_id']);
 }
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--ESTE ARCHIVO NO EXISTE-->
<link rel="stylesheet" href="../styles/style.css" type="text/css" /> 

<link rel="stylesheet" href="../styles/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/main.min.css">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>
</head>
<ol class="breadcrumb breadcrumb-small">
      <li>Noticias</li>
      <li class="active"><a>Editar noticia</a></li>
    </ol>
<body id="app" class="app off-canvas">
  <div class="page-wrap">
      <!-- row -->
      <div class="row">           
                <div class="col-sm-12 col-md-6">
          <div class="panel panel-default panel-hovered panel-stacked mb30">
            <div class="panel-heading">Editar Noticia</div>
                        <div class="panel-body" style="padding-right: 30%;">
    
                           <form role="form" name="form1" class="form-horizontal" method="post" action="../controlador/Noticias_controlador.php" > <!-- form horizontal acts as a row -->  
                                      <div class="form-group">
                                          <label class="col-md-3 control-label" style="margin-top: 10px">T&iacute;tulo:</label>
                                             <div class="col-md-9">
                                                  <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $noticia['titulo']; ?>" required  >    
                                             </div>
                                      </div> 
                                      <div class="form-group">
                                            <label class="col-md-3 control-label" style="margin-top: 10px">Detalle:</label>
                                            <div class="col-md-9">
                                                <textarea id="detalle" name="detalle" class="form-control" rows="5" cols="30" maxlenght="200" required  > <?php echo $noticia['detalle']; ?></textarea>
                                                <input type="hidden" name="idnoticia" value="<?php echo $_GET['edit_id'];?>">
                                            </div>
                                      </div> 
                                       
                                      
                                     
                                                                    
                                                                                    
                                                                                <br><br><br><br><br>
                                                                                
                    <div class="clearfix right">
                      <button class="btn btn-primary mr5" name="actualizar" name="submit" id="saveForm" type="submit">Actualizar</button>
                      <button class="btn btn-default" name="btn-cancel">Cancelar</button>
                    </div>
                  </form>
            </div> <!-- #end panel body -->
                                                
        </div> <!-- #end panel -->
              </div><!-------------->
        </div><!-- row -->
                                
                             </div>
                             <!--
<center>

<div id="body">
 <div id="content">
    <form method="post">
    <table align="center">
    <tr>
    <td><label class="col-md-3 control-label">T&iacute;tulo:</label><input type="text" name="titulo" placeholder="Titulo" value="<?php echo $fetched_row['titulo']; ?>" required /></td>
    </tr>
    <tr>
    <td><label class="col-md-3 control-label">Detalle:</label><input type="text" name="detalle" placeholder="detalle" value="<?php echo $fetched_row['detalle']; ?>" required /></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="btn-update"><strong>Actualizar</strong></button>
    <button type="submit" name="btn-cancel"><strong>Cancelar</strong></button>
    </td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center> -->
</body>
</html> 
