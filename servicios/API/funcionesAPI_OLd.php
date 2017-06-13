<?php

function ubicarGruas($link, $obj, $idSolicitud) {
//    $mLat = ($obj["latOrigen"]);
//    $mLng = ($obj["lngOrigen"]);

    $mGruas = getGruas($link, $obj["latOrigen"], $obj["lngOrigen"], 0.03);

    if ($mGruas["Error"]) {
        print_r($mGruas);
        exit();
    }

    if (count($mGruas) > 0) {
        AlmacenarGruas($link, $idSolicitud, $mGruas);
        NuevaSolicitudPUSH($mGruas, $idSolicitud, $obj);
        //SendPush($idSolicitud, $mGruas, $obj);
        //    printf("Exito, enviando Push a: %s\n", count($mGruas));
    } else {
        //   printf("Alerta: %s\n", "No se encontraron gruas en 5KM");
        //   printf("Alerta: %s\n", "Ampliando radio de búsqueda a 10KM");

        $mGruas2 = getGruas($link, $obj["latOrigen"], $obj["lngOrigen"], 0.07);

        if ($mGruas2["Error"]) {
            print_r($mGruas2);
            exit();
        }
        if (count($mGruas2) > 0) {
            AlmacenarGruas($link, $idSolicitud, $mGruas2);
            NuevaSolicitudPUSH($mGruas2, $idSolicitud, $obj);
            //  SendPush($idSolicitud, $mGruas2, $obj);
        } else {
            //     printf("Alerta: %s\n", "No se encontraron gruas, declarar solicitud desierta id:".$idSolicitud);
            solicitudDesierta($link, $idSolicitud);
        }
    }
}

//------------------------------
//Ubicando gruas dentro de un radio de búsqueda
//igual a $grados, 0.03 = 5Km y 0.07=10Km
//------------------------------
function getGruas($mLink, $mLat, $mLng, $grados) {

    $mTopes = array(
        'supLat' => $mLat + $grados,
        'infLat' => $mLat - $grados,
        'supLng' => $mLng + $grados,
        'infLng' => $mLng - $grados
    );

    $Tabla = "Gruas";
    $Disponible = "SI";

    $result = $mLink->query("SELECT idGrua,Token FROM $Tabla WHERE Disponible = '$Disponible' AND Latitud BETWEEN '$mTopes[infLat]' AND '$mTopes[supLat]' "
            . "AND Longitud BETWEEN '$mTopes[supLng]' AND '$mTopes[infLng]'");
    $response = ($result) ? loadGruas($result) : Error($mLink->error);
    return $response;
}

function loadGruas($result) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

/*
function Error($error) {
    $rows = array(
        "Error" => $error);
    return $rows;
}
*/

//------------------------------
//Actualizando la solicitud con estatus Desierto
//------------------------------
function solicitudDesierta($link, $idSolicitud) {

    $Tabla = "Solicitudes";
    $nuevoEstatus = "Desierto";
    $result = $link->query("UPDATE $Tabla SET Estatus = '$nuevoEstatus' WHERE idSolicitud = '$idSolicitud'");

    if (!$result) {
        printf("Error en el update: %s\n", $link->error);
    }
}

//------------------------------
//Almacena en el solicitud la cantidad de gruas en rango
//------------------------------
function AlmacenarGruas($link, $id, $Gruas) {
    $NumGruas = count($Gruas);
    $Tabla = "Solicitudes";
    $result = $link->query("UPDATE $Tabla SET NumGruas = '$NumGruas' WHERE idSolicitud = '$id'");

    if (!$result) {
        printf("Error en el update: %s\n", $link->error);
    }
}

function NuevaSolicitudPUSH($Gruas, $id, $obj) {

    $timeOpen = gmdate('g:i A - d/m/Y', time() - (4 * 3600 + 30 * 60));
    $data = array(
        'title' => '¡Nueva solicitud!',
        'message' => 'Tiene una nueva solicitud de servicio. #' . $id,
        'notId' => $id,
        'idSolicitud' => $id,
        'TimeOpen' => $timeOpen,
        'Modelo' => $obj['Modelo'],
        'Problema' => $obj['QueOcurre'].' #' . $id
    );

    SendPush($Gruas, $data,20);
}



//------------------------------
//Enviado el Push a las grúas localizadas
//Se extra el Token a cada grúa y se hace
//el envio. El API soporta hasta 1000 grúas.
//------------------------------
function SendPush($Gruas, $data,$time) {

    $ids = getTokens($Gruas);
    
    $apiKey = 'AIzaSyBFeSlIAjDg8U7zsWW82uJCNLi3IZxq9fI';
    $url = 'https://android.googleapis.com/gcm/send';

    $post = array(
        'registration_ids' => $ids,
        'data' => $data,
        "time_to_live" => $time

    );

    $headers = array(
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
    );

    //------------------------------
    // Iniciando librería del cURL
    //------------------------------
    $ch = curl_init();

    //------------------------------
    // Set URL to GCM endpoint
    //------------------------------
    curl_setopt($ch, CURLOPT_URL, $url);

    //------------------------------
    // Set request method to POST
    //------------------------------
    curl_setopt($ch, CURLOPT_POST, true);

    //------------------------------
    // Set our custom headers
    //------------------------------
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //------------------------------
    // Get the response back as 
    // string instead of printing it
    //------------------------------
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //------------------------------
    // Set post data as JSON
    //------------------------------
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

    //------------------------------
    // Actually send the push!
    //------------------------------
    $result = curl_exec($ch);
    curl_close($ch);

   // echo ($result);
}

function getTokens($Gruas) {
    foreach ($Gruas as $grua) {
        $ids[] = $grua["Token"];
    }
    return $ids;
}
