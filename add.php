<?php 
include "database.php";
session_start();
if (empty($_SESSION['userId'])) {
    header('Location: index.php');
}

$sql3=$dbh->prepare("SELECT * FROM user WHERE user.id= :id");
$sql3->bindParam(':id', $_SESSION['userId']);
$sql3->execute();
$user=$sql3->fetch();
$_SESSION['username']=$user['username'];
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <link href="styles/style.css" rel="stylesheet" type="text/css">
        <link href="styles/add_rew.css" rel="stylesheet" type="text/css">
        <link type="image/x-icon" rel="shortcut icon" href="images/video_kamera.png">
        <meta charset="utf-8">
        <title>Обзоры фильмов</title>
    </head>
    <body>
        <div  class="header" id="myHeader">
            <div class="hlogo"><img id="myLogo" src="images/video_kamera.png"></img></div>
                <div class="hmenu">
                    <div><a class="hmenu__box" href="./">Главная</a></div>
                    <div class="hmenu__box">
                            <?php
                            if(isset($_SESSION['userId'])){
                                echo("Привет, $user[username]");
                            }
                            else echo('<button  class="hmenu__box"  id="myBtnR">Регистрация</button>');
                            ?>
                        </div>
                    <div>
                            <?php
                            if(isset($_SESSION['userId'])){
                                echo('<a class="hmenu__box" href="logout.php"  target="_top">Выход</a>');
                            }
                            else echo('<button class="hmenu__box" id="myBtnL">Вход</button>');
                            ?>
                        </div>
                </div>   
        </div>
        <main class="main">
        <div class="main__title">
                <div>Добавить обзор</div>
        </div>
        <div class="rform">
            <form class="rform" name="add_rew" action="add_todb.php" 
            method="post" enctype="multipart/form-data">
                <label>Название фильма:<input placeholder="Фильм" name="title" 
                type="text" required
                style="margin: auto;"></label>
                <label>Постер<input title="Постер" placeholder="Постер" 
                type="file" name="poster" required
                style="margin: auto;"></label>
                <label>Текст обзора:<input placeholder="Обзор" name="rew" 
                type="text" required
                style="margin: auto;"></label>
                <label>Оценка автора
                    <input type="radio" id="g_bad" name="grade" value="0">
                    <label for="g_bad">Плохо</label><br>
                    <input type="radio" id="g_good" name="grade" value="1">
                    <label for="g_good">Хорошо</label><br>     
                </label>                 
                <input type="submit" name="submit" value='Отправить обзор'>
            </form>
        </div> 
    </body> 
</html>