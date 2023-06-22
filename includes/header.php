<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
</head>

<body>
  <header>
    <h1>Blog</h1>
  </header>
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <?php if (Auth::isLoggedIn()) : ?>
        <li><a href="/admin/">Admin</a></li>
        <li><a href="/logout.php">Log Out</a></li>
      <?php else : ?>
        <li><a href="/login.php">Log In</a></p></li> 
      <?php endif; ?>
    </ul>
  </nav>
  <main>