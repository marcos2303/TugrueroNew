<?php
if(!isset($_SESSION['IdUsuario']) or !isset($_SESSION['Perfil'])){

	header("Location:".full_url."/adm/PaginaErrores/login_required.php");} 

	
	if(isset($_SESSION['Perfil']) and ($_SESSION['Perfil']!='Operador' and $_SESSION['Perfil']!='Administrador'))
	{
		header("Location:".full_url."/adm/PaginaErrores/login_required.php");	
		
	}
