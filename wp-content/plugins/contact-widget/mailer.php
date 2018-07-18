<?php
//check for posts
if($_SERVER['REQUEST_METHOD'] == "POST") {
	//get and sanitize $_POST values
	$name = strip_tags(trim($_POST['name']));
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	$message = trim($_POST['message']);
	$recipient = $_POST['recipient'];
	$subject = $_POST['subject'];

	//simple validation
	if(empty($name) || empty($message) || empty($email)) {
		//set a 400 (bad request) response code and exit.
		http_response_code(400);
		echo "Please check your form fields";
		exit;
	}

	//build message
	$message = "Name: $name\n";
	$message .= "Email: $email\n\n";
	$message .= "Message: \n$message\n";

	//build headers
	$headers = "From: $name <$email>";

	//send email
	if(mail($recipient, $subject, $message, $headers)) {
		//set 200 response (success)
		http_response_code(200);
		echo "Thank you: Your message has been sent";
	} else {
		//set 500 response (internal server error)
		http_response_code(500);
		echo "Error: There was a problem sending your message";

	}
} else {
	//set 403 response
	http_response_code(403);
	echo 'There was a problem with your submission, please try again.';
}
