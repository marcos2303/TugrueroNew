<?php
session_start();
//error_reporting(1);
$project_folder = '';
$development_env = false;
setlocale(LC_NUMERIC,"es_ES.UTF8");
if(@$_SERVER['HTTP_HOST'] == '127.0.0.1' or @$_SERVER['HTTP_HOST'] == 'localhost' or strpos(@$_SERVER['HTTP_HOST'], "192.168") !== false)
{
	$development_env = true;
}
if($development_env == true)
{
    $project_folder = '/TugrueroNew';
}

define("main_folder",$project_folder);//Project name and directory name//prueba 2
define("title","TU/GRUERO®");
define("Author","De Andrade Groups C.A");
define("Company","TU/GRUERO®");
define("version","");
define("development_by","De Andrade Developmen Group C.A");
define("upload_temp_dir",$_SERVER["DOCUMENT_ROOT"]."/".main_folder."/web/uploads/temp");
define("upload_dir",$_SERVER["DOCUMENT_ROOT"]."/".main_folder."/web/uploads/documentos");
define("images_dir","../../../../web/images/");
define("dir_cuadros",$_SERVER["DOCUMENT_ROOT"]."/".main_folder."/web/files/Cuadros/");
/* configuraciones apache*/
$base_dir  = __DIR__; // Absolute path to your installation, ex: /var/www/mywebsite
$doc_root  = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
$base_url  = preg_replace("!^${doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$port      = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
$domain    = $_SERVER['SERVER_NAME'].$project_folder;
$full_url  = "${protocol}://${domain}";

define("base_dir",__DIR__);// Absolute path to your installation, ex: /var/www/mywebsite
define("doc_root", preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']));// ex: /var/www
define("base_url",preg_replace("!^${doc_root}!", '', $base_dir));# ex: '' or '/mywebsite'
define("protocol",empty($_SERVER['HTTPS']) ? 'http' : 'https');
define("port",$_SERVER['SERVER_PORT']);
define("disp_port",($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port");
define("domain",$_SERVER['SERVER_NAME'].$project_folder);
define("full_urlapi",protocol."://".$_SERVER['SERVER_NAME']);
define("full_url",protocol."://".domain);
define("image_url",full_url."/web/images/");

/*
 *
 * You can add more constants
 *
 *
 * */
 define('mail_from',"tugruero@tugruero.com");
 define('message_updated',"Registro actualizado satisfactoriamente");
 define('message_created',"Registro creado satisfactoriamente");
 define('max_input_size',1000000);
 define('message_max_size',"El archivo debe pesar máximo 10MB");
 define('IVA',1.12);
//Class definition
spl_autoload_register(function ($nombre_clase) {
    include $_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/".$nombre_clase . '.class.php';
	include $_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/notorm-master/".$nombre_clase . '.php';
	include $_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/".$nombre_clase . '.class.php';

});
