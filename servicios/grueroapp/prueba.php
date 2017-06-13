<?php



//header('Content-Type: application/json; charset:utf-8');
echo "Hola";


$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);


if (json_last_error() == 0) {
    $cedula = ($obj["Cedula"]);
    $placa = ($obj["Placa"]);
    $clave = ($obj["Clave"]);
} else {
    echo(JSONerror());
    exit();
}

//$cedula = "V123456"; //TestValue
//$placa = "ALX900"; //TestValue
//$clave = "1234"; //TestValue
$Tabla = "Grueros"; //TestValue

include_once 'conexion.php';

$result = $link->query("SELECT idGrua,Nombre,Modelo,Condicion FROM $Tabla WHERE Cedula = '$cedula' AND Placa = '$placa' AND Clave = '$clave'");
$response = ($result->num_rows === 1) ? Success($result->fetch_array(MYSQLI_ASSOC)) : Error();

echo($response);

//$result->close();
//$link->close();


function Success($data) {
    if ($data["Condicion"] !== "Activo") {
        $data = (array('Suspendido' => "Usted se encuentra temporalmente suspendido, contacte a sporte técnico para mayor información."));
    }
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}

function Error() {
    $data = (array('Error' => "La información que usted ha suministrado es incorrecta, por favor ingrese sus datos nuevamente."));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}

function JSONerror() {
    $jsonData = (array('Error' => json_last_error_msg()));
    $json_array = json_encode($jsonData, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}
