<?php
//include("Messages.class.php");
	
	
	class SecurityBase {
		
		public function verifiedCredentials($is_secure,$credentials){
					
				session_start();
				if(count($credentials)>0){
					foreach($credentials as $credential):							
							
							//echo $credential;die;
							//print_r($_SESSION['profiles']);die;
							$profiles[] = '1';
							/*if(!in_array($credential,$_SESSION['profiles'])){
								$messages = new Messages();	
								$messages->credentialsRequired();								
							}*/
							
							/*if(empty($_SESSION[$credential]) or $_SESSION[$credential] == 0){
								$messages = new Messages();	
								$messages->credentialsRequired();		
							}	*/		
						
				
						
					endforeach;						
				}	
		
		
				if($is_secure == true){
					if(empty($_SESSION['logged']) or $_SESSION['logged'] == 0 or $_SESSION['logged'] == null or $_SESSION['logged'] == '' or !isset($_SESSION['logged'])){
									
								$messages = new Messages();	
								$messages->loginRequired();
						
					}
					
					
				}			
		
		
		
		}
		
		public function verifiedFunctionAccess($function,$protected_functions){
			

			$access = false;
			//print_r($protected_functions);die;
			/*
			 * Function que permite comparar los perfiles que tenga el usuario en sesión
			 * 
			 * $_SESSION['profiles']; nombre de la session que debe contener los perfiles a comparar
			 * $function = nombre de la función a comprobar que tenga los permisos
			 * $protected_functions = array que contiene las funciones que están protegidas
			 * 
			 * 
			 * 
			 * 
			*/
			
			if(array_key_exists($function,$protected_functions)):
						
						
						$profiles = @$_SESSION['profiles'];
						$protected_function = $protected_functions[$function];
						
						//print_r($protected_functions[$function]);die;
						foreach($protected_function as $protected){
								
							foreach ($profiles as $profile) {
								
								if(($profile == $protected)  or ($protected == '')  ){
									$access = true;
									
										
								}
								
								
								
								
							}
							
						}
						
				if(count($protected_functions[$function])==0){
					$access = true;	
				}		

			
			endif;
			
			
			
			if(!array_key_exists($function,$protected_functions)):			
			$access = true;
			endif;			
			
			
			
			
			
		if($access == false){
								$messages = new Messages();	
								$messages->credentialsFaults();
		}			
			
		}
		
	}
