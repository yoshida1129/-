<html>
  <head>
	<title>3-4</title>
    <meta charset="utf-8">
  </head>
<body>
    <form method="post" action ="mission_3-4a.php">
		入力欄:<br>
	<p>名前<br>
	<input type="text" name="name" value="<?php echo $e_name;?>"><br>
	<p>コメント<br>
	<input type="text" name="comment" value="<?php echo $e_comment; ?>"><br>
	<input type = "submit" name = "submit" value = "送信"><br>

  </form>



    <form method="post" action ="mission_3-4a.php">
	<p>削除対象番号</p>
	<input type="text" name="d_num" value=""><br>
	<input type="submit" name="delete" value="削除"><br></p>
  </form>

  <form method="get">
    <p>編集番号指定フォーム</p>
    <p>編集番号:<input type="text" name="e_num"><br>
    <p>編集:<input type = "submit" name = "edit" value = "送信"><br>

  </form>







  <?php
	$dsn = 'mysql:dbname=テック'; $user = 'yoshida1129'; $password = 'period.1016'; $pdo = new PDO($dsn,$user,$password);

    if(!isset($_POST["name"])){//投稿フォーム処理


    }
    elseif (!$_POST["name"]){

    }
    else{
      if(!($_POST["mode"])){
        $filename="mission_3-4.txt";
        $fp=fopen($filename,"a");
        $fp2=file($filename);
        $num=count($fp2)+1;
        $str=$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y/m/d H:i:s");

        fwrite($fp,$str."\n");
        fclose($fp);
        $e_name="";
        $e_comment="";
        $e_mode="";
      }
      elseif(!isset($_POST["mode"])){
        $e_name="";
        $e_comment="";
        $e_mode="";
      }
      else{
        $filename="mission_3-4.txt";
        $fp2=file($filename);
        $fp=fopen($filename,"w");

        foreach ($fp2 as $value) {
          // code...
          $str2=explode("<>",$value);
          if($_POST["mode"]==$str2[0]){
            $str2[1]=$_POST["name"];
            $str2[2]=$_POST["comment"];
            $str2[3]=date("Y/m/d H:i:s");
            $str=$str2[0]."<>".$str2[1]."<>".$str2[2]."<>".$str2[3];
            fwrite($fp,$str."\n");
          }
          else{
            $str=$str2[0]."<>".$str2[1]."<>".$str2[2]."<>".$str2[3];
            fwrite($fp,$str."\n");
          }
        }
        fclose($fp);
        $e_name="";
        $e_comment="";
        $e_mode="";
      }
    }

    if(!isset($_POST["d_num"])){//削除処理

    }
    else{
      $filename="mission_3-4.txt";

      $fp2=file($filename);
      $fp=fopen($filename,"w");
      foreach ($fp2 as $x) {
        // code...
        $str2=explode("<>",$x);

        if($_POST["d_num"]!=$str2[0]){
          fwrite($fp,$x);
        }
        else {
        }
      }
    }

    if(isset($_GET["edit"])){//編集処理
      $filename="mission_3-4.txt";

      $fp2=file($filename);
      foreach ($fp2 as $x) {
        // code...
        $str2=explode("<>",$x);

        if($_GET["e_num"]==$str2[0]){
          $e_name=$str2[1];
          $e_comment=$str2[2];
          $e_mode=$str2[0];
        }
      }
    }
    else{
      $e_name="";
      $e_comment="";
      $e_mode="";
    }


  ?>



  <h3>送信データ</h3>
  <?php
  $filename="mission_3-4.txt";
  $fp=fopen($filename,"r");
  $fp2=file($filename);
  foreach ($fp2 as $i) {
    // code...
    $str2=explode("<>",$i);
    for($x=0;$x<4;$x++){
      echo $str2[$x]." ";
    }
      echo "<br>";
  }
  ?>
</body>
</html>