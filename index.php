<?php

// https://mailtrap.io/blog/php-email-sending/

// Affichage des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$errors = [];
$errorMessage = '';
$successMessage = '';
$siteKey = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
$secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = sanitizeInput($_POST['name']);
	$email = sanitizeInput($_POST['email']);
	$message = sanitizeInput($_POST['message']);
	$recaptchaResponse = sanitizeInput($_POST['g-recaptcha-response']);
	// var_dump($recaptchaResponse);

	$recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}";
	$verify = json_decode(file_get_contents($recaptchaUrl));
	// var_dump($verify);

	if (!$verify->success) {
		$errors[] = 'Recaptcha failed';
	}
	if (empty($name)) {
		$errors[] = 'Name is empty';
	}
	if (empty($email)) {
		$errors[] = 'Email is empty';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Email is invalid';
	}
	if (empty($message)) {
		$errors[] = 'Message is empty';
	}

	if (!empty($errors)) {
		$allErrors = join('<br/>', $errors);
		$errorMessage = "<p style='color: red;'>{$allErrors}</p>";
	} else {
		$toEmail = 'adrien.pierre@strategie.agency';
		$emailSubject = 'New email from your contaсt form';

		// Create a new PHPMailer instance
		$mail = new PHPMailer(true);
		try {
			// Configure the PHPMailer instance
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'adrienpierrewv@gmail.com';
			$mail->Password = 'yyvlwpgfohvbdtoo';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			// Set the sender, recipient, subject, and body of the message
			$mail->setFrom($email);
			$mail->addAddress($toEmail);
			$mail->Subject = $emailSubject;
			$mail->isHTML(true);
			$mail->Body = "<p>Name: {$name}</p><p>Email: {$email}</p><p>Message: {$message}</p>";

			// var_dump($mail);
			// Send the message
			$mail->send();

			$successMessage = "<p style='color: green;'>Thank you for contacting us :)</p>";
		} catch (Exception $e) {
			$errorMessage = "<p style='color: red;'>Oops, something went wrong. Please try again later</p>";
		}
	}
}

function sanitizeInput($input)
{
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
	return $input;
}

?>

<html>

<body>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<form action="" method="post" id="contact-form">
		<h2>Contact us</h2>
		<?php echo ((!empty($errorMessage)) ? $errorMessage : '') ?>
		<?php echo ((!empty($successMessage)) ? $successMessage : '') ?>
		<p>
			<label>First Name:</label>
			<input name="name" type="text" required />
		</p>
		<p>
			<label>Email Address:</label>
			<input style="cursor: pointer;" name="email" type="email" required />
		</p>
		<p>
			<label>Message:</label>
			<textarea name="message" required></textarea>
		</p>
		<p>
			<button class="g-recaptcha" type="submit" data-sitekey="<?php echo $siteKey ?>" data-callback='onRecaptchaSuccess'>
				Submit
			</button>
		</p>
	</form>

	<script>
		function onRecaptchaSuccess() {
			document.getElementById('contact-form').submit();
		}
	</script>
</body>

</html>
