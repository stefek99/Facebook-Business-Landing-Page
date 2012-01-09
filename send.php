<?php
	$to = "michal@ekouk.com"; 
	$subject = "Facebook Page Contact Form";

	$idea = $_POST['idea'];
	$email = $_POST['email'];
	$body = "From: $email\nIdea: $idea\n";
	
	$logFile = "logFile.txt";
	$fh = fopen($logFile, 'w') or die("can't open file");
	fwrite($fh, $body);
	fwrite($fh, time());
	fclose($fh);
	
	mail($to, $subject, $body);
?>