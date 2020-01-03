<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" type='text/css' href="../styles/QuestionTable.css">
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php if(empty($_GET["email"])) echo "<script>window.location.replace('" . $url_path . "php/Layout.php');</script>"; ?>
  <section class="main" id="s1">
    <div>

      <?php

      $directory = "../xml/Questions.xml";
      $xml=simplexml_load_file($directory) or die("El fichero XML no esta accesible");

      echo "<table id='data'><caption style'font-weight:bold;' >Lista de preguntas</caption><thead><tr><th>Autor</th><th>Pregunta</th><th>R_correcta</th></tr></thead><tbody>";
      foreach ($xml->children() as $child){
        echo "<tr>";
        echo "<td><span>" . $child['author'] . "</span></td>";
        echo "<td><span>" . $child->itemBody->p . "</span></td>";
        echo "<td><span>" . $child->correctResponse->value . "</span></td>";
        echo "</tr>";
      }
      echo "</tbody></table>";

      ?>

      <script src='../js/NavBar.js'></script>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
