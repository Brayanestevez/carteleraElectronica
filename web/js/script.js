var videoPlayer = document.getElementById('my-video');
var videoLinks = document.querySelectorAll('ul li a');

for (var i = 0; i < videoLinks.length; i++) {
    videoLinks[i].addEventListener('click', function(event) {
        event.preventDefault();
        var videoSource = this.getAttribute('data-src');
        videoPlayer.src = videoSource;
        videoPlayer.load();
        videoPlayer.play();
    });
}

const dropzone = document.getElementById('dropzone');
const archivos = document.getElementById('archivos');

dropzone.addEventListener('dragover', e => {
    e.preventDefault();
})
dropzone.addEventListener('drop', uploadArchivos);
archivos.addEventListener('change', uploadArchivos);

function uploadArchivos(e) {
    e.preventDefault();
    const FD = new FormData()
    const listado_archivos = e.target.id == 'archivos' ?
        archivos.files :
        e.dataTransfer.files;

    for (let file of listado_archivos) {
        FD.append('files[]', file)
    }

    fetch('upload.php', { method: 'POST', body: FD })
        .then(rta => rta.json())
        .then(json => {
            console.log(json);
            playNextVideo();
        })

    archivos.value = '';
}

function playNextVideo() {
    var video_list = document.querySelectorAll("ul li a");
    var current_video_src = document.querySelector("video source").src;
    var current_video_index = 0;
    for (var i = 0; i < video_list.length; i++) {
        if (video_list[i].getAttribute("data-src") == current_video_src) {
            current_video_index = i;
            break;
        }
    }
    var next_video_index = (current_video_index + 1) % video_list.length;
    var next_video_src = video_list[next_video_index].getAttribute("data-src");
    document.querySelector("video source").src = next_video_src;
    document.querySelector("video").load();
    document.querySelector("video").play();
}

var video_player = document.querySelector("video");
video_player.addEventListener("ended", playNextVideo);



//----------------------------------

    document.querySelector("form").addEventListener("submit", function (e) {
        e.preventDefault();

        // Crear un objeto FormData para enviar el archivo
        const formData = new FormData(this);

        // Realizar una solicitud AJAX para subir el archivo
        fetch("subir_video.php", {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.message); // Mostrar alerta de éxito
            } else {
                alert(data.message); // Mostrar alerta de error
            }
        })
        .catch((error) => {
            console.error("Error al subir el video", error);
        });
    });

