<?php
include("../notorm-master/NotORM.php");
include("../ConnectionORM.class.php");
include("../vendors/swiftmailer/lib/swift_required.php");

mailMarketing1(null);



function mailMarketing1($values){

			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->mail_marketing1
			->select("*")
			->where("status=?",0)
			->limit(50);
		$array_correos = array();
		foreach ($q as $emails){
			
			$array_correos[] = $emails['correo'];
			
		}

		/*print_r($array_correos);
		die;*/
		try{
        $smtp = "server-0116a.gconex.net";
        $port = 465;
        $secure = "ssl";
        $username = "contactenos@tugruero.com.ve";
        $password = "230386";
		$mail_from = 'mercadeo@tugruero.com'; 
	
        $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
          ->setUsername($username)
          ->setPassword($password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
       //$email = array('deandrademarcos@gmail.com','deandrademarcos@hotmail.com');
		$email = $array_correos;
			$message = Swift_Message::newInstance('TU/GRUERO®. ¡Grúas en menos de 30 minutos!');
			$message->setBody("
                            <html>
                            <body>
							<p align='center' style='font-size: 150%;'><strong>La nueva forma de solicitar una grúa. ¡Conócenos!</strong></p>
                            <p align='center'>
							<a href='http://www.tugruero.com' target='_blank'><img width='600'  src='http://www.tugruero.com/web/img/mail/flyer1.png' alt='tugruero.com' /></a>
                            </p>
                            <p align='center'>Si no puede observar la imagen dele click <strong><a href='http://www.tugruero.com/tugruero.php' target='_blank'>Aquí</a></strong</p>                            
                            <p align='center'><strong>2016. TU/GRUERO®.</strong> <strong style='color: #4C4C4C;'>Todos los Derechos Reservados.</strong></p>                            
                            </body>
                            </html>
							","text/html");			
			
        $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
		$message->setTo('info@tugruero.com');
		$message->setBcc($email);
        // Send the message

			
		$result = $mailer->send($message);	
		}catch(Exception $e){
			$error = array(
				'error' => $e->getMessage(),
				'fecha' => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)))
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->errores_mail()->insert($error);
			die;
		}
		
		

		
		
		foreach($array_correos as $correo){
			$update = array(
				'status' => 1,
				'fec_envio' => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)))
				
				);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->mail_marketing1("correo", $correo)->update($update);
			//echo $correo."<br>";
		}
		return $result;
		

		
		
		
		}
