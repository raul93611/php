<?php
require 'includes/init.php';
$conn = require 'includes/db.php';

if (isset($_GET['id'])) {
  $article = Article::getWithCategories($conn, $_GET['id'], true);
} else {
  $article = null;
}
require 'includes/header.php';
?>
<?php if (!$article) : ?>
  <p>Article not found!</p>
<?php else : ?>
  <article>
    <h2><?php echo htmlspecialchars($article[0]['title']); ?></h2>
    <time datetime="<?= $article[0]['published_at'] ?>">
      <?php
      $datetime = new DateTime($article[0]['published_at']);
      echo $datetime->format('j F, Y');
      ?>
    </time>
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
<?php endif; ?>
<?php
require 'includes/footer.php';
?>