<?php
include "database.php";
$page = (int)$_REQUEST['page'];

if ($page <= 0) {
    die();
}
$pageSize = 5;
$sql=$dbh->query("SELECT id FROM review ORDER BY id DESC LIMIT 1");
$maxID=$sql->fetch();
$id = $maxID['id']-$page*$pageSize;
foreach ($dbh->query("SELECT * FROM review WHERE id>$id-1 AND id<=$id+$pageSize ORDER BY id DESC LIMIT $pageSize") as $row): ?>
    <div class="movies__item">
        <ul>
            <li>
                <div><img class="img" src="<?=$row['image']?>"></div>
            </li>
            <li>
                <a href="review/<?=$row['id']?>.php"> <?=$row['film']?> </a>
                <div class="author"><?=$row['author_fk'], ($row['date']) ?></div>
                <div class="link"><a href="<?=$row['id']?>.php">перейти к рецензии>></a></div>
            </li>
        </ul>
    </div>
<?php endforeach;
