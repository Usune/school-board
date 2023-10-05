<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    class GenerarClave {
        
        public function nuevaClave($documento, $correo){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM usuario WHERE documento=:documento AND correo=:correo';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':correo', $correo);

            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                // SE GENERA UNA NUEVA CLAVE A PARTIR DE UN CÓDIGO ALEATORIO
                $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $longitud = 8;
                $nuevaClave = substr(str_shuffle($caracteres),0,$longitud);
                $claveMD = MD5($nuevaClave);

                $sql = 'UPDATE usuario SET clave=:claveMD WHERE documento=:documento';
                $consulta = $conexion->prepare($sql);

                $consulta->bindParam(':claveMD', $claveMD);
                $consulta->bindParam(':documento', $documento);

                $consulta->execute();

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
                    $mail->setFrom('school.board.company@gmail.com', 'Soporte School Board');
                    
                    // Receptor
                    $nombres = explode(" ", $f['nombres']);
                    // $apellidos = explode(" ", $f['apellidos']);
                    $correoPara = $f['correo'];
                    $mail->addAddress($correoPara);     //Add a recipient
                    // $mail->addAddress('ellen@example.com');
                    // lfrestrepo004@gmail.com               //Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
            
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                    //Content
                    $mail->isHTML(true);                     //Set email format to HTML
                    $mail->CharSet = 'UTF-8';          
                    $mail->Subject = 'NUEVA CLAVE';
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
                    
                                <div id="fondo" style="
                                    margin-bottom: 50px;
                                    padding-top: 50px;
                                    ">
                                    <p class="textoFondo" style="
                                        font-size: 40px;
                                        background-color: #fff;
                                        color: #123B7B;
                                        font-weight: bold;
                                        letter-spacing: 2px;
                                        width: 160px;
                                        text-align: center;
                                    ">School</p>
                                    <p class="textoFondo" style="
                                        font-size: 40px;
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
                                    max-width: 460px;
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
                                        text-align: center;
                                        font-size: 24px;
                                        margin-bottom: 20px;
                                    ">Hola, <span class="destacar" style="
                                        font-weight: bold;
                                        color: #2F5494;
                                    ">'.$nombres[0].'</span></p>
                                    <p class="texto1" style="
                                        font-size:16px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: center;
                                        font-size: 24px;
                                        margin-bottom: 20px;
                                    ">Su clave se a modificado.</p>
                                    <p class="texto" style="
                                        font-size:18px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Su nueva clave para ingresar al sistema es:</p>
                                    <div style="margin-top:0px;margin-bottom:0px;text-align:center; ">
                                        <p class="clave" style="
                                        font-size:30px; 
                                        text-align:center; 
                                        line-height:80px; 
                                        width:70%; 
                                        margin-top:30px; 
                                        margin-bottom:40px; 
                                        color:#000; 
                                        background-color:#ccc;
                                        border-radius: 20px;
                                        letter-spacing: 5px;
                                        ">'.$nuevaClave.'</p>
                                    </div>
                                    <div style="margin-top:0px;margin-bottom:0px;text-align:center;">
                                        <a href="http://localhost:8081/school-board/Vista/html/Extras/inicioSesion.html" target="_blank" style="
                                            border: 2px solid;
                                            line-height: 1.25rem;
                                            text-decoration: none;
                                            display: inline-block;
                                            max-width: 100%;
                                            font-size: 0.875rem;
                                            font-weight: 500;
                                            text-decoration-line: none;
                                            color: #ffffff;
                                            background-color:#2F5494;
                                            border-color: #2F5494;
                                            padding: 12px 34px;
                                            border-radius: 9999px;
                                            margin-bottom: 30px;
                                        "><span style="max-width:100%;display:inline-block;line-height:120%;">Ir al inicio de sesión</span></a>
                                    </div>
                                    <p class="texto" style="
                                        font-size:18px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Recuerde cambiar su clave nuevamente al ingresar al sistema.</p><br>
                                    <p class="texto" style="
                                        font-size:18px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Saludos,</p><br>
                                    <p class="texto" style="
                                        font-size:18px; 
                                        line-height:24px;
                                        margin-bottom: 10px;
                                        color: #000;
                                        text-align: justify;
                                    ">Soporte de School Board.</p>
                                </div>
                                <p class="final" style="
                                    width: 80%;
                                    padding: 0 20px;
                                    max-width: 460px;
                                    font-size:12px; 
                                    line-height:40px;
                                    color: #FFF;
                                    text-align: center; 
                                    background-color: #2F5494; 
                                    border-radius:0 0 20px 20px;
                                    border: 2px solid #2F5494;                   
                                ">&reg; School Board - 2023</p>
                        </html>
                    ';
                    
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    $mail->send();
                    echo '<script>alert("Se ha enviado el correo correctamente.")</script>';
                    echo '<script>location.href="../Vista/html/Extras/inicioSesion.html"</script>';
                } catch (Exception $e) {
                    echo "Meiler Error: {$mail->ErrorInfo}";
                }
            } else{
                echo '<script>alert("Se ha enviado el correo correctamente.")</script>';
                echo '<script>location.href="../Vista/html/Extras/olvido-clave.html"</script>';
            }
        }
    }
?>