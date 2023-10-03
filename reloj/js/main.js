//Reloj principal
function reloj () {
  var fecha = new Date();
  var hora = fecha.getHours();
  var minutos = fecha.getMinutes();

  //Agregar cero delante a numeros con 1 solo digito
  if (hora<10) { 
    hora = "0"+hora;
  }
  if (minutos<10) {
    minutos = "0"+minutos;
  }

  $("#hora").text(hora);
  $("#min").text(minutos);

  //Imágenes Background
  if(hora >= 1 && hora <6 ){
    $("section").removeClass("noche");
    $("section").addClass("madrugada");
  }
  if(hora >= 6 && hora <12 ){
    $("section").removeClass("noche");
    $("section").addClass("dia");
  }
  if(hora >= 12 && hora <19 ){
    $("section").removeClass("dia");
    $("section").addClass("tarde");
  }
  if(hora >= 19 && hora <24 ){
    $("section").removeClass("tarde");
    $("section").addClass("noche");
  }

}
// Avance de hora
reloj();
var intervalo = setInterval(reloj, 1000); 


//Fecha
var fecha = new Date();
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$("#fecha").html(diasSemana[fecha.getDay()] + ", " + fecha.getDate() + " de " + meses[fecha.getMonth()]);


//Horas Ciudades
//Debe haber otro metodo mas adecuado, pero en fin...
function ciudades () {
  var fecha = new Date();
  var horaLocal = fecha.getHours();
  var minutos = fecha.getMinutes();

  //Agregar cero delante a numeros con 1 solo digito
  if (horaLocal<10) {
    horaLocal = "0"+horaLocal;
  }
  if (minutos<10) {
    minutos = "0"+minutos;
  }


 
}


//Recarga de Doc
$(document).ready(function() {
  reloj();
  ciudades();
});

const apiKey = 'PEiqEJAUDpFgshFMpm6Lq8x2QijOQ3zU';
const ciudad = 'Bucaramanga';

fetch(`https://dataservice.accuweather.com/currentconditions/v1/349727?apikey=${apiKey}`)
  .then(response => response.json())
  .then(data => {
    const weather = data[0].WeatherText;

    if (weather.includes('Rain')) {
      document.body.classList.add('lluvia');
    } else if (weather.includes('Cloudy')) {
      document.body.classList.add('nublado');
    }
  })
  .catch(error => {
    console.error(error);
  });