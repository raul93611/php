<?php
require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();

if (isset($_GET['id'])) {
  $article = getArticle($conn, $_GET['id'], 'id');
  if ($article) {
    $id = $article['id'];
  } else {
    die('article not found');
  }
} else {
  die('id not found');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sql = "DELETE FROM article WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt === false) {
    echo mysqli_error($conn);
  } else {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    if (mysqli_stmt_execute($stmt)) {
      redirect("/index.php");
    } else {
      echo mysqli_stmt_error($stmt);
    }
  }
}
?>
<?php require 'includes/header.php'; ?>
<h2>Delete Article</h2>
<form action="" method="post">
  <p>are you sure?</p>
  <a href="article.php?id=<?= $article['id']; ?>">Cancel</a>
  <button>Delete</button>
</form>
<?php require 'includes/footer.php'; ?>