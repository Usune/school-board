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

INSERT INTO usuario (documento, clave, rol, estado, tipoDoc, nombres, apellidos, correo, foto) VALUES 
(1, MD5('administrador'), 'Administrador', 'activo', 'CC','Administrador', 'Prueba', NULL, '../../Uploads/Usuario/fotoUsuario.jpg'),
(2, MD5('docente'), 'Docente', 'activo', 'CC','Felipe', 'Restrepo','lfrestrepo004@gmail.com', '../../Uploads/Usuario/fotoUsuario.jpg'),
(8, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Estudiante', 'Prueba', NULL, '../../Uploads/Usuario/fotoUsuario.jpg'),

(4, MD5('docente'), 'Docente', 'activo', 'CC','Docente', 'Prueba', NULL, '../../Uploads/Usuario/fotoUsuario.jpg'),
(1023163093, MD5('docente'), 'Docente', 'activo', 'CC','Angelica Maria', 'Triana Guarnizo', 'angelica@gmail.com', '../../Uploads/Usuario/userAngelica.jpg'),

(3, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Nicole Dayana', 'Benavides Alfonso', 'nicole.benavides@misena.edu.co', '../../Uploads/Usuario/userNicole.jpg'),
-- (3, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Nicole Dayana', 'Benavides Alfonso', NULL, '../../Uploads/Usuario/userNicole.jpg'),
(1023163095, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Favian Andres', 'Mancilla Angulo', NULL, '../../Uploads/Usuario/userFavian.jpg'),
(1023163096, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Darwin', 'Urbina Lopez', 'darwin@gmail.com', '../../Uploads/Usuario/userDarwin.jpg'),

(1023163097, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Camila Dayana', 'Benavides Alfonso', 'Camila@gmail.com', '../../Uploads/Usuario/userCamila.jpg'),
(1023163098, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Camilo Andres', 'Mancilla Angulo', 'Camilo@gmail.com', '../../Uploads/Usuario/userCamilo.jpg'),
(1023163099, MD5('estudiante'), 'Estudiante', 'activo', 'TI','Camilin', 'Urbina Lopez', 'Camilin@gmail.com', '../../Uploads/Usuario/userCamilin.jpg');


CREATE TABLE asignatura (
    idAsignatura INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    PRIMARY KEY (idAsignatura)
);

INSERT INTO asignatura (nombre) VALUES 
('Matemáticas'),
('Calculo'),

('Sociales'),
('Religión'),
('Catedra para la paz'),

('Ciencias'),
('Quimica'),
('Fisica'),                                                                                                                                                                         

('Español'),
('Ingles'),
('Ed.Fisica'),
('Informatica');

CREATE TABLE curso (
    idCurso INT AUTO_INCREMENT,
    jornada ENUM('Única', 'Mañana', 'Tarde'),
    nombre VARCHAR(15),
    PRIMARY KEY (idCurso)
);

INSERT INTO curso (jornada, nombre) VALUES
-- No quitar este registro nunca
('', 'Todos'), 
('unica', 'SEXTO'),
('unica', 'SEPTIMO'),
('unica', 'OCTAVO'),
('unica', 'NOVENO'),
('unica', 'DECIMO'),
('unica', 'ONCE');

CREATE TABLE aula (
    idAula INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    capacidad VARCHAR(3),
    PRIMARY KEY (idAula)
);

INSERT INTO aula(nombre, capacidad) VALUES 
('119 Torre oriental', '20'),
('101  Festo', '30'),
('301 Torre occidental', '25');

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
(3, 1,'El estudiante no presta atención en clase y distrae a sus compañeros'),
(3, 2,'El estudiante, ha fallado 3 veces seguidas sin presentar excusa.');


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

INSERT INTO comunicado(idUsuario, idCurso, fecha, titulo, descripcion, archivos) VALUES
(1023163093, 2, '2023-11-26 20:21:51', 'Innovación y Crecimiento', 'Nos complace compartir una emocionante noticia: el lanzamiento de nuestro nuevo programa, "Innovación y Crecimiento". Este proyecto refleja nuestro compromiso continuo con la excelencia académica y el desarrollo integral de nuestros estudiantes. Estamos emocionados por incorporar nuevas tecnologías y actividades que promuevan habilidades esenciales para el siglo XXI.','../Vista/Uploads/Comunicados/sb.pdf'),


(2, 3, NOW(), 'Cancelación de clase', 'El día de mañana no habrá clase en porque se suspenderá el agua en el colegio','../Vista/Uploads/Comunicados/Arte Marcial - Felipe Angarita.pdf'),
(1, 3, NOW(), 'Entrega de boletines', 'La entrega de voletines se hará el día 20/11/2024 desde las 8:00a.m. En los proximos días el director de cada uno de los cursos estará comunicando la hora exacta de la reunión para cada estudiante.','../Vista/Uploads/Comunicados/Arte Marcial - Felipe Angarita.pdf');

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

INSERT INTO clase (idCurso, idAsignatura, idDocente, idAula) VALUES
-- Sexto, - Matematicas - Felipe - 119 
(2, 1, 2, 1),
-- Sexto, - Sociales - Angelica - festo 
(2, 3, 1023163093, 2),
-- Septimo - Matematicas - Felipe - 119
(3 , 1, 2, 1),
(3, 1, 2, 1),
(4, 1, 2, 1),
(4, 7, 1023163093, 2);

CREATE TABLE acudiente (
    documento INT,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(15),
    correo VARCHAR(100),
    PRIMARY KEY (documento)
);
INSERT INTO acudiente (documento, nombres, apellidos, telefono, correo) VALUES
(1024163098, 'Lilia', 'Alfonso', 3102274510, 'lilia@gmail.com');

CREATE TABLE estudianteAcudiente (
    idEstudianteAcudiente INT AUTO_INCREMENT,
    idAcudiente INT,
    idEstudiante INT,
    PRIMARY KEY (idEstudianteAcudiente),
    FOREIGN KEY (idAcudiente) REFERENCES acudiente(documento),
    FOREIGN KEY (idEstudiante) REFERENCES usuario(documento)
);
INSERT INTO estudianteAcudiente (idAcudiente, idEstudiante) VALUES
(1024163098, 3);

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
(2, 3),
(2, 1023163095),
(2, 1023163096),
(3, 1023163097),
(3, 1023163098),
(3, 1023163099);

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

INSERT INTO asistencia (idClase, idEstudiante, fecha, estado) VALUES
(1, 3,'2023-09-05 13:12:13','Asiste'),
(1, 1023163095,'2023-09-05 13:12:13','Asiste'),
(1, 1023163096,'2023-09-05 13:12:13', 'Falta'),
(2, 3,'2023-09-05 13:12:13', 'Falta'),
(1, 3,'2023-09-17 13:12:13', 'Retardo');


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

INSERT INTO tarea (idClase,idDocente, titulo, descripcion, fecha_creacion, fecha_vencimiento, archivos) VALUES
(1, 2, 'Ejercicios Matemáticas', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-12-13 13:11:05', 'sb.pdf'),
(2, 2, 'Ensayo sobre Tecnologia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-12-24 00:48:12', NULL),
(1, 2, 'Algoritmia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-12-08 13:11:05', NULL),
(1, 2, 'Matematicas', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet beatae saepe iste veniam sed quisquam.', '2023-09-05 13:12:13', '2023-12-08 13:11:05', NULL);



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

INSERT INTO entrega (descripcion, archivos, idEstudiante, idTarea) VALUES 
('Entrega Nicole', NULL, 3, 1),
('Entrega Erika', NULL, 1023163095, 1),
('Entrega Tatiana', NULL, 1023163096, 1);


CREATE TABLE calificacion(
    idCalificacion INT AUTO_INCREMENT,
    idEntrega INT ,
    fecha_calificacion  DATETIME DEFAULT NOW(),
    observacion VARCHAR(200),
    nota FLOAT,
    PRIMARY KEY (idCalificacion),
    FOREIGN KEY (idEntrega) REFERENCES entrega(idEntrega)
);


INSERT INTO calificacion (idEntrega, nota) VALUES 
(1, '4.5');

-- Consulta para mostrar todas las entregas de los estudiantes para una tarea específica:
-- SELECT e.idEntrega, e.idEstudiante, u.nombres, u.apellidos, e.fecha_entrega_est, e.descripcion, e.archivos, c.nota
-- FROM entrega e
-- JOIN usuario u ON e.idEstudiante = u.documento
-- LEFT JOIN calificacion c ON e.idEntrega = c.idEntrega
-- WHERE e.idTarea = {id_tarea_deseada};


-- Consulta para obtener todas las entregas y agregar un campo para indicar si está entregada o pendiente:
-- SELECT e.idEntrega, e.idEstudiante, u.nombres, u.apellidos, e.fecha_entrega_est, e.descripcion, e.archivos,
--        IF(c.idCalificacion IS NOT NULL, 'Entregada', 'Pendiente') AS estado_entrega, c.nota
-- FROM entrega e
-- JOIN usuario u ON e.idEstudiante = u.documento
-- LEFT JOIN calificacion c ON e.idEntrega = c.idEntrega
-- WHERE e.idTarea = {id_tarea_deseada};


-- Consulta para que el docente pueda calificar una entrega en específico:
-- UPDATE calificacion
-- SET nota = {nueva_nota}
-- WHERE idEntrega = {id_entrega_a_calificar};
