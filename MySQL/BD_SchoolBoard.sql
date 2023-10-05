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

INSERT INTO usuario (documento, clave, rol, estado, tipoDoc, nombres, apellidos, correo, foto) VALUES 
(1, MD5('administrador'), 'Administrador', 'activo', 'CC','Administrador', 'Prueba', NULL, '../../Uploads/Usuario/fotoUsuario.jpg'),
(2, MD5('docente'), 'Docente', 'activo', 'CC','Docente', 'Prueba', NULL, '../../Uploads/Usuario/fotoUsuario.jpg'),
(3, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Estudiante', 'Prueba', NULL, '../../Uploads/Usuario/fotoUsuario.jpg'),
(12345, MD5('12345'), 'Docente', 'activo', 'CC','Felipe', 'Restrepo','lfrestrepo004@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(1023163094, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Nicole', 'Benavides', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

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

INSERT INTO aula(nombre) VALUES 
('Laboratorio 102'),
('119 Torre oriental'),
('301 Torre occidental');

CREATE TABLE observador (
    idObservador INT AUTO_INCREMENT,
    idEstudiante INT,
    idAutor INT,
    fecha DATETIME DEFAULT NOW(),
    observacion VARCHAR(400),
    PRIMARY KEY (idObservador),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento),
    FOREIGN KEY (idAutor) REFERENCES usuario(documento)
);

INSERT INTO observador(idEstudiante, idAutor, observacion) VALUES 
(3, 1,'El estudiante no cumple con el uniforme de la institución'),
(3, 1,'El estudiante no presta atención en clase y distrae a sus compañeros');

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

INSERT INTO comunicado(titulo, descripcion, archivos) VALUES 
('Cancelación de clase', 'El día de mañana no habrá clase en porque se suspenderá el agua en el colegio','../Vista/Uploads/Comunicados/Arte Marcial - Felipe Angarita.pdf'),
('Entrega de boletines', 'La entrega de voletines se hará el día 20/11/2024 desde las 8:00a.m. En los proximos días el director de cada uno de los cursos estará comunicando la hora exacta de la reunión para cada estudiante.','../Vista/Uploads/Comunicados/Arte Marcial - Felipe Angarita.pdf');

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


CREATE TABLE acudiente (
    documento INT,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(15),
    correo VARCHAR(100),
    PRIMARY KEY (documento)
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
