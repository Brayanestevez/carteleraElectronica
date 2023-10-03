<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre_video = $_POST["nombre-video"];
  $ruta_video = "uploads/" . $nombre_video;
  if (file_exists($ruta_video)) {
    unlink($ruta_video);
    header("Location: index.php");
    exit();
  }
}
?>