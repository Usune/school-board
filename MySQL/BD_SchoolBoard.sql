--Tablas 
--DROP DATABASE SB;

-- school.board.company@gmail.com
-- 75920school

CREATE DATABASE SB;
USE  SB;

CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT,
    documento VARCHAR(15),
    clave VARCHAR(100),
    rol ENUM('Administrador','Docente','Estudiante','Master'),
    estado ENUM('activo', 'pendiente', 'inactivo'),
    tipoDoc ENUM('CC', 'TI', 'pasaporte'), 
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(15),
    direccion VARCHAR(100),
    correo VARCHAR(100),
    foto VARCHAR(200),
    fechaCreacion DATETIME DEFAULT NOW(),
    PRIMARY KEY (idUsuario)
);

INSERT INTO usuario (documento, clave, rol, estado, nombres, correo, foto) VALUES ('estudiante', MD5('estudiante'), 'Estudiante', 'activo', 'Estudiante', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

INSERT INTO usuario (documento, clave, rol, estado, nombres, correo, foto) VALUES ('docente', MD5('docente'), 'Docente', 'activo', 'Docente', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

INSERT INTO usuario (documento, clave, rol, estado, nombres, correo, foto) VALUES ('administrador', MD5('administrador'), 'Administrador', 'activo', 'Administrador', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

INSERT INTO usuario (documento, clave, rol, estado, nombres, apellidos, correo, foto) VALUES ('12345', MD5('12345'), 'Docente', 'activo', 'Felipe', 'Restrepo','lfrestrepo004@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

CREATE TABLE acudiente (
    idAcudiente INT AUTO_INCREMENT,
    documento VARCHAR(15),
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(15),
    correo VARCHAR(100),
    PRIMARY KEY (idAcudiente)
);

CREATE TABLE curso (
    idCurso INT AUTO_INCREMENT,
    jornada ENUM('unica', 'mañana', 'tarde'),
    nombre VARCHAR(15),
    PRIMARY KEY (idCurso)
);

CREATE TABLE aula (
    idAula INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    PRIMARY KEY (idAula)
);


CREATE TABLE estudianteAcudiente (--Tabla intermedia que relaciona estudiante y acudiente
    idEstudianteAcudiente INT AUTO_INCREMENT,
    idAcudiente INT,
    idEstudiante INT,
    PRIMARY KEY (idEstudianteAcudiente),
    FOREIGN KEY (idAcudiente) REFERENCES acudiente(idAcudiente),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(idUsuario)
);

CREATE TABLE estudianteCurso (
    idestudianteCurso INT AUTO_INCREMENT,
    idCurso INT,
    idUsuario INT,
    PRIMARY KEY (idestudianteCurso),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

CREATE TABLE asignatura (
    idAsignatura INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    PRIMARY KEY (idAsignatura)
);

CREATE TABLE clase (--Ver si este nombre funciona o pensar en otro
    idClase INT AUTO_INCREMENT,
    idCurso INT,
    idAsignatura INT,
    idProfesor INT, --aquí el usuario tiene el rol de profesor
    idAula INT,
    descripción VARCHAR(400),
    PRIMARY KEY (idClase),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso),
    FOREIGN KEY (idProfesor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idAsignatura) REFERENCES asignatura(idAsignatura)
);

CREATE TABLE asistencia (
    idAsistencia INT AUTO_INCREMENT,
    idClase INT,
    idEstudiante INT,
    fecha DATETIME DEFAULT NOW(),
    estado ENUM('Asiste', 'Falta', 'Falta Justificada', 'Retardo'),
    PRIMARY KEY (idAsistencia),
    FOREIGN KEY (idClase) REFERENCES clase(idClase),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(idUsuario)
);

CREATE TABLE observador (
    idObservador INT AUTO_INCREMENT,
    idEstudiante INT,
    idProfesor INT,
    fecha DATETIME DEFAULT NOW(),
    observacion VARCHAR(400),
    PRIMARY KEY (idObservador),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idProfesor) REFERENCES usuario(idUsuario)
);

CREATE TABLE comunicado (
    idComunicado INT AUTO_INCREMENT,
    idUsuario INT,
    titulo VARCHAR(200),
    fecha DATETIME DEFAULT NOW(),
    descripcion VARCHAR(400),
    archivo VARCHAR(200),
    PRIMARY KEY (idComunicado),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);







-- create table asignatura(
-- 	idAsignatura int auto_increment,
--     nombre varchar(45) not null,
--     primary key (idAsignatura)
-- );

-- create table acudiente(
-- 	idAcudiente int auto_increment,
-- 	idEstudiante int not null,
--     nombres varchar(45) not null,
--     apellidos varchar(45) not null,
--     documento varchar(10) not null,
--     telefono varchar(10) not null,
--     correo varchar(45) not null,
--     primary key (idAcudiente),
--     foreign key (idEstudiante) references estudiante(idEstudiante)
-- );

-- create table profesor(
-- 	idProfesor int auto_increment,
--     nombres varchar(45) not null,
--     apellidos varchar(45) not null,
--     documento varchar(10) not null,
--     correo varchar(45) not null,
--     clave varchar(20) not null,
--     telefono varchar(10) not null,
--     direccion varchar(45) not null,
--     primary key (idProfesor)
-- );

-- create table clase(
-- 	idClase int auto_increment,
--     idCurso int not null,
-- 	idProfesor int not null,
--     idAsignatura int not null,
--     primary key (idClase),
--     foreign key (idCurso) references curso(idCurso),
--     foreign key (idProfesor) references profesor(idProfesor),
--     foreign key (idAsignatura) references asignatura(idAsignatura)
-- );

-- create table asistencia(
-- 	idAsistencia int auto_increment,
--     idEstudiante int not null,
--     idClase int not null,
--     estado varchar(20) not null,
--     fecha date not null,
--     primary key(idAsistencia),
--     foreign key(idEstudiante) references estudiante(idEstudiante),
--     foreign key(idClase) references clase(idClase)
-- );

-- create table observador(
-- 	idObservador int auto_increment,
--     idProfesor int not null,
--     idEstudiante int not null,
--     fecha datetime not null,
--     observacion varchar(200) not null,
--     primary key(idObservador),
--     foreign key (idProfesor) references profesor(idProfesor),
--     foreign key (idEstudiante) references estudiante(idEstudiante)
-- );

-- create table tarea(
-- 	idTarea int auto_increment,
--     idClase int not null,
--     tipo varchar(20) not null,
--     titulo varchar(45) not null,
--     descripcion varchar(200),
--     material blob(3),
--     fecha datetime not null,
--     fechaLimite datetime not null,
--     estado varchar(20) not null,
--     primary key (idTarea),
--     foreign key (idClase) references clase(idClase)
-- );

-- create table entrega(
-- 	idEntrega int auto_increment,
--     idTarea int not null,
--     idEstudiante int not null,
--     fecha datetime not null,
--     descripcion varchar(100),
--     archivo varbinary(3),
--     primary key (idEntrega),
--     foreign key (idTarea) references tarea(idTarea),
--     foreign key (idEstudiante) references estudiante(idEstudiante)
-- );

-- create table calificacion(
-- 	idCalificacion int auto_increment,
--     idEstudiante int not null,
--     idTarea int not null,
--     nota int not null,
--     comentario varchar(100),
--     primary key (idCalificacion),
--     foreign key (idTarea) references tarea(idTarea),
--     foreign key (idEstudiante) references estudiante(idEstudiante)
-- );

-- #show tables;