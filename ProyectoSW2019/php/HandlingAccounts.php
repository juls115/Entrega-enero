<?php

include '../php/SessionStart.php';
if (!(isset($_SESSION["email"]) && isset($_SESSION["nombre"]) && isset($_SESSION['role']) && $_SESSION['role'] == 1)){
  header('Location: ../php/Layout.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" type='text/css' href="../styles/QuestionTable.css">
  <link rel="stylesheet" type='text/css' href="../styles/ZoomImage.css">
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php'?>
  <section class="main" id="s1">
    <div>

      <?php

      include '../php/DbConfig.php';

      $conn = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$conn) {
        die("Conexión fallida con la base de datos: " . mysqli_connect_error());
      }

      $sql_query = "SELECT * FROM usuarios";
      $result = $conn->query($sql_query);

      if ($result->num_rows > 0) {
        echo "<table id='data'><caption style'font-weight:bold;' >Lista de preguntas</caption><thead><tr><th>Elegir</th><th>Correo</th><th>Contraseña</th><th>Imagen</th><th>Estado actual de la cuenta</th></tr></thead><tbody>";
        while($row = $result->fetch_assoc()) {
          $imagen = "";
          if (!empty($row["Imagen"])){
            $imagen = "<img src='../images/" . addslashes($row["Imagen"]) . "' alt='" . addslashes($row["Tema"]) . "' style='display:block;' width='100%' onclick='clickImage(". "\"" . addslashes($row["Imagen"]) . "\"," . "\"" . addslashes($row["Tema"]) . "\"" . ")'/>";
          }
          $estado = ($row["Estado"] == 0) ? "Cuenta bloqueada" : "Cuenta activa";
          echo "<tr><td><span>" .
          "<input type='checkbox' class='userSelector' value='" . $row["Correo"] . "'>" . "</span></td><td><span>" .
          $row["Correo"] . "</span></td><td><span>" .
          $row["Contrasena"] . "</span></td><td><span>" .
          $imagen . "</span></td><td><span>" .
          $estado . "</span></td></tr>";
        }
        echo "</tbody></table>";
      } else {
        echo "No hay ninguna preguntas";
      }

      $conn->close();

      ?>

      <form name="ChangeForm" id="chForm" action="ChangeState.php" method="post" hidden>
        <input type="text" name="json_text" id="chInput">
      </form>

      <form name="DeleteForm" id="deForm" action="RemoveUser.php" method="post" hidden>
        <input type="text" name="json_text" id="deInput">
      </form>

      <div class="pruebas" id="cont"></div>

      <button type='button' name='stbutton' id='stateButton'>Cambiar estado</button>
      <button type='button' name='debutton' id='deleteButton'>Eliminar cuenta</button>

      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="imagen_zoom1" src=''>
        <div id="caption"></div>
      </div>

      <script src='../js/ZoomImage.js'></script>
      <script src='../js/NavBar.js'></script>
      <script src='../js/ManageAccounts.js'></script>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
