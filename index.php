<?php
require 'includes/init.php';
$conn = require 'includes/db.php';

$paginator = new Paginator($_GET["page"] ?? 1, 4, Article::getTotal($conn, true));
$articles = Article::getPage($conn, $paginator->limit, $paginator->offset, true);
require 'includes/header.php';
?>
<?php if (empty($articles)) : ?>
  <p>No results found!</p>
<?php else : ?>
  <ul>
    <?php foreach ($articles as $article) : ?>
      <li>
        <article>
          <h2><a href="article.php?id=<?= $article['id'] ?>"><?php echo htmlspecialchars($article['title']); ?></a></h2>
          <time datetime="<?= $article['published_at'] ?>">
            <?php
            $datetime = new DateTime($article['published_at']);
            echo $datetime->format('j F, Y');
            ?>
          </time>
          <?php if ($article['category_names']) : ?>
            <p>
              Categories:
              <?php foreach ($article['category_names'] as $key => $name) : ?>
                <?= htmlspecialchars($name) ?>
              <?php endforeach; ?>
            </p>
          <?php endif; ?>
          <p><?php echo htmlspecialchars($article['content']); ?></p>
        </article>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php require 'includes/paginator.php'; ?>
<?php endif; ?>

<?php
require 'includes/footer.php';
?>