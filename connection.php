<?php 
$connection = mysqli_connect('localhost', 'root', '', 'sport');
if ($connection->connect_error) 
    die('Ошибка: ('.$connection->connect_errno.')'.$connection->connect_error);
mysqli_set_charset($connection,'utf8'); 
?>

