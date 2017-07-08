<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Servicios= new Servicios();
/****************Seteo y comprobacion de valores*******************/
$values["IdServicio"] = 50;
$response = array("Error"=>1,"MensajeError"=>"No existen datos del servicio","MensajeSuccess"=> '');
$datos = $Servicios->getServiciosDetalle($values);
if($datos){
  $response = array(
    "CodigoServicio" =>  $datos['CodigoServicio'],
    "NombreAplicacion" =>  $datos['NombreAplicacion'],
    "NombreServicioTipo" =>  $datos['NombreServicioTipo'],
    "NombreEstatus" =>  $datos['NombreEstatus'],
    "Agendado" =>  $datos['Agendado'],
    "FechaAgendado" =>  $datos['FechaAgendado'],
    "NombreUsuarioServicio" =>  $datos['NombreUsuarioServicio'],
    "NombreAveria" =>  $datos['NombreAveria'],
    "AveriaDetalle" =>  $datos['AveriaDetalle'],
    "NombreCondicionLugar" =>  $datos['NombreCondicionLugar'],
    "CondicionDetalle" =>  $datos['CondicionDetalle'],
    "LatitudOrigen" =>  $datos['LatitudOrigen'],
    "LongitudOrigen" =>  $datos['LongitudOrigen'],
    "NombreEstadoOrigen" =>  $datos['NombreEstadoOrigen'],
    "DireccionOrigen" =>  $datos['DireccionOrigen'],
    "DireccionOrigenDetallada" =>  $datos['DireccionOrigenDetallada'],
    "LatitudDestino" =>  $datos['LatitudDestino'],
    "LongitudDestino" =>  $datos['LongitudDestino'],
    "NombreEstadoDestino" =>  $datos['NombreEstadoDestino'],
    "DireccionDestino" =>  $datos['DireccionDestino'],
    "DireccionDestinoDetallada" =>  $datos['DireccionDestinoDetallada'],
    "KM" =>  $datos['KM'],
    "Inicio" =>  $datos['Inicio'],
    "Fin" =>  $datos['Fin'],
    "Observacion" =>  $datos['Observacion'],
    "UltimaActCliente" =>  $datos['UltimaActCliente'],
    "UltimaActGruero" =>  $datos['UltimaActGruero'],
    /************Datos ServiciosGruas, Proveedores y Gruas*******************/
    "IdentificacionProveedor" =>  $datos['IdentificacionProveedor'],
    "NombresProveedor" =>  $datos['NombresProveedor'],
    "ApellidosProveedor" =>  $datos['ApellidosProveedor'],
    "NombreProveedorTipo" =>  $datos['NombreProveedorTipo'],
    "PlacaGrua" =>  $datos['PlacaGrua'],
    "NombreMarcaGruas" =>  $datos['NombreMarcaGruas'],
    "ModeloGrua" =>  $datos['ModeloGrua'],
    "AnioGrua" =>  $datos['AnioGrua'],
    "ColorGrua" =>  $datos['ColorGrua'],
    "NombresGrua" =>  $datos['NombresGrua'],
    "ApellidosGrua" =>  $datos['ApellidosGrua'],
    "CedulaGrua" =>  $datos['CedulaGrua'],
    "CelularGrua" =>  $datos['CelularGrua'],
    "TratoCordial" =>  $datos['TratoCordial'],
    "Presencia" =>  $datos['Presencia'],
    "TratoVehiculo" =>  $datos['TratoVehiculo'],
    "Puntual" =>  $datos['Puntual'],
    /**********Datos ServiciosClientes****************************/
    "NombresCliente" =>  $datos['NombresCliente'],
    "ApellidosCliente" =>  $datos['ApellidosCliente'],
    "CedulaCliente" =>  $datos['CedulaCliente'],
    "PlacaCliente" =>  $datos['PlacaCliente'],
    "ModeloCliente" =>  $datos['ModeloCliente'],
    "ColorCliente" =>  $datos['ColorCliente'],
    "AnioCliente" =>  $datos['AnioCliente'],
    "CelularCliente" =>  $datos['CelularCliente'],
    "PolizaVencida" =>  $datos['PolizaVencida'],
    "NombreUsuarioCliente" =>  $datos['NombreUsuarioCliente'],
    /*****************ServiciosPrecios*************************************/
    "PrecioModificado" =>  $datos['PrecioModificado'],
    "PrecioSIvaBaremo" =>  $datos['PrecioSIvaBaremo'],
    "PrecioCIvaBaremo" =>  $datos['PrecioCIvaBaremo'],
    "PrecioSIvaModificado" =>  $datos['PrecioSIvaModificado'],
    "PrecioCIvaModificado" =>  $datos['PrecioCIvaModificado'],
    "NombreUsuarioPrecio" =>  $datos['NombreUsuarioPrecio']
  );

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
