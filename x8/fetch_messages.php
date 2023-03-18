<?php
$db = new PDO('sqlite:forum.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$messagesPerPage = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $messagesPerPage;

$messages = $db->prepare('SELECT * FROM messages ORDER BY id DESC LIMIT ? OFFSET ?');
$messages->bindValue(1, $messagesPerPage, PDO::PARAM_INT);
$messages->bindValue(2, $offset, PDO::PARAM_INT);
$messages->execute();
?>

<?php foreach ($messages as $message): ?>
    <div class="reply">
        <span class="postName"><?= htmlspecialchars($message['name']) ?></span>
        <span class="postNum"><?= $message['id'] ?></span>
        <?php if (!empty($message['img'])): ?>
            <img src="<?= htmlspecialchars($message['img']) ?>">
        <?php endif ?>
        <p class="postText"><?= htmlspecialchars($message['post']) ?></p>
    </div>
<?php endforeach ?>
