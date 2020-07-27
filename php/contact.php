<?php
	if(isset($_POST ['submitContact'])) {
		require 'phpmailer/src/Exception.php';
		require 'phpmailer/src/PHPMailer.php';
		
		$errors = array();

		// Check if name has been entered
		if (!isset($_POST['name'])) {
			$errors['name'] = 'Please enter your name';
		}

		// Check if email has been entered and is valid
		if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Please enter a valid email address';
		}

		//Check if message has been entered
		if (!isset($_POST['message'])) {
			$errors['message'] = 'Please enter your message';
		}

		$errorOutput = '';

		if(!empty($errors)){

			$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
			$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

			$errorOutput  .= '<ul>';

			foreach ($errors as $key => $value) {
				$errorOutput .= '<li>'.$value.'</li>';
			}

			$errorOutput .= '</ul>';
			$errorOutput .= '</div>';

			echo $errorOutput;
			die();
		}
		
		function sendMail($to, $from, $name, $body) 
		{
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			$mail -> setFrom($from, $name);
			$mail -> addAddress($to);
			$mail -> Subject = 'Contact Form : POWER 24 Enquiry';
			$mail -> Body = $name .'<br>'. $body;
			$mail -> isHTML(true);
			return $mail -> send(); 
		}
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		
		if(sendMail('rajvishal2704@gmail.com', $email, $name, $message)) {
			$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
			$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$result .= 'Thank You! We will be in touch';
			$result .= '</div>';
			header("Location: http://www.power24.co.in/index.php?Message=" . urlencode($result));

			die();
		} else {
			$result = '';
			$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
			$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$result .= 'Something bad happend during sending this message. Please try again later';
			$result .= '</div>';

			header("Location: http://www.power24.co.in/index.php?Message=" . urlencode($result));
			exit();
		}	
    }
?>