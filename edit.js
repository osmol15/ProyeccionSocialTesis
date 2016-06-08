
function edt_id(id)
{
 if(confirm('Seguro quiere editar ?'))
 {
  window.location.href='EditarNoticias.php?edit_id='+id;
 }
}
function delete_id(id)
{
 if(confirm('Seguro que desea borrar ?'))
 {
  window.location.href='listarNoticia.php?delete_id='+id;
 }
}
