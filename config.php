<?php

date_default_timezone_set('America/Mexico_city');
$fecha = date('Y-m-d H:i:s');
define('FECHA', $fecha);
// Nueva linea
define('HORA',date('H:i:s'));
/**


 */

$folder = explode("/", $_SERVER['REQUEST_URI']);

define('FOLDER', $folder[1]);
define('URL_API', 'http://localhost/softmor-pos/api/public/');

// Definiendo la ruta de la web 
define('HTTP_HOST', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . FOLDER . '/');

// Definiendo el directorio del proyecto
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/' . $folder[1] . '/');
