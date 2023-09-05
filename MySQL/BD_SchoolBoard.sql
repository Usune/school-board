--Tablas 
--DROP DATABASE SB;

-- school.board.company@gmail.com
-- 75920school

CREATE DATABASE SB;
USE  SB;

-- El documento debe ser INT

CREATE TABLE usuario (
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
    PRIMARY KEY (documento)
);

INSERT INTO usuario (documento, clave, rol, estado, nombres, correo, foto) VALUES 

('estudiante', MD5('estudiante'), 'Estudiante', 'activo', 'Estudiante', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('docente', MD5('docente'), 'Docente', 'activo', 'Docente', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('administrador', MD5('administrador'), 'Administrador', 'activo', 'Administrador', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('12345', MD5('12345'), 'Docente', 'activo', 'Felipe','lfrestrepo004@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('1023163094', MD5('estudiante'), 'Estudiante', 'activo', 'Nicole',NULL, '../../Uploads/Usuario/fotoUsuario.jpg');



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

INSERT INTO curso (jornada, nombre) VALUES 
('unica', 'PRIMERO'),
('unica', 'SEGUNDO'),
('unica', 'TERCERO');

CREATE TABLE aula (
    idAula INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    PRIMARY KEY (idAula)
);

CREATE TABLE estudianteAcudiente (--Tabla intermedia que relaciona estudiante y acudiente
    idEstudianteAcudiente INT AUTO_INCREMENT,
    idAcudiente INT,
    idEstudiante VARCHAR(15),
    PRIMARY KEY (idEstudianteAcudiente),
    FOREIGN KEY (idAcudiente) REFERENCES acudiente(idAcudiente),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);


CREATE TABLE estudianteCurso (
    idestudianteCurso INT AUTO_INCREMENT,
    idCurso INT,
    idEstudiante VARCHAR(15),
    PRIMARY KEY (idestudianteCurso),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);


INSERT INTO estudianteCurso (idCurso, idEstudiante) VALUES 
(1, '1023163094'),
(1, 'estudiante'),
(2, '12345');


CREATE TABLE asignatura (
    idAsignatura INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    PRIMARY KEY (idAsignatura)
);

INSERT INTO asignatura (nombre) VALUES 
('Matemáticas'),
('Español'),
('Ciencias'),
('Sociales'),
('Fisica'),
('Ciencias prueba');


CREATE TABLE clase (
    idClase INT AUTO_INCREMENT,
    idCurso INT,
    idAsignatura INT,
    idDocente VARCHAR(15), 
    idAula INT,
    descripción VARCHAR(400),
    PRIMARY KEY (idClase),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso),
    FOREIGN KEY (idDocente) REFERENCES usuario(documento),
    FOREIGN KEY (idAsignatura) REFERENCES asignatura(idAsignatura)
);



INSERT INTO clase (idCurso, idAsignatura, idDocente) VALUES
(1, 2, 'docente'),
(1, 4, NULL),
(2, 1, 'docente');


CREATE TABLE asistencia (
    idAsistencia INT AUTO_INCREMENT,
    idClase INT,
    idEstudiante VARCHAR(15),
    fecha DATETIME DEFAULT NOW(),
    estado ENUM('Asiste', 'Falta', 'Falta Justificada', 'Retardo'),
    PRIMARY KEY (idAsistencia),
    FOREIGN KEY (idClase) REFERENCES clase(idClase),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);

CREATE TABLE observador (
    idObservador INT AUTO_INCREMENT,
    idEstudiante VARCHAR(15),
    idDocente VARCHAR(15),
    fecha DATETIME DEFAULT NOW(),
    observacion VARCHAR(400),
    PRIMARY KEY (idObservador),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento),
    FOREIGN KEY (idDocente) REFERENCES usuario(documento)
);

CREATE TABLE comunicado (
    idComunicado INT AUTO_INCREMENT,
    idUsuario VARCHAR(15),
    titulo VARCHAR(200),
    fecha DATETIME DEFAULT NOW(),
    descripcion VARCHAR(400),
    archivo VARCHAR(200),
    PRIMARY KEY (idComunicado),
    FOREIGN KEY (idUsuario) REFERENCES usuario(documento)
);

CREATE TABLE tarea (
    idTarea INT AUTO_INCREMENT,
    idClase INT,
    titulo VARCHAR(200),
    descripcion VARCHAR(200),
    fecha_creacion	DATETIME DEFAULT NOW(),
    fecha_vencimiento DATETIME,
    archivos VARCHAR(400),
    PRIMARY KEY(idTarea),
    FOREIGN KEY (idClase) REFERENCES clase(idClase)
);


INSERT INTO tarea (idClase, titulo, descripcion, fecha_creacion, fecha_vencimiento, archivos) VALUES
(1, 'Ensayo sobre Tecnologia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-09-08 13:11:5', NULL);


-- #show tables;