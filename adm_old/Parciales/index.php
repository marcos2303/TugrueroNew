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
		case "parcial_cliente":
			executeParcialCliente($values);	
		break;
		case "parcial_poliza":
			executeParcialPoliza($values);	
		break;
		case "parcial_gruero":
			executeParcialGruero($values);	
		break;
		case "parcial_solicitud":
			executeParcialSolicitud($values);	
		break;
		case "parcial_tips":
			executeParcialTips($values);	
		break;		
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		echo "nada";die;
	}
	function executeParcialCliente($values = null)
	{
		$Polizas = new Polizas();
		$data = $Polizas->getPolizasById($values);
		//print_r($data);die;
		require('cliente_view.php');
	}
	function executeParcialPoliza($values = null)
	{
		$Polizas = new Polizas();
		$data = $Polizas->getPolizasById($values);
		//print_r($data);die;
		require('poliza_view.php');
	}
	function executeParcialGruero($values = null)
	{
		echo "nada";die;
	}
	function executeParcialSolicitud($values = null)
	{
		$Solicitud = new Solicitud();
		$data = $Solicitud->getDatosSolicitud($values);
		require('solicitud_view.php');
	}
	function executeParcialTips($values = null)
	{

		require('tips_view.php');
	}