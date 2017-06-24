<?php include("../autoload.php");?>		
<?php //include("security.php");?>						
<?php
$action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
	switch ($action) {
		case "acceso":
			executeAcceso($values);	
		break;								
		default:
			executeIndex($values);
		break;
	}
						
	function executeAcceso($values = null){
	
	require('bienvenida.php');
	}
					