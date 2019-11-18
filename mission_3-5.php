<html>
  <head>
    <meta charset="utf-8">
    <title>3-5</title>
  </head>
<body>
  <?php
	$dsn = 'mysql:dbname=テック'; $user = 'yoshida1129'; $password = 'period.1016'; $pdo = new PDO($dsn,$user,$password);
    $filename="mission_3-5.txt";
    if(file_exists($filename)){//ファイルが存在するとき
    }
    else{//ファイルが存在しないとき未宣言などのエラーが表示されないように
      $tmp=fopen($filename,"w");
      fclose($tmp);
      $num1=0;
    }
    $fp=file($filename);

    //投稿フォーム処理
    //データがすべてきちんと入っていた時
    if(!empty($_POST["name"])&&!empty($_POST["comment"])&&!empty($_POST["post"])&&!empty($_POST["p_pass"])){
      $m_num=$_POST["mode"];
      $num1=0;

      if(empty($m_num)){//モードが入力されてない、新規投稿のとき
        foreach ($fp as $value) {
          $x=explode("<>",$value);
          $num1=$x[0];
        }
        //$num1=count($fp);
        $num1=$num1+1;

        $data=$num1."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y/m/d H:i:s")."<>".$_POST["p_pass"]."<>";//データフォーマット

        file_put_contents($filename,$data."\n",FILE_APPEND);//FILE_APPEND:追記
      }
      else{//モードが入力されている、編集投稿のとき
        if(!isset($str)){//$strがセットされていないとき
          $str="";
        }
        foreach ($fp as $value) {//ひとつづつテキストファイルの中身を取り出す
          $x=explode("<>",$value);//配列にする
          if($x[0]==$m_num){//編集番号と番号が一致しているとき
            $str=$str.$x[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y/m/d H:i:s")."<>".$_POST["p_pass"]."<>"."\n";//編集したものに書き換え
          }
          else{//一致していないとき
            $str=$str.$value;//そのまま
          }
        }
          file_put_contents($filename,$str);
      }
    }
    //名前データが入っていないとき
    elseif(!empty($_POST["post"])&&empty($_POST["name"])){
      echo "名前を入力してください<br>";
    }
    //コメントデータが入っていないとき
    elseif(!empty($_POST["post"])&&empty($_POST["comment"])){
      echo "コメントを入力してください<br>";
    }

    //削除フォーム処理
    if(!empty($_POST["d_num"])&&!empty($_POST["delete"])){//番号入力と削除ボタンが押されたとき
      $delete_num=$_POST["d_num"];
      if(!isset($d_str)){
        $d_str="";
      }
      foreach ($fp as $value) {//ファイルにあるデータを配列で１つずつ取り出す
        $x=explode("<>",$value);
        if($x[0] != $delete_num){//削除番号と、番号が一致しないとき
          $d_str=$d_str.$value;
        }
        elseif($x[0]==$delete_num){//削除番号と、番号が一致するとき
          if($x[4]==$_POST["d_pass"]){//パスワードが一致するとき
          }
          else{//しないとき
            $d_str=$d_str.$value;
            echo "パスワードが違います<br>";
          }
        }
      }
      file_put_contents($filename,$d_str);
    }
    elseif(!empty($_POST["delete"])&&empty($_POST["d_num"])){//削除番号の指定がないとき
      echo "削除番号を指定してください<br>";
    }

    //編集フォーム処理
    if(!empty($_POST["e_num"])&&!empty($_POST["edit"])){
      $e_numb=$_POST["e_num"];
      foreach ($fp as $value) {
        $x=explode("<>",$value);
        if($x[0]==$e_numb){
          $p_name=$x[1];
          $p_comment=$x[2];
          $p_mode=$x[0];
        }
      }
    }

  ?>

  <form method="post" action = "mission_3-5.php">
		入力欄:<br>
    <p>名前<br>
	<input type="text" name="name" value="<?php if(!isset($p_name)){ $p_name=""; } else{echo $p_name; } ?>"><br>
    <p>コメント<br>
	<input type="text" name="comment" value="<?php if(!isset($p_comment)){ $p_name=""; } else{echo $p_comment; } ?>"><br>
    <p>パスワード<br>
	<input type="text" name="p_pass"><br>
	<input type="hidden" name="mode" value="<?php if(!isset($p_mode)){ $p_mode="";} else{echo $p_mode; } ?>">
	<input type="submit" name="post" value="送信"><br>

    <p>削除対象番号<br>
	<input type="text" name="d_num"><br>
    <p>パスワード<br>
	<input type="text" name="d_pass"></p><br>
    <p>削除<br>
	<input type="submit" name="delete" value="削除"></p><br>

    <p>編集番号<br>
	<input type="text" name="e_num"><br>
    <p>パスワード<br>
	<input type="text" name="e_pass"></p><br>
    <p>編集<br>
	<input type="submit" name="edit" value="送信"></p><br>
  </form>

  <h3>送信データ</h3>
  <?php
  $filename="mission_3-5.txt";
  $fp=fopen($filename,"r");
  $fp2=file($filename,FILE_IGNORE_NEW_LINES);//FILE_IGNORE_NEW_LINES:改行を無視？？
  foreach ($fp2 as $i) {
    // code...
    if(!empty($i)){
    $str2=explode("<>",$i);
    for($x=0;$x<5;$x++){
      echo $str2[$x]." ";
    }
      echo "<br>";
    }
  }
  ?>
</body>
</html>
