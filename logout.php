<?php
session_start();	//инициализируем механизм сессий
session_destroy();	//удаляем текущую сессию
Header("Location: ../index.php");
?>
