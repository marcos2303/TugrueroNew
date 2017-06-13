<?php

    class Mail {
   
    function __construct() 
    {
        $this->smtp = "tugruero.com";
        $this->port = 465;
        $this->secure = "ssl";
        $this->username = "mercadeo@tugruero.com";
        $this->password = "tugruero123!";
        
    }
    
    
    
    function send($to = array(), $from = array() , $subject , $message ) 
    {
        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Create a message
        $send = Swift_Message::newInstance($subject)
          ->setFrom($from)
          ->setTo($to)
          ->setBody($message,'text/html')
          ;

        // Send the message
        $result = $mailer->send($send);        
    }
		public function mail1($values){
			
        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
			
			$message = Swift_Message::newInstance('Siga con su proceso de registro en TU/GRUERO®');
			$message->setBody("
				<html>
				<head></head>
				<body style='font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;font-size: 18px;'>
				<p align='center'><strong>Para seguir con su proceso de registro en nuestra plataforma como gruero Master, dele click al siguiente botón.</strong></p>

				<p align='center'>
				<a href='".$values['url']."'><img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/haz_click_aqui.png'))."' alt='' /></a>
				</p>
				
				
				<p align='justify'><strong>Gracias.</strong></p>
				<p align='justify'>Equipo – <strong>TU/GRUERO®</strong></p>

				<br><br>
				<p align='center'>
				<img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/logo_tugruero_mail.png'))."' alt='' />
					
				</p>
				<p align='center' style='color: #f1452b !important;font-style: italic !important;'>
					Revolucionando la industria del auxilio vial
				</p>
				</body>
				</html>","text/html");			
			
        $message  ->setFrom(array (mail_from => 'TU/GRUERO®'));
		$message   ->setTo($values['email']);
        // Send the message
        $result = $mailer->send($message); 
			return $result;
		}
		public function mail2($values){
		

        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
			
			$UsersData = new UsersData();
			$master = $UsersData->getMasterByIdCompany($values['id']);

			$login =  $master['login'];
			$name =  ucwords(strtolower($master['first_name']))." ".ucwords(strtolower($master['first_last_name']));
			
			$email =  $master['mail'];
			
			$message = Swift_Message::newInstance('Información registrada con éxito – TU/GRUERO®');
			$message->setBody("
				<html>
				<head></head>
				<body style='font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;font-size: 18px;'>
				<p align='left'><strong> <br><br>Sr(a). ".$name."</strong></p>
				
				<p align='justify'>Hemos registrado con éxito toda su información. Ahora debe esperar a que el equipo de 
				validación de proveedores apruebe su registro, después, ingresar en la página web de <strong>TU/GRUERO®</strong> 
				y registrar todas sus grúas y choferes/operadores para luego empezar a trabajar con la aplicación móvil <strong>TU/GRUERO®</strong>.</p>
				
				<p align='justify'>
				Recuerde que sus datos con los que podrá iniciar sesión en su cuenta tanto en la página web como en la aplicación móvil, son los siguientes:	

				</p>
	
				<p align='left'> - <strong> Usuario: </strong>".$login."</p>
				<p align='left'> - <strong> Clave: </strong>".$values['password']."</p>	
				<p align='left'> - <strong> Placa: </strong>".$values['placa']." (ésta solo la usará para la aplicación móvil)</p>	

				<p align='justify'>Puede cambiar su clave una vez inicie sesión, en el módulo de <strong>Modificación de Clave</strong> dentro de su cuenta.</p>


				
				<p align='justify'><strong>Gracias.</strong></p>
				<p align='justify'>Equipo – <strong>TU/GRUERO®</strong></p>

				<br><br>
				<p align='center'>
				<img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/logo_tugruero_mail.png'))."' alt='' />
					
				</p>
				<p align='center' style='color: #f1452b !important;font-style: italic !important;'>
					Revolucionando la industria del auxilio vial
				</p>
				</body>
				</html>","text/html");			
			
        $message  ->setFrom(array (mail_from => 'TU/GRUERO®'));
		$message   ->setTo($email);
        // Send the message
        $result = $mailer->send($message); 
			return $result;
		}
		public function mail3($values){
			
        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
			
			$UsersData = new UsersData();
			$master = $UsersData->getMasterByIdCompany($values['id']);
			$email = $master['mail'];
			$login =  $master['login'];
			$name =  ucwords(strtolower($master['first_name']))." ".ucwords(strtolower($master['first_last_name']));
			
			
			
			$message = Swift_Message::newInstance('¡Felicidades! Ha sido aceptado en TU/GRUERO®');
			$message->setBody("
				<html>
				<head></head>
				<body style='font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;font-size: 18px;'>
				<p align='left'><strong>Sr(a). ".$name."</strong></p>
				<p align='center' style='color: #f1452b !important;'>LEA CON DETENIMIENTO</p>

				<p align='justify'><strong>¡Felicidades!</strong> Nuestro equipo de validación de proveedores ha
				confirmado todos sus documentos y le da la bienvenida a <strong>TU/GRUERO®</strong>.</p>
				
				<p align='justify'>A partir de este momento puede iniciar sesión en la página web de <strong>TU/GRUERO®</strong> donde podrá 
				registrar sus grúas y sus choferes/operadores, para luego entrar en la aplicación 
				de <strong>TU/GRUERO®</strong> y tomar las solicitudes de servicio que tengan nuestros clientes accidentados.</p>
				
				<p align='justify'>Registre primero sus grúas disponibles y posteriormente los operadores/choferes que las conducirán.</p>
				
				<p align='justify'>Si usted mismo es quien conduce su grúa, agregue primero la grúa y luego asígnesela en el módulo <strong>Admin. Operadores</strong>.</p>
				
				<p align='justify'>EL <strong>Usuario</strong>, <strong>Placa</strong> y <strong>Clave</strong> para acceder a la página web y aplicación móvil <strong>TU/GRUERO®</strong> son 
				los que le enviamos en el correo anterior a éste. 
				Recuerde escribir ".'"<strong>V-</strong>", "<strong>E-</strong>" o "<strong>J-</strong>"'." seguido de su número de 
				identificación cuando vaya a indicar su <strong>Usuario</strong>.</p>
				
				<p align='justify'>Puede cambiar su clave una vez inicie sesión en el módulo de <strong>Modificación de Clave</strong> dentro de su cuenta.</p>
				<p align='center'>
				<a href='".full_url."/ap/index.php'><img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/inicie_sesion.png'))."' alt='' /></a>
				</p>
				
				<p align='justify'>Si aún no ha descargado la aplicación en su teléfono, le invitamos
				a buscarla en la tienda de aplicaciones de acuerdo al teléfono
				inteligente que tenga (Play Store o App Store), con el
				nombre de: <strong>Tu Gruero</strong></p>
				<p align='center'>
				<a href='#'><img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/apps_store.png'))."' alt='' /></a>
				<a href='#'><img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/google_play.png'))."' alt='' /></a>
					
				</p>
				
				<p align='justify'>Por cualquier duda en la descarga, uso y funcionalidad de la aplicación
				puede llamarnos al <strong>0212-227-5273</strong> o escribirnos a: <strong>tugruero@gmail.com</strong>.</p>
				
				<p align='left'>¡Gracias y disfrute de ofrecer el mejor	servicio de auxilio vial con <strong>TU/GRUERO®!</strong></p>
				<p align='left'>Equipo – <strong>TU/GRUERO®</strong></p>
				<br><br>
				<p align='center'>
				<img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/logo_tugruero_mail.png'))."' alt='' />
					
				</p>
				<p align='center' style='color: #f1452b !important;font-style: italic !important;'>
					Revolucionando la industria del auxilio vial
				</p>
				</body>
				</html>","text/html");			
			
        $message  ->setFrom(array (mail_from => 'TU/GRUERO®'));
		$message   ->setTo($email);
        // Send the message
        $result = $mailer->send($message); 
			return $result;
		}
		public function mail4($values){
			
			$UsersData = new UsersData();
			$master = $UsersData->getUsersDataById($values);
			$email = $master['mail'];
			$login =  $master['login'];
			$name =  ucwords(strtolower($master['first_name']))." ".ucwords(strtolower($master['first_last_name']));
			
        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
			
			$message = Swift_Message::newInstance('Recuperación de clave – TU/GRUERO®');
			$message->setBody("
				<html>
				<head></head>
				<body style='font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;font-size: 18px;'>
				<p align='left'><strong> Sr(a). ".$name."</strong></p>
				<p align='left'><label style='color: #f1452b !important;'>Esta es su nueva clave:</label> <strong>".$values['password']."</strong></p>
					
				<p align='justify'>Recuerde que esta clave puede modificarla dentro de su cuenta
				en el módulo de Modificación de Clave. Y que ésta es la misma
				tanto para el acceso a su cuenta en la Página web como en la
				Aplicación móvil.</p>
				
				<p align='justify'><strong>Gracias.</strong></p>
				<p align='justify'>Equipo – <strong>TU/GRUERO®</strong></p>

				<br><br>
				<p align='center'>
				<img src='".$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/logo_tugruero_mail.png'))."' alt='' />
					
				</p>
				<p align='center' style='color: #f1452b !important;font-style: italic !important;'>
					Revolucionando la industria del auxilio vial
				</p>
				</body>
				</html>","text/html");			
			
        $message  ->setFrom(array (mail_from => 'TU/GRUERO®'));
		$message   ->setTo($email);
        // Send the message
        $result = $mailer->send($message); 
			return $result;
		}
        public function mailMarketing1($values){
			
        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        $email = array('deandrademarcos@gmail.com','deandrademarcos@hotmail.com');
			
			$message = Swift_Message::newInstance('TU/GRUERO®');
			$message->setBody("
                            <html>
                            <body>
                            <p align='center'>
				<a href='www.tugruero.com' target='_blank'><img width='600'  src='http://www.tugruero.com/web/img/mail/flyer1.png' alt='tugruero.com' /></a>
					
                            </p>
                            <p align='justify'>Si no puede observar la imagen dele click <strong><a href='http://www.tugruero.com/tugruero.php' target='_blank'>Aquí</a></strong</p>                            
                            <p align='justify'><strong>2016. TU/GRUERO®.</strong> <strong style='color: #4C4C4C;'>Todos los Derechos Reservados.</strong></p>                            
                            </body>
                            </html>
","text/html");			
			
        $message  ->setFrom(array (mail_from => 'TU/GRUERO®'));
		$message   ->setTo($email);
        // Send the message
        $result = $mailer->send($message); 
			return $result;
		}
    function sendMessageContactenos($values){

            try{
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'mercadeo@tugruero.com'; 

            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array('deandrademarcos@gmail.com','tugruero@gmail.com','suscripcion@tugruero.com','info@tugruero.com','acostantini@tugruero.com');
            $mensaje = $values['names']." ".$values['email']." ".$values['phone']." ".$values['message'];

            $message = Swift_Message::newInstance('Solicitud de información');
            $message->setBody('<!DOCTYPE html>
    <html>

        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif, cursive;font-size: 12px;color:#262426;">
            <div align="center">
            <table width="700">
                <tr>
                    <td style="background-color:#CCC !important;"><b>Nombre y apellido:</b></td><td>'.$values['names'].'</td> 
                </tr>
                <tr>
                    <td style="background-color:#CCC !important;"><b>Correo electrónico:</b></td><td>'.$values['email'].'</td> 
                </tr>
                <tr>
                    <td style="background-color:#CCC !important;"><b>Número de contacto:</b></td><td>'.$values['phone'].'</td> 
                </tr>
                <tr>
                    <td style="background-color:#CCC !important;"><b>Mensaje:</b></td><td><p align="justify">'.$values['message'].'</p></td> 
                        
                </tr>
            </table>   
            </div>

        </body>
    </html>
    ',"text/html");			

            $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($email);
                    //$message->setBcc('info@tugruero.com');
            // Send the message


                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
    function sendMessageMercadopago($values){
            try{
            $Utilitarios = new Utilitarios();
            $idSolicitudPlan = $values['idSolicitudPlan'];
            $saludo = $Utilitarios->saludo();
            $SolicitudPlan = new SolicitudPlan();
            $data = $SolicitudPlan->getSolicitudPlanInfo($idSolicitudPlan);
            $Nombres = strtoupper($data['Nombres']);
            $Apellidos = strtoupper($data['Apellidos']);
            $ConcatenadoPlan = $data['concatenado_plan'];
            $Modelo = $data['Modelo'];
			$Marca= $data['Marca'];
			$Anio= $data['Anio'];
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'suscripcion@tugruero.com'; 
            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array($values['response']['payer']['email']);

            $message = Swift_Message::newInstance('¡Compra Plan TU/GRUERO®!');
            $message->setBody('
<!DOCTYPE html>
    <html>
        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-size: 16px;color:#000000;">
            <div align="center">
		<p align="justify">'.$saludo.', <strong>'.$Nombres.' '.$Apellidos.'</strong>, gracias por la compra del plan <strong>'.$ConcatenadoPlan.'</strong> para su vehículo <strong>'.$Marca.' '.$Modelo.' '.$Anio.'</strong></p>
		<p align="justify">Usted está a solo un paso de experimentar el excelente e innovador servicio de auxilio vial que hemos creado para usted.</p>
		<p align="justify">En este momento nuestro <strong>Departamento de Suscripción</strong> está validando los datos y documentos suministrados, y en menos de <strong>48 horas hábiles</strong> uno de nuestros agentes se estará comunicando con usted para darle oficialmente la bienvenida a la gran familia <strong>TU/GRUERO®</strong>.</p>
		<p align="justify">Es importante que sepa que el plan estará vigente <strong>5 días hábiles</strong> después que el agente le dé la confirmación de su pago</p>
		<p align="justify">¡Esté atento!</p>
		<p align="justify">Saludos.<br><br><br><br>
		<p align="justify"><strong>TU/GRUERO® quedarse accidentado, ya no es un problema.</strong></p>
		<p align="justify" style="font-size: 12px;">Para más información puede comunicarse directamente al 0500-GRUERO-0 (0500-478376-0)</p>
            </div>
            <br><br>--<br>
            <p>Equipo&nbsp;<b>TU/GRUERO</b><b>®</b></p>
            <p><b>Soluciones Tu Gruero, C.A.</b>  J-40680605-6</p>
            <p>Av Francisco de Miranda, Edif Provincial, Piso 8, Oficina 8B. Los Dos Caminos. Municipio Sucre, Edo. Miranda, Caracas, Venezuela. </p>
            <p><font style="color: #6F7DAA; ">Tlf:</font> <b><font style="color: #1B6055; ">(0500-GRUERO-0) / (0500-478376-0) / (0212) 237-9227 / (0212) 419-0105</font></b> · <a href="mailto:info@tugruero.com" style="text-decoration: none;"><font style="color:#1155D1;">info@tugruero.com</font></a>  <font style="color:#B45F06;">-</font> <a href="mailto:tugruero@gmail.com" style="text-decoration: none;"><font style="color:#1155D1;">tugruero@gmail.com</font></a></p>
            <img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/logo_correo.jpg')).'" alt="" />
            <p><b>Síguenos</b></p>
            <a target="_blank" href="https://www.instagram.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/instagram_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://twitter.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/twitter_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://www.facebook.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/facebook_correo.png')).'" alt="" /></a>
            <p><a href="http://www.tugruero.com" target="_blank" style="text-decoration: none;"><font style="color:#1155CC;font-size: 18px;"><b>www.tugruero.com</b></font></a></p>
        </body>
    </html>
    ',"text/html");			

            $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($email);
                    $message->setBcc('suscripcion@tugruero.com');
            // Send the message


                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
    function sendMessageMercadopagoVendedor($values){
            try{
            $Utilitarios = new Utilitarios();
            $idSolicitudPlan = $values['idSolicitudPlan'];
            $saludo = $Utilitarios->saludo();
            $SolicitudPlan = new SolicitudPlan();
            $data = $SolicitudPlan->getSolicitudPlanInfo($idSolicitudPlan);
            $Nombres = strtoupper($data['Nombres']);
            $Apellidos = strtoupper($data['Apellidos']);
            $ConcatenadoPlan = $data['concatenado_plan'];
            $Modelo = $data['Modelo'];
            $Marca= $data['Marca'];
            $Anio= $data['Anio'];
            $correo1_vendedor = '';
            $correo2_vendedor = '';
            $correo3_vendedor = '';
            $NombreVendedor = '';
                if(isset($data['IdV']) and $data['IdV']!=1)
                {
                    $datos_vendedor = $SolicitudPlan->getDatosVendedor($data['IdV']);
                    $correo1_vendedor = $datos_vendedor['Correo1'];
                    $correo2_vendedor = $datos_vendedor['Correo2'];
                    $correo3_vendedor = $datos_vendedor['Correo3'];
                    $NombreVendedor = $datos_vendedor['NombreVendedor'];
                    
                }
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'suscripcion@tugruero.com'; 
            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array($values['response']['payer']['email']);

            $message = Swift_Message::newInstance('¡Compra Plan TU/GRUERO®!');
            $message->setBody('
<!DOCTYPE html>
    <html>
        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-size: 16px;color:#000000;">
            <div align="center">
		<p align="justify">'.$saludo.', <strong>'.$Nombres.' '.$Apellidos.'</strong>, gracias por la compra del plan <strong>'.$ConcatenadoPlan.'</strong> para su vehículo <strong>'.$Marca.' '.$Modelo.' '.$Anio.'</strong></p>
		<p align="justify">Usted está a solo un paso de experimentar el excelente e innovador servicio de auxilio vial que hemos creado para usted, y que nuestro aliado comercial <strong>'.$NombreVendedor.'</strong> le ha ofrecido.</p>
		<p align="justify">En este momento nuestro <strong>Departamento de Suscripción</strong> está validando los datos y documentos suministrados, y en menos de <strong>48 horas hábiles</strong> uno de nuestros agentes se estará comunicando con usted para darle oficialmente la bienvenida a la gran familia <strong>TU/GRUERO®</strong>.</p>
		<p align="justify">Es importante que sepa que el plan estará vigente <strong>5 días hábiles</strong> después que el agente le dé la confirmación de su pago</p>
		<p align="justify">¡Esté atento!</p>
		<p align="justify">Saludos.<br><br><br><br>
		<p align="justify"><strong>TU/GRUERO® quedarse accidentado, ya no es un problema.</strong></p>
		<p align="justify" style="font-size: 12px;">Para más información puede comunicarse directamente al 0500-GRUERO-0 (0500-478376-0)</p>
            </div>
            <br><br>--<br>
            <p>Equipo&nbsp;<b>TU/GRUERO</b><b>®</b></p>
            <p><b>Soluciones Tu Gruero, C.A.</b>  J-40680605-6</p>
            <p>Av Francisco de Miranda, Edif Provincial, Piso 8, Oficina 8B. Los Dos Caminos. Municipio Sucre, Edo. Miranda, Caracas, Venezuela. </p>
            <p><font style="color: #6F7DAA; ">Tlf:</font> <b><font style="color: #1B6055; ">(0500-GRUERO-0) / (0500-478376-0) / (0212) 237-9227 / (0212) 419-0105</font></b> · <a href="mailto:info@tugruero.com" style="text-decoration: none;"><font style="color:#1155D1;">info@tugruero.com</font></a>  <font style="color:#B45F06;">-</font> <a href="mailto:tugruero@gmail.com" style="text-decoration: none;"><font style="color:#1155D1;">tugruero@gmail.com</font></a></p>
            <img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/logo_correo.jpg')).'" alt="" />
            <p><b>Síguenos</b></p>
            <a target="_blank" href="https://www.instagram.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/instagram_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://twitter.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/twitter_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://www.facebook.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/facebook_correo.png')).'" alt="" /></a>
            <p><a href="http://www.tugruero.com" target="_blank" style="text-decoration: none;"><font style="color:#1155CC;font-size: 18px;"><b>www.tugruero.com</b></font></a></p>
        </body>
    </html>
    ',"text/html");			

            $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($email);
                    $message->setBcc('suscripcion@tugruero.com');
                    if($correo1_vendedor!=''){
                       $message->setBcc($correo1_vendedor); 
                    }
                    if($correo2_vendedor!=''){
                       $message->setBcc($correo2_vendedor); 
                    }
                    if($correo3_vendedor!=''){
                       $message->setBcc($correo3_vendedor); 
                    }


                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
    function sendMessageDepositoPago($values){
            
            $Utilitarios = new Utilitarios();
            $idSolicitudPlan = $values['idSolicitudPlan'];
            $saludo = $Utilitarios->saludo();
            $SolicitudPlan = new SolicitudPlan();
            $data = $SolicitudPlan->getSolicitudPlanInfo($idSolicitudPlan);
            $Nombres = strtoupper($data['Nombres']);
            $Apellidos = strtoupper($data['Apellidos']);
            $Modelo = $data['Modelo'];
			$Marca= $data['Marca'];
			$Anio= $data['Anio'];
            $ConcatenadoPlan = $data['concatenado_plan'];
           
            try{
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'suscripcion@tugruero.com'; 
            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array($data['Correo']);

            $message = Swift_Message::newInstance('¡Compra Plan TU/GRUERO®!');
            $message->setBody('<!DOCTYPE html>
    <html>

        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-size: 16px;color:#000000;">
            <div align="center">
		<p align="justify">'.$saludo.', <strong>'.$Nombres.' '.$Apellidos.'</strong>, gracias por la compra del plan <strong>'.$ConcatenadoPlan.'</strong> para su vehículo <strong>'.$Marca.' '.$Modelo.' '.$Anio.'</strong></p>
		<p align="justify">Usted está a solo un paso de experimentar el excelente e innovador servicio de auxilio vial que hemos creado para usted.</p>
		<p align="justify">En este momento nuestro <strong>Departamento de Suscripción</strong> está validando los datos y documentos suministrados, y en menos de <strong>24 horas hábiles</strong> uno de nuestros agentes se estará comunicando con usted para darle oficialmente la bienvenida a la gran familia <strong>TU/GRUERO®</strong>.</p>
		<p align="justify">Es importante que sepa que el plan estará vigente <strong>5 días hábiles</strong> después que el agente le dé la confirmación de su pago</p>
		<p align="justify">¡Esté atento!</p>
		<p align="justify">Saludos.<br><br><br><br>
		<p align="justify"><strong>TU/GRUERO® quedarse accidentado, ya no es un problema.</strong></p>
		<p align="justify" style="font-size: 12px;">Para más información puede comunicarse directamente al 0500-GRUERO-0 (0500-478376-0)</p>
            </div>
            <br><br>--<br>
            <p>Equipo&nbsp;<b>TU/GRUERO</b><b>®</b></p>
            <p><b>Soluciones Tu Gruero, C.A.</b>  J-40680605-6</p>
            <p>Av Francisco de Miranda, Edif Provincial, Piso 8, Oficina 8B. Los Dos Caminos. Municipio Sucre, Edo. Miranda, Caracas, Venezuela. </p>
            <p><font style="color: #6F7DAA; ">Tlf:</font> <b><font style="color: #1B6055; ">(0500-GRUERO-0) / (0500-478376-0) / (0212) 237-9227 / (0212) 419-0105</font></b> · <a href="mailto:info@tugruero.com" style="text-decoration: none;"><font style="color:#1155D1;">info@tugruero.com</font></a>  <font style="color:#B45F06;">-</font> <a href="mailto:tugruero@gmail.com" style="text-decoration: none;"><font style="color:#1155D1;">tugruero@gmail.com</font></a></p>
            <img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/logo_correo.jpg')).'" alt="" />
            <p><b>Síguenos</b></p>
            <a target="_blank" href="https://www.instagram.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/instagram_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://twitter.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/twitter_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://www.facebook.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/facebook_correo.png')).'" alt="" /></a>
            <p><a href="http://www.tugruero.com" target="_blank" style="text-decoration: none;"><font style="color:#1155CC;font-size: 18px;"><b>www.tugruero.com</b></font></a></p>
        </body>
    </html>
    ',"text/html");			

            $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($values['Correo']);
                    $message->setBcc('suscripcion@tugruero.com');
					

            // Send the message


                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
    function sendMessageDepositoPagoVendedor($values){
            
            $Utilitarios = new Utilitarios();
            $idSolicitudPlan = $values['idSolicitudPlan'];
            $saludo = $Utilitarios->saludo();
            $SolicitudPlan = new SolicitudPlan();
            $data = $SolicitudPlan->getSolicitudPlanInfo($idSolicitudPlan);
            $Nombres = strtoupper($data['Nombres']);
            $Apellidos = strtoupper($data['Apellidos']);
            $Modelo = $data['Modelo'];
            $Marca= $data['Marca'];
            $Anio= $data['Anio'];
            $correo1_vendedor = '';
            $correo2_vendedor = '';
            $correo3_vendedor = '';
            $ConcatenadoPlan = $data['concatenado_plan'];
					//envío la aprobacion al vendedor
                if(isset($data['IdV']) and $data['IdV']!=1)
                {
                    $datos_vendedor = $SolicitudPlan->getDatosVendedor($data['IdV']);
                    $correo1_vendedor = $datos_vendedor['Correo1'];
                    $correo2_vendedor = $datos_vendedor['Correo2'];
                    $correo3_vendedor = $datos_vendedor['Correo3'];
                    $NombreVendedor = $datos_vendedor['NombreVendedor'];
                    
                }
            try{
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'suscripcion@tugruero.com'; 
            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array($data['Correo']);

            $message = Swift_Message::newInstance('¡Compra Plan TU/GRUERO®!');
            $message->setBody('<!DOCTYPE html>
    <html>

        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-size: 16px;color:#000000;">
            <div align="center">
		<p align="justify">'.$saludo.', <strong>'.$Nombres.' '.$Apellidos.'</strong>, gracias por la compra del plan <strong>'.$ConcatenadoPlan.'</strong> para su vehículo <strong>'.$Marca.' '.$Modelo.' '.$Anio.'</strong></p>
		<p align="justify">Usted está a solo un paso de experimentar el excelente e innovador servicio de auxilio vial que hemos creado para usted, y que nuestro aliado comercial <strong>'.$NombreVendedor.'</strong> le ha ofrecido.</p>
		<p align="justify">En este momento nuestro <strong>Departamento de Suscripción</strong> está validando los datos y documentos suministrados, y en menos de <strong>24 horas hábiles</strong> uno de nuestros agentes se estará comunicando con usted para darle oficialmente la bienvenida a la gran familia <strong>TU/GRUERO®</strong>.</p>
		<p align="justify">Es importante que sepa que el plan estará vigente <strong>5 días hábiles</strong> después que el agente le dé la confirmación de su pago</p>
		<p align="justify">¡Esté atento!</p>
		<p align="justify">Saludos.<br><br><br><br>
		<p align="justify"><strong>TU/GRUERO® quedarse accidentado, ya no es un problema.</strong></p>
		<p align="justify" style="font-size: 12px;">Para más información puede comunicarse directamente al 0500-GRUERO-0 (0500-478376-0)</p>
            </div>
            <br><br>--<br>
            <p>Equipo&nbsp;<b>TU/GRUERO</b><b>®</b></p>
            <p><b>Soluciones Tu Gruero, C.A.</b>  J-40680605-6</p>
            <p>Av Francisco de Miranda, Edif Provincial, Piso 8, Oficina 8B. Los Dos Caminos. Municipio Sucre, Edo. Miranda, Caracas, Venezuela. </p>
            <p><font style="color: #6F7DAA; ">Tlf:</font> <b><font style="color: #1B6055; ">(0500-GRUERO-0) / (0500-478376-0) / (0212) 237-9227 / (0212) 419-0105</font></b> · <a href="mailto:info@tugruero.com" style="text-decoration: none;"><font style="color:#1155D1;">info@tugruero.com</font></a>  <font style="color:#B45F06;">-</font> <a href="mailto:tugruero@gmail.com" style="text-decoration: none;"><font style="color:#1155D1;">tugruero@gmail.com</font></a></p>
            <img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/logo_correo.jpg')).'" alt="" />
            <p><b>Síguenos</b></p>
            <a target="_blank" href="https://www.instagram.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/instagram_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://twitter.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/twitter_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://www.facebook.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/facebook_correo.png')).'" alt="" /></a>
            <p><a href="http://www.tugruero.com" target="_blank" style="text-decoration: none;"><font style="color:#1155CC;font-size: 18px;"><b>www.tugruero.com</b></font></a></p>
        </body>
    </html>
    ',"text/html");			

            $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($values['Correo']);
                    $message->setBcc('suscripcion@tugruero.com');
                    if($correo1_vendedor!=''){
                       $message->setBcc($correo1_vendedor); 
                    }
                    if($correo2_vendedor!=''){
                       $message->setBcc($correo2_vendedor); 
                    }
                    if($correo3_vendedor!=''){
                       $message->setBcc($correo3_vendedor); 
                    }

            // Send the message


                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
    function sendMessagePolizaBienvenida($values){
            
            $Utilitarios = new Utilitarios();
            $idSolicitudPlan = $values['idSolicitudPlan'];
            $saludo = $Utilitarios->saludo();
            $SolicitudPlan = new SolicitudPlan();
            $data = $SolicitudPlan->getSolicitudPlanInfo($idSolicitudPlan);
			$data_aprobada = $SolicitudPlan->getSolicitudPlanAprobadaInfo($idSolicitudPlan);
			$NumProducto = $data_aprobada['NumProducto'];
			$Cedula = strtoupper($data['Cedula']);
			$Placa= strtoupper($data['Placa']);
            $Nombres = strtoupper($data['Nombres']);
            $Apellidos = strtoupper($data['Apellidos']);
            $ConcatenadoPlan = $data['concatenado_plan'];
            $plan_tugruero = $data['plan_tugruero'];
                if(isset($data['IdV']) and $data['IdV']!=1)
                {
                    $datos_vendedor = $SolicitudPlan->getDatosVendedor($data['IdV']);
                    $correo1_vendedor = $datos_vendedor['Correo1'];
                    $correo2_vendedor = $datos_vendedor['Correo2'];
                    $correo3_vendedor = $datos_vendedor['Correo3'];
                    $NombreVendedor = $datos_vendedor['NombreVendedor'];
                    
                }
            try{
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'suscripcion@tugruero.com'; 
            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array($data_aprobada['Correo']);

            $message = Swift_Message::newInstance('¡Felicidades! ¡Bienvenido a TU/GRUERO®!');
            $message->setBody('<!DOCTYPE html>
    <html>

        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-size: 16px;color:#000000;">
            <div align="">
		<p align="justify">'.$saludo.', <strong>'.$Nombres.' '.$Apellidos.'</strong>, tenemos el agrado de decirle que toda su información fue verificada y aprobada por nuestro <strong>Departamento de Suscripción</strong>.</p>
		<p align="justify">Por ende, le queremos dar la más cordial <strong>¡Bienvenida a la familia TU/GRUERO®!</strong></p>
		<p align="justify">A continuación le indicamos los datos para acceder a la <strong>aplicación móvil TU/GRUERO®</strong> y solicitar los servicios de grúa por esa vía:</p>
		<p align="left">
                    <ul align="left">
                        <li align="left">
                            <strong>Cédula: '.$Cedula.'</strong>
                        </li>
                        <li align="left">
                            <strong>Placa: '.$Placa.'</strong>
                        </li>
                        <li align="left">
                            <strong>Seguro: '.$plan_tugruero.'</strong>
                        </li>
                    </ul>
                </p>
		<br><br>
		<p align="justify">¡Esté atento!</p>

		<p align="justify">De igual forma puede solicitar sus servicios de grúa a través de nuestro Call Center al <strong>0500-GRUERO-0 (0500-478376-0)</strong> </p>

		<p align="justify">Le adjuntamos a este correo el <strong>Cuadro Producto</strong> contratado, donde podrá ver su información personal y la del vehículo cubierto por el plan.</p>

		<p align="justify">Es importante que sepa que usted estará activo tanto en el plan como en la aplicación móvil en <strong>5 días habiles</strong> a partir del día de hoy.</p>

		<p align="justify">Saludos.<br><br><br><br>
		<p align="justify"><strong>TU/GRUERO® quedarse accidentado, ya no es un problema.</strong></p>
		<p align="justify" style="font-size: 12px;">Para más información puede comunicarse directamente al 0500-GRUERO-0 (0500-478376-0)</p>
            </div>
			<br><br>--<br>
            <p>Equipo&nbsp;<b>TU/GRUERO</b><b>®</b></p>
            <p><b>Soluciones Tu Gruero, C.A.</b>  J-40680605-6</p>
            <p>Av Francisco de Miranda, Edif Provincial, Piso 8, Oficina 8B. Los Dos Caminos. Municipio Sucre, Edo. Miranda, Caracas, Venezuela. </p>
            <p><font style="color: #6F7DAA; ">Tlf:</font> <b><font style="color: #1B6055; ">(0500-GRUERO-0) / (0500-478376-0) / (0212) 237-9227 / (0212) 419-0105</font></b> · <a href="mailto:info@tugruero.com" style="text-decoration: none;"><font style="color:#1155D1;">info@tugruero.com</font></a>  <font style="color:#B45F06;">-</font> <a href="mailto:tugruero@gmail.com" style="text-decoration: none;"><font style="color:#1155D1;">tugruero@gmail.com</font></a></p>
            <img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/logo_correo.jpg')).'" alt="" />
            <p><b>Síguenos</b></p>
            <a target="_blank" href="https://www.instagram.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/instagram_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://twitter.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/twitter_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://www.facebook.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/facebook_correo.png')).'" alt="" /></a>
            <p><a href="http://www.tugruero.com" target="_blank" style="text-decoration: none;"><font style="color:#1155CC;font-size: 18px;"><b>www.tugruero.com</b></font></a></p>
		</div>

        </body>
    </html>
    ',"text/html");			
					$message->attach(Swift_Attachment::fromPath(dir_cuadros."/".$NumProducto.".pdf")); 
					$planes_rcv = $SolicitudPlan->getPlanesRCV($idSolicitudPlan);
					if(isset($planes_rcv['idPlan']) and $planes_rcv['idPlan']!=''){
						$message->attach(Swift_Attachment::fromPath(dir_cuadros."/".$idSolicitudPlan."_rcv.pdf")); 	
					}
					
                    $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($email);

                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
    function sendMessagePolizaBienvenidaRCV($values){
            
            $Utilitarios = new Utilitarios();
            $idSolicitudPlan = $values['idSolicitudPlan'];
            $saludo = $Utilitarios->saludo();
            $SolicitudPlan = new SolicitudPlan();
            $data = $SolicitudPlan->getSolicitudPlanInfo($idSolicitudPlan);
			$data_aprobada = $SolicitudPlan->getSolicitudPlanAprobadaInfo($idSolicitudPlan);
			$NumProducto = $data_aprobada['NumProducto'];
			$Cedula = strtoupper($data['Cedula']);
			$Placa= strtoupper($data['Placa']);
            $Nombres = strtoupper($data['Nombres']);
            $Apellidos = strtoupper($data['Apellidos']);
            $ConcatenadoPlan = $data['concatenado_plan'];
            $plan_tugruero = $data['plan_tugruero'];
                if(isset($data['IdV']) and $data['IdV']!=1)
                {
                    $datos_vendedor = $SolicitudPlan->getDatosVendedor($data['IdV']);
                    $correo1_vendedor = $datos_vendedor['Correo1'];
                    $correo2_vendedor = $datos_vendedor['Correo2'];
                    $correo3_vendedor = $datos_vendedor['Correo3'];
                    $NombreVendedor = $datos_vendedor['NombreVendedor'];
                    
                }
            try{
            //$smtp = "server-0116a.gconex.net";
            $smtp = "tugruero.com";
            $port = 465;
            $secure = "ssl";
            $username = "mercadeo@tugruero.com";
            $password = "tugruero123!";
            $mail_from = 'suscripcion@tugruero.com'; 
            $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
              ->setUsername($username)
              ->setPassword($password);
            $mailer = Swift_Mailer::newInstance($transport);
            $email = array($data_aprobada['Correo']);

            $message = Swift_Message::newInstance('¡Felicidades! ¡Bienvenido a TU/GRUERO®!');
            $message->setBody('<!DOCTYPE html>
    <html>

        <head>
            <title>TU/GRUERO®</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="font-size: 16px;color:#000000;">
            <div align="">
		<p align="justify">'.$saludo.', <strong>'.$Nombres.' '.$Apellidos.'</strong>, tenemos el agrado de decirle que toda su información fue verificada y aprobada por nuestro <strong>Departamento de Suscripción</strong>.</p>
		<p align="justify">Por ende, le queremos dar la más cordial <strong>¡Bienvenida a la familia TU/GRUERO®!</strong></p>
		<br><br>
		<p align="justify">¡Esté atento!</p>

		<p align="justify">De igual forma puede solicitar sus servicios de grúa a través de nuestro Call Center al <strong>0500-GRUERO-0 (0500-478376-0)</strong> </p>

		<p align="justify">Le adjuntamos a este correo el <strong>Cuadro RCV</strong> contratado, donde podrá ver su información personal y la del vehículo cubierto por el plan.</p>

		<p align="justify">Es importante que sepa que usted estará activo en <strong>5 días habiles</strong> a partir del día de hoy.</p>

		<p align="justify">Saludos.<br><br><br><br>
		<p align="justify"><strong>TU/GRUERO® quedarse accidentado, ya no es un problema.</strong></p>
		<p align="justify" style="font-size: 12px;">Para más información puede comunicarse directamente al 0500-GRUERO-0 (0500-478376-0)</p>
            </div>
			<br><br>--<br>
            <p>Equipo&nbsp;<b>TU/GRUERO</b><b>®</b></p>
            <p><b>Soluciones Tu Gruero, C.A.</b>  J-40680605-6</p>
            <p>Av Francisco de Miranda, Edif Provincial, Piso 8, Oficina 8B. Los Dos Caminos. Municipio Sucre, Edo. Miranda, Caracas, Venezuela. </p>
            <p><font style="color: #6F7DAA; ">Tlf:</font> <b><font style="color: #1B6055; ">(0500-GRUERO-0) / (0500-478376-0) / (0212) 237-9227 / (0212) 419-0105</font></b> · <a href="mailto:info@tugruero.com" style="text-decoration: none;"><font style="color:#1155D1;">info@tugruero.com</font></a>  <font style="color:#B45F06;">-</font> <a href="mailto:tugruero@gmail.com" style="text-decoration: none;"><font style="color:#1155D1;">tugruero@gmail.com</font></a></p>
            <img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/logo_correo.jpg')).'" alt="" />
            <p><b>Síguenos</b></p>
            <a target="_blank" href="https://www.instagram.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/instagram_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://twitter.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/twitter_correo.png')).'" alt="" /></a>
            <a target="_blank" href="https://www.facebook.com/tugruero"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/fresh/facebook_correo.png')).'" alt="" /></a>
            <p><a href="http://www.tugruero.com" target="_blank" style="text-decoration: none;"><font style="color:#1155CC;font-size: 18px;"><b>www.tugruero.com</b></font></a></p>
		</div>

        </body>
    </html>
    ',"text/html");			 
					$planes_rcv = $SolicitudPlan->getPlanesRCV($idSolicitudPlan);
					if(isset($planes_rcv['idPlan']) and $planes_rcv['idPlan']!=''){
						$message->attach(Swift_Attachment::fromPath(dir_cuadros."/".$idSolicitudPlan."_rcv.pdf")); 	
					}
					
                    $message->setFrom(array ($mail_from => 'TU/GRUERO®'));
                    $message->setTo($email);

                    $result = $mailer->send($message);	
                    }catch(Exception $e){
                            //echo $e->getMessage().$e->getTraceAsString();
                            die;
                    }






    }
}

