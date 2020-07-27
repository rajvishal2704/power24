<?php

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
	if (!isset($_POST['phone'])) {
		$errors['phone'] = 'Please enter your contact number';
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



	$name = $_POST['name'];
	$email = $_POST['email'];
	$coverLetter = $_POST['coverLetter'];
	$from = $email;
	$to = 'info@power24.co.in';  // please change this email id
	$subject = 'Job Application';

	$body = "From: $name\n E-Mail: $email\n Message:\n $coverLetter";

	$headers = "From: ".$from;


	//send the email
	$result = '';
	if (mail ($to, $subject, $body, $headers)) {
		$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Thank You! I will be in touch';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Something bad happend during sending this message. Please try again later';
	$result .= '</div>';

	echo $result;
