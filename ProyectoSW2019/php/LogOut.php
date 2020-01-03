<?php

include '../php/SessionStart.php';
if (!(isset($_SESSION["email"]) && isset($_SESSION["nombre"]) && isset($_SESSION['role']))){
  header('Location: ../php/Layout.php');
}
include '../php/URLPath.php';
include 'DecreaseGlobalCounter.php';

echo "<script>";
if (isset($_SESSION["email"]) && isset($_SESSION['nombre'])){
  $nombre = $_SESSION['nombre'];
  $despedida = "Hasta la próxima " . $nombre;
  echo "alert('$despedida');";
}
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
echo 'window.location.replace("' . $url_path . 'php/Layout.php");';
echo "</script>";

?>
