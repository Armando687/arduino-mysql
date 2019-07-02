CREATE TABLE temperatura_humedad(
	id int AUTO_INCREMENT PRIMARY KEY,
    temperatura  int,
    humedad int,
    fecha timestamp
);
CREATE TABLE conexion_electrica(
	id int AUTO_INCREMENT PRIMARY KEY,
    estado boolean,
    fecha timestamp
);
CREATE TABLE ventilador(
	id int AUTO_INCREMENT PRIMARY KEY,
    estado boolean,
    fecha timestamp
);
CREATE TABLE bomba_hidraulica(
	id int AUTO_INCREMENT PRIMARY KEY,
    estado boolean,
    fecha timestamp
);
CREATE TABLE configuracion(
	id int AUTO_INCREMENT PRIMARY KEY,
    temperatura_min int,
    temperatura_max int,
    temperatura_media int,
    temperatura_critica int,
    fecha timestamp
)