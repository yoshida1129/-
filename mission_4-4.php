﻿<?php
  $dsn = 'mysql:dbname=テック';
  $user = 'yoshida1129';
  $password = 'period.1016';
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

  $sql ='SHOW CREATE TABLE tbtest';//テーブルの型等を確認する
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
?>