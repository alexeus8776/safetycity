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
			<section class='center_moder'>
			<?
			if($_SESSION['login']!=''){
				?>
				<!--Аватар из ЛК-->
				<!-- Категории товаров -->
                <?
				$login=$_SESSION['login'];
				$login1=$_POST['login'];
				$pass=$_POST['pass'];
				$fio=$_POST['fio'];
				$telephone=$_POST['telephone'];
				
				if ($_POST['img'] == 'Сохранить'){
					//применяем переменные 
					$avatar=$_POST['avatar'];
					$query = "UPDATE `user` SET `avatar` ='$avatar' WHERE `login` = '$login' ";
					//отправка запроса
					$result = mysqli_query($conn,$query);
				}
				if ($_POST['save'] == 'Сохранить'){
					$login1=$_POST['login'];
					//запрос на редактирвоание date
					$query1 = "UPDATE `user` SET `login`='$login1' WHERE `login` = '$login'";
					//отправка запроса
					$result1 = mysqli_query($conn,$query1);
				}	
				if ($_POST['save'] == 'Сохранить'){
					$pass=$_POST['pass'];
					$query = "UPDATE `user` SET `pass` ='$pass' WHERE `login` = '$login' ";
					$result = mysqli_query($conn,$query);
				}
				if ($_POST['save'] == 'Сохранить'){
					$fio=$_POST['fio'];
					$query = "UPDATE `user` SET `fio` ='$fio' WHERE `login` = '$login' ";
					$result = mysqli_query($conn,$query);
				}
				if ($_POST['save'] == 'Сохранить'){
					$tel=$_POST['telephone'];
					$query = "UPDATE `user` SET `tel` ='$telephone' WHERE `login` = '$login' ";
					$result = mysqli_query($conn,$query);
				}
                //запрос на отображение
                $query="SELECT * FROM `user` WHERE `login`='$login' ";
                //отправка запроса
                $result=mysqli_query($conn,$query);
				//вывод из БД
				$row=mysqli_fetch_array($result);
			}
				?>
				<section class='block_avatar'>
					<img src='img/<? echo $row[4]; ?>' alt='avatar' class='avatar_img'>
					<form action='moder.php' method='post' class='avatar_form'>
						<input type='file' name='avatar'>
						<input type='submit' name='img' value='Сохранить'>
					</form>
				</section> 
				<!--Форма для данных и ЛК-->
				<section class='block_lk'>
					<div class='labellk'>
						<label>Вы вошли как:</label>
					</div><br>
					<div class='labellk'>
						<label><b><i><? echo $row[1];?></b></i></label>
					</div><hr><br>
					<div class='labellk'>
						<label>Статус:</label>
					</div><br>
					<div class='labellk'>
						<label>
							<? if($_SESSION['status']==1){
								echo "Модератор";
							}
						?></label>
					</div><hr><br>
					<div class='labellk'>
						<label>Баллы:</label>
					</div><br>
					<div class='labellk'>
						<label>
							<?
							  $query="SELECT * FROM `user` WHERE `login`='$login' ";
							  //отправка запроса
							  $result=mysqli_query($conn,$query);
							  //вывод из БД
							  $row=mysqli_fetch_array($result);
							  echo $row[5];
							?>
						</label>
					</div><hr><br>
				</section>
				<?
				if($_SESSION['login']!=''){
					$login=$_SESSION['login'];
					if ($_POST['com_del']=='Удалить'){
						//получение переменных
						$id=$_POST['id'];
						?>
						<form action='moder.php' method='post'>
							<input type='hidden' name='id' value='<? echo $id; ?>'>
							<input type='submit' name='com_del2' value='Удалить комментарий'>
						</form>
						<form action='moder.php' method='post'>
							<input type='submit' value='Нет'>
						</form>
						<?
					}
					if ($_POST['com_del2']=='Удалить комментарий'){
						//получение переменных
						$id=$_POST['id'];
						$query="DELETE FROM `comments` WHERE `id`='$id'";
						$result=mysqli_query($conn, $query);
						echo "<h3>Комментарий удален!</h3>";
						echo "<h3><a href='moder.php' class='a1'>Обновить страницу</a></h3>";
					}
					?>
					<?
						if ($_POST['com_red']=='Изменить'){
							//получение переменных
							$id=$_POST['id'];
							//запрос на отображение категорий
							$query="SELECT * FROM `comments` WHERE `id`='$id'";
							//отправка запроса
							$result=mysqli_query($conn,$query);
							//цикл с выводом данных из БД
							$row=mysqli_fetch_array($result);
						?>

						<form action="moder.php" method="post">
							<input type="hidden" name="id" value="<? echo $row[0]; ?>">
							<p>Комментарий</p>
							<input type="text" name="comment" value="<? echo $row[2]; ?>">
							<input type="submit" name="com_red2" value="Изменить комментарий">
						</form>
						<?
						}
						//проверка нажатия кнопки
						if ($_POST['com_red2']=='Изменить комментарий'){
							//получение переменных
							$id=$_POST['id'];
							$comment=$_POST['comment'];
							//запрос на отображение категорий
							$query="UPDATE `comments` SET `comment`='$comment' WHERE `id`='$id' ";
							//отправка запроса
							$result=mysqli_query($conn,$query);

							echo "<h3>Комментарий изменен!</h3><br>";
							echo "<h3><a href='moder.php' class='a1' >Обновить страницу</a></h3>";
					}
				}
						?>

				<div style='background: lightgrey; width:50%;  padding-bottom:30px; margin-top:10%; float:right; margin-top:30px;'>
				<h3 style='margin-left:2%; font-size:20px;'>Все комментарии</h3>
				<table style='margin-top:20px; margin-left:2%; width:96% ;background:#fff; font-size:20px;' cellspacing='0'>
				<?

						$query="SELECT * FROM `comments`";
						//отправка запроса
						$result=mysqli_query($conn,$query);
						//цикл с выводом данных из БД
						while($row=mysqli_fetch_array($result)){
							?>
							<tr>
								<td class='th1'><img src='img/<? echo $row[4];?>' alt='tovar' class = 'avatar_mini'></td>
								<td><? echo $row[1]; ?></td>
								<td class='th1'><img src='img/<? echo $row[6];?>' alt='tovar' class = 'avatar_mini'></td>
								<td><? echo $row[2]; ?></td>
								<td><? echo $row[3]; ?></td>
								<td class='th2'>
									<form action='moder.php' method='post'>
										<input type='hidden' name='id' value='<? echo $row[0]; ?>'>
										<input type='submit'  class='d10'name='com_red' value='Изменить'>
									</form>
								</td>
								<td class='th2'>
									<form action='moder.php' method='post'>
										<input type='hidden' name='id' value='<? echo $row[0]; ?>'>
										<input type='submit' class='d10' name='com_del' value='Удалить'>
									</form>
								</td>
							</tr>
							<?
						}
					?>
				</table>
				<br>
				<span style='margin-left:2%; font-size:25px; margin-top:70px;'>С отмеченными
					<input type='submit' style='background:none; border:none; width:50px; height:50px; font-size:43px;' class='a4' name='search' value=&#9998;>
					<input type='submit' style='background:none; border:none; width:60px; height:50px; font-size:40px;' class='a4' name='search' value=&#10060;>
				</span>
				</div>

		</main>
		<footer class='footer_moder'>
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
