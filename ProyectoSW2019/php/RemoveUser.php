<?php

include '../php/SessionStart.php';
if (!(isset($_SESSION["email"]) && isset($_SESSION["nombre"]) && isset($_SESSION['role']) && $_SESSION['role'] == 1)){
  header('Location: ../php/Layout.php');
}

function clean_form_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$json = json_decode($_POST['json_text'], true);
//print_r($json['usuarios']);

include '../php/DbConfig.php';
$conn = mysqli_connect($server, $user, $pass, $basededatos) or die("No se puede comunicar con el servidor");

// Check if all the users to be modified are in the database in the first place
$sql_query = "SELECT * FROM usuarios";
if ($result = $conn->query($sql_query)){
  $all_users = array();
  $all_states = array();
  while($row = $result->fetch_assoc()){
    $all_users[] = $row['Correo'];
    $all_states[] = $row['Estado'];
  }
  //print_r($all_users);
  //print_r($all_states);
  $invalid = false;
  foreach($json['usuarios'] as $validCorreo){
    if(!(in_array($validCorreo, $all_users))){
      $invalid = true;
      break;
    }
  }
  if ($invalid){
    echo "Alguno de los usuarios seleccionados no pertenecen a la plataforma, petición denegada";
  } else {
    if(!$sql_query = $conn->prepare("DELETE FROM usuarios WHERE Correo=?")){
      echo "La petición al servidor no se puede procesar";
    } else {
      foreach($json['usuarios'] as $key => $value){
        $sql_query->bind_param("s", $value);
        $result = $sql_query->execute();
      }
    }
  }
} else {
  echo "No se ha podido realizar la petición a la base de datos, vuelva a intentarlo mas tarde";
}
mysqli_close($conn);

header("Location: ../php/HandlingAccounts.php");

?>
