<?php
/*Puhdustaa syöttäminen data*/
function purifying_data($data)
{
$new_data = trim($data);
$new_data = stripslashes($data);
$new_data = htmlspecialchars($data);
return $new_data;
}
?>