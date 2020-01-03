<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" type='text/css' href="../styles/QuestionTable.css">
  <link rel="stylesheet" type='text/css' href="../styles/ZoomImage.css">
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php if(empty($_GET["email"])) echo "<script>window.location.replace('" . $url_path . "php/Layout.php');</script>"; ?>
  <section class="main" id="s1">
    <div>

      <?php

      include '../php/DbConfig.php';

      $conn = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$conn) {
        die("Conexión fallida con la base de datos: " . mysqli_connect_error());
      }

      $sql_query = "SELECT * FROM preguntas";
      $result = $conn->query($sql_query);

      if ($result->num_rows > 0) {
        echo "<table id='data'><caption style'font-weight:bold;' >Lista de preguntas</caption><thead><tr><th>Correo</th><th>Pregunta</th><th>R_correcta</th><th>R_errónea_1</th><th>R_errónea_2</th><th>R_errónea_3</th><th>Complejidad</th><th>Tema</th><th>Imagen<br><span style='color:red'>(Haz click en la imagen para agrandarlo)</span></th></tr></thead><tbody>";
        while($row = $result->fetch_assoc()) {
          $imagen = "";
          if (!empty($row["Imagen"])){
            $imagen = "<img src='../images/" . addslashes($row["Imagen"]) . "' alt='" . addslashes($row["Tema"]) . "' style='display:block;' width='100%' onclick='clickImage(". "\"" . addslashes($row["Imagen"]) . "\"," . "\"" . addslashes($row["Tema"]) . "\"" . ")'/>";
          }
          echo "<tr><td><span>" .
          $row["Correo"] . "</span></td><td><span>" .
          $row["Pregunta"] . "</span></td><td><span>" .
          $row["Respuesta_correcta"] . "</span></td><td><span>" .
          $row["R_Erronea_1"] . "</span></td><td><span>" .
          $row["R_Erronea_2"] . "</span></td><td><span>" .
          $row["R_Erronea_3"] . "</span></td><td><span>" .
          $row["Complejidad"] . "</span></td><td><span>" .
          $row["Tema"] . "</span></td><td><span>" .
          $imagen . "</span></td></tr>";
        }
        echo "</tbody></table>";
      } else {
        echo "No hay ninguna preguntas";
      }

      $conn->close();

      ?>

      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="imagen_zoom1" src=''>
        <div id="caption"></div>
      </div>

      <script type="text/javascript">
        var URL_image_directory = <?php echo ($local == 1) ? "'http://localhost/dashboard/WS19G14/ProyectoSW2019/images/'" : "'https://ws19g14.000webhostapp.com/ProyectoSW2019/images/'"; ?>;
      </script>
      <script src='../js/ZoomImage.js'></script>
      <script src='../js/NavBar.js'></script>


    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
