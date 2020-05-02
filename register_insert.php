<!--prepare内で各カラムの型を設定し、5つのbindValueを使って、受け渡されたデータをそれぞれの型に入れていく。-->

<?php
mb_internal_encoding("utf8");

$pdo = new PDO("mysql:dbname=yuzawa;host=localhost:8080;","root","mysql");

$stmt = $pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)value(?,?,?,?,?)");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['path_filename']);
$stmt->bindValue(5,$_POST['comments']);

$stmt->execute();
$pdo = NULL;

header('Location:after_register.html');
?>