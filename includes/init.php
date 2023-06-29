<?php 
spl_autoload_register(function($class){
  require dirname(__DIR__) . "/classes/{$class}.php";
});
session_start();
require dirname(__DIR__) . '/config.php';

function errorHandler($error, $message, $file, $line) {
  throw new ErrorException($message, 0, $file, $line);
}

function exceptionHandler($exception){
  http_response_code(500);
  if (SHOW_ERROR_DETAIL) {
    echo '<h1>An error ocurred</h1>';
    echo '<p>Uncaught exception: ' . get_class($exception) . '</p>';
    echo '<p>Message: '. $exception->getMessage(). '</p>';
    echo '<p>Stack: <pre>'. $exception->getTraceAsString() . '</pre></p>';
    echo '<p>File: '. $exception->getFile() . 'on line ' . $exception->getLine() . '</p>';
  } else {
    echo '<h1>An error ocurred</h1>';
    echo '<p>Try again later</p>';
  }
  exit();
}

set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');

