<?php
session_start();
require "html.php";
require_once('credenciales.php');
require "db.php";

include "head.html";
include "cabecera.html";
HTMLlogin();


HTMLnav(6);
  /**Body_Right, el único que cambia**/

echo '<div class="body_right">';
?>

<div class="cont_miembros_left">

<?php
// Inicializamos las variables que vamos a utilizar a false
$id=$nombre=$apellidos=$categoria=$typeu=$psdw=$tlf=$url=$email=$departamento=$centro=$universidad=$direc=FALSE;
// Si hemos recibido todos los datos, entonces no mostraremo el menú para la
// inserción de un nuevo miembro, por el contrario si aún no hemos rellenado
// todos los datos entonces no lo mostramos.
if(isset($_POST["ID"])){
  $id=TRUE;
}
if(isset($_POST["Nombre"])){
  $nombre=TRUE;
}
if(isset($_POST["Apellidos"])){
  $apellidos=TRUE;
}
if(isset($_POST["Categoria"])){
  $categoria=TRUE;
}
if(isset($_POST["TipoUsuario"])){
  $typeu=TRUE;
}
if(isset($_POST["ClaveAcceso"])){
  $pswd=TRUE;
}
if(isset($_POST["Telefono"])){
  $tlf=TRUE;
}
if(isset($_POST["URL"])){
  $url=TRUE;
}
if(isset($_POST["Email"])){
  $email=TRUE;
}
if(isset($_POST["Departamento"])){
  $departamento=TRUE;
}
if(isset($_POST["Centro"])){
  $centro=TRUE;
}
if(isset($_POST["Universidad"])){
  $universidad=TRUE;
}
if(isset($_POST["Direccion"])){
  $direc=TRUE;
}

// Se comprueba que se han rellenado todos los datos
if ($id && $nombre && $apellidos && $categoria && $typeu && $pswd && $tlf && $url && $email && $departamento && $centro && $universidad && $direc){
  $db  = DB_conexion();

  if(!$db){
    echo 'No conexión';
  }
  // Se realiza la query
  $query = "INSERT INTO `Miembros`(`idMiembro`,`Nombre`,`Apellidos`,`Categoria`,`TipoUsuario`,`ClaveAcceso`,`Telefono`,`URL`,`Email`,`Departamento`,`Centro`,`Universidad`,`Direccion`,`Fotografia`)
  VALUES ('".$_POST["ID"]."','".$_POST["Nombre"]."','".$_POST["Apellidos"]."','".$_POST["Categoria"]."','".$_POST["TipoUsuario"]."','".$_POST["ClaveAcceso"]."','".$_POST["Telefono"]."','"
  .$_POST["URL"]."','".$_POST["Email"]."','".$_POST["Departamento"]."','".$_POST["Centro"]."','".$_POST["Universidad"]."','".$_POST["Direccion"]."',NULL);";

  $res = mysqli_query($db,$query);

  if ($res) {
    echo 'Usuario insertado';
  }
  else {
    echo 'Dedicate a las cartas';
    echo $query;
    print_r($res);
    echo sizeof($res);
    echo mysqli_errno($db);
    echo mysqli_error($db);
  }
  DB_desconexion($db);
}else {
  // En caso de que no hayan rellenado los datos mostramos el formulario
  echo '<form action="addmember.php", method="post">;
      <label>idUsuario</label>
      <input type="text" name="ID" id="ID"></br>
      <label>Nombre</label>
      <input type="text" name="Nombre"></br>
      <label>Apellidos</label>
      <input type="text" name="Apellidos"></br>
      <label>Categoria</label>
      <input type="text" name="Categoria"></br>
      <label>TipoUsuario</label>
      <input type="text" name="TipoUsuario"></br>
      <label>ClaveAcceso</label>
      <input type="password" name="ClaveAcceso"></br>
      <label>Telefono</label>
      <input type="text" name="Telefono"></br>
      <label>URL</label>
      <input type="text" name="URL"></br>
      <label>Email</label>
      <input type="text" name="Email"></br>
      <label>Departamento</label>
      <input type="text" name="Departamento"></br>
      <label>Centro</label>
      <input type="text" name="Centro"></br>
      <label>Universidad</label>
      <input type="text" name="Universidad"></br>
      <label>Direccion</label>
      <input type="text" name="Direccion"></br>
      <button type="submit" name="adduser">Añadir</button>
  </form>';
}




?>
</div></div>
<?php
include "cierrebody.html";
include "footer.html";
include "fin.html";

?>
