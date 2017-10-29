<?php include("../../autoload_servicios.php");?>

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
	case "grueros":
	executeGrueros($values);
	break;
  case "servicios":
	executeServicios($values);
	break;
  default:
	executeIndex($values);
	break;
}
function executeIndex($values = null)
{
	die;
}
function executeGrueros($values){
    require("grueros.php");
}
function executeServicios($values){
    require("servicios.php");
}
