<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new PDO('sqlite:forum.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec('CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY, name TEXT, post TEXT, img TEXT)');

$messagesPerPage = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $messagesPerPage;

$messages = $db->prepare('SELECT * FROM messages ORDER BY id DESC LIMIT ? OFFSET ?');
$messages->bindValue(1, $messagesPerPage, PDO::PARAM_INT);
$messages->bindValue(2, $offset, PDO::PARAM_INT);
$messages->execute();

$totalMessages = $db->query('SELECT COUNT(*) FROM messages')->fetchColumn();
$totalPages = ceil($totalMessages / $messagesPerPage);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Board</title>
        <link rel="stylesheet" href="flex.css">
<script>
    function fetchMessages(page) {
        fetch(`fetch_messages.php?page=${page}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('posts').innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('pagination').addEventListener('click', event => {
            if (event.target.tagName === 'A') {
                event.preventDefault();
                const page = event.target.getAttribute('data-page');
                fetchMessages(page);
            }
        });
    });
</script>

    </head>
    <body>
        <div id="postBox">
            <form enctype="multipart/form-data" method="POST" action="shout.php">
                <table>
                    <tr>
                        <td>Name:</td>
                        <td>
                            <input type="text" name="name" value="Anonymous">
                            <input type="submit" value="Post">
                        </td>
                    </tr>
                    <tr>
                        <td>Post:</td>
                        <td>
                            <textarea name="post"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload:</td>
                        <td>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="posts">
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
        </div>

       <div id="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?page=<?= $i ?>" data-page="<?= $i ?>"><?= $i ?></a>
    <?php endfor ?>
</div>

    </body>
</html>

