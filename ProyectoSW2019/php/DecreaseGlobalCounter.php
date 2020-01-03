
<?php

include '../php/SessionStart.php';
if (!(isset($_SESSION["email"]) && isset($_SESSION["nombre"]) && isset($_SESSION['role']))){
  header('Location: ../php/Layout.php');
}

if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3){
  $d = "../xml/Counter.xml";
  $xml=simplexml_load_file($d) or die("<p>El fichero XML no esta accesible</p>");
  $xml->counter--;
  $xml->asXML($d);
}

 ?>
