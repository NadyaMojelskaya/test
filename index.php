<!DOCTYPE html>
<html>
<head>
<title>Спорт</title>
<meta charset="utf-8">
<link rel="stylesheet" href="styles/style1.css">
</head>
<header>
</header>
<body>
	<?php
	
$connection = mysqli_connect('localhost', 'root', '', 'sport2');
	if (isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password'])){
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$query = "INSERT INTO users (id, name, email, password) VALUES (null, '$username', '$email', '$password')";
		$result= mysqli_query($connection, $query);
		if($result){
			$smsg='Регистрация прошла успешно';
		}
		else $fmsg='Ошибка регистрации';
	}
	?>
<div class="container">
	<table class="table">
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<form class="form-signing" method="POST">
					<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div> <?php } ?>
					<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div> <?php } ?>
					<input type="text" name="username" class="form-control" placeholder="Введите имя" required>

					<input type="text" name="email" class="form-control" placeholder="Введите e-mail" required>

					<input type="password" name="password" class="form-control"  placeholder="Введите пароль">
<br><br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"> Зарегистрироваться</button>
					<a href="login.php" class="btn btn-lg btn-primary btn-block">Авторизоваться</a>
				</form>
			</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
</div>   
</body>
</html>
