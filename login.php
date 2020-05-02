<!--ログイン状態を判別するためにissetとidカラム使用。(sessionが存在している　=　すでにログインしている。)id以外のカラムでもOK。
ログイン状態でログインページへ移動すると、マイページへリダイレクトする。--> 

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
  <link rel="stylesheet" type="text/css" href="login.css">
 </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>
 
<!--　一度ログインしている場合、cookieから入力情報を表示させる-->
<main>
  <form action="mypage.php" method="post">
    
      <div class="form_contents">
          
      <!--input...name="XXX"のXXXは変数名(箱の名前)-->
      
      <div class="mail">
          
        <label>メールアドレス</label><br>
        <input type="text" class="formbox" size="40" value="<?php echo $_COOKIE['mail'];?>" name="mail">
      
      </div>
          
     <div class="password">
        <label>パスワード</label><br>
        <input type="password" class="formbox" size="40" value="<?php echo $_COOKIE['password'];?>"name="password">
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    