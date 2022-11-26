<?php
session_start();
if ($_POST['vihod']=='Выход'){
	$_SESSION['login']='';
	$_SESSION['pass']='';
	$_SESSION['status']='';
}
?>
<html>
    <head>
		<title>Safetycity.ykt</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--
        Укажите свой API-ключ. Тестовый ключ НЕ БУДЕТ работать на других сайтах.
        Получить ключ можно в Кабинете разработчика: https://developer.tech.yandex.ru/keys/
    -->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<4834dfbb-608c-4988-8873-9620081f8547>" type="text/javascript"></script>
    <script src="script.js" type="text/javascript"></script>
    <style type="text/css">
        html, body {
            width: 100%;
            height: 95%;
            margin: 0;
            padding: 0;
            font-family: /*'Inknut Antiqua', serif;;*/
            font-size: 14px;
        }
        #map {
            width: 100%;
            height: 95%;
        }
        .header {
            padding: 5px;
        }
    </style>
	</head>
	<?php
		include 'connect.php';
	?>
	<body>
		<!-- Шапка -->
		<header style='background-color: #005965;'>
			<!-- Лого -->
			<div class='logo'>
				<img  src='img/logo.png' alt='logo_png' class='img_logo'>
			</div>
			<!-- Name -->
			<div class='name'>
				<h1 style='margin-left:20px;'>SafetyCity</h1>
			</div>
			<!--LK-->
			<?	
				$login=$_SESSION['login'];
				$query="SELECT * FROM `user` WHERE `login`='$login' ";
                //отправка запроса
                $result=mysqli_query($conn,$query);
				//вывод из БД
				$row=mysqli_fetch_array($result)
				
				?>
			<div class='LK_img'>
				<img class='ava_img' src='img/<? echo $row[4];?>' alt='ava_img'>
			</div>
			<div class='LK'>
				<form action='LK.php' class=''>
					<label class='lk_name'>Имя пользователя: <? echo $row[1];?></label><br>
					<label class='score'>Баллы: <? echo $row[5];?> баллов</label><br>
					<input type='submit' class='btnLK' name='LK' value='Личный кабинет'>
				</form>
				<form action='index.php' method='post'>
					<input type='submit' class='btnVihod'name='vihod' value='Выход'>
				</form>
				<?
			if ($_SESSION['status']==1){
				?>
				<form action='moder.php'>
					<input type='submit' class='btnModer' name='moder' value='Модерка'>
				</form>
				<?
				}
			elseif ($_SESSION['status']==2)
			{
				?>
				<form action='admin.php'>
					<input type='submit' class='btnAdmin' name='admin' value='Админка'>
				</form>
				<?
				}
				?>
			</div>
			<!--vhod-->
			<div class='vhod'>
				<a href='auto.php' class='btn_vhod' style='font-size:18px; text-decoration: none;'>Войти</a>
			</div>
			
		</header>
		<!-- Меню -->
		<!-- Основная часть -->
		<main>
			<!-- left -->
			<section class='left'>
			
				<div class='info'>
				<?
				if ($_POST['knopka']=='Сохранить'){
					$address=$_POST['address'];
					$organiz=$_POST['organiz'];
					$koment=$_POST['koment'];
					$foto=$_POST['foto'];
					$login=$_SESSION['login'];
					$avatar=$_POST['avatar'];
					$query1="SELECT * FROM `user` WHERE `login`='$login'";
					//отправка запроса
					$result1=mysqli_query($conn,$query1);
					//цикл с выводом данных из БД
					$row1=mysqli_fetch_array($result1);
					$query="INSERT INTO `comments`(`user`, `address`, `comment`, `avatar`, `organization`, `foto`) 
										  VALUES ('$login', '$address', '$koment', '$row1[4]', '$organiz', '$foto') ";
					$result=mysqli_query($conn,$query);
				}
				?>
					<form method='post'>
						<label class='f4'><b style='font-size:20px;'>Адрес:</b></label>
						<br>
						<label class='f4'> <?echo $address;?> </label>
						<br> <br>
						
						<label class='f4'><b style='font-size:20px;'>Организация:</b></label>
						<br>
						<label class='f4'> <?echo $organiz;?> </label>
						<br> <br>
						
						<label class='f4'><b style='font-size:20px;'>Комментарии:</b></label>
						<br>
						<label class='f4'> <?echo $koment;?> </label>
						<br> <br>
						
						<label class='f4'><b style='font-size:20px;'>Фото:</b></label>
						<br>
						<label class='f4'> <?echo $foto;?> </label>
						<br> <br>
						
						<table>
							<tr>
								<td class='f4'>
									<b style='font-size:20px;'>Изображение:</b>
								</td>
							</tr>
							<tr>
								<td>
									<img src='img/<?echo $foto;?>' alt='' class='img_organiz'>
								</td>
							</tr>
						</table>
					</form>	
				</div>
			</section>
			<!-- center -->
			<section class='center' >
				<div id="map"></div>
			</section>
		</main>
		<footer class='indexfooter'>
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