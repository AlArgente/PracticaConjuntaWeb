<?php
session_start();
require "html.php";
require_once('credenciales.php');
require "db.php";

include "head.html";
include "cabecera.html";
HTMLlogin();


HTMLnav(6);
echo '<div class="body_right"><div class="cont_miembros_left">';



if (isset($_POST["Eliminar"])){
  $db  = DB_conexion();

  if(!$db){
    echo 'No conexión';
  }
  // Se realiza la query para eliminar miembro que tenga el id del miembro
  // seleccionado.
  $query = "DELETE FROM `Miembros` WHERE `Miembros`.`idMiembro`='".$_POST["Eliminar"]."'";
  $res = mysqli_query($db,$query);
  if ($res) {
    echo 'Usuario Eliminado';
  }
  else {
    echo mysqli_errno($db);
    echo mysqli_error($db);
  }
  DB_desconexion($db);
}
else {
  echo "NO EXISTO PARGUELAS";
}


echo '</div></div>';
include "cierrebody.html";
include "footer.html";
include "fin.html";
?>
