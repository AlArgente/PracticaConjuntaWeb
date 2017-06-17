<<?php
require "db.php";
require "html.php";
HTMLinicio();
HTMLcabecera();
HTMLnavbody();
$db = DB_conexion();
if($db){
  DB_miembros($db);
}
HTMLmiembros();
HTMLcierrebdoy();
HTMLfooter();
HTMLfin();
?>
