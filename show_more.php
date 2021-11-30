<?php
include "database.php";
$page = (int)$_REQUEST['page'];

if ($page <= 0) {
    die();
}
$pageSize = ($page-1)*5;
foreach ($dbh->query("SELECT * FROM review ORDER BY id DESC LIMIT $pageSize OFFSET $pageSize") as $row):
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
<?php endforeach;
