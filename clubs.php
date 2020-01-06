<?php
session_start();
if (!(isset($_SESSION['username'])) && !(isset($_SESSION['password'])))	header('location:index.php');
$connection = mysqli_connect('localhost', 'root', '', 'sport2');
echo "this is master";
?>

<!DOCTYPE html>
<html>
<head>
<title>Спортклубы</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="styles/style2.css">

</head>
<body>
	<style>body{background-attachment: fixed; /* Фиксируем фон веб-страницы */}</style>
	<table class="table1">
		<tr>
			<td width="70">
			</td>

			<!--2Я КОЛОНКА - СЕРЕДИНА-->
			<td id="col2" align="center">
				<h4>Состав спортклубов</h4><br>
				<form method="POST">
					Клуб:  
					<select style="width:240px;" name="club" width="300">
						<?php                                                //запоминается выбранное значение выпадающего списка
							$club = array(
							    0 => "",
							    1 => "ДГТУ-лидер",
							    2 => "Таганрог-ЮФУ",
							    3 => "Кубань",
							    4 => "Уникс",
							    5 => "Енисей",
							    6 => "Парма",
							    7 => "Автодор",
							    8 => "БК Локомотив-Кубань",
							    9 => "Сокол",
							    10 => "Буревестник",
							    11 => "БК Луч",
							);
							for ($s=0; $s <= 11; $s++)
								if($_POST["club"] == $s)
									print '<option selected value="'.$s.'">'.$club[$s].'</option>';
								else
									print '<option value="'.$s.'">'.$club[$s].'</option>';
						?>
					</select> 
					<input type="submit" name="submit" value="Найти">
				</form>

				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
						$q=$_POST['club'];
						switch ($q) {
								case 1:
									$q='ДГТУ-лидер';
									break;
								case 2:
									$q='Таганрог-ЮФУ';
									break;
								case 3:
									$q='Кубань';
									break;
								case 4:
									$q='Уникс';
									break;
								case 5:
									$q='Енисей';
									break;
								case 6:
									$q='Парма';
									break;
								case 7:
									$q='Автодор';
									break;
								case 8:
									$q='БК Локомотив-Кубань';
									break;
								case 9:
									$q="Сокол";
									break;
								case 10:
									$q="Буревестник";
									break;
								case 11:
									$q="БК Луч";
									break;
							}
						$query='select athletes.FIO as f, k.name as n
						from clubs join athletes on (clubs.id=athletes.club_id)
						join kind_of_sport as k on(athletes.kos_id=k.id) where clubs.name="'.$q.'"';
						$result=mysqli_query($connection, $query);
						echo "<table width='1000'>";
						echo "<tr>";
						echo "<th>ФИО спортсмена</th>";
						echo "<th>Вид спорта</th>";
						echo "</tr>";

						while ($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>".$row['f']."</td>";
							echo "<td>".$row['n']."</td>";
							echo "</tr>";
						}
						echo "</tr></table>";
					}

					?>




			</td>
			<!--3Я КОЛОНКА - КНОПОЧКА ВЫХОДА И МЕНЮ-->
			<td width="70">
				<a href='logout.php' class='btn btn-primary'>Выйти</a><br><br>
				<h4>
					<a href='athletic_facilities.php'>Спортивные сооружения</a><br><br>
					<a href='sportsmans.php'>Спортсмены</a><br><br>
					<a href='trainers.php'>Тренеры</a><br><br>
					<a href='clubs.php'>Клубы</a><br>
				<h4>
			</td>
		</tr>
	</table>
</body>
</html>