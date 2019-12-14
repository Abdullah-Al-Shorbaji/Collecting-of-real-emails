<?php
/*Syöttää aloituksen muuttuja*/
include("open_session.php");
include("connect_to_database.php");
include("data_validation.php");

$email						=	$_SESSION["email"];
$confirmation_code			=	$_SESSION["confirmation_code"];
$empty_confirmation_code	=	"";
$q_insert					=	"";
?>
<!DOCTYPE html>
<html>
<head> <!--Yhteyttää sivun ulko asetuksille -->
<title>Email validation</title>
<link rel="stylesheet" type="text/css" href="validate_email.css">
</head>
<body>
<?php

if(isset($_POST["ensure_confirm"])) /*Korottaa vahvistusprosessi*/
{
	if($_POST["confirmation_code"] == "") /*Selittää mitä pitäisi tapahtua kun vahvistuskoodi on tyhjänä*/
	{
		$empty_confirmation_code = "You should enter a valid code";
	}
	else /*Selittää mitä pitäisi tapahtua kun vahvistuskoodi ei ole tyhjänä*/
	{
		if($confirmation_code != $_POST["confirmation_code"]) /*Selittää mitä pitäisi tapahtua kun alkuperäinen vahvistuskoodi ei ole yhtä kuin syötetty koodi*/
		{
		$empty_confirmation_code = "Invalid code.";
		}
		else /*Selittää mitä pitäisi tapahtua kun alkuperäinen vahvistuskoodi on yhtä kuin syötetty koodi*/
		{

		$max_email_id	= 	"select ifnull(max(email_id), 0) + 1 email_id from doc_collected_emails";
		$get_max_id		=	$conn->query($max_email_id);

		if($get_max_id->num_rows > 0)
		{
		$rows			= 	$get_max_id->fetch_assoc();
		$new_email_id	=	$rows["email_id"];
		}

		$q_insert 		= 	"insert into doc_collected_emails values ($new_email_id, '$email', 1, current_timestamp)";

			if($conn->query($q_insert)) /*Selittää mitä tapahtuu kun vahvistusprosessi onnistui*/
			{
			echo "	<div id='transparency_body' name='transparency_body'>
					<div id='modal_content1' name='modal_content1'>
					<p id='successful_detail'>The verification process has been successful and your email has been saved in the database</p>
					</div>
					</div>
					<script>
					var t_body = document.getElementById('transparency_body');
					t_body.style.display = 'block';
					</script>";
					

				echo "<meta http-equiv='refresh' content='2;url=validate_email.php'>";
							
			}
		}
	}
}

?>
<!--Rakentaa syöttämisen muodon-->
		<div id="content_window">
			<div id="form_frame">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<label id="confirmation_code_title" name="confirmation_code_title">
					Please enter the verification code!
					</label>
					<br><br>
					<input type="text" id="confirmation_code" name="confirmation_code" value=""/>
					<span style="color:#a80a63;"><?php echo "<br>".$empty_confirmation_code; ?></span><br><br>
					<input id="ensure_confirm" name="ensure_confirm" type="submit" value="Confirm"/>
				</form>
			</div>
		</div>
</body>
</html>