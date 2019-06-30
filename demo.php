	
	<?php
	
		require 'config.php';
		
		// определение мобильного устройства
		function check_mobile_device() { 
			$mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
			$agent = strtolower($_SERVER['HTTP_USER_AGENT']);    
			// var_dump($agent);exit;
			foreach ($mobile_agent_array as $value) {    
				if (strpos($agent, $value) !== false) return true;   
			}       
			return false; 
		}

		// вывод переменной типа устройства
		$is_mobile_device = check_mobile_device();
		if($is_mobile_device){
			$size_code = 'mic'; 		// если устройство мобильное выводим код размера miс 
			echo '<script>document.getElementById("monitor").style.width = 900+"px";</script>';
			$device = 'mobil';
		}else{
			$size_code = 'min'; 		// если устройство стационарное выводим код размера min  
			echo '<script>document.getElementById("monitor").style.width = 1000+"px";</script>';
			$device = 'desktop';
		}
		
		
		$all_image = scandir('gallery');     // задаем массив исходников
		array_shift($all_image);
		array_shift($all_image);
		
		if (isset($_REQUEST['current_page'])) { $current_page = $_REQUEST['current_page'];}   // номер текущей страницы
		
		echo '	<script>
					document.getElementById("display_all_image").value = '.count($all_image).';
					document.getElementById("display_current_page").value = '.$current_page.';
					document.getElementById("display_all_page").value = '.(intdiv(count($all_image), 10)+1).';
				</script>';
		
		if ($current_page == 1) {
				$start_page = 1;
				$end_page = $start_page+9;
			}
		if ($current_page > 1 && $current_page < intdiv(count($all_image), 10)+1 ) {
				$start_page = ($current_page-1)*10 + 1;
				$end_page = $start_page+9;
			}
		if ($current_page == intdiv(count($all_image), 10)+1 ) {
				$start_page = ($current_page-1)*10 + 1;
				$end_page = count($all_image)-1;
			}
			

		// Соединяемся с базой
		$mysql_db = new mysqli($servername, $username, $password, $dbname);
		// Проверяем соединение на ошибку
		if ($mysql_db->connect_error) {
				die("Connection failed: " . $mysql_db->connect_error);
			}
			
		$query = "SELECT * FROM image_size";
		$msql = mysqli_query($mysql_db, $query);

		$counter_size_code = array(); 	// массив кода размера
		$counter_width = array();		// массив ширины копий
		$counter_height = array();		// массив высоты копий
		

		for ($i=0; $i < mysqli_num_rows($msql); $i++)
			{
				$row = mysqli_fetch_array($msql, MYSQLI_BOTH);
				$counter_size_code[$i] = $row['size_code'];     // значения массива кода размера
				$counter_width[$i] = $row['width'];				// значения массива ширины копий
				$counter_height[$i] = $row['height'];			// значения массива высоты копий
			}
			
		for	($j=$start_page; $j<=$end_page; $j++)
			{
				$filename = $all_image[$j];

				$extension = substr($filename, -4);   			// определяем расширение файла

				// определяем размеры
				list($width, $height) = getimagesize($gallery.$filename);
				?>
				<script>
					function load_swow_all_size_<?echo $j?>()
						{
							$("#monitor").load("show_all_size.php", "filename=<?echo $filename;?>&device=<?echo $device;?>");
							document.getElementById("to_next").style.display = "none";
							document.getElementById("to_back").style.display = "none";
						}
				</script>
				<img onclick = "load_swow_all_size_<?echo $j?>()" src = "<?require 'generator.php';?>" >
				
				<?
			}		
		mysqli_close($mysql_db);
		
		echo 	'
					<script>
						document.getElementById("waiting").style.display = "none";
						document.getElementById("load_all").style.display = "block";
					</script>
				';
		
	?>
			