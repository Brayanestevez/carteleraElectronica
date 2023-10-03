<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="https://localhost/assets/css/style.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            width: 100%;
            height: 100%;
            background: #fff;
            overflow: hidden;
        }

        Hide scrollbar for Chrome,
        Safari and Opera body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
            background-color: #2e8b57;
        }

        .header {
            text-decoration: none;
            background: #000000e9;
            color: white;
            text-align: center;
            padding: 10px;
            width: 850px;
            height: 750px;
        }

        header h1 {
            margin: 0;
        }

        main {
            width: 80%;
            margin: auto;
        }

        @media(max-width: 1200px) {
            #dropzone {
                display: none;
                background-color: #FFB347;
            }
        }

        #dropzone {
            padding: 1px 3px;
            background: #ffffff;
            border-style: dotted;
            position: absolute;
            margin-bottom: 700px;
            margin-left: 900px;


        }

        .mi-select {

            position: absolute;
            margin-left: 1000px;
            margin-bottom: 600px;
            width: 330px;
            background-color: #ADD8E6;
            border-radius: 20px;

        }

        #dropzone label {
            border-bottom: 1px solid blue;
            color: blue;
            cursor: pointer;
        }

        #dropzone p {
            padding: 20px;
            background: rgb(255, 255, 255);
            text-align: center;
            border: 2px;
            color: #333;

        }

        #dropzone input {
            display: none;
        }

        #weather-bg {
            transition: background-color 1s ease-in-out;
        }

        #weather-bg.sun {
            background-color: #FFB347;
        }

        #weather-bg.rain {
            background-color: #ADD8E6;
        }

        .current-time {
            font-size: 14px;
            color: #666;
        }

        .menu {
            display: flex;

            justify-content: end;
            align-items: end;
            flex-direction: column;

        }

        .boton {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            width: 500px;
            height: 30px;
            border-radius: 25px;
            cursor: pointer;
        }

        .boton:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            background-color: #FFB347;
        }

        .boton2 {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

            border: none;
            color: white;
            width: 300px;
            height: 30px;
            border-radius: 25px;
            cursor: pointer;
            position: absolute;
            margin-left: 900px;
            margin-bottom: 650px;
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
            /* Green */

        }

        .boton2:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            border: 2px solid #FFB347;
            background-color: #FFB347;
        }
    </style>
</head>

<body onload="initializeVideoPlayer()">
    <header class="header">
        <div>

            <?php

            $contenido = glob("uploads/*.{mp4,webm,ogg}", GLOB_BRACE);
            if (!empty($contenido)) {
                // Ordenar la lista de videos por fecha de modificación
                array_multisort(array_map('filemtime', $contenido), SORT_DESC, $contenido);
                $video_url = $contenido[0];
                $video_type = pathinfo($video_url, PATHINFO_EXTENSION);
                // echo '<video id="my-video"  style="margin-left: -16%; max-width:90%; height: 1000px ;   margin-top: -280px ;" preload="auto" padding="10px;" loop controls autoplay muted>
                //         <source src="' . $video_url . '" type="video/' . $video_type . '">
                //       </video>';
                echo '<video id="my-video"  style="margin-left: -16%; max-width:90%; height: 1000px ;   margin-top: -280px ;" preload="auto" padding="10px;" preload="auto" controls autoplay muted>
                <source src="' . $contenido[0] . '" type="video/' . pathinfo($contenido[0], PATHINFO_EXTENSION) . '">
              </video>';
            }

            echo '<script>
        var videos = ' . json_encode($contenido) . ';
        var myVideo = document.getElementById("my-video");
        var currentVideoIndex = 0;

        myVideo.addEventListener("ended", playNextVideo);

        function playNextVideo() {
            currentVideoIndex = (currentVideoIndex + 1) % videos.length;
            myVideo.src = videos[currentVideoIndex];
            myVideo.load();
            myVideo.play();
        }
    </script>';
            //
            // echo "<ul>";

            // foreach ($contenido as $video) {
            //     echo "<li><a href='#' data-src='$video'>" . basename($video) . "</a></li>";
            //  }
            //  echo "</ul>";


            ?>
        </div>
        <div class="container">
            <div>
                <h1>Contenedor 1</h1>
                <form method="post" onsubmit="location.reload()"> <!-- Resto del formulario -->
                    <button class="boton" type="submit">Subir</button>
                </form>
            </div>
    </header>

    <main>
        <!-- <button  class="boton2" type="submit">Subir</button> </form> -->
        <div class="menu">
            <div>
                <h2>Cargar archivos</h2>
            </div>
            <div id="dropzone">
                <p>arrastre los archivos en esta zona <label for="archivos">o haga click aqui</label></p>
            </div>
            <select name="videos" id="videos" class="mi-select">
                <?php foreach ($contenido as $video) : ?>
                    <option value="<?php echo $video; ?>" class="mi-option"><?php echo basename($video); ?></option>
                <?php endforeach; ?>
            </select>
            

            <div>
                <input type="file" id="archivos" name="archivos" multiple><!--lectura de archivos, varios archivos en simultaneo-->
            </div>
        </div>







    </main>


    <script src="js/script.js"></script>


</body>

</html>