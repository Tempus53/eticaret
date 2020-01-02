<?php 
session_start();
include "header.php";
include "dbInfo.php";
if (isset($_POST["input"])) {
    $input = $_POST["input"];
    $search_query = "select *,(select name from platform where games.p_code=p_code)as platform,
    (select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate from games where name like '%$input%';";
    $search_result = $conn->query($search_query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/0366f96474.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <link href="style.css" rel="stylesheet">
</head>

<body>

</body>
<html>
<div id="AllPage" class="bg-dark">
    <div class="Content">
        <div class="myGamesTitle">
            Arama Sonuçları
        </div>
        <div class="row justify-content-center">
            <?php
            while ($games = mysqli_fetch_array($search_result)) {
                echo '<form method="post" action="gamePage.php">
                    <input type="hidden" name="gameCode" value=' . $games["gameCode"] . '>
                    <button type="submit" class="cardsAllButton">
                    <div class="cardsAll">
                        <img class="cardsImg" src="img/' . $games["name"] . '.jpg" alt="">
                        <div class="cardsBody">
                            <div class="gamesTitleText">' . $games["name"] . '</div>
                            <div class="gamesPlatformText">' . $games["platform"] . '</div>
                            <div class="gamesPrizeText">
                               '; 
                               if ($games["discount"] == 0) {
                                echo '₺' . $games["price"];
                            } else {
                                echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $games["price"] . '</span>';
                                echo ' ₺'.discount($games["price"], $games["discount"]);
                            }
                            if ($games["rate"] != null && $games["howRate"] != 0) {
                                for ($j = intval($games["rate"] / $games["howRate"]); $j < 5; $j++) {
                                    echo '<span class="fa fa-star f-Right"></span>';
                                }
                                for ($k = 0; $k < intval($games["rate"] / $games["howRate"]); $k++) {
                                    echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                }
                            } else {
                                echo '<span class="fa fa-star f-Right"></span>
                                            <span class="fa fa-star f-Right"></span>
                                            <span class="fa fa-star f-Right"></span>
                                            <span class="fa fa-star f-Right"></span>
                                            <span class="fa fa-star f-Right"></span>';
                            }
                               echo'
                            </div>
                        </div>
                    </div>
                </button></form>';
            }
            ?>
        </div>
    </div>
</div>

</html>