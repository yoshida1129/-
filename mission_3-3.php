<html>
 <head>
  <title>3-3</title>
  <meta charset="utf-8">
 </head>
     
<body>
     <form action="mission_3-3.php" method="post">
	     入力欄:<br>
     <p>名前<br>
     <input type = "text" value = "名" name = "name"><br>
     <p>comment<br>
     <input type = "text" value = "コメント" name = "comment"><br>
     <input type = "submit" name = "submit" value = "送信"><br>

     <form action = "mission_3-3.php" method = "post">
     <p>削除対象番号</p>     
     <input type="text" name="delete" value=""><br>
     <input type="submit" value="削除">
     </form>

	<?php
	$filename = "mission_3-3.txt";


	$dsn = 'mysql:dbname=テック'; $user = 'yoshida1129'; $password = 'period.1016'; $pdo = new PDO($dsn,$user,$password);

//投稿機能
	
	if(!empty($_POST["name"]) && !empty($_POST["comment"] && empty($_POST["number"]))){
		$name = $_POST["name"];
		$comment = $_POST["comment"];
		$date = date("Y/m/d/G:i");
		$line_comment = file($filename);
		$key_comment = end($line_comment);
		$key_comment_element = explode("<>" , $key_comment);
		$i = ((int)$key_comment_element[0] + 1);
		$number = $i."<>".$name."<>".$comment."<>".$date;
		$fp = fopen($filename , "a");
		fwrite($fp , $number."\n");
		fclose($fp);
	};

	//削除機能
		if(!empty($_POST["delete"])){
	$texts_delete = file($filename);
		foreach($texts_delete as $key_delete => $value_delete){
			$texts_delete_element = explode("<>" , $value_delete);
			if ($texts_delete_element[0] == $_POST["delete"]){
				unset($texts_delete[$key_delete]);
			}
		}
	file_put_contents("mission_3-3.txt" , $texts_delete);
	}

$filename="mission_3-3.txt";
$lines=file($filename);
	$line = file($filename);
	foreach($line as $value){
	$element = explode("<>" , $value);
	$element_number = count($element);
	echo "<br>".$element[0];
	echo $element[1];
	echo $element[2];
	echo $element[3];
	}

?>
</body>
</html>
