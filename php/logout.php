<?php
    $_SESSION["tipouser"] = "invi";
    unset($_SESSION['nombre']);
    unset($_SESSION['tipouser']);
    session_destroy();
    header("Location: index.php");
?>
