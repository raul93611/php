<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])) {
  $article = getArticle($conn, $_GET['id']);
} else {
  $article = null;
}
require 'includes/header.php';
?>
<?php if (is_null($article)) : ?>
  <p>Article not found!</p>
<?php else : ?>
  <article>
    <h2><?php echo htmlspecialchars($article['title']); ?></h2>
    <p><?php echo htmlspecialchars($article['content']); ?></p>
  </article>
  <a href="edit-article.php?id=<?= $article['id']; ?>">Edit</a>
  <a href="delete-article.php?id=<?= $article['id']; ?>">Delete</a>
<?php endif; ?>
<?php
require 'includes/footer.php';
?>