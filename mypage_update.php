<!--mypage_hensyu.phpからPOST受け取る。 ほぼ回答を参照した。-->

<?php
mb_internal_encoding("utf8");

session_start();

try{
$pdo = new PDO("mysql:dbname=yuzawa;host=localhost;","root","mysql");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p><a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
   );
}

//プリペアードステートメントupdate文　「where id」でデータ指定しないと全ての行が更新される？

$stmt = $pdo->prepare("update login_mypage set name=?,mail=?,password=?,comments=? where id=?;");

//この各POSTには変更後の内容が格納されている。idはsessionであることに注意。既にmypage.php内で、sessionにidが格納されている。(DBから受け取っている)

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

$stmt->execute();

//cf. mypage.php
$stmt = $pdo->prepare("select * from login_mypage where mail=? && password=?");

$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);

$stmt->execute();
$pdo = NULL;

//更新した内容をsessionに代入する。リダイレクトでmypageに移動した際に、更新情報を反映させるためか？　ただし以下のwhile文はmypage.php内にも記述されている。
while($row = $stmt->fetch()) {
    $_SESSION['id'] = $row['id']; 
    $_SESSION['name'] = $row['name']; 
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments']; 
}

 header('Location:mypage.php');

?>



























