<?php
include("../notorm-master/NotORM.php");
include("../ConnectionORM.class.php");
include("../vendors/swiftmailer/lib/swift_required.php");

mailMarketing1(null);



function mailMarketing1($values){
$id_marketing = 2;
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->mail_marketing1
			->select("*")
			->where("status=?",0)
			->and('id_marketing=?',$id_marketing)
			->limit(50)
			->order("id desc");
		$array_correos = array();
		foreach ($q as $emails){
			
			$array_correos[] = $emails['correo'];
			
		

		//print_r($array_correos);die;
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
			$message = Swift_Message::newInstance('TU/GRUERO® Plus. ¡Tu plan de grúas ilimitado!');
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
                       <a href="http://www.tugruero.com" target="_blank"><img alt="www.tugruero.com" src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/header2.png')).'"></a>
                   </td>
               </tr>
               <tr>
                   <td style="font-size: 40px; font-weight: 800;padding-top: 0px;" align="center"><strong>Un plan de grúas</strong></td>
               </tr>
               <tr>
                   <td style="font-size: 30px;padding-top: 0px;" align="center">anual para que manejes</td>
               </tr>
               <tr>
                   <td align="center" style="font-size: 30px;padding-top: 0px;">tranquilo en todo el país</td>
               </tr>
               <tr>
                   <td>&nbsp;</td>
               </tr>
               <tr>
                   <td style="background-color: #E9E9E9;">
                       <table width="100%">
                           <tr>
                               <td style="padding-top: 0px;">
                                   <label style="font-size: 40px; color:#CA512A;"><a href="http://www.tugruero.com" style="text-decoration: none;color:#CA512A;" target="_blank"><strong>Incluye:</strong></a></label>
                                    <ul style="font-weight: 900;">
                                        <li style="padding-bottom: 10px; font-size: 20px;"><a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank">Servicios de grúa ilimitados a nivel nacional. 24 horas - 365 días.</a></li>
                                        <li style="padding-bottom: 10px; font-size: 20px;"><a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank">Rescate en menos de 30 minutos.</a></li>
                                        <li style="padding-bottom: 10px; font-size: 20px;"><a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank">Más de 2000 grueros en todo el país.</a></li>
                                        <li style="padding-bottom: 10px; font-size: 20px;"><a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank">Búsqueda del gruero más cercano por GPS.</a></li>
                                        <li style="padding-bottom: 10px; font-size: 20px;" ><a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank">Los grueros más calificados del mercado.</a></li>
                                    </ul>   
                               </td>
                               <td align="center">
                                   <a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank"><img alt="www.tugruero.com" src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_rapidez.png')).'"></a><br>
                                   <a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank"><img alt="www.tugruero.com" src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_comodidad.png')).'"></a><br>
                                   <a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank"><img alt="www.tugruero.com" src="'.$message->embed(Swift_Image::fromPath('http://www.tugruero.com/web/img/mail/icono_seguridad.png')).'"></a><br>
                               </td>
                           </tr>
                           
                           <tr>
                               <td colspan="2">
                                   <table width="100%" border="0">
                                       <tr>
                                           <td width="33%" align="right" style="color:#CA512A;">_________________________</td>
                                          
                                           <td align="center" style="padding-top: 10px;"><label style="font-size: 20px; color:#CA512A;"><strong>Válido por 1 año</strong></label></td>                                           
                                           <td width="33%" align="left" style="color:#CA512A;">_________________________</td>
                                       </tr>

                                   </table>
                               </td>
                               
                               
                               
                           </tr>
                           
                           
                       </table>
                       
                       
                   </td>
                   
                   
               </tr>
               
               
               
               <tr>
                   <td style="font-size: 25px; font-weight: 800" align="center">
                        <a href="http://www.tugruero.com" style="text-decoration: none;color:#262426;" target="_blank">¡ADQUIERELO YA!</a>
                   </td>
               </tr>
               <tr>
                   <td style="font-size: 25px; font-weight: 800" align="center">
                       0212-227-1492&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0212-419-0105
                   </td>
               </tr>
               <tr>
                   <td align="center" style="background-color: #E7E9EB; font-size: 20px">
                       <a href="http://www.tugruero.com" style="text-decoration: none; color:#f46830;font-weight: 800; font-size: 25px; ">www.tugruero.com</a>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="https://www.instagram.com/tugruero/" style="text-decoration: none; color:#f46830;font-weight: 800; font-size: 25px; ">@tugruero</a>
                   </td>
               </tr>
               <tr>
                   <td align="center" style="font-size: 18px;">Av. Francisco de Miranda Edif. Provincial, piso 8, ofic 8-B Los dos Caminos. Caracas, Venezuela</td>
               </tr>               
           </table>
           <p align="center"><strong style="font-size: 14px;">2016. TU/GRUERO®.</strong> <strong style="color: #4C4C4C;font-size: 14px;">Todos los Derechos Reservados.</strong></p>
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
				'id_marketing' => $id_marketing
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