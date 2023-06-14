<?php if (!empty($errors)) : ?>
  <?php foreach ($errors as $item) : ?>
    <li><?= $item ?></li>
  <?php endforeach; ?>
<?php endif; ?>
<h2>New article</h2>
<form action="" method="post">
  <div>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($title) ?>">
  </div>
  <div>
    <label for="content">Content</label>
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Article content"><?= htmlspecialchars($content) ?></textarea>
  </div>
  <div>
    <label for="published_at">Publish date and time</label>
    <input type="datetime-local" name="published_at" id="published_at" value="<?= htmlspecialchars($published_at) ?>">
  </div>
  <button>Save</button>
</form>