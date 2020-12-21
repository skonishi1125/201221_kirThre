<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS v4.5 -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/50821e33c6.js" crossorigin="anonymous"></script>  
  <title>kirThre</title>
</head>
<body>
  <div class="container">
    <div class="jumbotron">
      <h2 class="display-3">kirThre</h2>
      <p class="lead">書き込みテストページです。</p>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h4><b>登録確認</b></h4>

        <!-- フォーム
        action="" : action="index.php"と同じ意味  -->
        <form action="" method="post" enctype="multipart/form-data">
          <!-- ユーザー名 -->
          <div class="form-group">
            <label for="username">ユーザー名</label>
          </div>

          <!-- メールアドレス -->
          <div class="form-group">
            <label for="email1">メールアドレス</label>
          </div>

          <!-- パスワード -->
          <div class="form-group">
            <label for="password1">パスワード</label>
            <p>【非表示】</p>
          </div>

          <!-- アイコン画像 -->
          <div class="form-group">

          </div>

          <!-- 送信 -->
          <button type="submit" class="btn btn-primary">記入画面に戻る</button>
          <button type="submit" class="btn btn-primary">登録する</button>
          
        </form>

      </div>

    </div>

  </div>
  
</body>
</html>