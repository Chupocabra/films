<?php
include "database.php";
session_start();
$_POST = json_decode(file_get_contents("php://input"), true);
//получение из БД пользователя, проверка пароля
$sth = $dbh->prepare("SELECT * FROM user WHERE email = :email");
$sth->bindParam(':email' , $_POST['email']);
$sth->execute();
$user=$sth->fetch();
$errors = [];
//если все ок - сохраняем в сессию данные пользователя
if (password_verify($_POST['password'], $user['pwd'])) {
    $_SESSION['userId'] = $user['id'];
    echo json_encode(['success' => true]);
//...
}
else{
    $errors[]='Пароль введен неверно';
    echo json_encode(['errors' => $errors]);
    die();
}
?>
