--TEST--
Basic operations
--FILE--
<?php
include_once dirname(__FILE__) . "/connect.inc.php";

$personas = $software->prueba()
    ->select("id, nombre")
    //->where("web LIKE ?", "http://%")
    ->order("nombre")
    ->limit(10)
;


foreach ($personas as $persona) {
	
	echo $persona['id']." ".$persona['nombre'];
}
?>
