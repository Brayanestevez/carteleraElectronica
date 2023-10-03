<?php

$archivos = $_FILES['files'];//mis archivos sean en files 
//esto va llegar en formato de array, si el name fue files[]
foreach( $archivos['tmp_name'] as $indice => $tpm_name){// recorrer los tmp_name
    var_dump($indice);//mostrar informacion de indice
    var_dump($tpm_name);//mostrar informacion de name
echo '<hr />';
    $nombre_real = $archivos ['name'][$indice];//nombre real de archivos del indice name. pedir el name solamente del array
   // var_dump($nombre_real);
   move_uploaded_file($tpm_name, "uploads/$nombre_real");
  
   if (isset($_FILES['archivo'])) {
    $archivo_temporal = $_FILES['archivo']['tmp_name'];
    $nombre_archivo = $_FILES['archivo']['name'];
    $ruta_destino = $ruta_uploads . '/' . $nombre_archivo;
    if (move_uploaded_file($archivo_temporal, $ruta_destino)) {
        echo "El archivo se ha subido correctamente";
    } else {
        echo "Error al subir el archivo";
    }
}
 
}

//pedir todos los archivos dentro la carpeta para mostrarlos en la web

echo json_encode(  $archivos );//convertir en json  


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["accion"] == "eliminar") {
    $archivo = $_POST["nombre-video"];
    if (unlink($archivo)) {
      echo "El archivo $archivo fue eliminado exitosamente.";
    } else {
      echo "Ocurrió un error al intentar eliminar el archivo $archivo.";
    }
  }
  


  $targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["archivo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Verificar si el archivo es un video (puedes agregar más extensiones según sea necesario)
if ($imageFileType != "mp4" && $imageFileType != "webm" && $imageFileType != "ogg") {
    echo json_encode(["success" => false, "message" => "El archivo no es un video válido."]);
    exit;
}

// Verificar si ocurrió un error en la subida
if ($_FILES["archivo"]["error"] !== UPLOAD_ERR_OK) {
    echo json_encode(["success" => false, "message" => "Error al subir el archivo."]);
    exit;
}

// Mover el archivo a la carpeta de destino
if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $targetFile)) {
    echo json_encode(["success" => true, "message" => "Video subido con éxito."]);
} else {
    echo json_encode(["success" => false, "message" => "Error al mover el archivo."]);
}