<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<?php
		include 'connect.php';
	?>
	<body>
		<!-- Шапка -->
		<header style='background-color: #005965;'>
			<!-- Лого -->
			<div class='logo'style=' margin-left:40%;'>
				<a href='index.php'><img  src='img/logo.png' alt='logo_png' class='img_logo'></a>
			</div>
			<!-- Name -->
			<div class='name'>
				<h1 class='name_header' style='margin-left:20px; font-size:45px; margin-top:50px;'>SafetyCity<br> <p style='font-size:25px; margin:0;'>интерактивная карта</p></h1>
			</div>
			<!--vhod-->
			
		</header>
		<!-- Меню -->
		<!-- Основная часть -->
		<main>
			<!-- center -->
			<?
			
			if($_SESSION['login']!=''){
				$login=$_SESSION['login'];
				//запрос на отображение
                $query="SELECT * FROM `user` WHERE `login`='$login' ";
                //отправка запроса
                $result=mysqli_query($conn,$query);
				//вывод из БД
				$row=mysqli_fetch_array($result);
			}
			?>
			<section class='center_a' style='display:block;'>
				<section class='block_avatar' align='center'>
					<img src='img/<? echo $row[4]; ?>' alt='avatar' class='avatar_img'>
					<form action='LK.php' method='post' class='avatar_form'>
						<input type='submit' style='margin-top:20px; background:#6ED2D2; border:5px solid #fff; border-radius:15px; padding:10px 20px 10px 20px; font-size:20px;' name='img' value='Изменить профиль'>
					</form>
				</section>
				<section class='block_lk'>
					<div class='labellk'>
						<label>Вы вошли как:</label>
					</div><br>
					<div class='labellk'>
						<label><b><i><? echo $row[1];?></b></i></label>
					</div><hr><br>
					<div class='labellk'>
						<label>Статус: Админ</label>
					</div><hr><br>
				</section>
				<section>
				<div class='search'>
				<form action='' method='post'>
					<input type='text' style='background:#fff; margin-left:5%; width:87.5%; height:30px;' class='a4' name='search_text' placeholder='Найти пользователя...'>
					<input type='submit' style='background:#fff; width:auto; height:30px;' class='a4' name='search' value=&#128270;>
				</form>
				
			<div style='background: lightgrey; width:90%; margin-left:5%; padding-bottom:30px;'>
				<table style='margin-top:50px; margin-left:2%; height:50%; width:96% ;background:#fff; font-size:20px;' cellspacing='0'>
				<input type='hidden' >
					<tr style='background: lightgrey; height:60px;'>
						<td></td>
						<td style='width:150px;'>Все пользователи</td>
						<td style='margin-left:-50px;'></td>
						<td align='center' style='width:200px;'>Статус</td>
						<td align='center'>Количество комментариев</td>
						<td align='center'>Баллы</td>
					</tr>
					<?
					if($_SESSION['login']!=''){
						$login=$_SESSION['login'];
						//запрос на отображение категорий
						$query="SELECT * FROM `user` WHERE 1";
						//отправка запроса
						$result=mysqli_query($conn,$query);
						//цикл с выводом данных из БД
						while($row=mysqli_fetch_array($result)){
							?>
							<tr>
								<td align='center' style='width:50px;'>
									<input type="checkbox" name="interest" style='width:20px; height:20px;'>
								</td>
								<td style='width:100px; float:right; margin-right:20px;'><img src='img/<? echo $row[4];?>' alt='ava' class = 'avatar_mini'></td>
								<td><? echo $row[1]; ?></td>
								<td><? if ($row[5]=='0'){echo 'Пользователь';} elseif ($row[5]=='1'){echo 'Модератор';} else {echo 'Админ';}  ?> <select name='status'>
						<option value="0">Пользователь</option>
						<option value="1">Модератор</option>
						</select>
						<input type="submit" name="user_red2" value="Изменить данные">
						</td>
								<td align='center'><? echo $row[6]; ?></td>
								<td align='center'><? echo $row[7]; ?></td>
							</tr>
							<?
						}
					}
				?>
				</table>
				<br>
				<span style='margin-left:2%; font-size:25px; margin-top:70px;'>С отмеченными
					<input type='submit' style='background:none; border:none; width:50px; height:50px; font-size:43px;' class='a4' name='search' value=&#9998;>
					<input type='submit' style='background:none; border:none; width:60px; height:50px; font-size:40px;' class='a4' name='search' value=&#10060;>
				</span>
				</div>
				</section>
			</section>
		</main>
		<footer>
			<!-- Пользовательское соглашение -->
			<div class='footer_cont' style='margin-left:100px;'>
				<a href='index.php' style='color:white; font-size:20px; text-decoration: none;' class=''>Copyright &copy; 2020 safetycity.com<br> Все права защищены.</a>
			</div>
			<div class='footer_cont'  style='margin-left:80px;'>
				<a href='index.php' style=' color:white; font-size:20px; text-decoration: none;' class=''> Пользовательское<br> соглашение </a>
			</div>
			<!-- О проекте -->
			<div class='footer_cont' style='margin-left:100px;'>
				<a href='index.php' style='color:white; font-size:20px; text-decoration: none;' class=''>О создательях</a>
			</div>
			<!-- Команда -->
			<!-- WhatsApp -->
			<div class='footer_cont' style='margin-left:140px;'>
				<img src='img/2.png' style='height:50px; width:50px;' alt='whatsapp_img'> <br> <a style='color:white; font-size:20px;'>WhatsApp</a>
			</div>
			<!-- VK -->
			<div class='footer_cont' style='margin-left:140px;'>
				<img src='img/3.png' style='height:50px; width:50px;' alt='VK_img'> <br> <a style='color:white; font-size:20px;'>ВКонтакте</a>
			</div>
			<!-- Inst -->
			<div class='footer_cont' style='margin-left:120px;'>
				<img src='img/4.png' action='auto.php' style='height:50px; width:50px;' alt='inst_img'> <br> <a style='color:white; font-size:20px;'>Инстаграм</a>
			</div>
		</footer>
	</body>
</html>