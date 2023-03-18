<?php

$msj = htmlentities($_POST["msj"], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$post = dechex(rand());
$color = rand(0,6);
if($color == '0'){$back = '#aaffff';}elseif($color == '1'){$back = '#ffaaff';}elseif($color == '2'){$back = '#ffaaff';}elseif($color == '3'){$back = '#ccccff';}elseif($color == '4'){$back = '#ffcccc';}elseif($color == '5'){$back = '#ffccff';}else{$back = '#ffffaa';}


// HTML character escaping

if ($_GET["msj"]) {
	$msj = htmlentities($_GET["msj"], ENT_QUOTES | ENT_IGNORE, "UTF-8");
	
}



if ($_POST["msj"]){
	$msj = str_replace("[[","<a href=\"#", $msj);
	$msj = str_replace("]]","\">otro post</a>", $msj);
	$bbs = '<hr> ';
	$bbs = '<div style="background-color:'.$back.';"><a name="' . $post . '"><b>' . $post . '</b></a> - ' . $msj . '<div>';
	$bbs .= file_get_contents('bbs.htm');
	file_put_contents('bbs.htm', $bbs);
        header("Location: ./");
}


// Name and post form

echo "<center><form method=\"POST\"><textarea name=\"msj\"></textarea><br/><br/><input type=\"submit\" value=\"Send\"></form></center>";
echo '<br/>';

// If file does not exists, creates empty
if(!file_exists("bbs.htm")) {
    file_put_contents("bbs.htm", '');
}

$file = fopen("bbs.htm", "r");
while(!feof($file)) {
		echo fgets($file). "<br />";
}
fclose($file);

?>
