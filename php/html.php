<<?php

function HTMLinicio(){
  echo <<<HTML
  <!DOCTYPE html>
  <html lang="es">

    <head>

        <meta author="Jesús Sánchez de Castro y Alberto Argente del Castillo">
        <meta charset="utf-8">
        <title> SARG UGR</title>
        <link rel="stylesheet" href="estilo_web.css">
    </head>
    <body>
HTML;
}

function HTMLfin(){
  echo <<<HTML
  </body>
   </html>
HTML;
}

function HTMLcabecera(){
  echo <<<HTML
  <header>
            <!-- Parte de logos y cabecera del header-->
            <div class="cont_header_1">
                <div class="h11">
                    <img src="img/SARG_LOGO_NUEVO.png" alt="logo SARG">
                    <div class="linea"></div>
                </div>
                <div class="h12">
                    <p id="h12_p1"> Sentiment Analysis Research Group</p>
                    <!-- Linea vertical de separación -->
                    <div class="linea"></div><br>
                    <p id="h12_p2"> SARG UGR</p>
                </div>
                <div class="h13">
                    <img src="img/logo_ugr.png">
                </div>
            </div>
            <!-- Parte de login del header -->
            <div class="cont_header_2">
                <div class="h21">
                    <p>Login</p>
                </div>
                <div class="h22">
                    <input type="text" placeholder="Introduce tu usuario.." name="uname" required>
                    <input class="psw" type="password" placeholder="Introduce tu contraseña.." name="psw" required>
                </div>
                <div class="h23">
                    <button href="footer"></button>
                </div>
            </div>
        </header>
HTML;
}

function HTMLnavbody(){
  echo <<< HTML
  <div class="cont_body">
      <div class="body_left">
          <!-- NAVAGATION -->
          <nav>
              <div class="cont_lista">
                  <ul>
                      <li><a href="index.html">Inicio</a></li>
                      <li><a href="miembros.html">Miembros</a></li>
                      <li><a href="publicaciones.html">Publicación</a></li>
                      <li><a href="proyectos.html">Proyectos</a></li>
                      <li><a href="addquitmembers.html">Añadir/Editar Publicación</a> </li>
                      <li><a href="addquitproy.html">Añadir/Editar Proyecto</a> </li>
                      <li><a href="editmember.html">Editar usuarios</a> </li>
                      <li><a href="vlog.html">Ver log</a> </li>
                      <li><a href="backup.html">Realizar Backup</a> </li>
                      <li><a href="restbackup.html">Restaurar datos backup</a> </li>
                      <li><a href="">PDF</a> </li>
                  </ul>
              </div>
              <div class="cont_user">
                  <!-- TODO -->
              </div>
          </nav>
      </div>
HTML;
}

function HTMLcierrebdoy(){
  echo <<< HTML
  </div>
HTML;
}

function HTMLfooter(){
  echo <<<HTML
  <!--FOOTER-->
  <footer>
      <div class="f1">
          <img src="img/word_cloud_footer.png" alt="logo SARG">
          <!--LINEA VERTICAL DE SEPARACIÓN-->
          <div class="linea"></div>
      </div>
      <div class="f2">
          <p id="f12_p1">Sentiment Analysis Research Group</p>
          <!--LINEA HORIZONTAL DE SEPARACIÓN-->
          <div class="linea"></div><br>
          <!--LISTA DEL FOOTER-->
          <ul>
              <li><a href="">Inicio</a></li>
              <li><a href="">Miembros</a></li>
              <li><a href="">Publicación</a></li>
              <li><a href="">Proyectos</a></li>
          </ul>
      </div>

      <div class="f3">
          <img src="img/logo_UGR2.png" alt="logo UGR">
      </div>
  </footer>
HTML;
}

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

function HTMLmiembros(){
  echo <<<HTML
  <div class="body_right">
      <!-- MIEMBROS -->
      <div class="cont_miembros">
          <!-- Contenedor izquierdo de miembros -->
          <div class="cont_miembros_left">
              <!-- MIEMBRO -->
              <div class="miembro" id="1">
                  <!-- Contiene la foto del miembro-->
                  <div class="m1">
                      <img src="img/foto_miembro" alt="foto_miembro">
                      <div id="bloque_azul"></div>
                  </div>
                  <!-- Contiene los datos del miembro-->
                  <div class="m2">
                      <p class="primero"> Nombre usuario </p>
                      <p> Categoría </p>
                      <p> Dirección </p>
                      <p> blablableh3</p>
                  </div>
                  <!-- Contiene los botones de gestión de miembros -->
                  <div class="m3">
                      <button class="añadir">Añadir</button><br>
                      <button class="modificar">Modificar</button><br>
                      <button class="eliminar">Eliminar</button>
                  </div>
              </div>
          </div>
          <!-- Contenedor derecho de miembros -->
          <div class="cont_miembros_right">
              <!-- MIEMBRO -->
              <div class="miembro" id="1">
                  <!-- Contiene la foto del miembro-->
                  <div class="m1">
                      <img src="img/foto_miembro" alt="foto_miembro">
                      <div id="bloque_azul"></div>
                  </div>
                  <!-- Contiene los datos del miembro-->
                  <div class="m2">
                      <p class="primero"> Nombre usuario </p>
                      <p> Categoría </p>
                      <p> Dirección </p>
                      <p> blablableh3</p>
                  </div>
                  <!-- Contiene los botones de gestión de miembros -->
                  <div class="m3">
                      <button class="añadir">Añadir</button><br>
                      <button class="modificar">Modificar</button><br>
                      <button class="eliminar">Eliminar</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
HTML;
}

function HTMLproyectos(){
  echo <<<HTML
  <div class="body_right">
                <div class="cont_proyectos">
                    <p id="p_proy">Proyectos realizados por nuestro grupo de investigación: </p>
                    <!--PROYECTO -->
                    <div class="proyecto">
                        <ul>
                            <li>Código: Code</li>
                            <li>Título: Title</li>
                            <li>Descripción <br><span>Description</span></li>
                        </ul>
                        <table border="1">
                            <tr>
                                <th>Publicacion</th>
                            </tr>
                            <tr>
                                <th><a href="">Referenca a publicacion 1</a> </th>
                            </tr>
                            <tr>
                                <th><a href="">Referenca a publicacion 2</a> </th>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
HTML;
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

function HTMLaddquitproy(){
  echo <<<HTML
  <div class="body_right">
                <div class="cont_mod_proy">
                    <p id="contProy">Proyectos realizados por nuestro grupo de investigación: </p>
                    <!--PROYECTO MODIFICABLE-->
                    <div class="proyecto">
                        <ul>
                            <li>Código: Code</li>
                            <li>Título: Title</li>
                            <li>Descripción <br><span>Description</span></li>
                        </ul>
                        <div class="proy1">
                                    <button class="añadir">Añadir</button><br>
                                    <button class="modificar">Modificar</button><br>
                                    <button class="eliminar">Eliminar</button>
                        </div>
                    </div>

                </div>
            </div>
HTML;
}


?>
