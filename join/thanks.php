<?php
session_start();
require('../app/functions.php');

// if (!isset($_SESSION['join'])) {
//   header('Location: http://localhost:8888/201221_kirThre/join/check.php');
//   exit();
// }

include('../app/_parts/_header.php');

?>

<!-- HTML部分
------------------------------>

<p>登録が完了しました。201222現在、P257まで進めています。</p>
<p>ログインは<a href="../login.php">こちら</a>からどうぞ！</p>
<a href="index.php">join/index.phpへ</a>

<?php
include('../app/_parts/_footer.php');