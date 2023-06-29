<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <div class="container">
    <header>
      <h1>Blog</h1>
    </header>
    <nav>
      <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <?php if (Auth::isLoggedIn()) : ?>
          <li class="nav-item"><a class="nav-link" href="/admin/">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="/logout.php">Log Out</a></li>
        <?php else : ?>
          <li class="nav-item"><a class="nav-link" href="/login.php">Log In</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
      </ul>
    </nav>
    <main>