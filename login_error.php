<!--mypage.phpへPOST通信する
login.phpと構造はほぼ同じ-->

<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="login_error.css">
    </head>
    
<!--メアドとパスワードを入力欄に表示する-->
    <body>
         <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>
        
<!--　一度ログインした後、cookieから入力情報を表示させる-->
<main>
  <form action="mypage.php" method="post">
      
<!--エラー文を出す。エラー判定はmypage.php内でやる-->
    <div class="error_form">
        
    <div class= "error_message">メールアドレスまたはパスワードが間違っています
    </div>

    <div class="mail">
          
<!--input...name="XXX"のXXXは変数名(箱の名前)-->
        
        <label>メールアドレス</label><br>
        <input type="text" class="formbox" size="40" value="<?php echo $_COOKIE['mail']; ?>"name="mail">
        
    </div>
          
     <div class="password">
        <label>パスワード</label><br>
        <input type="password" class="formbox" size="40" value="<?php echo $_COOKIE['password']; ?>"name="password">
    </div>
          
    <div class="login_button">
      <input type="submit" class="submit_button" size="35" value="ログイン">      
    </div>
        
    </div>
          
  </form>
</main>
        
<footer>
  © 2018 InterNous.inc.All rights reserved        
</footer>
    
</body>
</html>