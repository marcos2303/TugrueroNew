<?php
//------------------------------
// Payload data you want to send
// to Android device (will be
// accessible via intent extras)
//------------------------------
//echo(phpinfo());


$version = curl_version();
//echo("version".$version);
$data = array( 'message' => '¡Nuevo servicio de Grúa!' );

//------------------------------
// The recipient registration IDs
// that will receive the push
// (Should be stored in your DB)
//
// Read about it here:
// http://developer.android.com/google/gcm/
//------------------------------

/*$ids = array(
  'APA91bEv49lUIJqf0fd9j2EPkM-D8bN9AnPhvsAZFfw9XfBgMzNItKeNsfJUEZvy53nZyJvd3pVZkS6K6elvCvmYg7iMjJeoUhSzVOeX2uGcPQxfHRlI6DtEgNi9H3X4VskxKmb88i4DVnvNgWBPxsY4QfZ-Mk03AA',

);*/

//------------------------------
// Call our custom GCM function
//------------------------------
$ids = array(
  'fXbsU_zyFYE:APA91bHjfVHkIURaMuqwcN2WJwKhKftjG-_M7bWZq1ReFJaq8LTx7M44olMv_vetmx9_MrCoVlcWuD5foAN6_IFJ-XuLqnRYE0e68eiSx7gHVw6P7U9bQHbzqPsAUxQbICCBroMFD5Qj',
'fLZ_GaB29TY:APA91bFb1-ARRDyndBta19PoaN-zWf0y-sYc65SqPWPpxqgbdlHnhBwC-JNCT4Pufi4WzzJho1iDn61MFx2_zIN8evYV3vAPgjgSQ3cForPv58jH1IcfEoMxFWg2eWIb1Fer62GmLO-q'
);
$notification =
   array(
    "body" => "¡Nuevo servicio de Grúa!",
    "title" => "TU/GRUERO®",
    "sound" => "default",
  );

sendGoogleCloudMessage(  $ids,$notification );

//------------------------------
// Define custom GCM function
//------------------------------

function sendGoogleCloudMessage( $ids, $data,$notification )
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
                    "notification" => $notification

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

    echo $result;
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
