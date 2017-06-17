<<?php
require "html.php";
HTMLinicio();
HTMLcabecera();
HTMLnavbody();
/**Conexión a la BD**/
$db = DB_conexion();
if(!db){
  echo 'No conexión';
}
/**Body_Right, el único que cambia**/
HTMLindex();
HTMLcierrebdoy();
HTMLfooter();
HTMLfin();
?>
