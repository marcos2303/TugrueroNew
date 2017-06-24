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
		case "seguros":
			executeSeguros($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		die;//require('list_view.php');
	}
	function executeSeguros($values = null)
	{
		$Seguros = new Seguros();
		$seguros_list = $Seguros->getSegurosListSelect();
		require('seguros_view.php');
	}