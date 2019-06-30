<?php

if (isset($_REQUEST['filename'])) { $filename = $_REQUEST['filename'];}   // имя файла
if (isset($_REQUEST['device'])) { $device = $_REQUEST['device'];}   // тип устройства


require 'config.php';

// Соединяемся с базой
$mysql_db = new mysqli($servername, $username, $password, $dbname);
// Проверяем соединение на ошибку
if ($mysql_db->connect_error) {
		die("Connection failed: " . $mysql_db->connect_error);
	}
	
$query = "SELECT * FROM image_size";
$msql = mysqli_query($mysql_db, $query);

for ($i=0; $i < mysqli_num_rows($msql); $i++)
	{
		$row = mysqli_fetch_array($msql, MYSQLI_BOTH);
		if ($device == 'desktop' && $row['size_code'] != 'mic')  // если устройство стационарное не выводим mic
			{
				?>
				<img src = "<?echo $cache.$row['size_code'].'_'.$filename;?>" ><br><br>
				<?
			}
		if ($device == 'mobil' && $row['size_code'] != 'big')  // если устройство стационарное не выводим mic
			{
				?>
				<img src = "<?echo $cache.$row['size_code'].'_'.$filename;?>" ><br><br>
				<?
			}
	}
	
?>

<input type = "button" value = "X" onclick = "reload_page()" class = "basic_button" style = "position: fixed; right: 20px; top: 20px; z-index: 5;">

