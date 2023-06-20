<?php
require 'includes/init.php';
$conn = require 'includes/db.php';

if (isset($_GET['id'])) {
  $article = Article::getById($conn, $_GET['id']);
  if (!$article) {
    die('article not found');
  }
} else {
  die('id not found');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if($article->delete($conn)){
    Url::redirect('/');
  }
}
?>
<?php require 'includes/header.php'; ?>
<h2>Delete Article</h2>
<form action="" method="post">
  <p>are you sure?</p>
  <a href="article.php?id=<?= $article->id; ?>">Cancel</a>
  <button>Delete</button>
</form>
<?php require 'includes/footer.php'; ?>