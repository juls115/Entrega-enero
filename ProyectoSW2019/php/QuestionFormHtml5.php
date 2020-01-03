<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php if(empty($_GET["email"])) echo "<script>window.location.replace('" . $url_path . "php/Layout.php');</script>"; ?>
  <section class="main" id="s1">
    <div>

      <form id="fquestion" name="fquestion" action=<?php echo '"AddQuestionWithImage.php' . $parameterURL . '"'; ?> enctype="multipart/form-data">
        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">DATOS DE LA PREGUNTA</legend>
          <table style="margin-left:auto;margin-right:auto;">
            <tr>
              <td><label for="email">Email: </label></td>
              <td><input type="email" name="email" id="email" pattern="([a-z]+\.)?[a-z]+@ehu\.(eus|es)$" autofocus required value='<?php if(isset($_GET["email"])) echo clean_form_data($_GET["email"]) . '  readonly'; ?>'/></td>
              <td>
                <span id="sEmail">
                  <select name="mailType" id="mailtype">
                    <option value="1" selected>Profesor</option>
                    <option value="2">Estudiante</option>
                  </select>
                </span>
              </td>
            </tr>
            <tr>
              <td><label for="qst">Pregunta: </label></td>
              <td><input type="text" name="question" id="qst" minlength="10" required/></td>
              <td><span id="sqst"></span></td>
            </tr>
            <tr>
              <td><label for="correct">Respuesta correcta: </label></td>
              <td><input type="text" name="correcta" id="correct" required/></td>
              <td><span id="scorrect"></span></td>
            </tr>
            <tr>
              <td><label for="error1">Respuesta incorrecta 1:</label></td>
              <td><input type="text" name="erronea1" id="error1" required/></td>
              <td><span id="serror1"></span></td>
            </tr>
            <tr>
              <td><label for="error2">Respuesta incorrecta 2:</label></td>
              <td><input type="text" name="erronea2" id="error2" required/></td>
              <td><span id="serror2"></span></td>
            </tr>
            <tr>
              <td><label for="error3">Respuesta incorrecta 3:</label></td>
              <td><input type="text" name="erronea3" id="error3" required/></td>
              <td><span id="serror3"></span></td>
            </tr>
            <tr>
              <td><label for="complexity">Complejidad (baja-media-alta): </label></td>
              <td>
                <input type="range" name="dificultad" id="complexity" min="1" max="3" value="2" required/>
              </td>
              <td><span id="scomplexity"></span></td>
            </tr>
            <tr>
              <td><label for="topic">Tema de la pregunta:</label></td>
              <td><input type="text" name="tema" id="topic" required/></td>
              <td><span id="stopic"></span></td>
            </tr>
            <tr>
              <td><label for="im">Imagen relacionada: </label></td>
              <td><input type="file" name="imagen" id="im" accept="image/*"/></td>
              <td><span id="sim"></span></td>
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
