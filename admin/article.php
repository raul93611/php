<?php
require '../includes/init.php';
Auth::requireLogin();
$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
  $article = Article::getWithCategories($conn, $_GET['id']);
} else {
  $article = null;
}
require '../includes/header.php';
?>
<?php if (!$article) : ?>
  <p>Article not found!</p>
<?php else : ?>
  <article>
    <h2><?php echo htmlspecialchars($article[0]['title']); ?></h2>
    <?= $article['published_at'] ?? 'Unpublished' ?> 
    <?php if ($article[0]['category_name']) : ?>
      <p>
        Categories:
        <?php foreach ($article as $key => $a) : ?>
          <?= htmlspecialchars($a['category_name']) ?>
        <?php endforeach; ?>
      </p>
    <?php endif; ?>
    <?php if ($article[0]['image_file']) : ?>
      <img src="/uploads/<?= $article[0]['image_file'] ?>" alt="">
    <?php endif; ?>
    <p><?php echo htmlspecialchars($article[0]['content']); ?></p>
  </article>
  <a href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit</a>
  <a class="delete" href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>
  <a href="edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit Image</a>
<?php endif; ?>
<?php
require '../includes/footer.php';
?>