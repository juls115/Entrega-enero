<?php
include '../php/SessionStart.php';
if(isset($_SESSION['email'])){
  header('Location: ../php/Layout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" type='text/css' href="../styles/FormTable.css">
  <script src='../js/jquery-3.4.1.min.js'></script>
  <style media="screen">
    span {
      color: darkred;
    }
  </style>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <?php include '../php/ValidateSignUp.php' ?>

      <form method="post" id="fquestion" name="fquestion" action="SignUp.php" enctype="multipart/form-data">
        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">DATOS DE REGISTRO</legend>
          <table style="margin-left:auto;margin-right:auto;">
            <tr>
              <td class="label">
                <label for="radioChoice" id="ocupation" >Ocupación:</label>
              </td>
              <td class="tdInput">
                <table id="radioChoice" style="margin-left:auto;margin-right:auto;">
                  <tr>
                    <td><label for="teacher">Profesor</label></td><td>
                    <input type="radio" id="teacher" name="ocupacion" value="profesor" <?php echo (isset($_POST["ocupacion"]) && clean_form_data($_POST['ocupacion']) == "profesor") ? 'checked' : '' ?> /></td></tr><tr>
                    <td><label for="student">Estudiante</label></td><td>
                    <input type="radio" id="student" name="ocupacion" value="estudiante" <?php echo (isset($_POST["ocupacion"]) && clean_form_data($_POST['ocupacion']) == "estudiante") ? 'checked' : '' ?> /></td>
                  </tr>
                </table>
              </td>
              <td><span class="spanSingUp" id="socupation"><?php if(!empty($required["socupation"])) echo $required["socupation"]; ?></span></td>
            </tr>
            <tr>
              <td class="label"><label for="email">Correo:</label></td>
              <td class="tdInput"><input type="text" class="sInput" id="email" name="correo" value="<?php echo isset($_POST['correo']) ? clean_form_data($_POST['correo']) : '' ?>"/><br><span id="emailWService"></span></td>
              <td><span class="spanSingUp" id="semail"><?php if(!empty($required["semail"])) echo $required["semail"]; ?></span></td>
            </tr>
            <tr>
              <td class="label"><label for="nombre">Nombre y apellidos:</label></td>
              <td class="tdInput"><input type="text" class="sInput" name="name_surname" id="nombre" value="<?php echo isset($_POST['name_surname']) ? clean_form_data($_POST['name_surname']) : '' ?>"/></td>
              <td><span class="spanSingUp" id="snombre"><?php if(!empty($required["snombre"])) echo $required["snombre"]; ?></span></td>
            </tr>
            <tr>
              <td class="label"><label for="pass">Password:</label></td>
              <td class="tdInput"><input type="password" class="sInput" name="password" id="pass"/><br><input type="checkbox" id="cpass1"/>Mostrar password<br><span id="passWService"></span></td>
              <td><span class="spanSingUp" id="spass"><?php if(!empty($required["spass"])) echo $required["spass"]; ?></span></td>
            </tr>
            <tr>
              <td class="label"><label for="pass2">Confirmar password:</label></td>
              <td class="tdInput"><input type="password" class="sInput" name="passcheck" id="pass2" /><br><input type="checkbox" id="cpass2"/>Mostrar password</td>
              <td><span class="spanSingUp" id="spass2"><?php if(!empty($required["spass2"])) echo $required["spass2"]; ?></span></td>
            </tr>
            <tr>
              <td class="label"><label for="" class="label">Imagen:</label></td>
              <td class="tdInput"><input type="file" name="imagen" id="im" accept="image/*"></td>
              <td><span id="simMsg" class="imPrev"><?php if(!empty($required["sim"])) echo $required["sim"]; ?></span></td>
            </tr>
            <tr>
              <td class="label"><label for="sim">Previsualización: </label></td>
              <td class="input" colspan="2"><span id="sim" class="imPrev"></span></td>
            </tr>
            <tr>
              <td colspan="3"><input type="submit" name="envio" value="Registrarse" /></td>
            </tr>
          </table>
        </fieldset>

      </form>

    </div>
  </section>

  <?php include '../html/Footer.html' ?>
  <script src='../js/ShowPassword.js'></script>
  <script src='../js/ShowImageInForm.js'></script>
  <script src='../js/WebServiceSignUp.js'></script>
</body>
</html>
