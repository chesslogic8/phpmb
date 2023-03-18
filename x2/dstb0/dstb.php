<?php
$msj = htmlentities($_GET["msj"], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$post = dechex(rand());
$color = rand(0,6);
if($color == '0'){$back = '#aaffff';}elseif($color == '1'){$back = '#ffaaff';}elseif($color == '2'){$back = '#ffaaff';}elseif($color == '3'){$back = '#ccccff';}elseif($color == '4'){$back = '#ffcccc';}elseif($color == '5'){$back = '#ffccff';}else{$back = '#ffffaa';}

if ($_GET["msj"]){
	$msj = str_replace("[[","<a href=\"#", $msj);
	$msj = str_replace("]]","\">otro post</a>", $msj);
	$bbs = '<br><br><a href="../">HOME</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="dstb.php">NEW POST</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.html">REFRESH</a><br><br><div style="background-color:'.$back.';"><a name="' . $post . '"><b>' . $post . '</b></a> - ' . $msj . '<div>';
	$bbs .= file_get_contents('index.html');
	file_put_contents('index.html', $bbs);
	header("Location: ./index.html");
}
echo '<meta http-equiv="pragma" content="no-cache" />';
echo '<div style="background-color: #000; color: #ccc; text-align: center;"><br><b>1)&nbsp;&nbsp; click &nbsp;<a href="?msj=">[LOAD URL]</a></b></div>';
echo '<div style="background-color: #000; color: #ccc; text-align: center;"><br><b>2)&nbsp;&nbsp;Write/paste your message in url bar after msj=</b></div>';
echo '<div style="background-color: #000; color: #ccc; text-align: center;"><br><b>3)&nbsp;&nbsp;Hit ENTER key to send.</b></div>';
echo '<div style="background-color: #000; color: #ccc; text-align: center;"><br><b>When you are returned to the board, hit a REFRESH link if your post is not showing.</b></div><br>';
echo 'If post does not go through you likely did not click [LOAD URL] in step 1, OR you changed loaded url by accident. &nbsp;&nbsp;';      
echo 'Also, posts can not be too long- about a half of a page usually goes through. &nbsp;&nbsp;';     
echo 'After you load the browser in step 1, see the browser URL bar, put mouse cursor after the msj= and click twice.&nbsp;&nbsp;';
echo 'First click highlights entire url, second click UN-highlights and puts cursor in place to write or paste your message.&nbsp;&nbsp;';
echo 'Posting from mobile phones can be tricky because it is easy to mess up the loaded url- but once you learn, it is easy. &nbsp;&nbsp;';
echo 'TOR browser sometimes gives cross site scripting warning, it is NOT a cross site script attack, as we are injecting text through the url bar on purpose.&nbsp;&nbsp;';
echo '<center> <h1> <a href="index.html">[Return to message board without posting]</a>';





//   $file = fopen("index.html", "r");
//     while(!feof($file)) {
//		echo fgets($file). "<br />";
//    }
//           fclose($file);
// exit;
?>









