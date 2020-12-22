<?php
session_start();
require('../app/functions.php');

// postが空でない場合の処理
if (!empty($_POST)) {
  // エラー確認
  if ($_POST['name'] == '' ) {
    $error['name'] = 'blank';
  }

  if ($_POST['email'] == '' ) {
    $error['email'] = 'blank';
  }

  if (strlen($_POST['password']) < 4 ) {
    $error['password'] = 'length';
  }

  if ($_POST['password'] == '' ) {
    $error['password'] = 'blank';
  }

  $fileName = $_FILES['image']['name'];
  if (!empty($fileName)) {
    $ext = substr($fileName, -3);
    if ($ext != 'jpg' && $ext != 'png') {
      $error['image'] = 'type';
    }
  }

  // postされて、エラーがなかった場合の処理
  if (empty($error)) {
    // 画像アップロード
    $image = date('YmdHis') . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
  
    $_SESSION['join'] = $_POST;
    $_SESSION['join']['image'] = $image;
    $_SESSION['join']['isSetFile'] = $_FILES['image']['name'];

    // !empty($_POST)の外に書いてしまうと、無記入の場合はerrorが空のためずっと飛び続けてしまう
    header('Location: http://localhost:8888/201221_kirThre/join/check.php');
    exit();
  
  }

}

// 書き直しの処理
if ($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['join'];
  $back['rewrite'] = true;
} else {
  $back['rewrite'] = false;
}


// // error配列状態の確認
// foreach($error as $key => $e) {
//   echo $key . "の状態:" . $e . "です。...\n";
// }

// // fileの確認
// echo "|アップロードされたファイル：" . $_FILES['image']['name'];

// ヘッダー読み込み
include('../app/_parts/_header.php');
?>



    <div class="row">
      <div class="col-md-12">

        <!-- エラーログ  -->
        <?php if (!empty($error)) : ?>
        <div class="alert alert-danger" role="alert">
          <h5 class="alert-heading">エラーがありました。</h5>
          <!-- 名前エラー -->
          <?php if ($error['name'] == 'blank') : ?>
            <p>・ユーザーネームを入力してください。</p>
          <?php endif; ?>
          <!-- メールエラー -->
          <?php if ($error['email'] == 'blank') : ?>
            <p>・メールアドレスを入力してください。</p>
          <?php endif; ?>
          <!-- パスワード(４文字以下)エラー -->
          <?php if ($error['password'] == 'length') : ?>
            <p>・パスワードは4文字以上としてください。</p>
          <?php endif; ?>
          <!-- パスワード未記入エラー -->
          <?php if ($error['password'] == 'blank') : ?>
            <p>・パスワードを入力してください。</p>
          <?php endif; ?>
          <!-- 拡張子エラー -->
          <?php if ($error['image'] == 'type') : ?>
            <p>
              ・拡張子「<?php echo $ext; ?>」のファイルが指定されています。<br>
              　本サービスのアイコン画像は、「.jpg」「.png」ファイルのみの対応となります。
              </p>
          <?php endif; ?>
          <small>※画像ファイルを指定されていた場合はお手数ですが再度ご指定ください。</small>
        </div>
        <?php endif; ?>
      
        <?php if ($back['rewrite'] == true && empty($error) ) : ?>
        <div class="alert alert-primary" role="alert">
          <small>※画像ファイルを指定されていた場合はお手数ですが再度ご指定ください。</small>
        </div>
        <?php endif; ?>


        <!-- フォーム
        action="" : action="index.php"と同じ意味  -->
        <form action="" method="post" enctype="multipart/form-data">
          <!-- ユーザー名 -->
          <div class="form-group">
            <label for="name"><b>ユーザー名</b></label>
            <input name="name" type="text" class="form-control" id="name" placeholder="テストくん" value="<?php echo h($_POST['name']);?>">
          </div>

          <!-- メールアドレス -->
          <div class="form-group">
            <label for="email"><b>メールアドレス</b></label>
            <input name="email" type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="sample@gmail.com" value="<?php echo h($_POST['email']); ?>">
            <small id="emailHelp" class="form-text text-muted">ログイン情報としてのみ利用します。</small>
          </div>

          <!-- パスワード -->
          <div class="form-group">
            <label for="password"><b>パスワード</b></label>
            <input name="password" type="password" class="form-control" id="password1" aria-describedby="passHelp" placeholder="****" 
            value="<?php h($_POST['password']); ?>">
            <small id="passHelp" class="form-text text-muted">4文字以上としてください。</small>
          </div>

          <!-- アイコン画像 -->
          <div class="form-group">
            <span class="badge badge-primary">任意</span>
            <label for="image"><b>アイコン画像を選択</b></label>
            <input name="image" type="file" class="form-control-file" id="image" aria-describedby="imageHelp">
            <small id="imageHelp" class="form-text text-muted">
              後から再設定が可能です。<br>
              未記入の場合、デフォルト画像が設定されます。<br>
              画像の拡張子は「.jpg」「.png」が設定可能です。
            </small>
          </div>

          <!-- 送信 -->
            <button type="submit" class="btn btn-primary">送信</button>

          <div class="form-group">
            <small id="subHelp" class="form-text text-muted">
              ※すでに登録済みの方は、<a href="../index.php">こちら</a>からログインしてください。
            </small>
          </div>
          
        </form>

      </div>

    </div>

  </div>

<?php
include('../app/_parts/_footer.php');
  
