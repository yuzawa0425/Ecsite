<!--mypage.phpと構造はほぼ同じ。記入欄はregister.phpを参照する。echo SESSIONでmypage.phpからデータを受け取る。また、actionでmypage_update.phpへのリンク。POSTで-->

<?php
mb_internal_encoding("utf8");

session_start();

/*mypage.php以外からの通信を行うとエラーページへ飛ぶ*/

if(empty($_POST['from_mypage'])){
    header("Location:login_error.php");
}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
    </head>
    
<!--マイページ表示部分　編集ができるように、sessionはvalueに入れる。-->
<body>
    
  <header>
    <img src="4eachblog_logo.jpg">
    <div class="logout"><a href="log_out.php">ログアウト</a></div>
  </header>
          
<main>
    
    <div class= "box">
        
        <h1>会員情報</h1>
         <div class="hello">
          <?php echo "こんにちは!  ".$_SESSION['name']."さん"; ?>
         </div>
        
<!--img src使ってsession呼びだし-->
    <form action= "mypage_update.php" method= "post">
          
          <div class= "profile_pic">
        　   <img src= "<?php echo $_SESSION['picture']; ?>">
          </div>
        
          <div class="basic_info">
              
          <!--編集後の各内容をnameに代入し、POSTでmypage_update.phpに送る-->
              
          <p>氏名: 
              <input type="text" class="formbox" size="40"  value="<?php echo $_SESSION['name']; ?>" name="name" required>
          </p>
              
          <p>メール:
              <input type="text" class="formbox" size="40"  value="<?php echo $_SESSION['mail']; ?>" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
          </p>
              
          <p>パスワード:
              <input type="password" class="formbox" size="40" value="<?php echo $_SESSION['password']; ?>" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" required>
           </p>

          </div>
          
          <div class= "comments">
              <textarea row="40" cols="90" value="<?php echo $_SESSION['comments']; ?>" name="comments"></textarea>
          </div>
         
           <div class="hensyubutton">
             <input type= "submit" class= "submit_button" size="50" value= "この内容に変更する">
           </div>
    </form>
    
    </div>
          
</main>
    
<footer>
© 2018 InterNous.inc.All rights reserved  
</footer>
    
</body>
    
</html>
    
    
    
    
    
    