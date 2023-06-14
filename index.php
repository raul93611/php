<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require 'includes/database.php';

$conn = getDB();

$sql = "SELECT * FROM article ORDER BY published_at DESC";

$results = mysqli_query($conn, $sql);

if ($results === false) {
  echo mysqli_error($conn);
} else {
  $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

require 'includes/header.php';
?>
<?php if (isset($_SESSION["is_logged_in"]) and $_SESSION["is_logged_in"]) : ?>
  <p>You are logged in. <a href="logout.php">Log Out</a></p>
<?php else : ?>
  <p>You are not logged in. <a href="login.php">Log In</a></p>
<?php endif; ?>

<a href="new-article.php">New Article</a>

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