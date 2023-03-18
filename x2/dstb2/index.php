<?php
$msj = htmlentities($_POST["msj"], ENT_QUOTES | ENT_IGNORE, "UTF-8");




 $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
 $back = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    


// HTML character escaping
if ($_GET["msj"]) {
	$msj = htmlentities($_GET["msj"], ENT_QUOTES | ENT_IGNORE, "UTF-8");
	
}


if ($_POST["msj"]){

	$bbs = '<div style="background-color:'.$back.';"><a name="' . $post . '"><b>' . $post . '</b></a> - ' . $msj . '<div>';
	$bbs .= file_get_contents('bbs.htm');
	file_put_contents('bbs.htm', $bbs);
       header("Location: ./");
}


// Name and post form

echo "<center><form method=\"POST\"><textarea name=\"msj\"></textarea><br/><br/><input type=\"submit\" value=\"Send\"></form></center>";
echo '<br/>';



$file = fopen("bbs.htm", "r");
while(!feof($file)) {
		echo fgets($file). "<br />";
}
fclose($file);

?>
