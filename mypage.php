<!--メアドとパスワード照合によるmypageへの移動判定は、login.php内ではなくmypage.php内で行う。-->

<?php
mb_internal_encoding("utf-8");
session_start();

/*初回ログイン時はまだsession通信を行っていないため、メアドとパスワードによる照会を行う。OKなら他のカラムのデータをsessionに格納し、すべて画面に表示*/

if(empty($_SESSION['id'])){

//try catch文。DBに接続できない場合にエラーメッセージ表示
   
try{
$pdo = new PDO("mysql:dbname=yuzawa;host=localhost;","root","mysql")
}catch(PDOException $e){
 die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p><a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
   );
}

//プリペアードステートメントでSQL文の型をつくる。select文でDBと以下のPOSTデータの照合。
 
$stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

$stmt->bindValue(1,$_POST["mail"]);
$stmt->bindValue(2,$_POST["password"]);

$stmt->execute();
$pdo = NULL;

//fetch(php初級　課題2 スライド30),while文でDBからデータ取得をし、sessionへ代入。fetchでDBからデータを取ってきて$rowに代入し、その後sessionに&rowを代入。画像ファイルの変数はここからpictureになる。
    
while($row = $stmt->fetch()){
    $_SESSION['id']= $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}
    
//データ取得ができずに(emptyで判定)sessionがなければ、リダイレクト(エラー画面へ)Lesson4参照する。自動連番のidカラムだけで、データの有無が判定できる。

if(empty($_SESSION['id'])){
    header("Location:login_error.php");
  }
}

setcookie('mail',$_SESSION['mail'],time()+60*60*24*7,'/'); 
setcookie('password',$_SESSION['password'],time()+60*60*24*7,'/');

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>
    
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
          
          <div class= "profile_pic">
            <img src= "<?php echo $_SESSION['picture']; ?>">
          </div>
        
          <div class="basic_info">
              
           <p>氏名: <?php echo $_SESSION['name']; ?></p>
           <p>メール: <?php echo $_SESSION['mail']; ?></p>
           <p>パスワード: <?php echo $_SESSION['password']; ?></p>
              
          </div>
          
          <div class= "comments">
             <?php echo $_SESSION['comments']; ?>
          </div>
          
          <form action= "mypage_hensyu.php" method="post" class="form_center">
          　　<input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
           　　　<div class="hensyubutton">
            　　　　 <input type= "submit" class="submit_button" size="35" value="編集する">
           　　　</div>
          </form>
    </div>
</main>
          
<footer>
© 2018 InterNous.inc.All rights reserved  
</footer>
                 
</body>
</html>





























