<?php
if(!isset($_SESSION['id_user']) or !isset($_SESSION['id_perms'])){

	header("Location:".full_url."/adm/errors_pages/login_required.php");	
} 
	if(isset($_SESSION['id_perms']) and $_SESSION['id_perms']!=2)
	{
	header("Location:".full_url."/adm/errors_pages/login_required.php");	
		
	}
