<?php
$db = new PDO('sqlite:forum.db');
$db->exec('CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY, name TEXT, post TEXT, img TEXT)');

$name = htmlspecialchars($_POST['name']);
$post = htmlspecialchars($_POST['post']);
$img = '';

if ($_FILES['fileToUpload']['error'] == 0) {
  $target_dir = 'uploads/';
  $imageFileType = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
  $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
  $uploadOk = 1;

  if ($_FILES['fileToUpload']['size'] > 500000) {
    $uploadOk = 0;
  }

  if ($uploadOk) {
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    $img = $target_file;
  }
}

$stmt = $db->prepare('INSERT INTO messages (name, post, img) VALUES (?, ?, ?)');
$stmt->execute([$name, $post, $img]);

header("Location: index.php");
?>
