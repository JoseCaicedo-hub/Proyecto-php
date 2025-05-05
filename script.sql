create database proyectophp_db;
USE proyectophp_db;
CREATE TABLE personas(
	pk_id_personas INT PRIMARY KEY AUTO_INCREMENT,
    pers_nombre VARCHAR(50),
    pers_tefelefono VARCHAR (50),
    pers_correo varchar(45) ,
	pers_clave varchar(255) ,
	pers_fecha_registro datetime
);

CREATE TABLE inventarios(
	pk_id_inventario int primary key auto_increment, 
	inve_nombre_producto varchar(45) ,
	inve_cantidad_producto int ,
	inve_precio_producto float ,
	inve_fecha_registro timestamp
);


CREATE TABLE roles(
	pk_id_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre_rol VARCHAR(20)
);

select*from roles;