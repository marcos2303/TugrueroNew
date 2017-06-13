<?php
include("../notorm-master/NotORM.php");
include("../ConnectionORM.class.php");
include("../vendors/swiftmailer/lib/swift_required.php");

mailMarketing1(null);



function mailMarketing1($values){
$id_marketing = 1;
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->mail_marketing1
			->select("*")
			->where("status=?",0)
			->and('id_marketing=?',$id_marketing)
			->limit(50)
			->order("id asc");
		$array_correos = array();
		foreach ($q as $emails){
			
			$array_correos[] = $emails['correo'];
			
		

		/*print_r($array_correos);
		die;*/
		try{
        //$smtp = "server-0116a.gconex.net";
		$smtp = "mail.tugruero.com";
        $port = 465;
        $secure = "ssl";
        $username = "mercadeo@tugruero.com";
        $password = "tugruero123";
		$mail_from = 'mercadeo@tugruero.com'; 
	
        $transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
          ->setUsername($username)
          ->setPassword($password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
       //$email = array('deandrademarcos@gmail.com','deandrademarcos@hotmail.com');
		$email = $emails['correo'];
			$message = Swift_Message::newInstance('TU/GRUERO®. ¡Grúas en menos de 30 minutos!');
			$message->setBody('<!DOCTYPE html>
<html>
    
    <head>
        <title>TU/GRUERO®</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif, cursive;font-size: 18.75px;color:#262426;">
        <div align="center">
            <table width="700">
               <tr>
                   <td style="" align="center">
                       <a href="http://www.tugruero.com/tugruero.php" target="_blank"><img alt="www.tugruero.com" src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/header1.png')).'"></a>
                   </td>
               </tr>
               <tr>
                   <td>&nbsp;</td>
               </tr>
               <tr>
                   <td style="color:#f46830; font-size: 30px;" align="center"><a href="http://www.tugruero.com/tugruero.php" target="_blank">Somos <strong>TU/GRUERO®</strong></a></td>
               </tr>
               <tr>
                   <td style="font-size: 28px;" align="center">¡El mejor servicio de grúas en todo el país!</td>
               </tr>
               <tr>
                   <td align="center" style="padding-top: 10px;font-size: 28px;"><strong>TU/GRUERO</strong> llegó para mejorar por</td>
               </tr>
               <tr>
                   <td align="center" style="font-size: 28px;">completo la industria del auxilio víal, para <strong>¡SIEMPRE!</strong></td>
               </tr>
               <tr>
                   <td>&nbsp;</td>
               </tr>
               <tr>
                   <td align="center">
                       <table width="90%">
                           <tr>
                               <td align="center" style="border-width:3px;border-style:dashed;border-color: #F19700;font-weight: 900; font-size: 40px;"><a href="http://www.tugruero.com" target="_blank">BENEFICIOS DE <img alt="www.tugruero.com" src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/logo_plus.png')).'"></a></td>
                           </tr>
                       </table>
                   </td>
               </tr>
               <tr>
                   <td>
                       <ul style="font-weight: 900;">
                           <li style="padding-bottom: 10px;"><a href="http://www.tugruero.com" target="_blank">Servicios de grúas y taxis en toda Venezuela. 24/7 y los 365 días del año.</a></li>
                           <li style="padding-bottom: 10px;"><a href="http://www.tugruero.com" target="_blank">Rescate en menos de 30 minutos.</a></li>
                           <li style="padding-bottom: 10px;"><a href="http://www.tugruero.com" target="_blank">Más de 2000 grueros a nivel nacional.</a></li>
                           <li style="padding-bottom: 10px;"><a href="http://www.tugruero.com" target="_blank">Búsqueda por GPS al gruero más cercano.</a></li>
                           <li style="padding-bottom: 10px;"><a href="http://www.tugruero.com" target="_blank">Nuestros grueros son los más calificados del país.</a></li>
                       </ul>
                   </td>
               </tr>
               <tr>
                   <td align="center">
                       <a href="http://www.tugruero.com" target="_blank"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_grua.png')).'" alt="www.tugruero.com"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="http://www.tugruero.com" target="_blank"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_call.png')).'" alt="www.tugruero.com"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="http://www.tugruero.com" target="_blank"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_gps.png')).'" alt="www.tugruero.com"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="http://www.tugruero.com" target="_blank"><img src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_check.png')).'" alt="www.tugruero.com"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                   </td>
               </tr>
               <tr>
                   <td align="center" style="background-color: #E7E9EB; font-size: 20px"><a href="http://www.tugruero.com" target="_blank">Visita nuestra página web <label style="text-decoration: none; color:#f46830;font-weight: 800; font-size: 25px; ">www.tugruero.com</label></a></td>
               </tr>
               <tr>
                   <td align="center" style="color:#666467;font-size: 14px;">Llámanos al <strong>0212-237-0491 / 0212-237-9762</strong> </td>
               </tr>
               <tr>
                   <td align="center" style="font-size: 12px;">Av. Francisco de Miranda Edif. Provincial, piso 8, ofic 8-B Los dos Caminos. Caracas, Venezuela</td>
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
			$error = array(
				'error' => $e->getMessage(),
				'fecha' => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600))),
				'id_marketing' => $id_marketing,
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->errores_mail()->insert($error);
			die;
		}
		
		}

		
		
		foreach($q as $correo){
			$update = array(
				'status' => 1,
				'fec_envio' => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)))
				);
			$id = $correo['id'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->mail_marketing1("id" , $id)->update($update);
		}
		//return $result;
		

		
		
		
		}