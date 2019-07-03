# Proyecto de Arduino y mysql conexión directa a db por medio de una tarjeta Ethernet
Este es un ejemplo con una simulación básica de un sistema Contra incendios, en el cual tomamos convenciones de sistemas de tiempo real.

Este ejemplo consta de dos partes uno  al codigo base de arduino con conexión directa a base de datos, el cual guarda los datos en tiempo real de forma optima solo si los datos de lectura diferentes (no guarda constantemente los datos, si la lectura se mantine con los mismos datos); se a modularisado las consultas en funciones independientes para su mejor comprención.
La segunda parte corresponde al cliente, que lee los datos de base de datos, en una simulación de tiempo de real. el cual esta echa en php7 
con pequeñas consultas a las diferentes tablas, estas son convertidas en formato JSON , donde son llamados desde una una funcion Javascript Jquery que las setea en tabla correspondiente en un setInterval de 2000ms.

En el cliente existe una opción de configuraciones,la cual es interpretada por el arduino para los intervalos de temperatura a considerar en la simulación; Temperatura mínima , Temperatura máxima, Temperatura media y Temperatura Crítica. Es importante mensionar que solo debe existir una única configuración de en base de datos, de existir mas de un dato de configuración, ocacionaría fallos en el código de lectura del arduino.
![index.php](https://github.com/Armando687/arduino-mysql/blob/master/img/arduino-mysql-index.png)
![config.php](https://github.com/Armando687/arduino-mysql/blob/master/img/arduino-mysql-configuraciones.png)
## Requisitos
### Servidor
* tener instalado LAMP con php >= 7 *v.
### Arduino
* Arduino Mega 2560
* Dos censores de Temperatura y Humedad DHT11
* Una pantalla LCD I2C
* Resistemcias de 1K
* Un led
* Un cooler o ventilador
* Motor de 5v Para bomba de agua
![esquema-base](https://github.com/Armando687/arduino-mysql/blob/master/img/esquema-base.jpeg)
## Configuraciones 
* Crear 3 usuarios Mysql para uso exclucivo del servicio para arduino, en el directorio ./db/createUser.sql se encuetra un script para crear los usuarios,  un usuario localhost , un usuario any % y por ultimo un usuario con la ip del servidor mysql.
`CREATE USER 'arduino'@'192.168.1.2' IDENTIFIED BY 'arduino';
GRANT ALL PRIVILEGES ON *.* TO 'arduno'@'192.168.1.2' WITH GRANT OPTION;
FLUSH PRIVILEGES;
exit`
 Ejecute cada uno directame en consola mysql, para entrar a la consola de mysql ejecute el comando `sudo mysql -u root -p` 
 * Ahora debe proporcionar la direccion ip de mysql, vaya a al directorio `/etc/mysql` y abra el archivo my.cnf y editelo como se muestra en la imagen `sudo nano my.cnf`
 ![configuracion-mysql](https://github.com/Armando687/arduino-mysql/blob/master/img/mysql-ip.png)
 * Ahora importe la base de datos se encuentra en ./db/db_arduino.sql , es importante que el nombre de la base de datos sea en minúsculas y de ser necesario separado por guion bajo, el uso de otro tipo de caracteres, ocacionara fallos en la conexion de arduino a mysql.
 * Bien ahora solo queda hacer unas pequeñas modificaciones al codigo de arduino, modifique el nombre de usuario y password para mysql, ademas de proporcionarle la ip del servidor mysql y una ip para escuchar a arduino.
 `byte mac_addr[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
    IPAddress server_mysql(192,168,1,10);// IP of the MySQL *server* here
    IPAddress server_addr(192,168,1,50);// IP of the arduiono *server* here
    char user[] = "arduino";              // MySQL user login username
    char password[] = "arduino";        // MySQL user login password `
* Ahora estamos listos, si estas en linux puede que necesites dar permisos al puerto antes de ejecutarlo, usa este comando para habilitar el puerto usb `ls -l /dev | grep ACM` y `sudo chmod 777 /dev/ttyACM1` este comando solo esta activo mientras el puerto usb sigue conectado, cuando lo desconectes este se restaurara y tendras que repetir el proceso. Ahora simplemente toca probar codigo.

