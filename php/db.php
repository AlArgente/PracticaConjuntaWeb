<?php
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

function DB_query($db, $query){

  //Mandamos consulta a la BD
  $res = mysqli_query($db,$query);
  //Si no ha habido errores
  if($res){
    //Miramos si hay un resultado
    if(mysqli_num_rows($res)>0){

      //Guardamos el resultado
      $tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
    }else {
      echo "Error: Tabla vacía";
      $tabla = [];
      echo mysqli_errno($db);
      echo mysqli_error($db);
    }
    //Liberamos memoria del query
    mysqli_free_result($res);

  } else{
    echo "Error: Tabla = false";
    $tabla = false;
  }
  return $tabla;
}
/************************************************************************/
/*
Esta función nos permite realizar una query para consultar los miembros
que se encuentran almacenados en la base de datos.
*/
function DB_miembros($db){
  $query = "SELECT Nombre, Apellidos, Categoria, Direccion from Miembros;";
  $res = DB_query($db,$query);
  HTMLmiembros($res);
}
/************************************************************************/
/*
Esta función nos permite realizar una query para consultar los proyectos
que se encuentran almacenados en la base de datos.
*/
function DB_proyectos($db){
  $query = "SELECT p.Codigo, p.Titulo as proyecto, p.Descripcion, pu.Titulo as publicacion FROM Proyectos p, PrTienePl pp, Publicaciones pu WHERE (p.Codigo=pp.FK_Codigo) AND (pp.FK_DOI=pu.DOI);";
  //$query = "SELECT p.Codigo, p.Titulo, p.Descripcion FROM Proyecto p, PrContienePl pp, Publicacion pu WHERE (p.Codigo=pp.Codigo) AND (pp.DOI=pu.DOI);";
  $res = DB_query($db,$query);
  HTMLproyectos($res);
}
/************************************************************************/
/*
Esta función al igual que la de proyectos, nos permite saber los Miembrosque
tenemos almacenados, pero en este caso abre el HTML que nos permite editar,
añdir y modificar los proyectos.
*/
function DB_addquitproyectos($db){
  $query = "SELECT p.Codigo, p.Titulo, p.Descripcion FROM Proyectos p, PrTienePl pp, Publicaciones pu WHERE (p.Codigo=pp.FK_Codigo) AND (pp.FK_DOI=pu.DOI);";
  $res = DB_query($db,$query);
  HTMLaddquitproy($res);
}
/************************************************************************/
/*
Estafunción realiza una query sobre la BD para encontras los miembros que tenemos,
pero esta vez se llama a la función HTML que nos permite editar miembros.
*/

function DB_editmembers($db){
  $query = "SELECT Nombre, Apellidos, Categoria, Direccion, idMiembro from Miembros;";
  $res = DB_query($db,$query);
  HTMLeditmembers($res);
}
/************************************************************************/
/*
No ha sido implementada
*/
function DB_addquitpublis($db){
  $query = "SELECT Nombre, Apellidos, Categoria, Direccion from Miembros;";
  $res = DB_query($db,$query);
  HTMLaddquitpublis($res);
}
/************************************************************************/
/*
No ha sido implementada
*/
function DB_publicacions($db){
  $query = "SELECT Nombre, Apellidos, Categoria, Direccion from Miembros;";
  $res = DB_query($db,$query);
  HTMLpublicaciones($res);
}


function DB_createDB($db){

  //Miembro
  $t_Miembros = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`Miembros` (
                `idMiembro` varchar(20) NOT NULL PRIMARY KEY,
                `Nombre` varchar(45) NOT NULL,
                `Apellidos` varchar(45) NOT NULL,
                `Categoria` varchar(45) NOT NULL,
                `TipoUsuario` varchar(10) NOT NULL,
                `ClaveAcceso` varchar(20) NOT NULL,
                `Telefono` int(10) NOT NULL,
                `URL` varchar(30) NOT NULL,
                `Email` varchar (30) NOT NULL,
                `Departamento` varchar(10) NOT NULL,
                `Centro` varchar(10) NOT NULL,
                `Universidad` varchar(30) NOT NULL,
                `Direccion` varchar(40) NOT NULL,
                `Fotografia` longblob
                )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Miembros);

  //Proyectos
  $t_Proyectos = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`Proyectos` (
                `Codigo` int NOT NULL PRIMARY KEY,
                `Titulo` varchar(30) NOT NULL,
                `Descripcion` varchar(100) NOT NULL,
                `FechaComienzo` date NOT NULL,
                `FechaFin` date NOT NULL,
                `EntidadesColaborativas` varchar(100),
                `CuantiaConcedida` int NOT NULL,
                `InvestigadorPrincipal` varchar(30) NOT NULL,
                `InvestigadoresColaboradores` varchar(100) NOT NULL)
                ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Proyectos);

  //Publicacion
  $t_Publicaciones = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`Publicaciones` (
                `DOI` int NOT NULL PRIMARY KEY,
                `FK_Codigo` int NOT NULL,
                `Titulo` varchar(45) NOT NULL,
                `Autores` varchar(45) NOT NULL,
                `Fecha` date NOT NULL,
                `Resumen` varchar(100) NOT NULL,
                `PalabrasClave` varchar(100) NOT NULL,
                `URL` varchar(40) NOT NULL,
                CONSTRAINT `FK_Publicacion_Codigo` FOREIGN KEY (`FK_Codigo`)
                REFERENCES `Proyectos`(`Codigo`)
                )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Publicaciones);

  //ProyectoTienePublicaciones
  $t_PrTienePl = "CREATE TABLE IF NOT EXISTS  `albertojesus1617`.`PrTienePl` (
                `FK_DOI` int NOT NULL,
                `FK_Codigo` int NOT NULL,
                CONSTRAINT `FK_Tiene_DOI` FOREIGN KEY (`FK_DOI`)
                REFERENCES `Publicaciones`(`DOI`),
                CONSTRAINT `FK_Tiene_Codigo` FOREIGN KEY (`FK_Codigo`)
                REFERENCES `Proyectos`(`Codigo`)
                )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

   DB_createTable($db,$t_PrTienePl);

  //MRealizaPr (miembro realiza proyectos)
  $t_MRealizaPr= "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`MRealizaPr` (
                `FK_idMiembro` varchar(20) NOT NULL,
                `FK_Codigo` int NOT NULL,
                CONSTRAINT `FK_Realiza_idMiembro` FOREIGN KEY (`FK_idMiembro`)
                REFERENCES `Miembros`(`idMiembro`),
                CONSTRAINT `FK_Realiza_Codigo` FOREIGN KEY (`FK_Codigo`)
                REFERENCES `Proyectos`(`Codigo`)
                )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";


   DB_createTable($db,$t_MRealizaPr);

  //TIPOS DE PUBLICACIONES

  //ARTICULOS
  $t_Articulos = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`PrTienePl` (
                `NombreRevista` varchar(30) NOT NULL PRIMARY KEY,
                `FK_DOI` int NOT NULL,
                `Volumen` int(3) NOT NULL,
                `Paginas` int(3) NOT NULL,
                CONSTRAINT `FK_Articulos_DOI` FOREIGN KEY (`FK_DOI`)
                REFERENCES `Publicaciones`(`DOI`)
                )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Articulos);

  //CAPITULOS LIBRO
  $t_Capitulos = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`CapitulosLibros` (
                  `ISBN` varchar(10) NOT NULL PRIMARY KEY,
                  `FK_DOI` int NOT NULL,
                  `TituloLibro` varchar(40) NOT NULL,
                  `Editorial` varchar(30) NOT NULL,
                  `Editor` varchar(30) NOT NULL,
                  `PaginasCapitulo` int NOT NULL,
                  CONSTRAINT `FK_Capitulos_DOI` FOREIGN KEY (`FK_DOI`)
                  REFERENCES `Publicaciones`(`DOI`)
                  ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Capitulos);

  //LIBRO
  $t_Libro = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`Libros` (
                  `ISBN` varchar(10) NOT NULL PRIMARY KEY,
                  `FK_DOI` int NOT NULL,
                  `TituloLibro` varchar(40) NOT NULL,
                  `Editorial` varchar(30) NOT NULL,
                  `Editor` varchar(30) NOT NULL,
                  CONSTRAINT `FK_Libro_DOI` FOREIGN KEY (`FK_DOI`)
                  REFERENCES `Publicaciones`(`DOI`)
                  ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Libro);

  //CONFERENCIA
  $t_Conferencia = "CREATE TABLE IF NOT EXISTS `albertojesus1617`.`Conferencias` (
                  `Nombre` varchar(30) NOT NULL PRIMARY KEY,
                  `FK_DOI` int NOT NULL,
                  `Lugar` varchar(40) NOT NULL,
                  `ReseñaPublicacion` varchar(100) NOT NULL,
                   CONSTRAINT `FK_Conferenca_DOI` FOREIGN KEY (`FK_DOI`)
                   REFERENCES `Publicaciones`(`DOI`)
                   ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;";

  DB_createTable($db,$t_Conferencia);

}
function DB_dropDB($db){

  //Dependientes de Publicaciones
  DB_dropTable($db,"Conferencias");
  DB_dropTable($db,"Libros");
  DB_dropTable($db,"CapitulosLibros");
  DB_dropTable($db,"Articulos");

  //Dependientes de Miembros, Publicaciones y Proyectos
  DB_dropTable($db,"PrTienePl");
  DB_dropTable($db,"MRealizaPr");


  //Finalmente Miembros, Proyectos y Publicaciones
  DB_dropTable($db,"Publicaciones");
  DB_dropTable($db,"Proyectos");
  DB_dropTable($db,"Miembros");

}
/******************************************************************************/
/*
  Función que permite borrar una tabla por su nombre.
*/

function DB_dropTable($db,$name){
  //Sentencia SQL
  $sql="DROP TABLE IF EXISTS $name;";

  //Enviamos una query con la sentencia
  if($db->query($sql) === TRUE){
    echo "Tabla $name eliminada correctamente.";
    echo "<br><br>";
  }
  else{
    echo "Error al borrar la tabla $name :".$db->error;
    echo "<br><br>";
  }
}
/******************************************************************************/
/*
  Función que permite mandar un Query para crear una tabla.
*/
function DB_createTable($db,$sql){

  // Create connection
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWD,DB_DATABASE);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($conn->query($sql) === TRUE) {
    echo "Tabla creada con éxito.";
    echo "<br><br>";

  } else {
    echo "Error al crear la tabla: ".$conn->error."<br><br>";

    echo "Sentencial SQL: ".$sql;
    echo "<br><br>";
  }
}
/******************************************************************************/
/*
  Función para insertar tuplas en una tabla.
*/
function DB_insertT($db,$name,$data){

  //Hacemos una query para extraer los campos que tiene la tupla
  $sql = "SHOW COLUMNS FROM $name";
  $res = DB_query($db,$sql);

  //Extraemos el número de valores que tiene la query para ver si coincide
  //con el número de campos.
  $data_array=(explode(",",$data));

  if(sizeof($res)!=sizeof($data_array)){

    echo "Error: el número de valores no es igual al número de columnas.";
    echo "<br><br>";

  }
  else {

    //Cogemos los nombres de los campos
    $fields= [];
    foreach($res as $i){

      $fields[]= $i["Field"];
    }

  }

  /*
    INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
    VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway');
  */

  //Formato para la query de insert (Datos con ' y columnas con `).
  $data = implode("','",$data_array);
  $data = "'".$data."'";
  $string_f = implode("`,`",$fields);
  $string_f = "`".$string_f."`";
  $name = "`".$name."`";

  $q = " INSERT INTO $name ($string_f) VALUES ($data);";

  if ($db->query($q) === TRUE) {
    echo "Tupla insertada correctamente";
  } else {

    echo "Campos de la tabla:<br><br>";
    print_r($fields); echo "<br><br>";

    echo "Datos para la inserción: $data"; echo "<br><br>";
    echo "Query enviada: $q";
  }
}
/***************************************************************************/
/*
Esta función va a borrar una tabla de la base de datos
*/
function DB_deleteT($db,$id){

  $sql =" DELETE FROM ";

}

/***************************************************************************/
/*
Esta función va a realizar una copia de seguridad de la base de datos (backup)
sobre el fichero "backup.sql"
*/
function DB_backup($db){
 // Obtener listado de tablas
 $tablas = array();
 $result = mysqli_query($db,'SHOW TABLES');
 while ($row = mysqli_fetch_row($result))
  $tablas[] = $row[0];

 // Salvar cada tabla
 $salida = '';
 foreach ($tablas as $tab) {
  $result = mysqli_query($db,'SELECT * FROM '.$tab);
  $num = mysqli_num_fields($result);
  $salida .= 'DROP TABLE '.$tab.';';
  $row2 = mysqli_fetch_row(mysqli_query($db,'SHOW CREATE TABLE '.$tab));
  $salida .= "\n\n".$row2[1].";\n\n"; // row2[0]=nombre de tabla
  while ($row = mysqli_fetch_row($result)) {
   $salida .= 'INSERT INTO '.$tab.' VALUES(';
   for ($j=0; $j<$num; $j++) {
    $row[$j] = addslashes($row[$j]);
    $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
    if (isset($row[$j]))
     if($row[$j]!=""){
      $salida .= '"'.$row[$j].'"';
     }else{
      $salida .= 'NULL';
     }
    else
     $salida .= '""';
    if ($j < ($num-1))
     $salida .= ',';
   }
   $salida .= ");\n";
  }
  $salida .= "\n\n\n";
 }

  $f = fopen("backup.sql","w");
  if ($f){
    fwrite($f,$salida);
    fclose($f);
    echo 'Se ha guardado la base de datos';
  }
  else {
    echo 'No se ha podido abrir el archivo y realizar la copia de seguridad';
  }
}


/***************************************************************************/
/*
Esta función se va a encargar de restaurarla base de datos a partir del fichero
de backup "backup.sql"
*/
function DB_restaurar($db) {
  $f = "backup.sql";
  if (file_exists($f)) {
    mysqli_query($db, 'SET FOREING_KEY_CHECKS=0');
    $error = '';
    $sql = file_get_contents($f);
    $queries = explode(';',$sql);
    foreach ($queries as $q) {
      if (!mysqli_query($db,$q))
        $error .= mysqli_error($db);
    }
    mysqli_query($db, 'SET FOREING_KEY_CHECKS=1');
  }
  else {
    echo 'No se ha podido restaurar la BD';
  }
}

?>
