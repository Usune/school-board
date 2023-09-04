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
                    $mail->Password = 'mkyyamnnnfpxlhjq';                   //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                    //Recipients
                    // Emisor
                    $mail->setFrom('school.board.company@gmail.com', 'Soporte School Board');
                    // Receptor

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
                            </style>
                            <style>
                                blockquote,h1,h2,h3,img,li,ol,p,ul{
                                    margin-top:0;
                                    margin-bottom:0
                                }
                            </style>
                            </head>
                            <body>
                                <table width="100%" role="presentation" cellspacing="0" cellpadding="0" style="max-width:600px;margin-left:auto;margin-right:auto;padding:.5rem">
                                    <tbody>
                                        <tr style="width:100%">
                                            <td>
                                                <img alt="logo" src="https://github.com/Usune/school-board/blob/main/Vista/img/logoSolo.png?raw=true" style="display: block;outline: none;border: none;text-decoration: none;margin-top: 0px;height: 80px;margin-bottom: 30px;">
                                            
                                                <h2 style="font-size: 30px;font-weight: 700;line-height: 40px;margin-bottom: 30px;color: #000;text-align: center;"><strong>RECUPERACIÓN DE CLAVE</strong></h2>
                                                <p style="font-size:15px; line-height:24px; margin-top: 0px;margin-bottom: 10px;color: #000;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;text-align: left;">Hola '.$f['nombres'].' '.$f['apellidos'].', se ha generado con exito su nueva clave.</p>
                                                <p style="font-size:15px;line-height: 24px; margin-top: 0px;margin-bottom: 10px;color: #000;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;text-align: left;">Su nueva clave de acceso para nuestro sistema es:</p>
                                                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:0px;margin-bottom:0px;text-align:center;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p style="font-size:24px; text-align:center; line-height:35px; width: 200px; margin-top: 30px; margin-bottom: 40px; color: #000; background-color: #ccc; -webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;">'.$nuevaClave.'</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:0px;margin-bottom:0px;text-align:center;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a href="" style="border: 2px solid;line-height: 1.25rem;text-decoration: none;display: inline-block;max-width: 100%;font-size: 0.875rem;font-weight: 500;text-decoration-line: none;color: #ffffff;background-color: #2F5494;border-color: #2F5494;padding: 12px 34px;border-radius: 9999px;"><span></span><span style="max-width:100%;display:inline-block;line-height:120%;">Ir al inicio de sesión</span><span></span></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p style="font-size: 15px;line-height: 24px;margin: 16px 0;margin-top: 40px;margin-bottom: 20px;color: #000;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;text-align: left;">Recuerde cambiar su clave nuevamente al ingresar al sistema.</p>
                                                <p style="font-size: 15px;line-height: 24px;margin: 16px 0;margin-top: 0px;margin-bottom: 20px;color: #000;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;text-align: left;">Saludos,<br>Soporte de School Board</p>
                                                <p style="font-size: 12px;line-height: 40px;margin: 16px 0;margin-top: 0px;margin-bottom: 20px;color: #fff;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;text-align: center; background-color: #2F5494;">&reg; School Board - 2023</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </body>
                            </html>
                    ';
                    
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    $mail->send();
                    echo '<script>alert("Se ha enviado el correo correctamente.")</script>';
                    echo '<script>location.href="../Vista/html/Extras/inicioSesion.html"</script>';
                } catch (Exception $e) {
                    echo '<script>alert("ERROR AL ENVIAR CORREO")</script>';
                }
            } else{
                echo '<script>alert("Se ha enviado el correo correctamente.")</script>';
                echo '<script>location.href="../Vista/html/Extras/olvido-clave.html"</script>';
            }
        }
    }
?>