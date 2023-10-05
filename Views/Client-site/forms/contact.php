<?php
  // /**
  // * Requires the "PHP Email Form" library
  // * The "PHP Email Form" library is available only in the pro version of the template
  // * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  // * For more info and help: https://bootstrapmade.com/php-email-form/
  // */

  // // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'contact@example.com';

  // if( file_exists($php_email_form = '../Views/client-site/assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // /*
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  // */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();
  
?>


<?php
  // Enviar correo con la libreria phpMailer

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../../../PHPMailer/Exception.php';
  require '../../../PHPMailer/PHPMailer.php';
  require '../../../PHPMailer/SMTP.php';

  // Configuración de PHPMailer
  $mail = new PHPMailer(true);

  try {

      // Configuración del servidor SMTP de tu empresa
      $mail->SMTPDebug = 0;  // Cambia a 2 para ver detalles de depuración
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com'; // Cambia esto al servidor SMTP de tu empresa
      $mail->SMTPAuth = true;

      $mail->Username = 'school.board.company@gmail.com'; // Tu correo empresarial

      $mail->Password = 'nkcs txom cquk kxia'; // Tu contraseña

      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // TLS o SSL, según la configuración de tu servidor
      $mail->Port = 465; // Puerto SMTP, generalmente 587 para TLS o 465 para SSL

      // Remitente y destinatario del correo
      $remitente = $_POST['correo']; // La dirección de correo proporcionada por el usuario
      $nombre = $_POST['nombre'];
      $asunto = $_POST['asunto'];
      $mensaje = $_POST['mensaje'];

      $mail->setFrom($remitente, $nombre); // Nombre del remitente opcional
      $mail->addAddress('school.board.company@gmail.com', 'School Board');
      $mail->Subject = $asunto;
      $mail->Body = $mensaje;

      // Enviar el correo
      $mail->send();
      echo 'El correo se envió correctamente desde ' . $remitente;

  } catch (Exception $e) {

      echo 'Error al enviar el correo: ' . $mail->ErrorInfo;

  }
?>