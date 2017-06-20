<?php
require "credenciales.php";
require "db.php";

// Si se ha relizado el formulario correctamente.
if (isset($_POST["enviar"])) {
  $user = $_POST["uname"];
  $pass = $_POST["psw"];

  // Ahora realizamos la consulta a la BD para comprobar la conexión.
  $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
  $query = "SELECT idMiembro as id, Nombre as name, ClaveAcceso as password, TipoUsuario as type FROM Miembros WHERE idMiembro='$user' and ClaveAcceso='$pass'";
  $res = mysqli_query($db,$query);
  // Si la consulta ha sido realizada con éxito
  if ($res){
    // Comprobamos que contenga 1 resultado.
    if(mysqli_num_rows($res)==1) {
      $tupla = mysqli_fetch_array($res);
      // Comprobamos que coincide con el usuario
	  if ($user==$tupla["id"] && $pass==$tupla["password"]) {
        // Actualizamos las variables de sesión
        $_SESSION['nombre'] = $tupla["name"];
        $_SESSION['tipouser'] = "admin";
        // echo $_SESSION["tipouser"];
        // echo $_SESSION["nombre"];
        // Redireccionamos a index.php
        header("Location: index.php");
      }
    }

    // header("Location: index.php");
  }else{
    // Si no se ha relizado correctamente la query mostramos los errores
    echo mysqli_errno($db);
    echo mysqli_error($db);
  }
  // header("Location: index.php");
}
?>
