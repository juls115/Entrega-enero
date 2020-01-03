<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

			<?php
        //Definition of the mySQL connection properties are included
        include '../php/DbConfig.php';

        function clean_form_data($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        /*
        echo $_POST['email'] . " <br>";
        echo $_POST['question'] . " <br>";
        echo $_POST['correcta'] . " <br>";
        echo $_POST['erronea1'] . " <br>";
        echo $_POST['erronea2'] . " <br>";
        echo $_POST['erronea3'] . " <br>";
        echo $_POST['dificultad'] . " <br>";
        echo $_POST['tema'] . " <br>";
        */
        $required = array(); // Almacena los errores encontrados en la validación del formulario
        $values = array(); // Almacena los valor de cada campo del formulario si este es corrento
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

          if (!empty($_POST["email"])){
            $email = clean_form_data($_POST["email"]);
            $expAlumnos = "/^[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)$/";
            $expProfesores = "/([a-z]+\.)?[a-z]+@ehu\.(eus|es)$/";
            if (preg_match("/^[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)$/", $email) || preg_match("/([a-z]+\.)?[a-z]+@ehu\.(eus|es)$/", $email)){
              $values["email"] = $email;
            } else {
              $required[] = "El correo proporcionado no cumple con los requisitos";
            }
          } else {
            $required[] = "Correo no proporcionado";
          }

          if (!empty($_POST["question"])) {
            $question = clean_form_data($_POST["question"]);
            if (strlen($question) >= 10){
              $values["pregunta"] = $question;
            } else {
              $required[] = "La longitud de la pregunta es inferior a 10 caracteres";
            }
          } else {
            $required[] = "No se ha incluido una pregunta";
          }

          if (!empty($_POST["correcta"])) {
            $values["respuesta_correcta"] = clean_form_data($_POST["correcta"]);
          } else {
            $required[] = "La respuesa correcta no se ha proporcionado";
          }

          if (!empty($_POST["erronea1"])) {
            $values["r_erronea_1"] = clean_form_data($_POST["erronea1"]);
          } else {
            $required[] = "La primera respuesta errónea no se ha proporcionado";
          }

          if (!empty($_POST["erronea2"])) {
            $values["r_erronea_2"] = clean_form_data($_POST["erronea2"]);
          } else {
            $required[] = "La segunda respuesta errónea no se ha proporcionado";
          }

          if (!empty($_POST["erronea3"])) {
            $values["r_erronea_3"] = clean_form_data($_POST["erronea3"]);
          } else {
            $required[] = "La tercera respuesta errónea no se ha proporcionado";
          }

          if (!empty($_POST["dificultad"])) {
            $dificultad = clean_form_data($_POST["dificultad"]);
            if ($dificultad == 1) {
              $values["complejidad"] = "Baja";
            } else if ($dificultad == 2) {
              $values["complejidad"] = "Media";
            } else if ($dificultad == 3) {
              $values["complejidad"] = "Alta";
            } else {
              $required[] = "El nivel de complejidad no es válido";
            }
          } else {
            $required[] = "No se ha establecido un nivel de complejidad para la pregunta";
          }

          if (!empty($_POST["tema"])) {
            $values["tema"] = clean_form_data($_POST["tema"]);
          } else {
            $required[] = "El tema de la pregunta no se ha proporcionado";
          }

          //Image upload directory and extension check
          if (!empty($_FILES['imagen']["tmp_name"])){
            $file = $_FILES['imagen'];
            $whitelist_type = array('image/jpeg', 'image/png','image/gif');
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $values["imagen"] = NULL;

            if (in_array(finfo_file($fileinfo, $file['tmp_name']), $whitelist_type)) {
              $values["imagen"] = file_get_contents($file['tmp_name']);
            } else {
              echo finfo_file($fileinfo, $file['tmp_name']) . "<br>";
              $required["imagen"] = "El fichero subido no es una imagen";
            }
            finfo_close($fileinfo);
          }

          if (empty($required)){
            //echo "<p>La información del formulario se ha recibido correctamente</p>";

            $conn = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$conn) {
              die("Conexión fallida con la base de datos: " . mysqli_connect_error());
            }
            //echo "<p>Conexión con la base de datos establecida satisfactoriamente</p>";

            $sql_query = $conn->prepare("INSERT INTO preguntas(Correo, Pregunta, Respuesta_correcta, R_Erronea_1, R_Erronea_2, R_Erronea_3, Complejidad, Tema, Imagen)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if (!empty($values["imagen"])) {
              $sql_query->bind_param("sssssssss", $values["email"], $values["pregunta"], $values["respuesta_correcta"], $values["r_erronea_1"], $values["r_erronea_2"], $values["r_erronea_3"], $values["complejidad"], $values["tema"], $values["imagen"]);
            } else {
              $sql_query->bind_param("sssssssss", $values["email"], $values["pregunta"], $values["respuesta_correcta"], $values["r_erronea_1"], $values["r_erronea_2"], $values["r_erronea_3"], $values["complejidad"], $values["tema"], $values["imagen"]);
            }

            if ($sql_query->execute()) {
              echo "Nueva pregunta introducida a la base de datos <br>";
              echo "<a href='ShowQuestionsWithImage.php'>Visualizar todas las preguntas</a>";
            } else {
              echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

          } else {
            echo "<h2>El formulario contiene los siguientes errores de formato: </h2>";
            echo "<ul>";
            foreach ($required as $key => $value) {
              echo "<li>" . $value . "</li>";
            }
            echo "</ul>";
          }

        } else {
          echo "<p>El método de envio no es válido</p>";
        }

      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
