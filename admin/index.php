<?php
require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET["page"] ?? 1, 4, Article::getTotal($conn));
$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

require '../includes/header.php';
?>

<h2>Administration</h2>
<p><a href="new-article.php">New Article</a></p>

<?php if (empty($articles)) : ?>
  <p>No results found!</p>
<?php else : ?>
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Published At</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($articles as $article) : ?>
        <tr>
          <td>
            <a href="article.php?id=<?= $article['id'] ?>"><?php echo htmlspecialchars($article['title']); ?></a>
          </td>
          <td>
            <?php if ($article['published_at']) : ?>
              <time><?= $article['published_at'] ?></time>
            <?php else : ?>
              Unpublished
              <button class="publish" data-id="<?= $article['id'] ?>">Publish</button>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php require '../includes/paginator.php'; ?>
<?php endif; ?>

<?php
require '../includes/footer.php';
?>