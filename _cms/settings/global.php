<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


define('appTitleLarge', 'Aplicacion Monteverde LTDA - Developer by @FelipheGomez');
define('appTitleMedium', 'Aplicacion Monteverde LTDA');
define('appTitleSmall', 'Monteverde LTDA');
define('appTitleXSmall', 'AMV');
define('appDescription', appTitleLarge);
define('authorDev', 'QEZlbGlwaGVHb21leg==');

setlocale(LC_TIME,"es_CO"); // Configurar Hora para Colombia
setlocale(LC_TIME, 'es_CO.UTF-8'); // Configurar Hora para Colombia en UTF-8
date_default_timezone_set('America/Bogota'); // Configurar Zona Horaria

define('site_author_name', 'FelipheGomez'); // Nombre del desarrollador del Sitio
define('site_author_url', 'wWw.FelipheGomez.Info'); // URL del creador del Sitio
session_set_cookie_params(0, 'cmr.feliphegomez.info');
session_start(['cookie_lifetime' => 86400,'read_and_close'  => false,]); // 86400 -> 1 Dia /// Tiempo de expiracion de la sesion en el servidor // Lectura y Cierre de la sessio e servidor 
header('Access-Control-Allow-Origin: *'); // Control de acceso Permitir origen de: