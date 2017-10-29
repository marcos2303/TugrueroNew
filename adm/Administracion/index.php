<?php include("../../autoload.php");?>
<?php //include("validator.php");?>
<?php include("../security/security.php");?>

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
	case "new":
	executeNew($values);
	break;
	case "edit":
	executeEdit($values);
	break;
	case "list_json":
	executeListJson($values);
	break;
	default:
	executeIndex($values);
	break;
}
function executeIndex($values = null)
{
	require('list_view.php');
}
function executeNew($values = null)
{
	$values['action'] = "new";
	require('form_view.php');
}
function executeEdit($values = null)
{
	$values['action'] = "edit";
	require('form_view.php');
}
