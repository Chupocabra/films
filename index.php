<?php
include "database.php";
$page=isset($_GET['page']) ? $_GET['page']: 1;
$limit=5;
 ?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <link href="styles/style.css" rel="stylesheet" type="text/css">
        <link type="image/x-icon" rel="shortcut icon" href="images/video_kamera.png">
        <style>
            li {
                list-style-type: none;
            }
        </style>
        <meta charset="utf-8">
        <title>Обзоры фильмов</title>
    </head>
    <body>
        <div  class="header" id="myHeader">
            <div class="hlogo"><img id="myLogo" src="images/video_kamera.png"></img></div>
                <div class="hmenu">
                    <div><a class="hmenu__box" href="./">Главная</a></div>
                    <div><button class="hmenu__box" id="myBtnR">Регистрация</button></div>
                    <div><button class="hmenu__box" id="myBtnL">Вход</button></div>
                </div>   
        </div>
        <main class="main">
            <div class="main__title">
                <div>Обзоры фильмов</div>
            </div>
            <div class="main__description">
                <div>Это сайт с рецензиями фильмов. Здесь рецензии составляют сами пользователи.</div>
            </div>
            <table class="main__list">               
                    <tr>
                        <td>
                            <div class="movies">
                                    <?php
                                    foreach ($dbh->query("SELECT * FROM review ORDER BY id DESC LIMIT $limit") as $row):
                                        ?>
                                        <div class="movies__item">
                                            <ul class="movies__items">
                                                <li>
                                                    <div><img class="img" src="<?=$row['image']?>"></div>
                                                </li>
                                                <li>
                                                    <a href="/review.php/?id=<?=$row['id']?>"> <?=$row['film']?> </a>
                                                    <div class="author"><?=$row['author_fk'], ($row['date']) ?></div>
                                                    <div class="link"><a href="/review.php/?id=<?=$row['id']?>">перейти к рецензии>></a></div>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </td>
                    </tr>
            </table>
            <div id="show_more_btn" href='show_more.php' class="show_more"  data-next-page="2">
                Показать еще
            </div>
        </main>
        <footer>
            <div>Разработчик сайта Комаричев Александр</div>
            <div>почта для связи: komari4ev@gmail.com</div>
        </footer>
        <div id="myModalL" class="modal">
            <div class="modal-content">
                <button class="close" id="log_close">x</button>
                <form class="modal__login" id="log_window">
                    <fieldset>
                        <legend>АВТОРИЗАЦИЯ</legend>
                        <p><label for="E-mail">почта<input type="email" name="email" required></label></p>
                        <p><label for="Пароль">пароль<input type="password" name="password" required></label></p>
                      </fieldset>
                    <p><input class="modal__button" type="submit" value="Войти"></p>
                    <a id="to_reg" class="linkform">
                        Вы еще не зарегистрировались? Присоединяйтесь
                    </a>
                        
                </form>
            </div>
        </div>
        <div id="myModalR" class="modal">
            <div class="modal-content">
                <button class="close" id="reg_close">x</button>
                <form class="modal__reg" id="reg_window">
                    <fieldset>
                        <legend>РЕГИСТРАЦИЯ</legend>
                        <p><label for="Имя">имя<input placeholder="русские буквы" pattern="[А-Яа-яЁё  -]+" type="text" name="name" required></label></p>
                        <p><label for="E-mail">email<input type="email" name="email" required></label></p>
                        <p><label for="Телефон">телефон<input type="number" id="phone" required></label></p>
                        <p><label for="Пароль">пароль<input placeholder="латинские буквы и цифры" class="password" pattern="(?=.*[a-z])[0-9a-zA-Z]{6,}" id="pwd1" type="password" name="pwd1" required></label></p>
                        <p><label for="Повторите пароль">повторите пароль<input class="password" id="pwd2" type="password" name="pwd2" required></label></p>    
                        <input type="checkbox" class="mycheckbox" id="personal" required>
                        <label for="personal">согласие на обработку персональных данных</label>               
                      </fieldset>
                    <p><input class="modal__button" type="submit" value="Зарегистрироваться"></p>

                    <a id="to_log" class="linkform">
                        Вы уже зарегистрировались? Вход
                    </a>
                </form>
            </div>
        </div>
        <script src="js/script.js"></script>
    </body> 
</html>
