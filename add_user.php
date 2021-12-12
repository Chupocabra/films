<?php
include "./database.php";
$_POST = json_decode(file_get_contents("php://input"), true);
header('Content-Type: application/json');//сообщаем браузеру, что ответ будет в формате JSON
$errors = [];
$sql2 = $dbh->prepare("SELECT 'email' FROM `user` WHERE `email`= :email");
$sql2->bindParam(':email', $_POST['email']);
$sql2->execute();
$count = $sql2->rowCount();
//логика проверки полей
if ($_POST['name'] == '')
{
    $errors[] = 'Не заполнено поле Имя';
}
if ($count>0)
{
    $errors[] = 'Пользователь с таким email уже существует';
}
if ($_POST['email'] == '')
{
    $errors[] = 'Не заполнено поле E-mail';
}
if ($_POST['phone'] == '')
{
    $errors[] = 'Не заполнено поле телефон';
}
if ($_POST['pwd1'] == '' || $_POST['pwd1']!=$_POST['pwd2'])
{
    $errors[] = 'Ошибка в пароле';
}
if ($_POST['agreement'] != 'on')
{
    $errors[] = 'Вы не дали согласие';
}

if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    die();
}
$name=htmlspecialchars($_POST['name'], ENT_QUOTES);
$phone=htmlspecialchars($_POST['phone'], ENT_QUOTES);
$email=htmlspecialchars($_POST['email'], ENT_QUOTES);
$pwd=htmlspecialchars($_POST['pwd1'], ENT_QUOTES);
$pwd=password_hash($pwd, PASSWORD_DEFAULT);
if(empty($errors)){
    $sql = $dbh->prepare("INSERT INTO `user`(`username`, `phone`, `email`, `pwd`) 
        VALUES (:name, :phone, :email, :pwd)");
    $sql->bindParam(':name', $name);
    $sql->bindParam(':phone', $phone);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':pwd', $pwd);
    $sql->execute();

    $sth = $dbh->prepare("SELECT id FROM `user` WHERE `email` = :email");
    $sth->bindParam(':email' , $email);
    $sth->execute();
    $array = $sth->fetch(PDO::FETCH_ASSOC);
    //$_SESSION["visit_count"] = $array;
    echo json_encode(['success' => true]);
}


?>