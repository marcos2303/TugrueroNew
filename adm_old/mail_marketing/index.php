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
		case "mail_marketing1":
			executeMailMarketing1($values);	
		break;		
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		die;
                //require('list_view.php');
	}
	function executeMailMarketing1($values = null)
	{
            $Mail = new Mail();
            $values['mail'] = 'deandrademarcos@gmail.com';
            $envio = $Mail->mailMarketing1($values);
            die;
                //require('list_view.php');
	}