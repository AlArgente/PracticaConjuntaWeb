<<?php
require "html.php";
require "db.php";
HTMLinicio();
HTMLcabecera();
/**Conexión a la BD**/
$db = DB_conexion();
if(!$db){
  echo 'No conexión';
}
if (!isset($_GET["p"]))
  $_GET['p']=0;
else if ($_GET["p"]<0 || $_GET["p"]>11)
  $_GET['p']=0;
HTMLnav($_GET['p']);
/**Body_Right, el único que cambia**/
switch ($_GET['p']) {
  case 0:HTMLindex();break;
  case 1:HTMLmiembros();break;
  case 2:HTMLpublicaciones();break;
  case 3:HTMLproyectos();break;
  case 4:HTMLaddquitpublis();break;
  case 5:HTMLaddquitproy();break;
  case 6:HTMLeditmembers();break;
  case 7:HTMLlog();break;
  case 8:HTMLdobackup();break;
  case 9:HTMLbackup();break;
  case 10:HTMLpdf();break;
}
HTMLcierrebdoy();
HTMLfooter();
HTMLfin();
?>
