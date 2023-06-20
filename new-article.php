<?php
require 'includes/init.php';

if (!Auth::isLoggedIn()) {
  die('Unauthorized');
}

$article = new Article();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = require 'includes/db.php';

  $article->title = $_POST["title"];
  $article->content = $_POST["content"];
  $article->published_at = $_POST["published_at"];

  if ($article->create($conn)) {
    Url::redirect("/article.php?id={$article->id}");
  }
}
?>

<?php require 'includes/header.php'; ?>
<?php require 'includes/article-form.php'; ?>
<?php require 'includes/footer.php'; ?>