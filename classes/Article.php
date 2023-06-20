<?php
class Article {
  public $id;
  public $title;
  public $content;
  public $published_at;
  public $errors = [];

  public static function getAll($conn) {
    $sql = "SELECT * FROM article ORDER BY published_at DESC";

    $results = $conn->query($sql);
    return $results->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getById($conn, $id, $columns = '*') {
    $sql = "SELECT {$columns} FROM article WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
    if ($stmt->execute()) {
      return $stmt->fetch();
    }
  }

  public function update($conn) {
    if ($this->validate()) {
      $sql = "UPDATE article SET title = :title, content = :content, published_at = :published_at WHERE id = :id";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
      $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
      $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
      if (empty($this->published_at)) {
        $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
      } else {
        $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
      }

      return $stmt->execute();
    } else {
      return false;
    }
  }

  protected function validate() {
    if ($this->title == '') {
      $this->errors[] = 'Title is required';
    }

    if ($this->content == '') {
      $this->errors[] = 'Content is required';
    }

    if ($this->published_at == '') {
      $datetime = date_create_from_format('Y-m-d H:i:s', $this->published_at);
      if ($datetime) {
        $this->errors[] = 'Date format is incorrect';
      }
    }

    return empty($this->errors);
  }

  public function delete($conn) {
    $sql = "DELETE FROM article WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

    return $stmt->execute();
  }

  public function create($conn){
    if ($this->validate()) {
      $sql = "INSERT INTO article (title, content, published_at) VALUES(:title, :content, :published_at)";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
      $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
      if (empty($this->published_at)) {
        $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
      } else {
        $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
      }

      if($stmt->execute()){
        $this->id = $conn->lastInsertId();
        return true;
      }
    } else {
      return false;
    }
  }
}