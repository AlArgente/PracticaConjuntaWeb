<?php
require "credenciales.php";
require "db.php";

if (isset($_POST["enviar"])) {
  $user = $_POST["uname"];
  $pass = $_POST["psw"];

  // Ahora realizamos la consulta a la BD para comprobar la conexión.

  $query = "SELECT idUsuario as id, Nombre as name, ClaveAcceso as password, tipouser as type FROM Miembro WHERE idUsuario=$user and ClaveAcceso=$pass";
  $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
  $res = mysqli_query($db, $query);

  if ($res) {
    if (mysqli_num_rows($res)>0) {
      while ($row = mysqli_fetch_all($res,MYSQLI_ASSOC)) {
        $userok = $row['id'];
        $passok = $row['password'];
        $tipouser = $row['type'];
        $nombre = $row['name'];
      }
    }else {
      echo "Error: Tabla vacía";
      $tabla = [];
    }

    if (isset($user) && isset($password)) {
      if ($user==$userok && $password==$passok) {
        session_start();
        $_SESSION['tipouser'] = $tipouser;
        $_SESSION['nombre'] = $nombre;
      }
    }

    header("Location: index.php");
  }
  header("Location: index.php");
}
else{
  header("Location: index.php");
}

?>
