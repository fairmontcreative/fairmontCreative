	<?php
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	if(!isset($_POST['submit']))
	{
		//This page should not be accessed directly. Need to submit the form.
		echo "error; you need to submit the form!";
	}
	$name = $_POST["name"];
	$visitor_email = $_POST["email"];
	$yardsign = $_POST["yardsign"];
	$host_meetandgreet = $_POST["host_meetandgreet"];
	$volunteer = $_POST["volunteer"];
	$donation = $_POST["donation"];
	$leavenote = $_POST["leavenote"];

	//Validate first`
	if(empty($name)||empty($visitor_email))
	{
	    echo "Name and email are mandatory!";
	    exit;
	}

	if(IsInjected($visitor_email))
	{
	    echo "Bad email value!";
	    exit;
	}

	$email_from = $visitor_email;//<== update the email address
	$email_subject = "$name would like to help Winfield Working Together";
	$email_body = "You have received a new message from $name.
	    $name has requested:
			$yardsign
			$host_meetandgreet
			$volunteer
			$donation
			$leavenote";



	$to = "winfieldworkingtogether@gmail.com";//<== update the email address
	$headers = "From: $email_from \r\n";
	$headers .= "Reply-To: $visitor_email \r\n";
	//Send the email!
	mail($to,$email_subject,$email_body,$headers);
	//done. redirect to thank-you page.
	//header(Location: index.html);
	echo "<script type='text/javascript'>window.top.location='https://www.winfieldworkingtogether.com/form_thankyou.html';</script>"; exit;


	// Function to validate against any email injection attempts
	function IsInjected($str)
	{
	  $injections = array('(\n+)',
	              '(\r+)',
	              '(\t+)',
	              '(%0A+)',
	              '(%0D+)',
	              '(%08+)',
	              '(%09+)'
	              );
	  $inject = join('|', $injections);
	  $inject = "/$inject/i";
	  if(preg_match($inject,$str))
	    {
	    return true;
	  }
	  else
	    {
	    return false;
	  }
	}
	?>
