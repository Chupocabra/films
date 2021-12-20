<?php
use Symfony\Component;
session_start();
if (empty($_SESSION['userId'])) {
    header('Location: index.php');
}
include_once 'MyValidator.php';
include "database.php";

#header('Content-Type: application/json');
$errors = [];
$title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
if (!empty($_POST['rew'])) {
    $rew = filter_var($_POST['rew'], FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $rew = 'Нет текста обзора.';
}
$grade = filter_var($_POST['grade'], FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($_FILES['poster'])) {
    $file = $_FILES['poster'];
} else {
    $errors [] = 'Файл не загружен!';
    $_SESSION['formErrors'] = $errors;
    header('Location: add.php');
    die();
}

$input = array();
$input['title'] = $title;
$input['rew'] = $rew;
$input['poster'] = $_FILES['poster']['tmp_name'];


$validator = new MyValidator();
$errors += $validator->validate($input);
if (!empty($errors)) {
    $_SESSION['formErrors'] = $errors;
    header('Location: add.php');
    die();
}

$pathInfo = pathinfo($_FILES['poster']['name']);
$ext = $pathInfo['extension'] ?? "";

$sql2 = $dbh->prepare("SELECT id FROM review ORDER BY id DESC LIMIT 1");
$sql2->execute();
$newid = $sql2->fetch();
$newid = $newid['id'] + 1;
$newPath = '/pictures' . "/" . $newid . "." . $ext;

###
if (move_uploaded_file($_FILES['poster']['tmp_name'], $newPath)) {
    echo('ok');
    $sql = "INSERT INTO review(id, film, image, date, text, grade, author)
        VALUES (:id, :title, :poster, current_timestamp, :rew, :grade, :author)";
    $result = $dbh->prepare($sql);
    $result->bindParam(':id', $newid);
    $result->bindParam(':title', $title);
    $result->bindParam(':poster', $newPath);
    $result->bindParam(':rew', $rew);
    $result->bindParam(':grade', $grade);
    $result->bindParam(':author', $_SESSION['userId']);
    $result->execute();
    $row = ($result->fetch(PDO::FETCH_ASSOC));
    header('Location: review.php?id=' . $row['id']);
} else {
    $errors[] = "Ошибка файла";
    $_SESSION['formErrors'] = $errors;
    //header('Location: add.php');
    die();
}
