$(document).ready(function(){
    setInterval(
        function(){
            $.getJSON('http://localhost/arduino-mysql/src/php/dht.php',function(datos){
        //  $.each(datos,function(i,value){
        //      console.log(i + " " + value );
        //  });
        //console.log(datos.temperatura);
        $('#temperatura').text(datos.temperatura);
        $('#humedad').text(datos.humedad);
        $('#fecha').text(datos.fecha);
     });
        },1000);
});