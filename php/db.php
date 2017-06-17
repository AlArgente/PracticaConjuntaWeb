<<?php
require_once('credenciales.php');
/***Conexión a la BBDD***/
function DB_conexion(){
  $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
  if (!$db) {
    echo "<p>Error de conexión.</p>";
    echo "<p>Codigo: " .mysqli_connect_errno(). "</p>";
    echo "<p>Mensaje: " .mysqli_connect_errno(). "</p>";
    return false;
  }
  mysqli_set_charset($db,"utf8");
  return $db;
}
/***Cierre de la BBDD***/
function DB_desconexion($db){
  mysqli_close($db);
}


function DB_miembros($db){
  $res = mysqli_query($db, "SELECT * from Miembro;");
  if($res){
    if(mysqli_num_rows($res)>0){
      $tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
      $n = mysqli_num_fields($res);
      echo "$n";
      print_r($tabla);
    }else {
      $tabla = [];
    }
    mysqli_free_result($res);
  } else{
    $tabla = false;
  }
  /*echo "$tabla[]";*/
  return $tabla;
}
?>
