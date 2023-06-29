<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>
<?php require 'includes/init.php' ?>
<?php
$email = '';
$subject = '';
$message = '';

$sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  $errors = [];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address";
  }

  if (empty($subject)) {
    $errors[] = "Please enter a subject";
  }

  if (empty($message)) {
    $errors[] = "Please enter a message";
  }

  if (count($errors) == 0) {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->isSMTP();
      $mail->Host = SMTP_HOST;
      $mail->SMTPAuth = true;
      $mail->Port = 2525;
      $mail->Username = SMTP_USER;
      $mail->Password = SMTP_PASS;

      //Recipients
      $mail->setFrom('from@example.com', 'Mailer');
      $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
      $mail->addAddress('ellen@example.com');               //Name is optional
      $mail->addReplyTo('info@example.com', 'Information');
      $mail->addCC('cc@example.com');
      $mail->addBCC('bcc@example.com');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Here is the subject';
      $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      $sent = true;
    } catch (Exception $e) {
      $errors[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
?>
<?php require 'includes/header.php' ?>
<h2>Contact</h2>
<?php if ($sent) : ?>
  <p>Message has been sent.</p>
<?php else : ?>
  <?php if (!empty($errors)) : ?>
    <ul>
      <?php foreach ($errors as $error) : ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <form action="" method="post" id="contactForm">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($email) ?>">
    </div>
    <div class="form-group">
      <label for="subject">Subject</label>
      <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="<?= htmlspecialchars($subject) ?>">
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea name="message" id="message" class="form-control" placeholder="Message"><?= htmlspecialchars($message) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
  </form>
<?php endif; ?>
<?php require 'includes/footer.php' ?>