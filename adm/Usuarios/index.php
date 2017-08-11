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
		case "add":
			executeAdd($values);	
		break;
		case "update":
			executeUpdate($values);	
		break;		
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
        $values['action'] = 'update';
        $values['IdUsuario'] = $_SESSION['IdUsuario'];
		require('personal_view.php');
	}
	function executeUpdate($values = null,$msg = null)
	{
        $values['action'] = 'update';
        $values['IdUsuario'] = $_SESSION['IdUsuario'];
		require('personal_view.php');
	}
	function executeAdd($values = null,$msg = null)
	{
        $values['action'] = 'add';
		require('personal_view.php');
	}