<?php
session_start();
error_reporting(1);
$project_folder = '';
$development_env = false;
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

include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/notorm-master/NotORM.php");//se debe incluir una sola vez en todo el cms
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/ConnectionORM.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/ConnectionAws.class.php");

include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/Utilitarios.class.php");

include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/vendors/swiftmailer/lib/swift_required.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/vendors/tcpdf/tcpdf.php");

include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/ValidateBase.class.php");

//require($_SERVER["DOCUMENT_ROOT"]."/".main_folder.'/lib/vendors/securimage/securimage.php');

//require($_SERVER["DOCUMENT_ROOT"]."/".main_folder.'/lib/vendors/Mobile-Detect/Mobile_Detect.php');
//include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Panels.class.php");

include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/SecurityBase.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/clean.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/RegistroModel.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Menu.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/CarousselDetails.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/Mail.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/MessagesUtilities.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Users.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Login.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Hoist.class.php");
//include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/ContentsHtml.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Message.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Company.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Bank.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/CompanyFiles.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/UsersCompany.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/UsersHoistCompany.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/ServicesOperator.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/ServicesMasters.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/ServicesAdministrators.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/UsersData.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Aws.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Polizas.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Seguros.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Estados.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/UsuariosInternos.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/ServiciosClientes.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Solicitud.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Bitacora.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Grueros.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Baremo.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/PDFSolicitud.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/SolicitudPlan.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Marcas.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Planes.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/SolicitudPagoDetalle.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/PDFPagos.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/SolicitudDocumentos.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/SolicitudAprobada.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/PreguntasFrecuentes.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Usuarios.class.php");
/*validation class*/

//include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/vendor/GUMP/gump.class.php");


/***
 Class autoloads by model_base_generator.php
**/
//include($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/lib/model/Users.class.php");

