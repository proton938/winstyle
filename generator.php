<?php

if (!file_exists($cache.$size_code.'_'.$filename)) // проверяем существование файла
	{
		for ($i=0; $i < count($counter_size_code); $i++)
			{		  
				 // загрузка
				$thumb = imagecreatetruecolor($counter_width[$i], $counter_height[$i]);
				
				if ($extension == '.jpg')
					{
						$source = imagecreatefromjpeg($gallery.$filename);
					
						// замена размеров
						imagecopyresized($thumb, $source, 0, 0, 0, 0, $counter_width[$i], $counter_height[$i], $width, $height);    

						// вывод в файл
						imagejpeg($thumb, $cache.$counter_size_code[$i].'_'.$filename);
					}
					
				if ($extension == '.png')  
					{
						imageAlphaBlending($thumb, false);  // если это png необходимо учесть наличие альфаканала
						imageSaveAlpha($thumb, true);
						
						$source = imageCreateFromPng($gallery.$filename);
						
						// замена размеров
						imagecopyresized($thumb, $source, 0, 0, 0, 0, $counter_width[$i], $counter_height[$i], $width, $height);

						// вывод в файл
						imagepng($thumb, $cache.$counter_size_code[$i].'_'.$filename);
					}
			}
	}

echo $cache.$size_code.'_'.$filename;





