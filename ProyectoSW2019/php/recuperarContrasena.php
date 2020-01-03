<?php
 include '../php/SessionStart.php';
  if(!isset($_SESSION["mail"]) || !isset($_SESSION["cod"]) || isset($_SESSION["email"]) ){
    header('Location: ../php/Layout.php');
  }

?>
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
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
          $required = array();
         

          if (empty($_POST["contrasena"])){
            $required["errorcontra"] = "Contrasena vacia";
          } else {
            $contra = clean_form_data($_POST["contrasena"]);
            if (strlen($contra)<6){

              $required["errorcontra"] = "la contraseña es demasiado corta";
            } 
            
          }

          if (empty($_POST["contrasena2"])){
            $required["errorcontra2"] = "Contraseña2 vacia";

          } else {
            $contra2 = clean_form_data($_POST["contrasena2"]);

            if($contra!=$contra2){
               $required["errorcontra2"] = "Las contraseñas no coinciden ";
            }
          }

          if (empty($_POST["cod"])){
            $required["errorcod"] = " Código vacio";
          } else {
            $codigo = clean_form_data($_POST["cod"]);
            if ($codigo != $_SESSION["cod"]){
              $required["errorcod"] = "El código no es correcto";
            }
          }

           if (empty($required)){
            
            include '../php/DbConfig.php';

            $conn = mysqli_connect($server, $user, $pass, $basededatos) or die("No se puede comunicar con el servidor");

            $sql="UPDATE usuarios SET Contrasena='".password_hash($contra, PASSWORD_DEFAULT)."' WHERE Correo='".$_SESSION["mail"]."'";
            $result=mysqli_query($conn,$sql);

            if ($result) {
                unset($_SESSION['mail']);
                unset($_SESSION["cod"]);
                echo "<script type='text/javascript'> alert('Contraseña modificada'); window.location.href='" . $url_path . "php/Layout.php';</script>";
              } else {
                echo "<p>No se ha podido actualizar la contraseña</p>";
                }


            mysqli_close($conn);
          }


}
        ?>
      <form method="post" id="fquestion" name="fquestion" action='recuperarContrasena.php' >
         <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">RECUPERACION DE LA CONTRASEÑA</legend>
          <table style="margin-left:auto;margin-right:auto;">
            <tr>
              <td><label for="email">Introducir email para recuperar: </label></td>
              <td><input type="text" name="email" id="email" value=<?php echo "'".$_SESSION["mail"]."'"; ?> readonly /></td>
              <td><span id="sEmail" class="advertencia"><?php echo $required["errormail"]  ?></span></td>
            </tr>

            <tr>
              <td><label for="contrasena">Contraseña Nueva: </label></td>
              <td><input type="text" name="contrasena" id="contrasena"  /></td>
              <td><span id="contra" class="advertencia"><?php echo $required["errorcontra"]  ?></span></td>
            </tr>

            <tr>
              <td><label for="contrasena2">Repetir Contraseña: </label></td>
              <td><input type="text" name="contrasena2" id="contrasena2"  /></td>
              <td><span id="contra2" class="advertencia"><?php echo $required["errorcontra2"]  ?></span></td>
            </tr>

              <tr>
              <td><label for="cod">Codigo de validacion: </label></td>
              <td><input type="text" name="cod" id="cod"  /></td>
              <td><span id="codi" class="advertencia"><?php echo $required["errorcod"]  ?></span></td>
            </tr>

            <tr>
              <td colspan="3"><input type="submit" name="enviar" id="subm" value="Reestablecer Contrasena"/></td>
        
            </tr>
          </table>
        </fieldset>
      </form>
			

    

    </div>
  </section>
  </script>
  <?php include '../html/Footer.html' ?>
</body>
</html>
