--Tablas 

-- school.board.company@gmail.com
-- 75920sb-

DROP DATABASE SB;
CREATE DATABASE SB;
USE  SB;

CREATE TABLE usuario (
    documento INT,
    clave VARCHAR(100),
    rol ENUM('Administrador','Docente','Estudiante','Master'),
    estado ENUM('Activo', 'Pendiente', 'Inactivo'),
    tipoDoc ENUM('CC', 'TI', 'Pasaporte'), 
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(15),
    direccion VARCHAR(100),
    correo VARCHAR(100),
    foto VARCHAR(200),
    fechaCreacion DATETIME DEFAULT NOW(),
    PRIMARY KEY (documento)
);

INSERT INTO usuario (documento, clave, rol, estado, nombres, apellidos, correo, foto) VALUES 
(1, MD5('administrador'), 'Administrador', 'activo', 'Administrador', 'Prueba', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(2, MD5('docente'), 'Docente', 'activo', 'Docente', 'Prueba', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(3, MD5('estudiante'), 'Estudiante', 'activo', 'Estudiante', 'Prueba', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(12345, MD5('12345'), 'Docente', 'activo', 'Felipe', 'Restrepo','lfrestrepo004@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(1023163094, MD5('estudiante'), 'Estudiante', 'activo', 'Nicole', 'Benavides', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

CREATE TABLE acudiente (
    documento INT,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(15),
    correo VARCHAR(100),
    PRIMARY KEY (documento)
);

CREATE TABLE curso (
    idCurso INT AUTO_INCREMENT,
    jornada ENUM('Única', 'Mañana', 'Tarde'),
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

CREATE TABLE estudianteAcudiente (
    idEstudianteAcudiente INT AUTO_INCREMENT,
    idAcudiente INT,
    idEstudiante INT,
    PRIMARY KEY (idEstudianteAcudiente),
    FOREIGN KEY (idAcudiente) REFERENCES acudiente(documento),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);

CREATE TABLE estudianteCurso (
    idestudianteCurso INT AUTO_INCREMENT,
    idCurso INT,
    idEstudiante INT,
    fechaCreacion DATETIME DEFAULT NOW(),
    PRIMARY KEY (idestudianteCurso),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);

INSERT INTO estudianteCurso (idCurso, idEstudiante) VALUES 
(1, 1023163094),
(1, 3);

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
    idDocente INT, 
    idAula INT,
    descripción VARCHAR(400),
    PRIMARY KEY (idClase),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso),
    FOREIGN KEY (idDocente) REFERENCES usuario(documento),
    FOREIGN KEY (idAsignatura) REFERENCES asignatura(idAsignatura)
);

INSERT INTO clase (idCurso, idAsignatura, idDocente) VALUES
(1, 2, 2),
(2, 1, 2);

CREATE TABLE asistencia (
    idAsistencia INT AUTO_INCREMENT,
    idClase INT,
    idEstudiante INT,
    fecha DATETIME DEFAULT NOW(),
    estado ENUM('Asiste', 'Falta', 'Falta Justificada', 'Retardo'),
    PRIMARY KEY (idAsistencia),
    FOREIGN KEY (idClase) REFERENCES clase(idClase),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);

CREATE TABLE observador (
    idObservador INT AUTO_INCREMENT,
    idEstudiante INT,
    idDocente INT,
    fecha DATETIME DEFAULT NOW(),
    observacion VARCHAR(400),
    PRIMARY KEY (idObservador),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento),
    FOREIGN KEY (idDocente) REFERENCES usuario(documento)
);

CREATE TABLE comunicado (
    idComunicado INT AUTO_INCREMENT,
    idUsuario INT,
    idCurso INT,
    titulo VARCHAR(200),
    fecha DATETIME DEFAULT NOW(),
    descripcion VARCHAR(400),
    archivos VARCHAR(200),
    PRIMARY KEY (idComunicado),
    FOREIGN KEY (idUsuario) REFERENCES usuario(documento),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso)
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
(1, 'Ensayo sobre Tecnologia1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-09-13 13:11:05', NULL),
(1, 'Ensayo sobre Tecnologia2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-09-24 00:48:12', NULL),
(1, 'Ensayo sobre Tecnologia3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-05-08 13:11:05', NULL);

CREATE TABLE entrega(
    idEntrega INT AUTO_INCREMENT,
    descripcion VARCHAR(200),
    archivos VARCHAR(400),
    PRIMARY KEY (idEntrega)
);
