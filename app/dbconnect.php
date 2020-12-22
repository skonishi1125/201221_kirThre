<?php
try {
  $db = new PDO('mysql:dbname=kirThre;host=localhost;charser=utf8', 'root','root');
} catch (PDOException $e) {
  echo 'DB接続エラー:' . $e->getMessage();
}

?>
