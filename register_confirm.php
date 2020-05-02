<?php
mb_internal_encoding("utf8");

/*仮保存されたファイル名で画像ファイルを取得(サーバーへ仮アップロードされたディレクトリとファイル名)
アップロードした画像はimgフォルダに保存される前に、php.iniのデフォルト設定によってprivate/var/tmpに仮保存される*/

$temp_pic_name = $_FILES['picture']['tmp_name'];

//元のファイル名で画像ファイルを取得。事前に画像を格納する「image」フォルダを作成しておく

$original_pic_name = $_FILES['picture']['name'];

//imageフォルダと元の画像ファイル名を結び付けて変数に代入する。

$path_filename = './image/'.$original_pic_name;

//仮保存のファイル名を、imageフォルダに元のファイル名で移動する

move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
    <title>マイページ登録</title>
    <link rel ="stylesheet" type="text/css" href="register_confirm.css">
    </head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
    </header>
        
<main>
    
<!--mail_confirm参照-->
    
<div class ="confirm">
    <h1>会員登録 確認</h1>
    
       <div class= "confirm_contents">
        
        <p class= "a"> こちらの内容で登録しても宜しいでしょうか？</p>
        
        <p>氏名：
            <?php echo $_POST['name']; ?>
        </p>
        
        <p>メール：
            <?php echo $_POST['mail']; ?>
        </p>
            
        <p>パスワード：
            <?php echo $_POST['password']; ?>
        </p>
        
<!-- $_POST['picture']ではなく、original_pic_name
original_pic_nameなので、まだimageフォルダに格納されていない。つまり確認画面表示の段階では、画像はimageフォルダに移動していない。-->
           
        <p>プロフィール写真：
            <?php echo $original_pic_name; ?>
        </p>
        
        <p>コメント：
            <?php echo $_POST['comments']; ?>
        </p>  
           
    
        <form action= "register.php" method= "post">
            
                <input type= "submit" class= "button1" value= "戻って修正する"　/>
            
        </form>

<!--register.phpから送られてきたPOST(name,mailなど)を再度箱に格納し、register_insertへ引き渡す。登録押した瞬間に画像はimageフォルダに格納か？-->
        
        <form action= "register_insert.php" method= "post">
              <input type= "submit" class= "button2" value= "登録する" />
        
            <input type= "hidden" value= "<?php echo $_POST['name'];?>"name= "name">
            <input type= "hidden" value= "<?php echo $_POST['mail'];?>"name= "mail">
            <input type= "hidden" value= "<?php echo $_POST['password'];?>"name= "password">
            <input type= "hidden" value= "<?php echo $path_filename;?>"name= "path_filename">
            <input type= "hidden" value= "<?php echo $_POST['comments'];?>"name= "comments">
        </form>
        
</div>
</div>
  
</main>
<footer>
© 2018 InterNous.inc.All rights reserved
</footer>
    
</body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
           
