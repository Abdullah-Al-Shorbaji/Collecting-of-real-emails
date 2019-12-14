<?php
/*Syöttää tietokannan muutujat*/
$db_server 		= 	"localhost";
$db_user		=	"admin";
$db_password	=	"";
$db_name		=	"joinme_docs";

$conn = new mysqli($db_server, $db_user, $db_password, $db_name);

if($conn->connect_error)
{
die("Connection failed: ".$conn->connect_error);
}

?>