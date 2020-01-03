<?php

include '../php/SessionStart.php';
if (!(isset($_SESSION["email"]) && isset($_SESSION["nombre"]) && isset($_SESSION['role']) && ($_SESSION['role'] == 2 || $_SESSION['role'] == 3))){
  header('Location: ../php/Layout.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" type='text/css' href="../styles/FormTable.css">
  <link rel="stylesheet" type='text/css' href="../styles/UpdateBar.css">
  <link rel="stylesheet" type='text/css' href="../styles/QuestionTable.css">
  <link rel="stylesheet" type='text/css' href="../styles/ZoomImage.css">
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php'?>
  <section class="main" id="s1">
    <div>

      <div class="userQ" name="conUsers" id="connUsers" style="border-style: double;"></div>

      <div class="userQ" name="userTotal" id="usertotal" style="border-style: double;"></div>

      <form method="post" id="fquestion" name="fquestion" action=<?php echo '"AddQuestionWithAjax.php"'; ?> enctype="multipart/form-data">
        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">DATOS DE LA PREGUNTA</legend>
          <table class="fquest" style="margin-left:auto;margin-right:auto;">
            <tr>
              <td class="label"><label for="email">Email: </label></td>
              <td class="input"><input type="email" class="qInput" name="email" id="email" pattern="(([a-z]+\.)?[a-z]+@ehu\.(eus|es)|[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es))$" required readonly value="<?php if(isset($_SESSION["email"])) echo $_SESSION["email"]; ?>"/></td>
            </tr>
            <tr>
              <td class="label"><label for="qst">Pregunta: </label></td>
              <td class="input"><input type="text" class="qInput" name="question" id="qst" minlength="10" autofocus required/></td>
            </tr>
            <tr>
              <td class="label"><label for="correct">Respuesta correcta: </label></td>
              <td class="input"><input type="text" class="qInput" name="correcta" id="correct" required/></td>
            </tr>
            <tr>
              <td class="label"><label for="error1">Respuesta incorrecta 1:</label></td>
              <td class="input"><input type="text" class="qInput" name="erronea1" id="error1" required/></td>
            </tr>
            <tr>
              <td class="label"><label for="error2">Respuesta incorrecta 2:</label></td>
              <td class="input"><input type="text" class="qInput" name="erronea2" id="error2" required/></td>
            </tr>
            <tr>
              <td class="label"><label for="error3">Respuesta incorrecta 3:</label></td>
              <td class="input"><input type="text" class="qInput" name="erronea3" id="error3" required/></td>
            </tr>
            <tr>
              <td class="label"><label for="complexity">Complejidad (baja-media-alta): </label></td>
              <td class="input"><input type="range" name="dificultad" id="complexity" min="1" max="3" value="2" required/></td>
            </tr>
            <tr>
              <td class="label"><label for="topic">Tema de la pregunta:</label></td>
              <td class="input"><input type="text" class="qInput" name="tema" id="topic" required/></td>
            </tr>
            <tr>
              <td class="label"><label for="im">Imagen relacionada: </label></td>
              <td class="input"><input type="file" name="imagen" id="im" accept="image/*"/></td>
            </tr>
            <tr>
              <td class="label"><label for="sim">Previsualización: </label></td>
              <td class="input"><span id="sim" class="imPrev"></span></td>
            </tr>
          </table>
        </fieldset>
      </form>
      <span style="font-weight:bold">Barra de progreso de la petición para insertar pregunta</span>
      <div id="upload-progress"><div class="progress-bar"></div></div> <!-- Progress bar added -->

      <div class="buttons">
        <button type="button" name="preguntas" id="watchQ">Ver preguntas</button>
        <button type="button" name="enviar" id="subm" value="Enviar datos"/>Insertar pregunta</button>
        <button type="button" name="resetear" id="reset" value="Vaciar campos">Vaciar campos</button>
        <button type="button" name="buscar" id="lim" value="Buscar imagen">Buscar imagen</button>
      </div>

      <!-- Recoger la respuesta del servidor al insertar una imagen -->
      <div class="resp" name="respuesta" id="response"></div>

      <!-- Ver las preguntas almacenadas en el fichero xml -->
      <div class="visual" name="visualization" id="visl"></div>

      <div class="imagenes" name="imvisual" id="imvsl"></div>

      <div class="tablaIm" name="imagetable" id="imTable"></div>

      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="imagen_zoom1" src=''>
        <div id="caption"></div>
      </div>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src='../js/ClearForm.js'></script>
  <script src='../js/ShowImageInForm.js'></script>
  <script src='../js/AddQuestionsAjax.js'></script>
  <script src='../js/ShowQuestionsAjax.js'></script>
  <script src='../js/NavBar.js'></script>
  <script src='../js/CountQuestionsAjax.js'></script>
  <script src='../js/RefreshLoginCounter.js'></script>
  <script src='../js/SearchImagesWS.js'></script>
  <script src='../js/ZoomImage.js'></script>
</body>
</html>
