<?php

function HTMLpdf(){
  echo <<<HTML
  <div class="cont_body">
  <object width='85%' height="600" data="memoria.pdf"></object>
</div>
HTML;
}
/*
function HTMLpdf(){
  echo '<div class="cont_body">';
  <iframe src="http://docs.google.com/gview?url=http://memoria.pdf.pdf&embedded=true"
  style="width:85%; height:600px;" frameborder="0"></iframe>
  echo '</div>';
}*/

// nav una vez se tengan las sesiones activadas.
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
  if ($_SESSION["tipouser"]=="admin"){
    $items = ["Inicio","Miembros","Publicaciones","Proyectos","Añadir/Editar Publicaciones", "Añadir/Editar Proyectos","Editar Usuarios","Ver log","Realizar Backup", "Restaurar datos backup","PDF"];
    foreach ($items as $k => $v) {
      echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }
  }
  else if ($_SESSION["tipouser"]=="miembro"){
    $items = ["Inicio","Miembros","Publicaciones","Proyectos","Añadir/Editar Publicaciones", "Añadir/Editar Proyectos","PDF"];
    foreach ($items as $k => $v) {
      echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }
  }
  else if ($_SESSION["tipouser"]=="invi") {
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



function HTMLlogin(){
echo <<<HTML
          <!-- Parte de login del header -->
          <div class="cont_header_2">
              <div class="h21">
                  <p>Login</p>
              </div>
              <div class="h22">
HTML;
              if (isset($_SESSION['tipouser'])){
                echo '<h5>Usuario:'.$_SESSION['nombre'].'-<a href=logout.php>Cerrar Sesión</a></h5>';
              }
              else {
                echo '<form action="login.php", method="post">';
                echo '<input type="text" placeholder="Introduce tu usuario.." name="uname" required>';
                echo '<input class="psw" type="password" placeholder="Introduce tu contraseña.." name="psw" required>';
                echo '<button type="submit" name="enviar">Entrar</button>';
                echo '</form>';
              }

              echo <<<HTML
              </div>
              <div class="h23">
                  <button href="footer"></button>
              </div>
          </div>
      </header>
HTML;
}
/*
function HTMLnav($activo){
  echo <<< HTML
  <div class="cont_body">
      <div class="body_left">
          <!-- NAVAGATION -->
          <nav>
              <div class="cont_lista">
                  <ul>
HTML;
$items = ["Inicio","Miembros","Publicaciones","Proyectos","Añadir/Editar Publicaciones", "Añadir/Editar Proyectos","Editar Usuarios","Ver log","Realizar Backup", "Restaurar datos backup","PDF"];
foreach ($items as $k => $v) {
  echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
}
echo <<< HTML
</ul></div>
<div class="cont_user">
</div>
</nav>
</div>
HTML;
}*/

/**************************/

function HTMLindex(){
  echo <<<HTML
  <div class="body_right">
                <!--PRINCIPAL-->
                <div class="cont_principal">
                    <div class="cont_left">
                        <div class="cont_text">

                            <h1>¿Quienes somos?</h1>
                            <p class="descripcion">SARG (Sentiment Analysis Research Group) es un grupo de investigación en el campo de la Ciencia de Datos enfocado a la extracción y análisis de los sentimientos procedentes de un texto.

                            El grupo está actualmente estudiando algoritmos de aprendizaje automático para buscar aquellos que den mejores resultados en la extracción de sentimientos a nivel de aspecto. Por otro lado, la extracción y selección de las características que permiten entrenar estos modelos son un tema de gran interés.

                            El grupo está compuesto por 7 integrantes, miembros del departamento de Ciencias de la Computación e Inteligencia Artificial de la Universidad de Granada.</p>

                            <h1>Análisis de Sentimientos</h1>
                            <p> El análisis de sentimientos es el procesamiento del lenguaje natural y análisis del texto que nos permite extraer información subjetiva procedente del texto fuente o corpus. Desde el punto de vista de la minería de datos, el análisis de sentimientos es una tarea de clasificación masiva de documentos de manera automática en función de la connotación postiva o negativa del lenguaje del documento. </p>

                            <img src="img/pic_principal_PNG.png">
                        </div>
                    </div>
                    <div class="cont_right">
                        <img class="foto_etsiit" src="img/etsiit2.png"s>
                    </div>
                </div>
            </div>
HTML;
}

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
/**QUERY**/

/*HTML;
}*/
/**********Proyectos*************/

function HTMLproyectos($res){
  $len = sizeof($res);
  echo <<< HTML
  <div class="body_right">
                <div class="cont_proyectos">
                <p id="p_proy">Proyectos realizados por nuestro grupo de investigación: </p>
HTML;

  /*for($i=0;$i<$len;$i++){
    for($j=0;$j<$len;$j++){
      if ($proy[$i]==$proy[$j]) {

      }
    }
  }*/

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
    <div class="m3">
        <button class="añadir">Añadir</button><br>
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
        echo '<p> Dirección: '.$proy["Dirección"].' </p>';
    echo '</div><div class="m3">
        <button class="modificar">Modificar</button><br>
        <button class="eliminar">Eliminar</button>
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
        echo '<p> Dirección: '.$proy["Dirección"].' </p>';
    echo '</div><div class="m3">
        <button class="modificar">Modificar</button><br>
        <button class="eliminar">Eliminar</button>
    </div></div>';
  }
}
echo '</div>';// Final cont_miembros_right
echo '</div></div>
</div>';
}


function HTMLpublicaciones(){
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


?>
