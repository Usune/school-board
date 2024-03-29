-- Tablas 

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

CREATE TABLE asignatura (
    idAsignatura INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    PRIMARY KEY (idAsignatura)
);

CREATE TABLE curso (
    idCurso INT AUTO_INCREMENT,
    jornada ENUM('Única', 'Mañana', 'Tarde'),
    nombre VARCHAR(15),
    PRIMARY KEY (idCurso)
);

CREATE TABLE aula (
    idAula INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    capacidad VARCHAR(3),
    PRIMARY KEY (idAula)
);

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
    FOREIGN KEY (idAsignatura) REFERENCES asignatura(idAsignatura),
    FOREIGN KEY (idAula) REFERENCES aula(idAula)
);

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
    idDocente INT,
    titulo VARCHAR(200),
    descripcion VARCHAR(200),
    fecha_creacion	DATETIME DEFAULT NOW(),
    fecha_vencimiento DATETIME,
    archivos VARCHAR(400),
    PRIMARY KEY(idTarea),
    FOREIGN KEY (idClase) REFERENCES clase(idClase),
    FOREIGN KEY (idDocente) REFERENCES usuario(documento)
);

CREATE TABLE entrega (
    idEntrega INT AUTO_INCREMENT,
    idEstudiante INT,
    idTarea INT,
    fecha_entrega_est DATETIME DEFAULT NOW(),
    descripcion VARCHAR(200),
    archivos VARCHAR(400) DEFAULT NULL,
    PRIMARY KEY (idEntrega),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento),
    FOREIGN KEY (idTarea) REFERENCES tarea(idTarea)
);

CREATE TABLE calificacion(
    idCalificacion INT AUTO_INCREMENT,
    idEntrega INT ,
    fecha_calificacion  DATETIME DEFAULT NOW(),
    observacion VARCHAR(200),
    nota DECIMAL(3,1),
    PRIMARY KEY (idCalificacion),
    FOREIGN KEY (idEntrega) REFERENCES entrega(idEntrega)
);

INSERT INTO usuario (documento, clave, rol, estado, tipoDoc, nombres, apellidos, correo, foto) VALUES 
(1, MD5('administrador'), 'Administrador', 'activo', 'CC','Estefani', 'Arenas', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(2, MD5('docente'), 'Docente', 'activo', 'CC','Felipe', 'Restrepo','lfrestrepo004@gmail.com', '../../Uploads/Usuario/userFelipe.jpg'),
(31, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Estudiante', 'Prueba', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),

(4, MD5('docente'), 'Docente', 'activo', 'CC','Docente', 'Prueba', 'yuraniester@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(1023163093, MD5('docente'), 'Docente', 'activo', 'CC','Angelica Maria', 'Triana Guarnizo', 'angelica@gmail.com', '../../Uploads/Usuario/userAngelica.jpg'),

(3, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Nicole Dayana', 'Benavides Alfonso', 'nicole.benavides@misena.edu.co', '../../Uploads/Usuario/userNicole.jpg'),
(1023163095, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Favian Andres', 'Mancilla Angulo', 'favian@gmail.com', '../../Uploads/Usuario/userFavian.jpg'),
(1023163096, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Darwin', 'Urbina Lopez', 'darwin@gmail.com', '../../Uploads/Usuario/userDarwin.jpg'),

(1023163097, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Camila Dayana', 'Benavides Alfonso', 'Camila@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(1023163098, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Camilo Andres', 'Mancilla Angulo', 'Camilo@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(1023163099, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Camilin', 'Urbina Lopez', 'Camilin@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg');

INSERT INTO asignatura (nombre) VALUES 
('Matemáticas'),
('Quimica'),
('Fisica'),
('Español'),
('Ed.Fisica'),
('Informatica');

INSERT INTO curso (jornada, nombre) VALUES
('', 'Todos'),
('unica', 'Sexto'),
('unica', 'Septimo'),
('unica', 'Octavo'),
('unica', 'Noveno'),
('unica', 'Decimo'),
('unica', 'Once');

INSERT INTO aula(nombre, capacidad) VALUES 
('119 Torre oriental', '20'),
('101  Festo', '30'),
('301 Torre occidental', '25');

INSERT INTO observador(idEstudiante, idAutor, observacion) VALUES 
(3, 1,'El estudiante no cumple con el uniforme de la institución'),
(3, 1,'El estudiante no presta atención en clase y distrae a sus compañeros'),
(3, 2,'El estudiante, ha fallado 3 veces seguidas sin presentar excusa.');

INSERT INTO comunicado(idUsuario, idCurso, fecha, titulo, descripcion, archivos) VALUES
(1023163093, 2, '2023-11-26 20:21:51', 'Innovación y Crecimiento', 'Estimada comunidad educativa, Nos complace compartir una emocionante noticia: el lanzamiento de nuestro nuevo programa, "Innovación y Crecimiento". Este proyecto refleja nuestro compromiso continuo con la excelencia académica y el desarrollo integral de nuestros estudiantes. Estamos emocionados por incorporar nuevas tecnologías y actividades que promuevan habilidades esenciales para el siglo XXI.','../Vista/Uploads/Comunicados/comunicado.pdf'),
(2, 2, NOW(), 'Cancelación de clase', 'El día de mañana no habrá clase en porque se suspenderá el agua en el colegio','../Vista/Uploads/Comunicados/sb.pdf'),
(1, 1, NOW(), 'Entrega de boletines', 'La entrega de voletines se hará el día 20/11/2024 desde las 8:00a.m. En los proximos días el director de cada uno de los cursos estará comunicando la hora exacta de la reunión para cada estudiante.','../Vista/Uploads/Comunicados/sb.pdf');

INSERT INTO acudiente (documento, nombres, apellidos, telefono, correo) VALUES
(1023163098, 'Lilia', 'Alfonso', '3102274510', 'yuraniester@gmail.com'),
(1024163011, 'Camila', 'Rodriguez', '3104544510', 'nicole.benavides@misena.edu.co'),
(1015213099, 'Steven', 'Blanco', '3102342510', 'yuraniester@gmail.com');

INSERT INTO estudianteAcudiente (idAcudiente, idEstudiante) VALUES
(1023163098, 3),
(1024163011, 1023163096),
(1015213099, 1023163095);

INSERT INTO estudianteCurso (idCurso, idEstudiante) VALUES 
(2, 3),
(2, 1023163095),
(2, 1023163096),
(3, 1023163097),
(3, 1023163098),
(3, 1023163099);

INSERT INTO clase (idCurso, idAsignatura, idDocente, idAula) VALUES
(2, 1, 2, 1),
(2, 3, 1023163093, 2),
(3 , 1, 2, 1),
(3, 1, 2, 1),
(4, 1, 2, 1),
(4, 2, 1023163093, 2);

INSERT INTO asistencia (idClase, idEstudiante, fecha, estado) VALUES
(1, 3,'2023-09-05 13:12:13','Asiste'),
(1, 3,'2023-09-05 13:12:13', 'Falta'),
(1, 3,'2023-09-05 13:12:13', 'Retardo');

INSERT INTO tarea (idClase,idDocente, titulo, descripcion, fecha_creacion, fecha_vencimiento, archivos) VALUES
(1, 2, 'Ejercicios Matemáticas', 'La tarea consiste en resolver una serie de ejercicios matemáticos que abarcan distintas áreas de la disciplina, desde conceptos básicos de aritmética hasta problemas más avanzados de álgebra, geometría o cálculo.', '2023-09-05 13:12:13', '2023-09-13 13:11:05', 'mate.pdf'),
(2, 2, 'Ensayo sobre Tecnologia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-09-24 00:48:12', NULL),
(1, 2, 'Corrección Ejercicios Matemáticas', 'Corregir los ejercicios anteriores.', '2023-09-05 13:12:13', '2023-12-10 13:11:05', NULL),
(1, 2, 'Algoritmia', 'Adjuntar evidencia de lo que se ha realizado hoy en clase.', '2023-09-05 13:12:13', '2023-12-12 13:11:05', NULL);

INSERT INTO entrega (descripcion, archivos, idEstudiante, idTarea) VALUES 
('Buenos días profesor, adjunto a este mensaje le envío el archivo con los ejercicios resueltos. Quedo a su disposición para cualquier comentario o corrección. Saludos cordiales.', '../../Uploads/Entregas/mateRta.pdf', 3, 1),
('Entrega Erika', NULL, 1023163095, 1),
('Adjunto PDF', 'algoritmia.pdf', 3, 4),
('Entrega Tatiana', NULL, 1023163096, 1);

INSERT INTO calificacion (idEntrega, nota) VALUES (1,4.5);
