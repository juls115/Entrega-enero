<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php'?>
  <?php if(empty($_GET["email"])) echo "<script>window.location.replace('" . $url_path . "php/Layout.php');</script>"; ?>
  <section class="main" id="s1">
    <div>

      <form method="post" id="fquestion" name="fquestion" action=<?php echo '"AddQuestionWithImage.php' . $parameterURL . '"'; ?> enctype="multipart/form-data">
        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">DATOS DE LA PREGUNTA</legend>
          <table class="fquest" style="margin-left:auto;margin-right:auto;">
            <tr>
              <td class="label"><label for="email">Email: </label></td>
              <td class="input"><input type="email" class="qInput" name="email" id="email" pattern="(([a-z]+\.)?[a-z]+@ehu\.(eus|es)|[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es))$" required readonly value="<?php if(isset($_GET["email"])) echo clean_form_data($_GET["email"]); ?>"/></td>
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
            <tr>
              <td colspan="2"><input type="submit" name="enviar" id="subm" value="Enviar datos"/></td>
              <td colspan="1"><button type="button" name="resetear" id="reset" value="Vaciar campos">Vaciar campos</button></td>
            </tr>
          </table>
        </fieldset>
      </form>


    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src='../js/ValidateFieldsQuestionHtml5.js'></script>
  <script src='../js/ShowImageInForm.js'></script>
</body>
</html>
