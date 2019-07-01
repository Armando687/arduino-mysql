$(document).ready(function(){
    setInterval(
        function(){
            $.getJSON('http://localhost/arduino-mysql/src/php/ventilador.php',function(datos){
        //  $.each(datos,function(i,value){
        //      console.log(i + " " + value );
        //  });
        var estado = datos.estado;
        if(estado == 1){
            $('#estadoVt').text("Encendido");
        }else{
            $('#estadoVt').text("Apagado");
        }
     });
        },1000);
});