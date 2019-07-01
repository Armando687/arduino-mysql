$(document).ready(function(){
    setInterval(
        function(){
            $.getJSON('http://localhost/arduino-mysql/src/php/extintor.php',function(datos){
        //  $.each(datos,function(i,value){
        //      console.log(i + " " + value );
        //  });
        var estado = datos.estado;
        if(estado == 1){
            $('#estadoMt').text("Encendido");
        }else{
            $('#estadoMt').text("Apagado");
        }
     });
        },1000);
});