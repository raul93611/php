<?php

/**
 * getArticle
 *
 * @param  mixed $conn
 * @param  mixed $id
 * @param  mixed $columns
 * @return void
 */
function getArticle($conn, $id, $columns = '*') {
  $sql = "SELECT {$columns} FROM article WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt === false) {
    echo mysqli_error($conn);
  } else {
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
      $result =  mysqli_stmt_get_result($stmt);

      return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
  }
}

/**
 * validateArticle
 *
 * @param  mixed $title
 * @param  mixed $content
 * @param  mixed $published_at
 * @return void
 */
function validateArticle($title, $content, $published_at) {
  $errors = [];
  if ($title == '') {
    $errors[] = 'Title is required';
  }

  if ($content == '') {
    $errors[] = 'Content is required';
  }

  if ($published_at == '') {
    $datetime = date_create_from_format('Y-m-d H:i:s', $published_at);
    if ($datetime) {
      $errors[] = 'Date format is incorrect';
    }
  }

  return $errors;
}
