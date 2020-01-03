<?php

include '../php/URLPath.php';

function clean_form_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$pass = clean_form_data($_POST["passwordData"]);
include 'ClientVerifyPass.php';
if ($result_pass == "VALIDA"){
  echo "<span style='color:green'>Password válido</span>";
} else if ($result_pass == "INVALIDA"){
  echo "<span style='color:red'>Password inválido</span>";
} else {
  echo "Que es esto";
  echo "<span style='color:red'>Validación del password fuera de servicio</span>";
}

?>
