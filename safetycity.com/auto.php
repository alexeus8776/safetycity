<?php
session_start();
?>
<html>
    <head>
		<title>Safetycity.ykt</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<?
		include 'connect.php';
	?>
	<body class='bg'>
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
		<!-- Основная часть -->
		<main>
		<section class='left2'>
		<?
		if ($_POST['auto']=='Войти'){
			$login=$_POST['login'];
			$pass=$_POST['pass'];
				$query="SELECT * FROM `user` WHERE `login` = '$login' AND `pass` = '$pass'";
				$result=mysqli_query($conn, $query);
				$num=mysqli_num_rows($result);
				if ($num==1){
					$_SESSION['login']=$login;
					$_SESSION['pass']=$pass;
						
					//проверка статуса
					$row=mysqli_fetch_array($result); 
					
					$_SESSION['status']=$row['6'];
					echo "<p>Вы успешно вошли!</p><br>";
					echo "<p><a href='index.php' class='a1'>Главное меню</a></p>";
					echo "<p><a href='lk.php' class='a1'>Личный кабинет</a></p>";
					
					//доступ к фдмине
					if ($_SESSION['status']==1){
						echo "<p><a href='moder.php' class='a1'>Пройдите в панель модератора</a></p>";
					}
					elseif ($_SESSION['status']==2){
						echo "<p><a href='admin.php' class='a1'>Пройдите в панель администратора</a></p>";
					}
				}
					else{
						echo "<p>Данные не верны!</p>";
						echo "<p><a href='auto.php' class='a1'>Попробуйте еще раз</a></p>";
					}
				}
				else{
			
		?>
				<table>
					<form action = 'auto.php' method='post'>
					<h2 style='color:white; font-size:35px;'>Вход</h2>
						<tr style='color:#333; font-size:20px;'>
							<td>Имя пользователя: </td>
							<td><input type = 'text' name = 'login' class='' placeholder='Имя пользователя'></td>
						</tr>
						<tr style='color:#333; font-size:20px;'>
							<td>Пароль: </td>
							<td><input type = 'password' name = 'pass' class='' placeholder='Пароль'></td>
						</tr>
						<tr>
							<td>
								<a href='index.php'>Забыли пароль?</a>
							</td>
						<tr>
							<td colspan = '2' align='center'>
								<input type = 'submit' class='f3' name='auto' value='Войти'>
							</td>
						</tr>
					</form>
				</table>
				<?
		}
		?>
			</section>
			<section class='right2'>
			<?
				//проверка нажатия кнопки
				if ($_POST['reg'] == 'Зарегистрироваться'){
					//получение значения переменных
					$login=$_POST['login'];
					$pass1=$_POST['pass1'];
					$pass2=$_POST['pass2'];
					$tel=$_POST['tel'];

					if ($pass1 != $pass2){
						echo "<p>Пароль не верен!</p>";
						echo "<p><a href='auto.php' class='a1'>Попробовать снова</a></p>";
					}
					else{
						$pass=$pass1;
					
						//запрос на поиск пользователя
						$query = "SELECT * FROM `user` WHERE `login`='$login'";
						//отправка запроса
						$result = mysqli_query($conn, $query);
						//цикл с выводом данных из бд
						$num = mysqli_num_rows($result);
						if ($num>0){ 
							echo "<p>Пользователь с таким именем уже зарегистрирован<p>";
							echo "<p><a href='auto.php' class='a1'>Попробовать снова</a></p>";
						}
						else{
							$pass=$pass1;
							//запрос на добавление пользователя
							$query = "INSERT INTO `user` (`login`, `pass`, `tel`, `avatar`, `score`, `status`) 
												VALUES('$login', '$pass', '$tel', 'noavatar.png', '0', '0')";
							$result = mysqli_query($conn, $query);
							echo "<p>Пользователь успешно зарегистрирован</p><br>";
							echo "<p><a href='index.php' class='a1'>Вернуться</a></p>";
							}
						}
					}
				else
				{
				?>
				<table>
					<form action = 'auto.php' method='post'>
					<h2 style='color:white; font-size:35px;'>Регистрация</h2>
						<tr style='color:#333; font-size:20px;'>
							<td>Имя пользователя: </td>
							<td><input type = 'text' name = 'login' class='' placeholder='Имя пользователя'></td>
						</tr>
						<tr style='color:#333; font-size:20px;'>
							<td>Номер телефона: </td>
							<td><input type = 'text' name = 'tel' class='' placeholder='Номер телефона' maxlength='11' minlength='11'></td>
						</tr>
						<tr style='color:#333; font-size:20px;'>
							<td>Пароль: </td>
							<td><input type = 'text' name = 'pass1' class='' placeholder='Пароль'></td>
						</tr>
						<tr style='color:#333; font-size:20px;'>
							<td >Повторный пароль: </td>
							<td><input type = 'password' name = 'pass2' class='' placeholder='Повтор пароля'></td>
						</tr>
						<tr>
							<td colspan = '2' ' align='center'>
								<input type = 'submit' class='f3' name = 'reg' value='Зарегистрироваться'>
							</td>
						</tr>
					</form>
				</table>
				<?
				}
				?>
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