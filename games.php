<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "dbInfo.php";
$pc_query = 'select gameCode,name,(select name from platform where p_code=games.p_code) as platform,price,about,discount,
(select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate from games 
where p_code="ORG" or p_code="STM" or p_code = "UPLY" or p_code ="EPICG" or p_code="BNET" or p_code="PC";';
$ps_query = 'select gameCode,name,(select name from platform where p_code=games.p_code) as platform,price,about,discount,
(select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate from games 
where p_code="PS3" or p_code="PS4" ';
$xbox_query = 'select gameCode,name,(select name from platform where p_code=games.p_code) as platform,price,about,discount,
(select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate from games 
where p_code="XB360" or p_code="XBONE"';
$pc_result = $conn->query($pc_query);
$ps_result = $conn->query($ps_query);
$xbox_result = $conn->query($xbox_query);

?>

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
    <div id="gamesPageContent">
        <div id="gamesContent">
            <div id="gamesFilterBar">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-light bg-mygreen" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">PC</a>
                    </li>
                    <li class="nav-item bg-succes">
                        <a class="nav-link text-light bg-mygreen" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">PlayStation</a>
                    </li>
                    <li class="nav-item bg-succes">
                        <a class="nav-link text-light bg-mygreen" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Xbox</a>
                    </li>
            </div>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row justify-content-center">
                        <?php
                        while ($pc_games = mysqli_fetch_array($pc_result)) {
                            echo
                                '<form method="post" action="gamePage.php">
                                <input type="hidden" name="gameCode" value=' . $pc_games["gameCode"] . '>
                                <button type="submit" class="cardsAllButton">
                                    <div class="cardsAll">
                                        <img class="cardsImg" src="img/' . $pc_games["name"] . '.jpg" alt="">
                                        <div class="cardsBody">
                                            <div class="gamesTitleText">' . $pc_games["name"] . '</div>
                                            <div class="gamesPlatformText">' . $pc_games["platform"] . '</div>
                                            <div class="gamesPrizeText">';
                                            if ($pc_games["discount"] == 0) {
                                                echo '₺' . $pc_games["price"];
                                            } else {
                                                echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $pc_games["price"] . '</span>';
                                                echo ' ₺'.discount($pc_games["price"], $pc_games["discount"]);
                                            }
                                            if($pc_games["rate"] != null && $pc_games["howRate"] != 0){
                                                for ($i = intval($pc_games["rate"] / $pc_games["howRate"]); $i < 5; $i++){
                                                    echo '<span class="fa fa-star f-Right"></span>';
                                                }
                                                for ($i = 0; $i < intval($pc_games["rate"] / $pc_games["howRate"]); $i++){
                                                    echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                                }
                                            }
                                            else{
                                                echo '<span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>';
                                            }
                                        echo '</div>
                                        </div>
                                    </div>
                                </button>
                            </form>';
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row justify-content-center">
                        <?php
                        while ($ps_games = mysqli_fetch_array($ps_result)) {
                            echo
                                '<form method="post" action="gamePage.php">
                                <input type="hidden" name="gameCode" value=' . $ps_games["gameCode"] . '>
                                <button type="submit" class="cardsAllButton">
                                    <div class="cardsAll">
                                        <img class="cardsImg" src="img/' . $ps_games["name"] . '.jpg" alt="">
                                        <div class="cardsBody">
                                            <div class="gamesTitleText">' . $ps_games["name"] . '</div>
                                            <div class="gamesPlatformText">' . $ps_games["platform"] . '</div>
                                            <div class="gamesPrizeText">';
                                            if ($ps_games["discount"] == 0) {
                                                echo '₺' . $ps_games["price"];
                                            } else {
                                                echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $ps_games["price"] . '</span>';
                                                echo ' ₺'.discount($ps_games["price"], $ps_games["discount"]);
                                            }
                                            if($ps_games["rate"] != null && $ps_games["howRate"] != 0){
                                                for ($i = intval($ps_games["rate"] / $ps_games["howRate"]); $i < 5; $i++){
                                                    echo '<span class="fa fa-star f-Right"></span>';
                                                }
                                                for ($i = 0; $i < intval($ps_games["rate"] / $ps_games["howRate"]); $i++){
                                                    echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                                }
                                            }
                                            else{
                                                echo '<span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>';
                                            }
                                        echo '</div>
                                        </div>
                                    </div>
                                </button>
                            </form>';
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row justify-content-center">
                        <?php
                        while ($xb_games = mysqli_fetch_array($xbox_result)) {
                            echo
                                '<form method="post" action="gamePage.php">
                                <input type="hidden" name="gameCode" value=' . $xb_games["gameCode"] . '>
                                <button type="submit" class="cardsAllButton">
                                    <div class="cardsAll">
                                        <img class="cardsImg" src="img/' . $xb_games["name"] . '.jpg" alt="">
                                        <div class="cardsBody">
                                            <div class="gamesTitleText">' . $xb_games["name"] . '</div>
                                            <div class="gamesPlatformText">' . $xb_games["platform"] . '</div>
                                            <div class="gamesPrizeText">';
                                            if ($xb_games["discount"] == 0) {
                                                echo '₺' . $xb_games["price"];
                                            } else {
                                                echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $xb_games["price"] . '</span>';
                                                echo ' ₺'.discount($xb_games["price"], $xb_games["discount"]);
                                            }
                                            if($xb_games["rate"] != null && $xb_games["howRate"] != 0){
                                                for ($i = intval($xb_games["rate"] / $xb_games["howRate"]); $i < 5; $i++){
                                                    echo '<span class="fa fa-star f-Right"></span>';
                                                }
                                                for ($i = 0; $i < intval($xb_games["rate"] / $xb_games["howRate"]); $i++){
                                                    echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                                }
                                            }
                                            else{
                                                echo '<span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>
                                                <span class="fa fa-star f-Right"></span>';
                                            }
                                        echo '</div>
                                        </div>
                                    </div>
                                </button>
                            </form>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>