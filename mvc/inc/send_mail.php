<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../TEST_3/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../TEST_3/vendor/phpmailer/phpmailer/src/Exception.php';
require '../TEST_3/vendor/phpmailer/phpmailer/src/SMTP.php';

function sendMail($recipient, $subject, $message) {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'nmh7624@gmail.com';
    $mail->Password = 'bnns rrhb jfdt vpyh';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('nmh7624@gmail.com', 'Order Manager Website');
    $mail->addAddress($recipient);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        if (!$mail->Send()) {
            throw new Exception("Error while sending Email.");
        } else {
            echo "Email sent successfully";
            return true;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}