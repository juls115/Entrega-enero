<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src='../js/jquery-3.4.1.min.js'></script>
  <style media="screen">
    table, th, td {
      border: 1px solid grey;
    }
    #data {
      table-layout: fixed;
      width: 100%;
      background-color: white;
    }
    #data td {
      overflow: hidden;
      text-overflow: ellipsis;
      word-break: keep-all;
    }
    #data td:hover{
    white-space: normal;
    overflow: visible;
    position: relative;
    }
    #data td:hover span {
    background-color: white;
    border: 1px solid grey;
    display: inline-block;
    height: 100%;
    }
  </style>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <?php

      include '../php/DbConfig.php';

      $conn = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$conn) {
        die("Conexión fallida con la base de datos: " . mysqli_connect_error());
      }

      $sql_query = "SELECT * FROM preguntas";
      $result = $conn->query($sql_query);

      if ($result->num_rows > 0) {
        echo "<table id='data'><caption>Lista de preguntas</caption><thead><tr><th>Correo</th><th>Pregunta</th><th>R_correcta</th><th>R_errónea_1</th><th>R_errónea_2</th><th>R_errónea_3</th><th>Complejidad</th><th>Tema</th></tr></thead><tbody>";
        while($row = $result->fetch_assoc()) {
          echo "<tr><td><span>" .
          $row["Correo"] . "</span></td><td><span>" .
          $row["Pregunta"] . "</span></td><td><span>" .
          $row["Respuesta_correcta"] . "</span></td><td><span>" .
          $row["R_Erronea_1"] . "</span></td><td><span>" .
          $row["R_Erronea_2"] . "</span></td><td><span>" .
          $row["R_Erronea_3"] . "</span></td><td><span>" .
          $row["Complejidad"] . "</span></td><td><span>" .
          $row["Tema"] . "</span></td></tr>";
        }
        echo "</tbody></table>";
      } else {
        echo "No hay ninguna pregunta";
      }

      $conn->close();

      ?>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#data').after('<div id="nav"></div>');
          var rowsShown = 8;
          var rowsTotal = $('#data tbody tr').length;
          var numPages = rowsTotal/rowsShown;
          for(i = 0;i < numPages;i++) {
              var pageNum = i + 1;
              $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
          }
          $('#data tbody tr').hide();
          $('#data tbody tr').slice(0, rowsShown).show();
          $('#nav a:first').addClass('active');
          $('#nav a').bind('click', function(){
              $('#nav a').removeClass('active');
              $(this).addClass('active');
              var currPage = $(this).attr('rel');
              var startItem = currPage * rowsShown;
              var endItem = startItem + rowsShown;
              $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                      css('display','table-row').animate({opacity:1}, 300);
          });
        });
      </script>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
