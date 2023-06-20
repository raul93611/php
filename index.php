<?php
require 'includes/init.php';
$conn = require 'includes/db.php';

$articles = Article::getAll($conn);

require 'includes/header.php';
?>
<?php if (Auth::isLoggedIn()) : ?>
  <p>You are logged in. <a href="logout.php">Log Out</a></p>
  <p><a href="new-article.php">New Article</a></p>
<?php else : ?>
  <p>You are not logged in. <a href="login.php">Log In</a></p>
<?php endif; ?>


<?php if (empty($articles)) : ?>
  <p>No results found!</p>
<?php else : ?>
  <ul>
    <?php foreach ($articles as $article) : ?>
      <li>
        <article>
          <h2><a href="article.php?id=<?= $article['id'] ?>"><?php echo htmlspecialchars($article['title']); ?></a></h2>
          <p><?php echo htmlspecialchars($article['content']); ?></p>
        </article>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php
require 'includes/footer.php';
?>