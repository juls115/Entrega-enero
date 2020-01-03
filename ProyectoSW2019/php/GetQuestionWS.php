<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

include '../php/URLPath.php';

$ns = $url_path;
$serverWS = new soap_server;
$serverWS->configureWSDL('ObtenerPregunta',$ns);
$serverWS->wsdl->schemaTargetNamespace=$ns;

$serverWS->wsdl->addComplexType(
'pregunta',
'complexType',
'struct',
'all',
'',
array(
'autor' => array('name' => 'autor','type' => 'xsd:string'),
'pregunta' => array('name' => 'pregunta','type' => 'xsd:string'),
'respuesta_correcta' => array('name' => 'respuesta_correcta','type' => 'xsd:string'),
)
);

$serverWS->register("obtenerPregunta", array('identificador'=>'xsd:int'), array('resultado'=>'tns:pregunta'), $ns);

function obtenerPregunta($identificador){
  include '../php/DbConfig.php';
  $conn = mysqli_connect($server, $user, $pass, $basededatos);
  if (!$conn) {
    die("Conexión fallida con la base de datos: " . mysqli_connect_error());
  }

  $sql_query = "SELECT * FROM preguntas WHERE Identificador = $identificador";
  $result = $conn->query($sql_query);

  if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $p = array(
      'autor' => $row["Correo"],
      'pregunta' => $row["Pregunta"],
      'respuesta_correcta' => $row["Respuesta_correcta"],
    );
  } else {
    $p = array(
      'autor' => "",
      'pregunta' => "",
      'respuesta_correcta' => "",
    );
  }

  $conn->close();
  return $p;
}

if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$serverWS->service($HTTP_RAW_POST_DATA);

?>
