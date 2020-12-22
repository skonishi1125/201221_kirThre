<?php
session_start();
require('../app/dbconnect.php');
require('../app/functions.php');

// URLを入力して飛んできた場合
if (!isset($_SESSION['join'])) {
  header('Location: http://localhost:8888/201221_kirThre/join/check.php');
  exit();
}

// 登録ボタンを押した時の処理
if (!empty($_POST)) {
  //画像指定
  if (!empty($_SESSION['join']['isSetFile'])) {
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, session_id=?, created=NOW()');
    echo $ret = $statement->execute(array(
      $_SESSION['join']['name'],
      $_SESSION['join']['email'],
      sha1($_SESSION['join']['password']),
      $_SESSION['join']['image'],
      'sessionID'
    ));

    unset($_SESSION['join']);
    header('Location: http://localhost:8888/201221_kirThre/join/thanks.php');
    exit();

  } else {
    // 画像未指定
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, session_id=?, created=NOW()');
    echo $ret = $statement->execute(array(
      $_SESSION['join']['name'],
      $_SESSION['join']['email'],
      sha1($_SESSION['join']['password']),
      'default.jpg',
      'sessionID',
    ));
    unset($_SESSION['join']);
  
    header('Location: http://localhost:8888/201221_kirThre/join/thanks.php');
    exit();


  }

  

}

include('../app/_parts/_header.php');

?>

<!-- HTML部分
------------------------------>
<div class="row">
  <div class="col-md-12">
    <h4><b>登録確認</b></h4>

    <!-- フォーム -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- ユーザー名 -->
      <div class="form-group">
        <label for="name">ユーザー名</label>
        <p><?= h($_SESSION['join']['name']); ?></p>
      </div>

      <!-- メールアドレス -->
      <div class="form-group">
        <label for="email">メールアドレス</label>
        <p><?= h($_SESSION['join']['email']); ?></p>

      </div>

      <!-- パスワード -->
      <div class="form-group">
        <label for="password">パスワード</label>
        <p><?= h($_SESSION['join']['password']); ?></p>
        <p>【非表示】</p>
      </div>

      <!-- アイコン画像 -->
      <div class="form-group">
        <label for="image">アイコン画像</label>
        <img class="img-thumbnail iconImg" src="../member_picture/<?= h($_SESSION['join']['image']); ?>" alt="icon">
        <p><?= $_SESSION['join']['image'];?></p>
      </div>

      <!-- 送信 -->
      <!-- name="文字列"がないと動作しない? -->
      <!-- name
      入力コントロールの名前を指定する文字列です。
      この名前はフォームデータが送信される時に、コントロールの値と共に送信されます。

      name に入れるもの
      name は (厳密にはそうではありませんが) 必須の属性と考えてください。
      入力欄に name が指定されていなかった場合や name が空欄だった場合、
      その入力欄の値はフォームと一緒に送信されません。 
      (無効なコントロール、チェックされていないラジオボタン、
      チェックされていないチェックボックス、リセットボタンも送信されません。) 
      フォームを送信する際に必要な処理っぽい
      -->

      <a href="index.php?action=rewrite">戻る</a>
      <button type="submit" class="btn btn-primary" name="act">登録する</button>
      <!-- 
      <button type="submit" class="btn btn-primary">登録する</button> だとだめ
      <input type="hidden" name="action" value="submit"> とか、
      name=""を持つinputを別のところに入れても動作する
      -->
      
    </form>

  </div>

</div>

<?php
include('../app/_parts/_footer.php');