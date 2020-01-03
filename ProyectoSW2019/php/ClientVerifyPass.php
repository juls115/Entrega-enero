<?php

// Se incorporan las librerías
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$soapclient = new nusoap_client($url_path . "php/VerifyPassWS.php?wsdl",true);
$result_pass = $soapclient->call('verificarPassword',array('s'=>$pass, 'ticket'=>1010));
//echo "<h2>Result</h2><pre>$result_pass</pre>";
//echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
//echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';

?>
