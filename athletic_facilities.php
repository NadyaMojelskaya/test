<?php
session_start();
if (!(isset($_SESSION['username'])) && !(isset($_SESSION['password'])))	header('location:index.php');
$connection = mysqli_connect('localhost', 'root', '', 'sport2');
?>

<!DOCTYPE html>
<html>
<head>
<title>Спортивные сооружения</title>
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
				<h4>Спортивные сооружения</h4><br>
				<form method="POST">
					<table>
						<tr>
							<td>
								<h5>Манежи</h5>
								<select style="width:90px;" title="Площадь" name="arena">
									<?php                                                //запоминается выбранное значение выпадающего списка
										$square = array(
										    0 => "",
										    1 => "400",
										    2 => "500",
										    3 => "600",
										    4 => "650",
										    5 => "750",
										    6 => "800",
										);
										for ($s=0; $s <= 6; $s++)
											if($_POST["arena"] == $s)
												print '<option selected value="'.$s.'">'.$square[$s].'</option>';
											else
												print '<option value="'.$s.'">'.$square[$s].'</option>';
									?>
								</select>
							</td>
							<td>
								<h5>Корты</h5>
								<select style="width:120px;" title="Тип покрытия" name="court">
									<?php                                                //запоминается выбранное значение выпадающего списка
										$coating = array(
										    0 => "",
										    1 => "Хард",
										    2 => "Бетонное",
										    3 => "Резиновое",
										    4 => "Ковровое",
										    5 => "Травяное",
										    6 => "Грунтовое",
										    7 => "Асфальтное",
										);
										for ($s=0; $s < 8; $s++)
											if($_POST["court"] == $s)
												print '<option selected value="'.$s.'">'.$coating[$s].'</option>';
											else
												print '<option value="'.$s.'">'.$coating[$s].'</option>';
									?>
								</select>
							</td>
							<td>
								<h5>Спортзалы</h5>
								<select style="width:120px;" title="Количество тренажёров" name="jym">
									<?php                                                //запоминается выбранное значение выпадающего списка
										$quantity = array(
										    0 => "",
										    1 => "до 30",
										    2 => "больше 30",
										    3 => "больше 50",
										    4 => "больше 70",
										    5 => "больше 100",
										);
										for ($s=0; $s < 8; $s++)
											if($_POST["jym"] == $s)
												print '<option selected value="'.$s.'">'.$quantity[$s].'</option>';
											else
												print '<option value="'.$s.'">'.$quantity[$s].'</option>';
									?>
								</select>
							</td>
							<td>
								<h5>Стадионы</h5>
								<select style="width:150px;" title="Вместимость зрителей" name="stadium">
									<?php                                                //запоминается выбранное значение выпадающего списка
										$capacity = array(
										    0 => "",
										    1 => "до 1000",
										    2 => "больше 1000",
										    3 => "больше 10000",
										    4 => "больше 15000",
										    5 => "больше 30000",
										);
										for ($s=0; $s < 8; $s++)
											if($_POST["stadium"] == $s)
												print '<option selected value="'.$s.'">'.$capacity[$s].'</option>';
											else
												print '<option value="'.$s.'">'.$capacity[$s].'</option>';
									?>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" name="submit" value="Найти">
				</form>
				
				<?php 
					
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){             //если форма не заполнена, выводим все таблицы
						$query='SELECT name, square, address FROM arena';
						$result=mysqli_query($connection, $query);
						//ARENA!!!!!!!!!!!!
						echo "<table width='1000'>";
						echo "<tr>";
						echo "<th>Манеж</th>";
						echo "<th>Площадь</th>";
						echo "<th>Адрес</th>";
						echo "</tr>";

						while ($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['square']."</td>";
							echo "<td>".$row['address']."</td>";
							echo "</tr>";
						}
						echo "</tr></table>";

						//COURT!!!!!!!!!!!!
						$query='SELECT name, address, coating FROM court';
						$result=mysqli_query($connection, $query);

						echo "<table width='1000'>";
						echo "<tr>";
						echo "<th>Корт</th>";
						echo "<th>Покрытие</th>";
						echo "<th>Адрес</th>";
						echo "</tr>";

						while ($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['coating']."</td>";
							echo "<td>".$row['address']."</td>";
							echo "</tr>";
						}
						echo "</tr></table>";

						//JYM!!!!!!!!!!!!
						$query='SELECT name, quantity_of_trainers, address FROM jym';
						$result=mysqli_query($connection, $query);
						echo "<table width='1000'>";
						echo "<tr>";
						echo "<th>Спортзал</th>";
						echo "<th>Количество тренажёров</th>";
						echo "<th>Адрес</th>";
						echo "</tr>";

						while ($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['quantity_of_trainers']."</td>";
							echo "<td>".$row['address']."</td>";
							echo "</tr>";
						}
						echo "</tr></table>";

						//STADIUM!!!!!!!!!!!!
						$query='SELECT name, address, capacity FROM stadium';
						$result=mysqli_query($connection, $query);

						echo "<table width='1000'>";
						echo "<tr>";
						echo "<th>Стадион</th>";
						echo "<th>Вместимость зрителей</th>";
						echo "<th>Адрес</th>";
						echo "</tr>";

						while ($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['capacity']."</td>";
							echo "<td>".$row['address']."</td>";
							echo "</tr>";
						}
						echo "</tr></table>";
					}
					else {                                               //иначе выводим таблицы согласно сортировке
						//ARENA!!!!!!!!!!!!
						if ($_POST['arena']!=""){
							$sq=$_POST['arena'];
							$sq=$square[$sq];
							if($sq!=""){
								$query='SELECT name, square, address FROM arena WHERE square='.$sq;
								$result=mysqli_query($connection, $query);
								echo "<table width='1000'>";
								echo "<tr>";
								echo "<th>Манеж</th>";
								echo "<th>Площадь</th>";
								echo "<th>Адрес</th>";
								echo "</tr>";

								while ($row = mysqli_fetch_array($result)){
									echo "<tr>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['square']."</td>";
									echo "<td>".$row['address']."</td>";
									echo "</tr>";
								}
								echo "</tr></table>";
							}
						}
						//COURT!!!!!!!!!!!!
						if ($_POST['court']!=""){
							$ct=$_POST['court'];
							$ct=$coating[$ct];
							if($ct!=""){
								$query='SELECT name, coating, address FROM court WHERE coating="'.$ct.'"';
								//$result=mysqli_query($connection, $query);
								$result = $connection->query($query);
								
								echo "<table width='1000'>";
								echo "<tr>";
								echo "<th>Корт</th>";
								echo "<th>Покрытие</th>";
								echo "<th>Адрес</th>";
								echo "</tr>";

								while ($row = mysqli_fetch_array($result)){
									echo "<tr>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['coating']."</td>";
									echo "<td>".$row['address']."</td>";
									echo "</tr>";
								}
								echo "</tr></table>";
							}
						}

						//JYM!!!!!!!!!!!!
						if ($_POST['jym']!=""){
							$q=$_POST['jym'];
							if ($q!=0){
								switch ($q) {
								    case 1:
								        $q='< 30';
								        break;
								    case 2:
								        $q='> 30';
								        break;
								    case 3:
								        $q='> 50';
								        break;
								    case 4:
								        $q='> 70';
								        break;
								    case 5:
								    $q='> 100';
								    break;
								}
								$query='SELECT name, quantity_of_trainers, address FROM jym WHERE quantity_of_trainers'.$q;
								$result=mysqli_query($connection, $query);
								echo "<table width='1000'>";
								echo "<tr>";
								echo "<th>Спортзал</th>";
								echo "<th>Количество тренажёров</th>";
								echo "<th>Адрес</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)){
									echo "<tr>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['quantity_of_trainers']."</td>";
									echo "<td>".$row['address']."</td>";
									echo "</tr>";
								}
								echo "</tr></table>";
							}
						}
						
						//STADIUM!!!!!!!!!!!!
						if ($_POST['stadium']!=""){
							$q=$_POST['stadium'];
							if($q!=0){
								switch ($q) {
								    case 1:
								        $q='<= 1000';
								        break;
								    case 2:
								        $q='> 1000';
								        break;
								    case 3:
								        $q='> 10000';
								        break;
								    case 4:
								        $q='> 15000';
								        break;
								    case 5:
								    $q='> 30000';
								    break;
								}
								$query='SELECT name, address, capacity FROM stadium WHERE capacity'.$q;
								$result=mysqli_query($connection, $query);

								echo "<table width='1000'>";
								echo "<tr>";
								echo "<th>Стадион</th>";
								echo "<th>Вместимость зрителей</th>";
								echo "<th>Адрес</th>";
								echo "</tr>";

								while ($row = mysqli_fetch_array($result)){
									echo "<tr>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['capacity']."</td>";
									echo "<td>".$row['address']."</td>";
									echo "</tr>";
								}
								echo "</tr></table>";
							}
						}
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