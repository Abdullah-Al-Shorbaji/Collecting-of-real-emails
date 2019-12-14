<?php
/*Asettaa alkuasetukset*/
include("open_session.php");
include("connect_to_database.php");
include("data_validation.php");
require_once("PHPMailerAutoload.php");
require_once("PHPMailer/PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer/PHPMailer-master/src/SMTP.php");
require_once("PHPMailer/PHPMailer-master/src/Exception.php");
require_once("config.php");
$resulted_msg	=	"";
$new_email_id	=	"";
$pass_to_insert	=	0;

if(isset($_POST["add_email"]))
{
	$email_to_add	=	$_POST["email_to_add"];
	
	if(empty($_POST["email_to_add"]))
	{

		$resulted_msg	=	"Please enter an email";
	}
	else
	{
		$pass_to_insert ++;
	}

	if($pass_to_insert == 1)
	{	
	$pass_to_insert	=	0;
		$_SESSION["confirmation_code"]	=	$c_code	=	strtoupper(substr(md5(microtime()),rand(0,26),5));
		$_SESSION["email"]	=	$to		=	$_POST["email_to_add"];
		$mail = new PHPMailer\PHPMailer\PHPMailer();

		$mail->SMTPDebug = false;

		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = smpt_user;
		$mail->Password = smpt_password;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		$mail->setFrom(smpt_user, " ");
		$mail->addAddress($_POST["email_to_add"], "New email owner");     // Add a recipient
		$mail->addReplyTo(smpt_user, " ");
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = "Confirmation code to validate your email";
		$mail->Body    = "	<table style='text-align: left;'>
								<tr>
									<th style='	font-size:		2em;
												color:			#1d4096;
												border-bottom: 	3px dashed #3a63c7; 
												padding-bottom:	10px;
												width:			auto;
												height:			auto;'>
									Hi there,<br>
									</th>
								</tr>

								<tr>
									<td style='	font-size:		1.5em;
												color:			#557ee0;
												border-top: 	3px dashed #3a63c7;
												padding-top:	10px;
												width:			auto;
												height:			auto;'>
									Thank you for providing us your email.
									<br>
									Your confirmation code is: <span style='color:#1d4096;'>".$c_code.".<br></span>
									Please enter this code in the textbox found in the validation page.
									</td>
								</tr>
							</table>";
			if(!$mail->send())
			{
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
		else
			{	
				echo "	<div id='transparency_body' name='transparency_body'>
						<div id='modal_content' name='modal_content'>
						<p id='successful_detail'><strong id='successful_title'>Congratulations!</strong><br>An email contains a code sent to email's to confirm his/her email on the validation page.<br>Contact his/her to inform his/her about that</p>
						</div>
						</div>
						<script>
						var t_body = document.getElementById('transparency_body');
						t_body.style.display = 'block';
						</script>";
				echo "<meta http-equiv='refresh' content='3;url=index.php'>";
			}
	}
}
?>
<html>
<head> <!--Yhteyttää sivun ulko asetuksille -->
<title>Collection emails' homepage</title>
<meta name="viewport" content="width=device-width,intial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie-edge">
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
<h1>
Welcome to Email collection system
</h1>
<div class="form-frame">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<ul class="form-list">
	<li>
	Enter an email to add it to your list:
	</li>
	
	<li>
	<input id="email-to-add" name="email_to_add" type="email" placeholder="Email address"><span style="color: red;">*</span>
	</li>
	
	<li>
	<div id="resulted-msg"><span style="color: red;"><?php echo $resulted_msg; ?></span></div>
	</li>
	
	<li>
	<input id="submit-to-add" name="add_email" type="submit" value="Submit the email">
	</li>	
</ul>
	
</form>

</div>
<?php
$conn->close();
?>
</body>
