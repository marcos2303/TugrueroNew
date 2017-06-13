<?php


	class MessagesUtilities{
		
		public function loginRequired(){
			
			echo "<div align='center'>Login requerido</div>";die;
			
		}
		public function credentialsRequired(){
			
			echo "<div align='center'>Credenciales requeridas</div>";die;
			
		}
		public function credentialsFaults(){
			
			echo "<div align='center'>No posee los permisos suficientes</div>";die;
			
		}			
		

	}
