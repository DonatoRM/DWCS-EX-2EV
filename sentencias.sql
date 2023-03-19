CREATE DATABASE ejercicio1;
CREATE user 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON ejercicio1.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;
use ejercicio1;
CREATE TABLE usuarios(
    usuario varchar(32),
    contrasena varchar(64) not null,
    rol bool,
    constraint usu_pk primary key(usuario)
);
INSERT INTO usuarios SELECT 'User1',sha2('1234',256),true;
