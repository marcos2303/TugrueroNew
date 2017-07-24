<?php include("../../autoload.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
$values = array_merge($values,$_FILES);
switch ($action) {
	case "index":
	executeIndex($values);
	break;
	case "mapa_servicio":
	executeMapaServicio($values);
	break;
  case "mapa_grueros":
	executeMapaGrueros($values);
	break;
  default:
	executeIndex($values);
	break;
}
function executeIndex($values = null)
{
	die;
}
function executeMapaServicio($values){
    require("mapa_servicio.php");
}
function executeMapaGrueros($values){
    require("mapa_grueros.php");
}
