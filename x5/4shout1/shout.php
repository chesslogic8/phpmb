<?php

$postName = htmlspecialchars($_POST["name"]);
$postText = htmlspecialchars($_POST["post"]);

$postTemplate = file_get_contents("replyTemplate.html");
$postNum = file_get_contents("counter.txt");

// fill out the template with the post contents
$postHTML = str_replace("<_POSTNAME_>",$postName, $postTemplate);
$postHTML = str_replace("<_POSTTEXT_>",$postText, $postHTML);
$postHTML = str_replace("<_POSTNUM_>",$postNum, $postHTML);

 
 
 header("Location: ./ ");

echo $postHTML;
file_put_contents("posts.html", $postHTML . file_get_contents("posts.html")); 

file_put_contents("a.html", $postHTML . file_get_contents("a.html"));


// put the post in the flatfile
//file_put_contents("a.html", file_get_contents("a.html") . $postHTML); // add post to frontpage
file_put_contents("counter.txt", $postNum+1); // update the counter


?>