$(document).ready(function(){
    setInterval(
        function(){
            $.getJSON('http://localhost/arduino-mysql/src/php/led.php',function(datos){
        //  $.each(datos,function(i,value){
        //      console.log(i + " " + value );
        //  });
        var estado = datos.estado;
        if(estado == 1){
            $('#estadoLed').text("Encendido");
        }else{
            $('#estadoLed').text("Apagado");
        }
     });
        },1000);
});