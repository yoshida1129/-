<!DOCTYPE html>
<html>
   <head>

      <meta charset = "utf-8">
      <title>3-2</title>

   </head>
   <body>

     <form action = "mission_3-2.php" method = "post">

     入力欄:<br>
     <p>名前<br>
     <input type = "text" value = "名前" name = "name"><br>
     <p>comment<br>
     <input type = "text" value = "コメント" name = "comment"><br>
     <input type = "submit" name = "submit" value = "送信">
     </form>

  <?php
	$dsn = 'mysql:dbname=テック'; $user = 'yoshida1129'; $password = 'period.1016'; $pdo = new PDO($dsn,$user,$password);

     if(!empty($_POST["comment"]));
     $filename = "mission_3-2.txt";

     if(!empty($_POST["name"])){
     $fp = fopen("$filename" , "a");   
     $comment = $_POST["comment"];
     $name = $_POST["name"];
     $date = date("Y年m月d日 H:m:s");
     $number = (count(file($filename))+1);
     $toukou = $number."<>".$name."<>".$comment."<>".$date;
     fwrite($fp,$toukou."\n");
     fclose($fp);};
	$line = file($filename);
	foreach($line as $value){
	$element = explode("<>",$value);
	echo"<br>".$element[0];
	echo $element[1];
	echo $element[2];
	echo $element[3];
}
  ?>
   </body>
<html>
