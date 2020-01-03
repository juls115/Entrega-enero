<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

include '../php/URLPath.php';

function clean_form_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$id = clean_form_data($_POST["id"]);

$soapclient = new nusoap_client($url_path . "php/GetQuestionWS.php?wsdl",true);
$result_question = $soapclient->call('obtenerPregunta',array( 'identificador' => $id));

if (empty($result_question["autor"]) && empty($result_question["pregunta"]) && empty($result_question["respuesta_correcta"])){
  echo "<span style='color:red'>No existe una pregunta con el identificador especificado</span>";
} else {
  echo "<table id='data'><caption style'font-weight:bold;' >Lista de preguntas</caption><thead><tr><th>Correo</th><th>Pregunta</th><th>R_correcta</th></tr></thead><tbody>";
  echo "<tr><td><span>" .
  $result_question["autor"] . "</span></td><td><span>" .
  $result_question["pregunta"] . "</span></td><td><span>" .
  $result_question["respuesta_correcta"] . "</span></td></tr></tbody></table>";
}

/*
echo "<h2>Result</h2><pre>$result</pre>";
echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
*/

?>
