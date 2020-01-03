<?php
include '../php/URLPath.php';
$registrado = (isset($_SESSION["email"]) && isset($_SESSION["nombre"]) && isset($_SESSION['role'])) ? "Registrado" : "Visitante";
$admin = false;
if ($registrado == "Registrado" && $_SESSION['role']==1){
  $admin = true;
}

?>
<div id='page-wrap'>
<header class='main' id='h1'>

<?php

  function clean_form_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if($registrado == "Registrado"){
    echo "<span class='right' style='padding-right:10px'><a href='LogOut.php'>Logout</a></span>";
    echo '<span class="right" style="padding-right:10px">' . $_SESSION["email"] . '</span>';
    if (!empty($_SESSION["image"])){
      $imagen = "<img src='../images/" . $_SESSION["image"] . "' alt='Foto de perfil' style='display:inline;max-height:100px;' />";
    } else {
      $imagen = "<img src='../images/anonimo.jpeg' alt='Foto de perfil' style='display:inline;max-height:100px;'/>";
    }
    echo '<span class="right">' . $imagen . '</span>';
  } else {
    echo '<span class="right" style="padding-right:10px"><a href="SignUp.php">Registro</a></span>';
    echo '<span class="right" style="padding-right:10px"><a href="LogIn.php">Login</a></span>';
    echo 'Anónimo <img src="../images/anonimo.jpeg" alt="Foto de perfil" style="display:inline;max-height:100px;" />';
  }

  ?>
</header>
<nav class='main' id='n1' role='navigation'>
  <?php

  echo "<span><a href='Layout.php'>Inicio</a></span>";
  if ($registrado == "Registrado" && !$admin){
    echo "<span><a href='HandlingQuizesAjax.php'>Gestionar Preguntas</a></span>";
    echo "<span><a href='ObtenerPregunta.php'>Obtener pregunta</a></span>";
  } else if ($registrado == "Registrado" && $admin){
    echo "<span><a href='HandlingAccounts.php'>Gestionar usuarios</a></span>";
  }else if($registrado== "Visitante"){
     echo "<span><a href='contrasenaForm.php'>Recuperar Contraseña</a></span>";
  }
  echo "<span><a href='Credits.php'>Creditos</a></span>";


  ?>
</nav>
