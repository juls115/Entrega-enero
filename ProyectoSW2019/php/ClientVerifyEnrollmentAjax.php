<?php

function clean_form_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$email = clean_form_data($_POST["emailData"]);
include 'ClientVerifyEnrollment.php';
if ($result == "SI"){
  echo "<span style='color:green'>El correo es VIP</span>";
} else {
  echo "<span style='color:red'>El correo no es VIP</span>";
}

?>
