<?php

$directory = "../xml/Questions.xml";
$xml=simplexml_load_file($directory) or die("El fichero XML no esta accesible");

echo "<table id='data'><caption style'font-weight:bold;' >Lista de preguntas</caption><thead><tr><th>Autor</th><th>Pregunta</th><th>R_correcta</th></tr></thead><tbody>";
foreach ($xml->children() as $child){
  echo "<tr>";
  echo "<td><span>" . htmlentities($child['author']) . "</span></td>";
  echo "<td><span>" . htmlentities($child->itemBody->p) . "</span></td>";
  echo "<td><span>" . htmlentities($child->correctResponse->value) . "</span></td>";
  echo "</tr>";
}
echo "</tbody></table>";

?>
