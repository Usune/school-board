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

INSERT INTO usuario (documento, clave, rol, estado, nombres, correo, foto) VALUES 

('estudiante', MD5('estudiante'), 'Estudiante', 'activo', 'Estudiante', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('docente', MD5('docente'), 'Docente', 'activo', 'Docente', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('administrador', MD5('administrador'), 'Administrador', 'activo', 'Administrador', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

('12345', MD5('12345'), 'Docente', 'activo', 'Felipe', 'Restrepo','lfrestrepo004@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

INSERT INTO usuario (idUsuario, documento, clave, rol, estado, tipoDoc, nombres, apellidos, telefono, direccion, correo, foto, fechaCreacion) VALUES
(1, 'administrador', '91f5167c34c400758115c2a6826ec2e3', 'Administrador', 'activo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-02 01:28:26'),
(1023163094, 'estudiante', 'e4e4564027d73a4325024d948d167e93', 'Estudiante', 'activo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-02 01:28:26'),
(4, 'estudiante2', 'e4e4564027d73a4325024d948d167e93', 'Estudiante', 'activo', NULL, 'Nicole', NULL, NULL, NULL, NULL, NULL, '2023-09-02 01:28:26'),
(5, 'estudiante3', 'e4e4564027d73a4325024d948d167e93', 'Estudiante', 'activo', NULL, 'Nicole', NULL, NULL, NULL, NULL, NULL, '2023-09-02 01:28:26'),
(6, 'estudiante3', 'e4e4564027d73a4325024d948d167e93', 'Estudiante', 'activo', NULL, 'Carolina', NULL, NULL, NULL, NULL, NULL, '2023-09-02 01:42:23');



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

INSERT INTO curso (jornada, nombre) VALUES ('unica', 'PRIMERO');
INSERT INTO curso (jornada, nombre) VALUES ('unica', 'SEGUNDO');
INSERT INTO curso (jornada, nombre) VALUES ('unica', 'TERCERO');

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

INSERT INTO `estudiantecurso` (`idestudianteCurso`, `idCurso`, `idUsuario`) VALUES
(1, 1, 1023163094),
(2, 1, 5),
(3, 2, 6);


CREATE TABLE asignatura (
    idAsignatura INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    PRIMARY KEY (idAsignatura)
);

    INSERT INTO asignatura (nombre) VALUES ('Matemáticas');
    INSERT INTO asignatura (nombre) VALUES ('Español');
    INSERT INTO asignatura (nombre) VALUES ('Ciencias');
    INSERT INTO asignatura (nombre) VALUES ('Sociales');
    INSERT INTO asignatura (nombre) VALUES ('Fisica');
    INSERT INTO asignatura (nombre) VALUES ('Ciencias prueba');

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


INSERT INTO clase (idClase, idCurso, idAsignatura, idProfesor) VALUES
(1, 1, 2, NULL),
(2, 1, 4, NULL),
(3, 2, 1, NULL);


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

-- #show tables;