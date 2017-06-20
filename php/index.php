<?php
session_start();/*
if (!isset($_SESSION["tipouser"])) {
  $_SESSION['tipouser']="admin";
  $_SESSION['nombre'] = "Alberto";
}*/
// echo '</br></br></br></br></br>';
/*echo $_SESSION['tipouser'];*/
// Añadimos las dependencias del fichero.
require "html.php";
require_once('credenciales.php');
require "db.php";
// Inicia el código HTML
include "head.html";
include "cabecera.html";

HTMLlogin();

/**Conexión a la BD**/
$db = DB_conexion();
$conn = new mysqli(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
if(!$db){
  echo 'No conexión';
}

// DB_dropDB($db);DB_createDB($db);

// Iniciamos las sesiones.
// session_start();
// Creamos las variables que utilizaremos después.
// Variables para usuario y contraseña:
// Variable de session.
if (!isset($_SESSION["tipouser"])) {
  $_SESSION['tipouser']="admin";
  $_SESSION['nombre'] = "Alberto";
}
/************************************************************************/
// Para saber cuál estamos clickando en el menú de navegación.
if (!isset($_GET["p"]))
  $_GET['p']=0;
else if ($_GET["p"]<0 || $_GET["p"]>11)
  $_GET['p']=0;

if ($_SESSION["tipouser"]=="admin") {
  HTMLnav($_GET['p']);
  /**Body_Right, el único que cambia**/
  // en caso de ser admin mostramos todo el menú de navegación
  switch ($_GET['p']) {
    case 0: include "principal.html"; break;
    case 1:DB_miembros($db);break;
    case 2:DB_publicacions($db);break;
    case 3:DB_proyectos($db);break;
    case 4:DB_addquitpublis($db);break;
    case 5:DB_addquitproyectos($db);break;
    case 6:DB_editmembers($db);break;
    case 7:HTMLlog($db);break;
    case 8:DB_backup($db);break;
    case 9:DB_restaurar($db);break;
    case 10:HTMLpdf();break;
  }
  // Si somos miembros solo mostramos una parte del menú de navegación
}else if ($_SESSION["tipouser"]=="miembro") {
    HTMLnav($_GET['p']);
  switch ($_GET['p']) {
    case 0:include "principal.html";break;
    case 1:DB_miembros($db);break;
    case 2:DB_publicacions($db);break;
    case 3:DB_proyectos($db);break;
    case 4:DB_addquitpublis($db);break;
    case 5:DB_addquitproyectos($db);break;
    case 6:HTMLpdf();break;
  }
  // Si somos inivitados solo mostramos lo mńimo del menú de navegación.
}else if ($_SESSION["tipouser"]=="invi") {
    HTMLnav($_GET['p']);
  switch ($_GET['p']) {
    case 0:include "principal.html";break;
    case 1:DB_miembros($db);break;
    case 2:DB_publicacions($db);break;
    case 3:DB_proyectos($db);break;
    case 4:HTMLpdf();break;
  }
}
/************************************************************************/
// Cierre del código HTML
include "cierrebody.html";
include "footer.html";
include "fin.html";
// DB_desconexion($db);
?>
