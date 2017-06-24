<?php include("../../autoload.php");?>	
<?php include("validator.php");?>	
<?php 

$values = array();
$values['idGrua'] = 54;
$Aws = new Aws();
$Aws->saveGrueros($values);
$Aws->saveGruas($values);