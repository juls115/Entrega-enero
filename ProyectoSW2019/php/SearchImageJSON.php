
<?php

function clean_form_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (empty($_POST['tag'])) {
  echo "<span style='color:red'>No se ha especificado el tag</span>";
} else {
  $tag = clean_form_data($_POST['tag']);
  $json = file_get_contents('https://api.flickr.com/services/feeds/photos_public.gne?format=json&tags=' . urlencode($tag));
  preg_match_all('/\{\"m\"\:.*?\}/', $json, $json_match);
  //print_r($json_match);
  $num_images = count($json_match[0]);
  $num_rows = $num_images / 4;
  if (is_float($num_rows)){
    $num_rows = intval($num_rows) + 1;
  }
  /*
  echo "Number of images: $num_images";
  echo "Cantidad de filas: $num_rows";
  echo json_decode($json_match[0][0])->m;
  echo "<span><img src='" . json_decode($json_match[0][0])->m . "' alt='" . json_decode($json_match[0][0])->m . "'></span>";
  */
  echo "<table id='data'><caption style'font-weight:bold;' >Lista de imágenes</caption><thead><tr><th colspan=4>Imagenes disponibles (<span style='color:red'>click para agrandar la imagen y descargarla al hacer click en el boton de abajo</span>)</th></tr></thead><tbody>";
  for($i = 0; $i < $num_rows; $i++){
    echo "<tr>";
    if ($i < $num_rows - 1) {
      $slots = 4;
    } else {
      $slots = $num_images - 4*$i;
    }
    for($j = 4*$i; $j < (4*$i)+$slots; $j++){
        echo "<td><span><img src='" . json_decode($json_match[0][$j])->m . "' alt='" . json_decode($json_match[0][$j])->m . "' style='display:block;' width='100%' onclick='clickImageSearch(this.src)'></span></td>";
    }
    echo "</tr>";
  }
  echo "</tbody></table>";
}

?>
