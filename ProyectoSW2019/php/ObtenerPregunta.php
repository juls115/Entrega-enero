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
  <link rel="stylesheet" type='text/css' href="../styles/UpdateBar.css">
  <link rel="stylesheet" type='text/css' href="../styles/QuestionTable.css">
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php'?>
  <section class="main" id="s1">
    <div>

      <div class="userQ" name="conUsers" id="connUsers" style="border-style: double;"></div>

      <div class="userQ" name="userTotal" id="usertotal" style="border-style: double;"></div>

      <form method="post" id="fquestion" name="fquestion" action=<?php echo '"ClientGetQuestion.php"'; ?>>
        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">PETICION DE LA PREGUNTA</legend>
          <table class="fquest" style="margin-left:auto;margin-right:auto;">
            <tr>
              <td class="label"><label for="email">Identificador: </label></td>
              <td class="input"><input type="number" name="quantity" id="identifier" min="1" value="1" placeholder="Inserta el número del identificador" autofocus required></td>
            </tr>
            <tr>
              <td class="input"><input type="submit" name="submit" id="subm" value="Obtener pregunta"></td>
              <td><input type="reset" name="resetear" id="reset" value="Vaciar campos"></td>
            </tr>
          </table>
        </fieldset>
      </form>
      <span style="font-weight:bold">Barra de progreso de la petición para insertar pregunta</span>
      <div id="upload-progress"><div class="progress-bar"></div></div>
      <div class="quest" name="question" id="qst"></div>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src='../js/CountQuestionsAjax.js'></script>
  <script src='../js/RefreshLoginCounter.js'></script>
  <script src='../js/ObtenerPreguntaWS.js'></script>
</body>
</html>
