<?php include '../php/SessionStart.php'; 
 if(isset($_SESSION['email'])){
   header('Location: ../php/Layout.php');
  }

 ?>

<!DOCTYPE html>

<html>
<head>
  <?php include '../html/Head.html'?>
  <script src='../js/jquery-3.4.1.min.js'></script>
  <style media="screen">
    span.advertencia {
      color: darkred;
    }
  </style>
</head>
<body>
  <?php include '../php/Menus.php'?>

  <section class="main" id="s1">
    <div>
      
      <?php
        //Definition of the mySQL connection properties are included
        include '../php/DbConfig.php';
        $required = array(); // Almacena los errores encontrados en la validación del formulario
       
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

          if (!empty($_POST["email"])){
            $email = clean_form_data($_POST["email"]);

           $conn = mysqli_connect($server, $user, $pass, $basededatos) or die("No se puede comunicar con el servidor, la pregunta no se incluirá");

           $sql="SELECT * FROM usuarios WHERE Correo='".$email."'";
           echo $sql;
           $result=mysqli_query($conn,$sql);

            if($result->num_rows>0){
               $destinatario=$email;
              $tema="recuperar contraseña";
              $codigo=rand(10000,99999);
              $mensaje= '<html>
                    <head>
                      <title>Recuperación de la contraseña</title>
                    </head>
                    <body>
                      <h1>Reestablecer contraseña en el enlace</h1>
                      <h3><a href="https://laboratoriosjulian.000webhostapp.com/ProyectoSW2019/php/recuperarContrasena.php">Aqui enlace para recuperar la contraseña</a></h3>
                      
                      <h3>Código de recuperación</h3>
                      <h3>' . $codigo . '</h3>
                    </body>
                  </html>';

              $_SESSION['cod']=$codigo;
              $_SESSION['mail']=$email;

              $headers = "MIME-Version: 1.0" . "\r\n" .
                              "Content-type: text/html; charset=UTF-8" . "\r\n";

              mail($destinatario,$tema,$mensaje,$headers);
               $required["errormail"] ="Correo enviado correctamente";

            }else{
              $required["errormail"] ="Usuario inexistente";
            }

             mysqli_close($conn);

          } else {
            $required["errormail"] = "Correo no proporcionado";
          }
        } 
    ?>

      <form method="post" id="fquestion" name="fquestion" action='contrasenaForm.php' >

        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">RECUPERACION DE LA CONTRASEÑA</legend>
          <table style="margin-left:auto;margin-right:auto;">
            <tr>
              <td><label for="email">Introducir email para recuperar: </label></td>
              <td><input type="text" name="email" id="email"  /></td>
              <td><span id="sEmail" class="advertencia"><?php if(!empty($required["errormail"])) echo $required["errormail"] ; ?></span></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="enviar" id="subm" value="Enviar datos"/></td>
              <td colspan="1"><input type="reset" name="resetear" id="reset" value="Vaciar campos"></button></td>
            </tr>
          </table>
        </fieldset>
      </form>




    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>