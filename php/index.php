<?php
require_once"html.php";
require_once('credenciales.php');
require_once "db.php";
include_once "head.html";
include_once "cabecera.html";
HTMLlogin();
if (!isset($_SESSION["tipouser"])) {
  $_SESSION["tipouser"]="miembro";
}
/**Conexión a la BD**/
$db = DB_conexion();
$conn = new mysqli(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
if(!$db){
  echo 'No conexión';
}
// Iniciamos las sesiones.
// session_start();
// Creamos las variables que utilizaremos después.
// Variables para usuario y contraseña:
// Variable de session.
/*
if(isset($_POST['tipouser'])){
    $_SESSION['tipouser'] = $_POST['tipouser'];
}*/

if (!isset($_GET["p"]))
  $_GET['p']=0;
else if ($_GET["p"]<0 || $_GET["p"]>11)
  $_GET['p']=0;

if ($_SESSION["tipouser"]=="admin") {
  HTMLnav($_GET['p']);
  /**Body_Right, el único que cambia**/
  switch ($_GET['p']) {
    case 0:HTMLindex();break;
    case 1:DB_miembros($db);break;
    case 2:HTMLpublicaciones();break;
    case 3:DB_proyectos($db);break;
    case 4:HTMLaddquitpublis();break;
    case 5:DB_addquitproyectos($db);break;
    case 6:DB_editmembers($db);break;
    case 7:HTMLlog();break;
    case 8:HTMLdobackup();break;
    case 9:HTMLbackup();break;
    case 10:HTMLpdf();break;
  }
}else if ($_SESSION["tipouser"]=="miembro") {
    HTMLnav($_GET['p']);
  switch ($_GET['p']) {
    case 0:HTMLindex();break;
    case 1:DB_miembros($db);break;
    case 2:HTMLpublicaciones();break;
    case 3:DB_proyectos($db);break;
    case 4:HTMLaddquitpublis();break;
    case 5:DB_addquitproyectos($db);break;
    case 6:HTMLpdf();break;
  }
}else if ($_SESSION["tipouser"]=="invi"){
    HTMLnav($_GET['p']);
  switch ($_GET['p']) {
    case 0:HTMLindex();break;
    case 1:DB_miembros($db);break;
    case 2:HTMLpublicaciones();break;
    case 3:DB_proyectos($db);break;
    case 4:HTMLpdf();break;
  }
}


include "cierrebody.html";
include "footer.html";
include "fin.html";
DB_desconexion($db);
?>
