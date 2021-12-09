<?php
include "database.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$method = $_SERVER['REQUEST_METHOD'];

$sql=$dbh->prepare("SELECT * FROM comment INNER JOIN review ON review.id=comment.film_id 
WHERE review.id= :id");
$sql->bindParam(':id', $id);
$sql->execute();

if (true) {
    http_response_code(200);
    echo "Данные отправлены.";
} else {
    http_response_code(400);
    echo "Ошибка. Данные не отправлены.";
};
?>