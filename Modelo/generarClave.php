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
                    
                    <!DOCTYPE html
                    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>NOTIFICACION LIVING SAFE</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                </head>
                
                <body style="margin: 0; padding: 0;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 10px 0 30px 0;">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
                                    style="border: 1px solid #cccccc; border-collapse: collapse;">
                                    <tr>
                                        <td align="center" bgcolor="#FFFAF4"
                                            style="padding: 20px 0 20px 0; color: #FFFAF4; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                            <img src="https://github.com/Usune/school-board/blob/main/Vista/img/logoSolo.png?raw=true" alt="logo" width="120"
                                                height="120" style="display: block;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#FFFAF4" style="padding: 40px 30px 40px 30px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td align="center"
                                                        style="color:#2F5494; font-family: Arial, sans-serif; font-size: 24px;">
                                                        <b>RECUPERACIÓN DE CLAVE</b>
                                                    </td>
                                                </tr><tr>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td style="font-size: 0; line-height: 0;" width="100">
                                                                    &nbsp;
                                                                </td>
                                                                <td width="400" valign="top">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td align="center">
                                                                            <p style="color:#000; font-size:22px; padding-top: 30px">Hola '.$f['nombres'].''.$f['apellidos'].', tu nueva clave de acceso para nuestro sistema es: </p>
            <p style="color:#2F5494; font-size:25px; padding-top: 30px">'.$nuevaClave.'</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center"
                                                                                style="padding: 0; color: #000; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td style="font-size: 0; line-height: 0;" width="100">
                                                                    &nbsp;
                                                                </td>
                
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#2F5494" style="padding: 30px 30px 30px 30px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td align="center"
                                                        style="color: #FFFAF4; font-family: Arial, sans-serif; font-size: 14px;"
                                                        width="75%; text-aling:center">
                                                        &reg; School Board - 2023<br />
                                                        <a href="" target="_blank"
                                                            style="color: #FFFAF4;">
                                                            <font color="#FFFAF4">Enlace del proyecto</font>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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