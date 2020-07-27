<?php 
	if(isset($_POST ['submit'])) {
		require 'src/Exception.php';
		require 'src/PHPMailer.php';


		$errors = array();

		// Check if name has been entered
		if (!isset($_POST['name'])) {
			$errors['name'] = 'Please enter your name';
		}
	
		// Check if address has been entered
		if (!isset($_POST['address1'])) {
			$errors['address1'] = 'Please enter your address';
		}
	
		// Check if address has been entered
		if (!isset($_POST['address2'])) {
			$errors['address2'] = 'Please enter your city name';
		}
	
		// Check if address has been entered
		if (!isset($_POST['address3'])) {
			$errors['address3'] = 'Please enter your state / Union Territory name';
		}
	
		// Check if address has been entered
		if (!isset($_POST['address4'])) {
			$errors['address4'] = 'Please enter your postal / zip code';
		}
	
		// Check if address has been entered
		if (!isset($_POST['address5'])) {
			$errors['address5'] = 'Please enter your country name';
		}
	
		// Check if contact number has been entered
		if (!isset($_POST['contactNumber'])) {
			$errors['contactNumber'] = 'Please enter your contact number';
		}
	
		// Check if email has been entered and is valid
		if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Please enter a valid email address';
		}
	
		// Check if position/post has been entered
		if (!isset($_POST['position'])) {
			$errors['position'] = 'Please enter the position';
		}
	
		//Check if cover letter has been entered
		if (!isset($_POST['coverLetter'])) {
			$errors['coverLetter'] = 'Please fill this section';
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
	
	
	
		



		function sendMail($to, $from, $fromName, $contactNo, $position, $coverLetter, $resume, $photo, $address1, $address2, $address3, $address4, $address5) 
		{
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			$mail -> setFrom($from, $fromName);
			$mail -> addAddress($to);
			$mail -> addAttachment($resume);
			$mail -> addAttachment($photo);
			$mail -> Subject = 'Job Application for bouncer and body guard';
			$mail -> Body = $fromName .'<br>'. $contactNo .'<br>'. $position .'<br>'. $address1.', '.$address2.', '.$address3.'('.$address4.')' .'<br>'. $address5 .'<br>'. $coverLetter;
			$mail -> isHTML(true);
			return $mail -> send(); 
		}
		$name = $_POST['name'];
		$email = $_POST['email'];
		$contactNumber = $_POST['contactNumber'];
		$position = $_POST['position'];
		$coverLetter = $_POST['coverLetter'];
		$fileResume = "attachment/".basename($_FILES['resume']['name']);
		$filePhoto = "attachment/".basename($_FILES['photo']['name']);
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$address3 = $_POST['address3'];
		$address4 = $_POST['address4'];
		$address5 = $_POST['address5'];
		if(move_uploaded_file($_FILES['resume']['tmp_name'], $fileResume)) {
			if(move_uploaded_file($_FILES['photo']['tmp_name'], $filePhoto)) {
				if(sendMail('rajvishal2704@gmail.com', $email, $name, $contactNumber, $position, $coverLetter, $fileResume, $filePhoto, $address1, $address2, $address3, $address4, $address5)) {
					$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
					$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					$result .= 'Thank You! I will be in touch';
					$result .= '</div>';
					
					echo $result;
					die();
				} else {
					$result = '';
					$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
					$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					$result .= 'Something bad happend during sending this message. Please try again later';
					$result .= '</div>';

					echo $result;
				}
			}
		} else {
			$result = '';
			$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
			$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$result .= 'Please check your attachment';
			$result .= '</div>';

			echo $result;
		}
	}	
?>
