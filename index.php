<?php include("autoload.php");?>		
<?php //include("security.php");?>						
<?php
$action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "message":                   
			executeMessage($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
						
	function executeIndex($values = null){
        /*Menu*/
        /*$Menu = new Menu();
        $items = $Menu ->getMenu(1, 1);*/
        
        
        /*Caroussels*/
        /*$CarousselDetails = new CarousselDetails();
        $caroussel1_name = $CarousselDetails ->getCarousselName(1);
        $caroussel1_details = $CarousselDetails ->getCarousselDetails(1);*/
		
		/*Contents*/
		
		//$HtmlContents = new ContentsHtml();
		/*about*/
		//$about1_title = $HtmlContents ->getContentTitle(1, 'about', 'page.php', 'es', 1, 'QUIENES_SOMOS' );
		//$about1_contents = $HtmlContents ->getContents(1, 'about', 'page.php', 'es', 1, 'QUIENES_SOMOS' );

		//$about2_title = $HtmlContents ->getContentTitle(1, 'about', 'page.php', 'es', 1, 'NUESTRA_MISION' );
		//$about2_contents = $HtmlContents ->getContents(1, 'about', 'page.php', 'es', 1, 'NUESTRA_MISION' );		

		//$about3_title = $HtmlContents ->getContentTitle(1, 'about', 'page.php', 'es', 1, 'DONDE_VAMOS' );
		//$about3_contents = $HtmlContents ->getContents(1, 'about', 'page.php', 'es', 1, 'DONDE_VAMOS' );			
		
		/*work*/		
		//$work_title = $HtmlContents ->getContentTitle(1, 'work', 'page.php', 'es', 1, 'QUE_HACEMOS' );
		//$work_contents = $HtmlContents ->getContents(1, 'work', 'page.php', 'es', 1, 'QUE_HACEMOS' );		
		
		/*portfolio*/		
		//$portfolio_title = $HtmlContents ->getContentTitle(1, 'portfolio', 'page.php', 'es', 1, 'COMO_FUNCIONAMOS' );
		//$portfolio_contents = $HtmlContents ->getContents(1, 'portfolio', 'page.php', 'es', 1, 'COMO_FUNCIONAMOS' );			
		
		
		/*objectives*/
		//$objectives_title = $HtmlContents ->getContentTitle(1, 'objectives', 'page.php', 'es', 1, 'OBJETIVOS' );
		//$objectives_contents = $HtmlContents ->getContents(1, 'objectives', 'page.php', 'es', 1, 'OBJETIVOS' );
        
        $Planes = new Planes();
        $lista_beneficios = $Planes ->getBeneficios();
	require('page.php');
	}

	function executeMessage($values = null){
	
	$Message = new Message();
        $Message ->saveMessage($values);
        
        
        $Mail = new Mail();
        $mensaje = $values['names']." ".$values['email']." ".$values['phone']." ".$values['message'];
        
        $Mail ->sendMessageContactenos($values);
	}			