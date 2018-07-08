<?php
include("inc/user.inc.php");
include("inc/cred.inc.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/POP3.php';
require './PHPMailer-master/src/OAuth.php';

if(isset($_POST['recover-submit'])){
  $email_mail = mysqli_real_escape_string($conn,htmlentities($_POST['email']));
  $sqlmail = "SELECT * FROM users WHERE email='".$email_mail."'";
  $query_mail = mysqli_query($conn,$sqlmail) or die (mysqli_error($conn).$sqlmail);
  $row_count_mail =  mysqli_num_rows($query_mail);
  //echo $sqlmail;
  if($row_count_mail > 0){
    $row_mail = mysqli_fetch_array($query_mail);
    $username_mail = $row_mail['username'];
    $password_mail = $row_mail['password'];
    $name_mail = $row_mail['name'];
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();
        $mail->SMTPAuth = true;;                                      // Set mailer to use SMTP
        $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
        //$mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'lex.icon.original@gmail.com';                 // SMTP username
        $mail->Password = 'lex-icon123';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('lex.icon.original@gmail.com');
        // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress($_POST['email']);               // Name is optional
        $mail->addReplyTo('lex.icon.original@gmail.com');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Lex-icon PASSWORD RECOVERY';
        $mail->Body    = 'Hey '.$name_mail.'.Your username is <b>'.$username_mail.'</b> and password is <b>'.$password_mail.'</b>';
        $mail->AltBody = 'This mail cannot be rendered in plain text for non-HTML mail client for security purposes.';

        $mail->send();
        header('location: ../index.php#popup3');
        exit;
    } catch (Exception $e) {
      header('location: ../index.php#popup4');
      exit;
    }
  }else{
    //echo email entered is not registered.;
    header('location: ../index.php#popup5');
    exit;
  }
}
 ?>
