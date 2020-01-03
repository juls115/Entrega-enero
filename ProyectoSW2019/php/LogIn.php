<?php
include '../php/SessionStart.php';
  if(isset($_SESSION['email'])){
    header('Location: ../php/Layout.php');
  }

  function clean_form_data_login($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $mistake = '';
  function inform($s){
    global $mistake;
    $mistake = "<span style='color:red'>$s</span>";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["correo"]) && !empty($_POST["password"])){
      $correo = clean_form_data_login($_POST["correo"]);
      $password = clean_form_data_login($_POST["password"]);

      include '../php/DbConfig.php';
      $conn = mysqli_connect($server, $user, $pass, $basededatos) or die("No se puede comunicar con el servidor, vuelvelo a intentar mas tarde");
      $sql_query = "SELECT * FROM usuarios WHERE Correo='$correo'";
      if ($result = $conn->query($sql_query)){
        if ($result->num_rows > 0){
          $row_value = $result->fetch_assoc();
          if(password_verify($password, $row_value['Contrasena'])){
            if ($row_value["Estado"] == 0){
              inform('La cuenta se encuentra bloqueada, acceso denegado');
            } else {
              $_SESSION['email'] = $row_value["Correo"];
              $_SESSION['nombre'] = $row_value["Nombre_Apellidos"];
              $_SESSION['image'] = $row_value["Imagen"];
              $_SESSION['role'] = $row_value["Rol"];
              include 'IncreaseGlobalCounter.php';
              header('Location: ../php/Layout.php');
            }
          } else {
            inform('Ha ocurrido un error: Los datos son incorrectos PASSWORD');
          }
        } else {
          inform('Ha ocurrido un error: Los datos son incorrectos');
        }
      } else {
        inform('Ha ocurrido un error: Los datos son incorrectos');
      }
      mysqli_close($conn);

    } else {
      inform('Ha ocurrido un error: Los datos son incorrectos');
    }

  }

?>

<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src='../js/jquery-3.4.1.min.js'></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <form action="LogIn.php" method="post">
        <fieldset style="background-color:lightblue">
          <legend style="background-color:white;border-style: solid; border-width: 2px">DATOS DE INICIO DE SESIÓN</legend>
          <table style="margin-left:auto;margin-right:auto;">
            <tr>
              <td><label for="email">Correo:</label></td>
              <td><input type="email" name="correo" id="email" pattern="[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)|([a-z]+\.)?[a-z]+@ehu\.(eus|es)$" required autofocus value="<?php echo isset($_POST['correo']) ? clean_form_data($_POST['correo']) : '' ?>" /></td>
            </tr>
            <tr>
              <td><label for="pass">Contraseña:</label></td>
              <td><input type="password" name="password" id="pass" minlength=6 required/></td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" name="send" value="Login" />
              </td>
            </tr>
          </table>
        </fieldset>
      </form>
      <?php echo $mistake; ?>
    </div>
  </section>

</body>
</html>
