<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    class CorreosAcudiente {
        
        public function enviarCorreo($idCurso, $tipoInfo, $titulo, $descripcion){

            $f1 = null;

            if($idCurso == 1){

                $objConexion = new Conexion();
                $conexion = $objConexion->get_conexion();
    
                $sql = 
                'SELECT DISTINCT a.correo AS correoAcudiente, a.nombres AS nombreAcudiente, a.apellidos AS apellidoAcudiente,
                e.nombres AS nombreEstudiante, e.apellidos AS apellidoEstudiante
                FROM usuario e
                JOIN estudianteAcudiente ea ON e.documento = ea.idEstudiante
                JOIN acudiente a ON ea.idAcudiente = a.documento
                WHERE e.documento IN (SELECT idEstudiante FROM estudianteCurso)                
                AND e.estado NOT IN ("Inactivo", "Pendiente")';

                $consulta = $conexion->prepare($sql);
    
                $consulta->execute();
                
                while ($resultado = $consulta->fetch()) {

                    $f1[] = $resultado;
    
                }

            } else {

                $objConexion = new Conexion();
                $conexion = $objConexion->get_conexion();
    
                $sql = 
                'SELECT a.correo AS correoAcudiente, a.nombres AS nombreAcudiente, a.apellidos AS apellidoAcudiente,
                e.nombres AS nombreEstudiante, e.apellidos AS apellidoEstudiante
                FROM curso c
                JOIN estudianteCurso ec ON c.idCurso = ec.idCurso
                JOIN usuario e ON ec.idEstudiante = e.documento
                JOIN estudianteAcudiente ea ON e.documento = ea.idEstudiante
                JOIN acudiente a ON ea.idAcudiente = a.documento
                WHERE c.idCurso = :idCurso;';
                $consulta = $conexion->prepare($sql);
    
                $consulta->bindParam(':idCurso', $idCurso);
    
                $consulta->execute();
                
                while ($resultado = $consulta->fetch()) {

                    $f1[] = $resultado;
    
                }

            }
                
            foreach($f1 as $f) {
            
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
            
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                           //Send using SMTP
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth = true;                                 //Enable SMTP authentication
                    $mail->Username = 'school.board.company@gmail.com';     //SMTP username
                    $mail->Password = 'nkcs txom cquk kxia';                   //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                    //Recipients
                    // Emisor
                    $mail->setFrom('school.board.company@gmail.com', 'Notificaciones School Board');
                    
                    // Receptor
                    $correoPara = $f['correoAcudiente'];
                    $mail->addAddress($correoPara);     //Add a recipient
                    // $mail->addAddress('ellen@example.com');
                    // lfrestrepo004@gmail.com               //Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
            
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                    
                    $nombreAcudiente = explode(" ", $f['nombreAcudiente']);
                    $apellidoAcudiente = explode(" ", $f['apellidoAcudiente']);
                    $nombreEstudiante = explode(" ", $f['nombreEstudiante']);
                    $apellidoEstudiante = explode(" ", $f['apellidoEstudiante']);
                    $asunto = $tipoInfo.' School Board';
            
                    //Content
                    $mail->isHTML(true);                     //Set email format to HTML
                    $mail->CharSet = 'UTF-8';          
                    $mail->Subject = $asunto;
                    $mail->Body    = '
                    <!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <style>
                                @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&display=swap");
                                
                                * {
                                    margin: auto;
                                    padding: 0;
                                    font-family: "Montserrat", sans-serif;
                                }
                                blockquote,h1,h2,h3,img,li,ol,p,ul{
                                    margin-top:0;
                                    margin-bottom:0
                                }
                            </style>
                            </head>
                            <body style="
                                background-image: radial-gradient(circle, transparent 39%, rgb(255, 255, 255) 96%),url(https://github.com/Usune/school-board/blob/main/Vista/img/fondoArriba3.jpg?raw=true);
                                background-repeat: no-repeat;
                                background-position: 50% 0%; 
                                background-size: 700px 600px;
                                overflow-y: scroll;">
                    
                                <div style="
                                    margin-bottom: 50px;
                                    padding-top: 50px;
                                    ">
                                    <p class="textoFondo" style="
                                        font-size: 28px;
                                        background-color: #fff;
                                        color: #123B7B;
                                        font-weight: bold;
                                        letter-spacing: 2px;
                                        width: 160px;
                                        text-align: center;
                                    ">School</p>
                                    <p class="textoFondo" style="
                                        font-size: 28px;
                                        background-color: #fff;
                                        color: #123B7B;
                                        font-weight: bold;
                                        letter-spacing: 2px;
                                        width: 140px;
                                        text-align: center;
                                    ">Board</p>
                                </div>
                                    
                                <div id="cuerpo" style="
                                    display: block;
                                    width: 80%;
                                    max-width: 400px;
                                    border: 2px solid #2F5494; 
                                    border-radius:20px 20px 0 0;
                                    padding: 20px;
                                    margin: auto;
                                    background-color: #fff;
                                ">
                                    <img alt="logo" src="https://github.com/Usune/school-board/blob/main/Vista/img/logoSolo.png?raw=true" id="logo" style="
                                        display: block;
                                        margin-top: 0px;
                                        height: 80px;
                                        margin-bottom: 30px;
                                        ">
                                    <p class="texto1" style="
                                        font-size:16px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify; 
                                        margin-bottom: 20px;
                                    ">Hola, '.$nombreAcudiente[0].' '.$apellidoAcudiente[0].'</p>
                                    <p class="texto1" style="
                                        font-size:16px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify; 
                                        margin-bottom: 20px;
                                    ">Se ha subido un nuevo '.$tipoInfo.' para el estudiante <span style="
                                        font-weight: bold;
                                        color: #2F5494;
                                    ">'.$nombreEstudiante[0].' '.$apellidoEstudiante[0].'</span></p>
                                    <p style="
                                        font-size:20px; 
                                        font-weight: bold;
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify; 
                                    ">'.$tipoInfo.'</p>
                                    <p style="
                                        font-size:18px; 
                                        font-weight: bold;
                                        line-height:24px; 
                                        width:95%;
                                        padding: 10px;
                                        color:#000; 
                                        background-color:#2f549463;
                                        text-align: justify; 
                                    ">'.$titulo.'</p>
                                    <div style="margin-top:0px;margin-bottom:0px;text-align:center; ">
                                        <p style="
                                        font-size:16px; 
                                        text-align: justify; 
                                        line-height:24px; 
                                        width:95%;
                                        margin-bottom:40px;
                                        padding: 10px;
                                        color:#000; 
                                        background-color:#2f549430;
                                        ">'.$descripcion.'</p>
                                    </div>
                                    <p style="
                                        font-size:12px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Recuerde que este correo es informativo y no se reciben respuestas.</p>
                                    <p style="
                                        font-size:12px; 
                                        color: #000;
                                        text-align: justify;
                                    ">Saludos,</p>
                                    <p style="
                                        font-size:12px; 
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Equipo de School Board.</p>
                                </div>
                                <p class="final" style="
                                    width: 80%;
                                    padding: 0 20px;
                                    max-width: 400px;
                                    font-size:12px; 
                                    line-height:40px;
                                    color: #FFF;
                                    text-align: center; 
                                    background-color: #2F5494; 
                                    border-radius:0 0 20px 20px;
                                    border: 2px solid #2F5494;                   
                                ">&reg; School Board - 2023</p>
                            </body>
                        </html>
                    ';
                    
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    $mail->send();
                    // echo '<script>alert("Se ha enviado el correo correctamente.")</script>';
                    // echo '<script>location.href="../Vista/html/Extras/inicioSesion.html"</script>';
                } catch (Exception $e) {
                    echo "Meiler Error: {$mail->ErrorInfo}";
                }
            }
        }

        public function enviarObservacion($idEstudiante, $tipoInfo, $observacion, $idAutor){

            $f1 = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            'SELECT
            e.nombres AS nombreEstudiante,
            e.apellidos AS apellidoEstudiante,
            a.nombres AS nombreAcudiente,
            a.apellidos AS apellidoAcudiente,
            a.correo AS correoAcudiente,
            ua.nombres AS nombreAutor,
            ua.apellidos AS apellidoAutor
            FROM usuario e
            JOIN estudianteAcudiente ea ON e.documento = ea.idEstudiante
            JOIN acudiente a ON ea.idAcudiente = a.documento
            JOIN usuario ua ON ua.documento = :idAutor
            WHERE e.documento = :idEstudiante';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':idEstudiante', $idEstudiante);
            $consulta->bindParam(':idAutor', $idAutor);

            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f1[] = $resultado;

            }
                
            foreach($f1 as $f) {
            
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
            
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                           //Send using SMTP
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth = true;                                 //Enable SMTP authentication
                    $mail->Username = 'school.board.company@gmail.com';     //SMTP username
                    $mail->Password = 'nkcs txom cquk kxia';                   //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                    //Recipients
                    // Emisor
                    $mail->setFrom('school.board.company@gmail.com', 'Notificaciones School Board');
                    
                    // Receptor
                    $correoPara = $f['correoAcudiente'];
                    $mail->addAddress($correoPara);     //Add a recipient
                    // $mail->addAddress('ellen@example.com');
                    // lfrestrepo004@gmail.com               //Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
            
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                    
                    $nombreAcudiente = explode(" ", $f['nombreAcudiente']);
                    $apellidoAcudiente = explode(" ", $f['apellidoAcudiente']);
                    $nombreEstudiante = explode(" ", $f['nombreEstudiante']);
                    $apellidoEstudiante = explode(" ", $f['apellidoEstudiante']);
                    $nombreAutor = explode(" ", $f['nombreAutor']);
                    $apellidoAutor = explode(" ", $f['apellidoAutor']);
                    $asunto = $tipoInfo.' School Board';
            
                    //Content
                    $mail->isHTML(true);                     //Set email format to HTML
                    $mail->CharSet = 'UTF-8';          
                    $mail->Subject = $asunto;
                    $mail->Body    = '
                    <!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <style>
                                @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&display=swap");
                                
                                * {
                                    margin: auto;
                                    padding: 0;
                                    font-family: "Montserrat", sans-serif;
                                }
                                blockquote,h1,h2,h3,img,li,ol,p,ul{
                                    margin-top:0;
                                    margin-bottom:0
                                }
                            </style>
                            </head>
                            <body style="
                                background-image: radial-gradient(circle, transparent 39%, rgb(255, 255, 255) 96%),url(https://github.com/Usune/school-board/blob/main/Vista/img/fondoArriba3.jpg?raw=true);
                                background-repeat: no-repeat;
                                background-position: 50% 0%; 
                                background-size: 700px 600px;
                                overflow-y: scroll;">
                    
                                <div style="
                                    margin-bottom: 50px;
                                    padding-top: 50px;
                                    ">
                                    <p class="textoFondo" style="
                                        font-size: 28px;
                                        background-color: #fff;
                                        color: #123B7B;
                                        font-weight: bold;
                                        letter-spacing: 2px;
                                        width: 160px;
                                        text-align: center;
                                    ">School</p>
                                    <p class="textoFondo" style="
                                        font-size: 28px;
                                        background-color: #fff;
                                        color: #123B7B;
                                        font-weight: bold;
                                        letter-spacing: 2px;
                                        width: 140px;
                                        text-align: center;
                                    ">Board</p>
                                </div>
                                    
                                <div id="cuerpo" style="
                                    display: block;
                                    width: 80%;
                                    max-width: 400px;
                                    border: 2px solid #2F5494; 
                                    border-radius:20px 20px 0 0;
                                    padding: 20px;
                                    margin: auto;
                                    background-color: #fff;
                                ">
                                    <img alt="logo" src="https://github.com/Usune/school-board/blob/main/Vista/img/logoSolo.png?raw=true" id="logo" style="
                                        display: block;
                                        margin-top: 0px;
                                        height: 80px;
                                        margin-bottom: 30px;
                                        ">
                                    <p class="texto1" style="
                                        font-size:16px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify; 
                                        margin-bottom: 20px;
                                    ">Hola, '.$nombreAcudiente[0].' '.$apellidoAcudiente[0].'</p>
                                    <p class="texto1" style="
                                        font-size:16px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify; 
                                        margin-bottom: 20px;
                                    ">Se ha subido una '.$tipoInfo.' para el estudiante <span style="
                                        font-weight: bold;
                                        color: #2F5494;
                                    ">'.$nombreEstudiante[0].' '.$apellidoEstudiante[0].'</span></p>
                                    <p style="
                                        font-size:20px; 
                                        font-weight: bold;
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: start; 
                                    ">'.$tipoInfo.'</p>
                                    <p style="
                                        font-size:18px; 
                                        font-weight: bold;
                                        line-height:24px; 
                                        width:95%;
                                        padding: 10px;
                                        color:#000; 
                                        background-color:#2f549463;
                                        text-align: justify; 
                                    ">Observación realizada por '.$nombreAutor[0].' '.$apellidoAutor[0].'</p>
                                    <div style="margin-top:0px;margin-bottom:0px;text-align:center; ">
                                        <p style="
                                        font-size:16px; 
                                        text-align: justify; 
                                        line-height:24px; 
                                        width:95%;
                                        margin-bottom:40px;
                                        padding: 10px;
                                        color:#000; 
                                        background-color:#2f549430;
                                        ">'.$observacion.'</p>
                                    </div>
                                    <p style="
                                        font-size:12px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Recuerde que este correo es informativo y no se reciben respuestas.</p>
                                    <p style="
                                        font-size:12px; 
                                        color: #000;
                                        text-align: justify;
                                    ">Saludos,</p>
                                    <p style="
                                        font-size:12px; 
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Equipo de School Board.</p>
                                </div>
                                <p class="final" style="
                                    width: 80%;
                                    padding: 0 20px;
                                    max-width: 400px;
                                    font-size:12px; 
                                    line-height:40px;
                                    color: #FFF;
                                    text-align: center; 
                                    background-color: #2F5494; 
                                    border-radius:0 0 20px 20px;
                                    border: 2px solid #2F5494;                   
                                ">&reg; School Board - 2023</p>
                            </body>
                        </html>
                    ';
                    
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    $mail->send();
                    // echo '<script>alert("Se ha enviado el correo correctamente.")</script>';
                    // echo '<script>location.href="../Vista/html/Extras/inicioSesion.html"</script>';
                } catch (Exception $e) {
                    echo "Meiler Error: {$mail->ErrorInfo}";
                }
            }
        }

    }
?>