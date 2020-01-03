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
        if(empty($_GET["email"])) echo "<script>window.location.replace('" . $url_path . "php/Layout.php');</script>";

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

          $targetDir = "../images/";
          $name = pathinfo($_FILES['imagen']['name'], PATHINFO_FILENAME);
          $fileType = pathinfo($_FILES['imagen']['name'],PATHINFO_EXTENSION);
          $values["imagen"] = NULL;

          if(!empty($_FILES["imagen"]["name"])){
              $allowTypes = array('jpg','png','jpeg','gif');
              if(in_array($fileType, $allowTypes)){
                $increment = 0;
                 $pname = $name . '.' . $fileType;
                 while(is_file($targetDir . $pname)) {
                   $increment++;
                   $pname = $name . $increment . '.' . $fileType;
                 }
                 $targetDir =  $targetDir . $pname;
                  if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetDir)){
                    $values["imagen"] = $pname;
                  }else{
                  // echo $_FILES["imagen"]["tmp_name"];
                    $required["imagen"] = "Ha ocurrido un error al subir la imagen";
                  }
              }else{
                $required["imagen"] = "El formato del archivo no es aceptado";
              }
          }

          if (empty($required)){
            //echo "<p>La información del formulario se ha recibido correctamente</p>";

            // Insert the question in the database

            $conn = mysqli_connect($server, $user, $pass, $basededatos) or die("No se puede comunicar con el servidor, la pregunta no se incluirá");
            /*
            if (!$conn) {
              //die("Conexión fallida con la base de datos: " . mysqli_connect_error());
            }
            //echo "<p>Conexión con la base de datos establecida satisfactoriamente</p>";
            */

            if(!$sql_query = $conn->prepare("INSERT INTO preguntas(Correo, Pregunta, Respuesta_correcta, R_Erronea_1, R_Erronea_2, R_Erronea_3, Complejidad, Tema, Imagen)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")){
              echo "La petición al servidor no se puede procesar";
            } else {
              $sql_query->bind_param("sssssssss", $values["email"], $values["pregunta"], $values["respuesta_correcta"], $values["r_erronea_1"], $values["r_erronea_2"], $values["r_erronea_3"], $values["complejidad"], $values["tema"], $values["imagen"]);
              if ($result = $sql_query->execute()) {
                echo "Nueva pregunta introducida a la base de datos <br>";
                echo "<a href='ShowQuestionsWithImage.php" . $parameterURL . "'>Visualizar todas las preguntas en la BD</a>";
              } else {
                echo "No se ha podido procesar su pregunta. La información, a pesar de ser del formato correcto, no puede ser procesada por razones desconocidas. Vuelva a intentarlo otra vez mas tarde o póngase en contacto con el sistema de soporte.";
                //echo "Error: No se ha podido realizar la insercón de los datos<br>" . mysqli_error($conn);
              }
            }

            mysqli_close($conn);

            // Insert the question in the XML file
            $directory = "../xml/Questions.xml";
            $xml=simplexml_load_file($directory) or die("<p>El fichero XML no esta accesible</p>");
            $question_form = $xml->addChild("assessmentItem");
            // Atributos tema y autor
            $question_form->addAttribute("subject", $values["tema"]);
            $question_form->addAttribute("author", $values["email"]);
            // Pregunta
            $pregunta = $question_form->addChild("itemBody");
            $pregunta->addChild("p", $values["pregunta"]);
            // Respuesta correcta
            $respuesta_correcta = $question_form->addChild("correctResponse");
            $respuesta_correcta->addChild("value", $values["respuesta_correcta"]);
            // Respuestas incorrectas
            $respuestas_incorrectas = $question_form->addChild("incorrectResponses");
            $respuestas_incorrectas->addChild("value", $values["r_erronea_1"]);
            $respuestas_incorrectas->addChild("value", $values["r_erronea_2"]);
            $respuestas_incorrectas->addChild("value", $values["r_erronea_3"]);
            // Update the xml file
            if ($xml->asXML($directory)){
              echo "<br><a href='ShowXmlQuestions.php" . $parameterURL . "'>Visualizar todas las preguntas del fichero XML</a>";
            } else {
              echo "<p>No se ha podido introducir la pregunta en el fichero XML</p>";
            }


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
      <br>
      <button onclick="returnPage()">Volver a insertar una pregunta</button>

    </div>
  </section>
  <script type="text/javascript">
    function returnPage(){
      window.history.back();
    }
  </script>
  <?php include '../html/Footer.html' ?>
</body>
</html>
