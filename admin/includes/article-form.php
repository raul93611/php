<?php if (!empty($article->errors)) : ?>
  <?php foreach ($article->errors as $item) : ?>
    <li><?= $item ?></li>
  <?php endforeach; ?>
<?php endif; ?>
<h2>New article</h2>
<form action="" method="post" id="formArticle">
  <div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($article->title) ?>">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Article content"><?= htmlspecialchars($article->content) ?></textarea>
  </div>
  <div class="form-group">
    <label for="published_at">Publish date and time</label>
    <input class="form-control" type="datetime-local" name="published_at" id="published_at" value="<?= htmlspecialchars($article->published_at) ?>">
  </div>
  <fieldset>
    <legend>Categories</legend>
    <?php foreach ($categories as $category) : ?>
      <div class="form-check">
        <input class="form-check-input" id="<?= $category['id'] ?>" type="checkbox" name="categories[]" value="<?= $category['id'] ?>" <?= in_array($category['id'], $category_ids) ? 'checked' : '' ?>/>
        <label class="form-check-label" for="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
      </div>
    <?php endforeach; ?>
  </fieldset>
  <button class="btn btn-primary">Save</button>
</form>