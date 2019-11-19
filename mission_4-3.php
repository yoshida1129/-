<?php 
  $dsn = 'mysql:dbname=テック';
  $user = 'yoshida1129';
  $password = 'period.1016';
 $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

  $sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";
?>
