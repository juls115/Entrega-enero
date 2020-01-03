<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

include '../php/URLPath.php';

$ns = $url_path;
$server = new soap_server;
$server->configureWSDL('PasswordCheck',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register("verificarPassword", array('s'=>'xsd:string', 'ticket'=>'xsd:int'), array('validation'=>'xsd:string'), $ns);

function verificarPassword($s, $ticket){
  $lines_tickets = file('../txt/tickets.txt', FILE_IGNORE_NEW_LINES);
  if (!in_array($ticket, $lines_tickets)) {
    return "SIN SERVICIO";
  }
  $lines = file('../txt/toppasswords.txt', FILE_IGNORE_NEW_LINES);
  if (in_array($s, $lines)){
    return "INVALIDA";
  } else {
    return "VALIDA";
  }
}

if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);

?>
