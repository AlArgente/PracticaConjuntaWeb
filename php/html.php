<?php
/*
Esta función se ha creado para mostrar por pantalla el PDF con la memoria de
la práctica realizada.
*/
function HTMLpdf(){
  echo <<<HTML
  <div class="cont_body">
  <object width='85%' height="600" data="memoria.pdf"></object>
</div>
HTML;
}
/***************************************************************************/
// nav una vez se tengan las sesiones activadas.
/*
Con este nav según el tipo de usuario que esté logueado se mostrarán unos items
u otros.
*/
function HTMLnav($activo){
echo <<< HTML
<div class="cont_body">
    <div class="body_left">
        <!-- NAVAGATION -->
        <nav>
            <div class="cont_lista">
                <ul>
HTML;
if (isset($_SESSION["tipouser"])){
  // Si se está logueado como admin
  if ($_SESSION['tipouser']=="admin"){
    $items = ["Inicio","Miembros","Publicaciones","Proyectos","Añadir/Editar Publicaciones", "Añadir/Editar Proyectos","Editar Usuarios","Ver log","Realizar Backup", "Restaurar datos backup","PDF"];
    foreach ($items as $k => $v) {
      echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }
  }
  // Si se está logueado como miembro
  else if ($_SESSION['tipouser']=="miembro"){
    $items = ["Inicio","Miembros","Publicaciones","Proyectos","Añadir/Editar Publicaciones", "Añadir/Editar Proyectos","PDF"];
    foreach ($items as $k => $v) {
      echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }
  }
  // Si no se está logueado y es solamente un invitado.
  else if ($_SESSION['tipouser']=="invi") {
    $items = ["Inicio","Miembros","Publicaciones","Proyectos","PDF"];
    foreach ($items as $k => $v) {
      echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }
  }
}

echo <<< HTML
</ul></div>
<div class="cont_user">
</div>
</nav>
</div>
HTML;
}

/***************************************************************************/

/*
Esta función está creada para poder realizar el login en la página, a través
del formulario realizado y de la función que se encuentra en el archivo
login.php, además si se está logueado se puede cerrar la sesión a través de
logout.php
*/

function HTMLlogin(){
echo <<<HTML
          <!-- Parte de login del header -->
          <div class="cont_header_2">
              <div class="h21">
                  <p>Login</p>
              </div>
              <div class="h22">
HTML;
              if ($_SESSION['tipouser']!="invi"){
                echo '<h5>'.$_SESSION['nombre'].'-<a href=logout.php>Cerrar Sesión</a></h5>';
              }
              else {
                echo '<form action="login.php", method="post">';
                echo '<input type="text" placeholder="Introduce tu usuario.." name="uname" required>';
                echo '<input class="psw" type="password" placeholder="Introduce tu contraseña.." name="psw" required>';
                /*echo '<button type="submit" name="enviar">Entrar</button>';
                echo '</form>';*/

              echo '</div>
              <div class="h23">¡';
                  echo '<button type="submit" name="enviar"></button>';
                  echo '</form>';
                }
                  echo <<<HTML
              </div>
          </div>
      </header>
HTML;
}

/**************************/
/*
Esta función muestra los miembros que tenemos en el sistema. Es llamada desde
DB_miembros y recibe el resultado de la query a través de $res
*/
function HTMLmiembros($res){
  echo <<<HTML
  <div class="body_right">
      <!-- MIEMBROS -->
      <div class="cont_miembros">
HTML;

$len = sizeof($res);
echo '<div class="cont_miembros_left">';
for($i=0;$i<$len;$i++){
  $proy = $res[$i];
  if ($i%2!=1) {
    echo '<div class="miembro">';
    echo '<div class="m1">
        <img src="img/foto_miembro" alt="foto_miembro">
        <div id="bloque_azul"></div>
    </div>';
    echo '<div class="m2">';
        echo '<p class="primero"> Nombre usuario: '.$proy["Nombre"].' '.$proy["Apellidos"].' </p>';
        echo '<p> Categoría: '.$proy["Categoria"].' </p>';
        echo '<p> Dirección: '.$proy["Direccion"].' </p>';
    echo '</div></div>';
  }
}
echo '</div>';// Final cont_miembros_left

echo '<div class="cont_miembros_right">';
for($i=0;$i<$len;$i++){
  if ($i%2==0) {
    echo '<div class="miembro">';
    echo '<div class="m1">
        <img src="img/foto_miembro" alt="foto_miembro">
        <div id="bloque_azul"></div>
    </div>';
    echo '<div class="m2">';
        echo '<p class="primero"> Nombre usuario: '.$proy["Nombre"].' '.$proy["Apellidos"].' </p>';
        echo '<p> Categoría: '.$proy["Categoria"].' </p>';
        echo '<p> Dirección: '.$proy["Direccion"].' </p>';
    echo '</div></div>';
  }
}
echo '</div>';// Final cont_miembros_right
echo '</div></div>
</div>';
}

/**********Proyectos*************/
/*
Es función muestra los proyectos que tenemos en el sistema. Se llama a través
de DB_proyectos, desde la cual le pasamos el resultado de la query ($res)
*/
function HTMLproyectos($res){
  $len = sizeof($res);
  echo <<< HTML
  <div class="body_right">
                <div class="cont_proyectos">
                <p id="p_proy">Proyectos realizados por nuestro grupo de investigación: </p>
HTML;

  for($i=0;$i<$len;$i++){
    $proy = $res[$i];
    echo '
    <div class="proyecto">
        <ul>';
        echo "<li> Codigo: ".$proy["Codigo"]."</li>";
        echo "<li> Titulo: ".$proy["proyecto"]."</li>";
        echo "<li> Descripción: </br><span>".$proy["Descripcion"]."</span></li></ul>";
        echo '<table border="1">';
        // echo '<tr><th>'.$proy['3'].'</th></tr>';
        echo '<tr><th> Publicacion: '.$proy["publicacion"].' </th></tr>';
        echo "</table></div>";
  }
  echo '</div></div>';
}

/***************************************************************************/

/*
Esta función recibe la query $res para mostrar los proyectos y posteriormente
poder borrar proyectos, modificarlos o añadirlos. Estas funcionalidades no han
sido implementadas.
*/


function HTMLaddquitproy($res){
  echo <<<HTML
  <div class="body_right">
                <div class="cont_mod_proy">
                    <p id="contProy">Proyectos realizados por nuestro grupo de investigación: </p>
HTML;

    $len = sizeof($res);

    echo '<div class="proyecto">
          <p>Proyecto NºXXX:
          <ul>';
    echo '<li>Codigo</li><li>Titulo</li><li>Descripcion</li></ul>';
    echo '<div class="proy1"><button class="añadir">Añadir</button><br></div></div>';

    for($i=0;$i<$len;$i++){
      $proy = $res[$i];
      echo '<div class="proyecto">';
          echo '<p>Proyecto Nº'.$i.'<p>';
          echo '<ul>';
      echo '<li>Codigo: '.$proy["Codigo"].'</li>';
      echo '<li>Título: '.$proy["Titulo"].'</li>';
      echo '<li>Descripcion: </br><span>'.$proy["Descripcion"].'</span></li></ul>';
      echo '<div class="proy1">
                                    <button class="modificar">Modificar</button><br>
                                    <button class="eliminar">Eliminar</button>
                        </div>
                    </div>';
    }
    echo '</div></div>';
}


/***************************************************************************/
/*
Esta función nos muestra a través de la query $res los miembros que tenemos en
el sistema, y además nos permite añadir nuevos usuarios a través de addmember.php,
y eliminar users a través de eliminaruser.php
La implementación para modificar no ha sido realizada
*/


function HTMLeditmembers($res){
  echo <<<HTML
  <div class="body_right">
      <!-- MIEMBROS -->
      <div class="cont_miembros">
HTML;

$len = sizeof($res);
echo '<div class="cont_miembros_left">';
echo '<div class="miembro">
    <div class="m1">
        <img src="img/foto_miembro" alt="foto_miembro">
        <div id="bloque_azul"></div>
    </div>
    <div class="m2">
        <p class="primero"> Nombre usuario </p>
        <p> Categoría </p>
        <p> Dirección </p>
    </div>
      <div class="m3">';
          echo '<form action="addmember.php", method="post">';
          echo '<button class="añadir">Añadir</button><br>';
    echo '</form>
    </div>
  </div>
';
for($i=0;$i<$len;$i++){
  $proy = $res[$i];
  if ($i%2!=1) {
    echo '<div class="miembro">';
    echo '<div class="m1">
        <img src="img/foto_miembro" alt="foto_miembro">
        <div id="bloque_azul"></div>
    </div>';
    echo '<div class="m2">';
        echo '<p class="primero"> Nombre usuario: '.$proy["Nombre"].' '.$proy["Apellidos"].' </p>';
        echo '<p> Categoría: '.$proy["Categoria"].' </p>';
        echo '<p> Dirección: '.$proy["Direccion"].' </p>';
    echo '</div><div class="m3">
        <button class="modificar">Modificar</button><br>
        <form action="eliminaruser.php", method=post>
          <input type="radio" name="Eliminar" value='.$proy["idMiembro"].'>
          <input type="submit" value="Eliminar">
        </form>
    </div></div>';
  }
}
echo '</div>';// Final cont_miembros_left

echo '<div class="cont_miembros_right">';

for($i=0;$i<$len;$i++){
  if ($i%2==0) {
    echo '<div class="miembro">';
    echo '<div class="m1">
        <img src="img/foto_miembro" alt="foto_miembro">
        <div id="bloque_azul"></div>
    </div>';
    echo '<div class="m2">';
        echo '<p class="primero"> Nombre usuario: '.$proy["Nombre"].' '.$proy["Apellidos"].' </p>';
        echo '<p> Categoría: '.$proy["Categoria"].' </p>';
        echo '<p> Dirección: '.$proy["Direccion"].' </p>';
    echo '</div><div class="m3">
    <button class="modificar">Modificar</button><br>
    <form action="eliminaruser.php", method=post>
      <input type="radio" name="Eliminar" value='.$proy["idMiembro"].'>
      <input type="submit" value="Eliminar">
    </form>
    </div></div>';
  }
}
echo '</div>';// Final cont_miembros_right
echo '</div></div>
</div>';
}

/************************************************************************/
/*
Esta función muestra las publicaciones que se han realizado en el sistema.
Falta adaptarla para que sea dinámica y muestre las que haya en el sistema e
implementar el buscador.
*/

function HTMLpublicaciones($res){
  echo <<<HTML
  <div class="body_right">
                <div class="cont_publi">
                    <div class="p1">
                        <p class="contenido"> PUBLICACIONES</p>
                        <!-- TITULO -->
                        <div class="p11">
                            <p>Buscar por:</p>
                        </div>
                        <!-- INPUTS y SELECT -->
                        <div class="p12">
                            <ul>
                                <li>
                                    <p>Año de inicio:</p>
                                    <input type="text">
                                </li>
                                <li>
                                    <p>Año de finalización:</p>
                                    <input type="text">
                                </li>
                                <li>
                                    <p>Título:</p>
                                    <input type="text">
                                </li>
                                <li>
                                    <p>Investigador:</p>
                                    <select></select>
                                </li>
                            </ul>
                        </div>
                        <!-- BOTONES -->
                        <div class="p13">
                            <button>Borrar</button>
                            <button>Buscar</button>
                        </div>
                    </div>
                    <!-- LISTADO DE PUBLICACIONES -->
                    <div class="p2">
                        <p> LISTA DE PROYECTOS</p>
                        <table>
                            <tr>
                                <th>Nombre proyecto</th>
                                <th>Fecha inicio</th>
                                <th>Fecha finalización</th>
                            </tr>
                            <tr>
                                <td>Proyecto 1: Extracción de características con métodos lexicon-based.</td>
                                <td>2015</td>
                                <td>2018</td>
                            </tr>
                            <tr>
                                <td>Proyecto 2: Estudio de los algoritmos de clasificación en Sentiment Analysis.</td>
                                <td>2014</td>
                                <td>2017</td>
                            </tr>
                            <tr>
                                <td>Proyecto 3: Caso de estudio: Alhambra, extracción del conocimiento de reviews de TripAdvisor.</td>
                                <td>2014</td>
                                <td>2017</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
HTML;
}

/************************************************************************/
/*
Esta función muestra las publicaciones que hay en el sistema a través del
resultado de la query $res y permite añadir más, modificarlas y eliminarlas.
No ha sido implemtada.
*/
function HTMLaddquitpublis($res){
  echo <<<HTML
  <div class="body_right"></div>
HTML;
}

?>
