<?php
class Push{

  function sendGoogleCloudMessage( $values,$ids,$notification )
  {

      //------------------------------
      // Replace with real GCM API
      // key from Google APIs Console
      //
      // https://code.google.com/apis/console/
      //------------------------------

      $apiKey = 'AIzaSyBFeSlIAjDg8U7zsWW82uJCNLi3IZxq9fI';

      //------------------------------
      // Define URL to GCM endpoint
      //------------------------------

      $url = 'https://android.googleapis.com/gcm/send';

      //------------------------------
      // Set GCM post variables
      // (Device IDs and push payload)
      //------------------------------

      $post = array(
                      'registration_ids'  => $ids,
                      'notification' => $notification,
					  'data' => array("IdServicio" => $values['IdServicio'])

                      );

      //------------------------------
      // Set CURL request headers
      // (Authentication and type)
      //------------------------------

      $headers = array(
                          'Authorization: key=' . $apiKey,
                          'Content-Type: application/json'
                      );

      //------------------------------
      // Initialize curl handle
      //------------------------------

      $ch = curl_init();

      //------------------------------
      // Set URL to GCM endpoint
      //------------------------------

      curl_setopt( $ch, CURLOPT_URL, $url );

      //------------------------------
      // Set request method to POST
      //------------------------------

      curl_setopt( $ch, CURLOPT_POST, true );

      //------------------------------
      // Set our custom headers
      //------------------------------

      curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

      //------------------------------
      // Get the response back as
      // string instead of printing it
      //------------------------------

      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

      //------------------------------
      // Set post data as JSON
      //------------------------------

      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );

      //------------------------------
      // Actually send the push!
      //------------------------------

      $result = curl_exec( $ch );

      //------------------------------
      // Error? Display it!
      //------------------------------

      if ( curl_errno( $ch ) )
      {
          echo 'GCM error: ' . curl_error( $ch );
      }

      //------------------------------
      // Close curl handle
      //------------------------------

      curl_close( $ch );

      //------------------------------
      // Debug GCM response
      //------------------------------

      return $result;
  }

  function sendPushFirebase($values,$ids,$data){
//$url = "https://code.google.com/apis/console/#project:tugruero-19680";
$url = 'https://fcm.googleapis.com/fcm/send';
	$data["Modelo"] = $values['Modelo'];
	$data["Inicio"] = $values['Inicio'];
	$data["AveriaNombre"] = $values['AveriaNombre'];
	$data["CodigoServicio"] = $values['CodigoServicio'];
	$data["LatitudOrigen"] = $values["LatitudOrigen"];
	$data["LongitudOrigen"] = $values["LongitudOrigen"];
	$data["LatitudDestino"] = $values["LatitudDestino"];
	$data["LongitudDestino"] = $values["LongitudDestino"];
	$data["IdEstatus"] = $values["IdEstatus"];
    $fields = array(
         'registration_ids' => $ids,
		 'data' => $data,
		 
         //'data' => array("IdServicio" => $values['IdServicio'])

        );
	//print_r($notification);die;
    $headers = array(
        'Authorization:key = AAAAov3-Dnw:APA91bHokwmlK8Qpxa6YEU0sPby5UGu66AoqrnirlkQJO62yEPJ33JNsf26V1_qeJEsg_-jdCVYnngQEvYL55CEY4UlPVxZS3kKAOL236y4XjAxYk72EtMoq_d7IrWWUw6ag6g3hBbcA',
        'Content-Type: application/json'
        );
   $ch = curl_init(); 
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   $result = curl_exec($ch);           
   if ($result === FALSE) {
       die('Curl failed: ' . curl_error($ch));
   }
   curl_close($ch);
   return $result;
  }
  function despacharPush($values){
		
		$IdServicio = $values["IdServicio"];
		
		$data = $this->formateaServicio($IdServicio);
		$tokens = array();
		//print_r($datos_servicio);die;
		switch ($data["IdEstatus"]){
			case "1":
				if($values['IdAplicacion'] == 2)//viene desde el cliente una nueva solicitud
				{
					
					$data["body"] = "¡Nuevo servicio de Grúa!";
					$data["title"] = "TU/GRUERO®";
					$data["sound"] = "default";
					$data["content-available"] = "1";
					
					//array de grueros
					$Gruas = new Gruas();
					//Busqueda de todos los grueros
					$gruas_disponibles = $Gruas->getGruasServicio($values, 0.10);
					foreach ($gruas_disponibles as $grua) {
						$tokens[] = $grua["Token"];

					}
					
					$envio = $this->sendPush($data,$tokens);
				}
			
				
				//echo ($envio);
				break;
			case "2":
				if($values['IdAplicacion'] == 2)//viene desde el cliente una nueva solicitud
				{
					
					$data["body"] = "¡Nuevo servicio de Grúa!";
					$data["title"] = "TU/GRUERO®";
					$data["sound"] = "default";
					$data["content-available"] = "1";
					//array de grueros
					$Gruas = new Gruas();
					//Busqueda de todos los grueros
					$gruas_disponibles = $Gruas->getGruasServicio($values, 0.10);
					foreach ($gruas_disponibles as $grua) {
						$tokens[] = $grua["Token"];

					}
					
					$envio = $this->sendPush($data,$tokens);
				}
				break;
			case "3":
				if($values['IdAplicacion'] == 1)//viene desde el gruero la aceptacion de la solicitud. Se le envia al cliente
				{
					
					$data["body"] = "Un gruero ha aceptado su solicitud.";
					$data["title"] = "TU/GRUERO®";
					$data["sound"] = "default";
					$data["content-available"] = "1";
					//Token del cliente
					$tokens = array(
						$data['ClienteToken']

					);
					$envio = $this->sendPush($data,$tokens);
				}
				break;
			case "4":
				if($values['IdAplicacion'] == 1)//viene desde el gruero diciendo que se encuentra en el sitio con el cliente
				{
					
					$data["body"] = "El gruero ha indicado que se encuentra con usted.";
					$data["title"] = "TU/GRUERO®";
					$data["sound"] = "default";
					$data["content-available"] = "1";
					//Token del cliente
					$tokens = array(
						$data['ClienteToken']

					);
					$envio = $this->sendPush($data,$tokens);
				}
				break;
			case "5":
				if($values['IdAplicacion'] == 2)//viene desde el cliente la confirmación del gruero en sitio
				{
					
					$data["body"] = "El cliente indicó que se encuentra con usted.";
					$data["title"] = "TU/GRUERO®";
					$data["sound"] = "default";
					$data["content-available"] = "1";
					//Token del cliente
					$tokens = array(
						$data['GrueroToken']

					);
					$envio = $this->sendPush($data,$tokens);
				}
				break;
		}
  }
  function formateaServicio($IdServicio){
		$values["IdServicio"] = $IdServicio;
		$Servicios = new Servicios();
		$datos_servicio = $Servicios->getServiciosInfo($values);  
		foreach($datos_servicio as $key => $value){

			$response[$key] = $value;

		}
		
		return $response;

		
  }
  function sendPush($data,$tokens){
	
	$url = 'https://fcm.googleapis.com/fcm/send';



	
    $fields = array(
         'registration_ids' => $tokens,
		 'data' => $data,
		 
         //'data' => array("IdServicio" => $values['IdServicio'])

        );
	//print_r($notification);die;
    $headers = array(
        'Authorization:key = AAAAov3-Dnw:APA91bHokwmlK8Qpxa6YEU0sPby5UGu66AoqrnirlkQJO62yEPJ33JNsf26V1_qeJEsg_-jdCVYnngQEvYL55CEY4UlPVxZS3kKAOL236y4XjAxYk72EtMoq_d7IrWWUw6ag6g3hBbcA',
        'Content-Type: application/json'
        );
   $ch = curl_init(); 
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   $result = curl_exec($ch);           
   if ($result === FALSE) {
       die('Curl failed: ' . curl_error($ch));
   }
   curl_close($ch);
   return $result;  
  }
  
}
