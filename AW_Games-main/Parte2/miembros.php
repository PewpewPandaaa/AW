<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sobre nosotros';

$contenidoPrincipal = '';

$contenidoPrincipal.=<<<EOS
    <div id="contenido_gestion_user">
EOS;

$contenidoPrincipal .= <<<EOS
<div class="miembros_wrapper">
        <div class="titulo">
            <div>
                <h2>Miembros</h2>
            </div>
        </div>
        <!-- Enlaces de cada uno de los miembros -->
        <div class="nombres">
            <h4><a href="#Sishi">Sishi Chen</a></h4>
            <h4><a href="#Jing">Jing Sun</a></h4>
            <h4><a href="#Xin">Xin Xiang Lin Zhou</a></h4>
            <h4><a href="#Shangyu">Shangyu Qiu</a></h4>
            <h4><a href="#Yingting">Yingting Qiu Zhao</a></h4>
            <h4><a href="#Chaoran">Chaoran Zheng</a></h4>
            <h4><a href="#Rouyi">Rouyi Wang</a></h4>
            <h4><a href="#Xinxiang">Xinxiang Zhu</a></h4>
        </div>
        <!-- Imformaciones de cada uno de los miembros -->
        <div class="informacion">
            <a id="SiShi">
                <img src="img/miembros/f1.jpg" alt="SiShi">
                <h3>SiShi Chen</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: sishiche@ucm.es</p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del doble grado ADE-INFO a tiempo completo.</p>
                <br><br>

            </a>

            <a id="Jing">
                <img src="img/miembros/f2.jpg" alt="Jing">
                <h3>Jing Sun</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: jsun02@ucm.es</p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del doble grado ADE-INFO a tiempo completo.</p>
                <br><br>
            </a>

            <a id="Xin">
                <img src="img/miembros/f3.jpg" alt="Xin Xiang">
                <h3>Xin Xiang Lin Zhou</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: xinlin@ucm.es </p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del grado de Ingeniería Informática a tiempo completo.</p>
                <br><br>

            </a>

            <a id="Shangyu">
                <img src="img/miembros/f4.jpg" alt="ShangYu">
                <h3>ShangYu Qiu</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: xinlin@ucm.es </p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del grado de Ingeniería Informática a tiempo completo.</p>
                <br><br>

            </a>

            <a id="Yingting">
                <img src="img/miembros/f5.jpg" alt="Yingting">
                <h3>Yingting Qiu Zhao</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: yqiu@ucm.es </p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del doble grado ADE-INFO a tiempo completo.</p>
                <br><br>

            </a>

            <a id="Chaoran">
                <img src="img/miembros/f6.jpg" alt="Chaoran">
                <h3>Chaoran Zheng</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: chaoranz@ucm.es </p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del doble grado ADE-INFO a tiempo completo.</p>
                <br><br>

            </a>

            <a id="Rouyi">
                <img src="img/miembros/f7.jpg" alt="Rouyi">
                <h3>Rouyi Wang</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: rouywang@ucm.es </p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del doble grado ADE-INFO a tiempo completo.</p>
                <br><br>

            </a>

            <a id="Xinxiang">
                <img src="img/miembros/f8.jpg" alt="Xinxiang">
                <h3>Xinxiang Zhu</h3>
                <h4>Contacto</h4>
                <p> E-MAIL: xinzhu@ucm.es </p>
                <h4>Descripción</h4>
                <p> Estudiante de ucm del doble grado ADE-INFO a tiempo completo.</p>
                <br><br>
            </a>
        </div>

    </div>

EOS;

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>