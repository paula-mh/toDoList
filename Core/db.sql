DROP DATABASE toDoList;

CREATE DATABASE toDoList;
USE toDoList;


CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(255) UNIQUE,
    passwd VARCHAR(255)
);


CREATE TABLE tareas (
    id VARCHAR(255) PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion VARCHAR(255),
    estado VARCHAR(255),
    usuario VARCHAR(255)
);