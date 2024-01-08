<?php 
session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';

    

    if(isset($_POST['send'])){
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $subject = htmlentities($_POST['subject']);
        $message = htmlentities($_POST['message']);

        if(empty($name) || empty($email) || empty($subject) || empty($message)){
            $_SESSION['status'] = 'error';
            $_SESSION['status_code']= 'Not be empty';
            header('location:../contact.php');
        }else{

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tytly0110@gmail.com';
            $mail->Password = 'onktudcubwwerrcv';
            $mail->Port = 465; // Sửa port thành 465 vì bạn đang sử dụng SSL
            $mail->SMTPSecure = 'ssl';
            $mail->isHTML(true);
            $mail->setFrom($email, $name); // Sửa 'Form' thành 'From'
            $mail->addAddress('tytly0110@gmail.com');
            $mail->Subject = "$email ($subject)"; // Sửa dấu ngoặc kép và đặt dấu ngoặc đơn vào xung quanh biểu thức
            $mail->Body = $message;
            $mail->send();
    
            $_SESSION['status'] = 'success';
            $_SESSION['status_code']= 'E-mail sent successfully';
            header('location:../contact.php');
        }

    }else{
        die( 'Unable to load the "PHP Email Form" Library!');
    }



?>
<!-- <a href="../../PHPMailer/"></a> -->