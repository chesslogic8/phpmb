
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
    <title>VA.WTF</title>
	
<link rel="stylesheet" type="text/css" href="1.css">
	
</head>
  <body>
     
&nbsp;&nbsp;&nbsp;
<a href="../">GO TO HOME PAGE</a>





<?php

// Configuration
$name = '/sandbox';

$defname = "Anonymous";
// End of configuration

// HTML character escaping
if ($_POST["p"]) {
	$p = htmlentities($_POST["p"], ENT_QUOTES | ENT_IGNORE, "UTF-8");
	
}
// Make links clickable
$p = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $p);
$p = preg_replace('!(((goph)e(r)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $p);

if ($_POST["script"] == "POST") {
   header("Content-Type: text/plain");
   $code = file_get_contents('index.php');
   echo $code;
   die();
}

// If request is to post, writes to file
if ($_POST["p"]){
        $bbs = '<hr> ';
        $mydate=getdate(date("U"));
        $bbs .= " $mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
        $bbs .= '<br/>' . $p . "<br/>\n";
        $bbs .= file_get_contents('v.htm');
        file_put_contents('v.htm', $bbs);
        header("Location: ./");
}






// Name and post form

echo "<center><form method=\"POST\"><textarea name=\"p\"></textarea><br/><br/><input type=\"submit\" value=\"Send\"></form></center>";
echo '<br/>';
echo "<br/><center><h1>$name</h1></center>\n";
// If file does not exists, creates empty
if(!file_exists("v.htm")) {
    file_put_contents("v.htm", '');
}


// Prints contents of file
$file = fopen("v.htm", "r");
while(!feof($file)) { echo fgets($file). "<br/>\n";}
fclose($file);


?>
