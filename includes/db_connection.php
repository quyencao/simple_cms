<?php
  define("DB_HOST", "localhost");
  define("DB_USER", "widget_cms");
  define("DB_PASS", "secretpassword");
  define("DB_NAME", "widget_corp");

  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  // 2. Test if connection occured
  if(mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")");
  }
?>
