<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "dbInfo.php";
$games_query = "select gameCode,name,(select name from platform where games.p_code=p_code) as platform,price,about,(select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate,discount from games;";
$games_result = $conn->query($games_query);
$discount_query = "select *,(select name from platform where p_code=games.p_code)as platform from games where discount != 0 order by discount desc limit 0,12;";
$best_sell_query = "select gameCode,name,price,about,(select name from platform where games.p_code=p_code)as platform,count(*) as adet,(select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate,discount from games where gameCode in(select gameCode from mygames) group by name order by adet desc limit 0,12;";
$best_sell_result = $conn->query($best_sell_query);
$discount_result = $conn->query($discount_query);
$discount_games_result = array();
$best_sellers = array();
while ($discount_games = mysqli_fetch_array($discount_result)) {
    $discount_games_result[] = $discount_games;
}
while ($best_sells = mysqli_fetch_array($best_sell_result)) {
    $best_sellers[] = $best_sells;
}

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
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="max-height: 700px; margin-top:62px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 sliderImages" src="https://cdn-cf.gamivo.com/image_cover.jpg?f=123073&n=7967124560810508.jpg&h=f103c38d9ecc8833b4f7a45e6582f5f9" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 sliderImages" src="img/slider_2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 sliderImages" src="img/slider_3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="allContent">
        <div class="contentTextBar">
            <a class="btn-floating sliderPreviusBtn" href="#populer-Content-Slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
            <a class="btn-floating sliderNextBtn" href="#populer-Content-Slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
            <div class="contentText">
                <h2>Popüler İçerikler</h2>
            </div>
        </div>
        <div id="popularContentAll">
            <div class="container my-4" style="height:auto;">
                <!--Carousel Wrapper-->
                <div id="populer-Content-Slider" class="carousel slide carousel-multi-item" data-ride="carousel">
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                        <!--First slide-->
                        <div class="carousel-item active sliderItemsContent">
                            <div class="row justify-content-center">
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                    echo
                                        '<form method="post" action="gamePage.php">
                                            <input type="hidden" name="gameCode" value=' . $discount_games_result[$i]["gameCode"] . '>
                                            <button type="submit" class="cardsAllButton">
                                                <div class="cardsAll">
                                                    <img class="cardsImg" src="img/' . $discount_games_result[$i]["name"] . '.jpg" alt="">
                                                    <div class="cardsBody">
                                                        <div class="gamesTitleText">' . $discount_games_result[$i]["name"] . '</div>
                                                        <div class="gamesPlatformText">' . $discount_games_result[$i]["platform"] . '</div>
                                                        <div class="gamesPrizeText">
                                                            <span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $discount_games_result[$i]["price"] . '</span>
                                                            ₺' . discount($discount_games_result[$i]["price"], $discount_games_result[$i]["discount"]) . '
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>';
                                }
                                ?>
                            </div>
                        </div>
                        <!--/.First slide-->
                        <!--Second slide-->
                        <div class="carousel-item sliderItemsContent">
                            <div class="row justify-content-center">
                                <?php
                                for ($i = 4; $i < 8; $i++) {
                                    echo
                                        '<form method="post" action="gamePage.php">
                                        <input type="hidden" name="gameCode" value=' . $discount_games_result[$i]["gameCode"] . '>
                                            <button type="submit" class="cardsAllButton">
                                                <div class="cardsAll">
                                                    <img class="cardsImg" src="img/' . $discount_games_result[$i]["name"] . '.jpg" alt="">
                                                    <div class="cardsBody">
                                                        <div class="gamesTitleText">' . $discount_games_result[$i]["name"] . '</div>
                                                        <div class="gamesPlatformText">' . $discount_games_result[$i]["platform"] . '</div>
                                                        <div class="gamesPrizeText">
                                                            <span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $discount_games_result[$i]["price"] . '</span>
                                                            ₺' . discount($discount_games_result[$i]["price"], $discount_games_result[$i]["discount"]) . '
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>';
                                }
                                ?>
                            </div>
                        </div>
                        <!--/.Second slide-->

                        <!--Third slide-->
                        <div class="carousel-item sliderItemsContent">
                            <div class="row justify-content-center">
                                <?php
                                for ($i = 8; $i < 12; $i++) {
                                    echo
                                        '<form method="post" action="gamePage.php">
                                        <input type="hidden" name="gameCode" value=' . $discount_games_result[$i]["gameCode"] . '>
                                            <button type="submit" class="cardsAllButton">
                                                <div class="cardsAll">
                                                    <img class="cardsImg" src="img/' . $discount_games_result[$i]["name"] . '.jpg" alt="">
                                                    <div class="cardsBody">
                                                        <div class="gamesTitleText">' . $discount_games_result[$i]["name"] . '</div>
                                                        <div class="gamesPlatformText">' . $discount_games_result[$i]["platform"] . '</div>
                                                        <div class="gamesPrizeText">
                                                            <span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $discount_games_result[$i]["price"] . '</span>
                                                            ₺' . discount($discount_games_result[$i]["price"], $discount_games_result[$i]["discount"]) . '
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                            <span class="fa fa-star f-Right"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>';
                                }
                                ?>
                            </div>
                        </div>
                        <!--/.Third slide-->
                    </div>
                    <!--/.Slides-->
                </div>
                <!--/.Carousel Wrapper-->
            </div>
        </div>
        <div class="contentTextBar">
            <a class="btn-floating sliderPreviusBtn" href="#bestSellers-Content-Slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
            <a class="btn-floating sliderNextBtn" href="#bestSellers-Content-Slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
            <div class="contentText">
                <h2>Çok Satanlar</h2>
            </div>
        </div>
        <div id="bestSellersContentAll">
            <div class="container my-4">
                <!--Carousel Wrapper-->
                <div id="bestSellers-Content-Slider" class="carousel slide carousel-multi-item" data-ride="carousel">
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">

                        <!--First slide-->
                        <div class="carousel-item active sliderItemsContent">
                            <div class="row justify-content-center">
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                    echo
                                        '<form method="post" action="gamePage.php">
                                            <input type="hidden" name="gameCode" value=' . $best_sellers[$i]["gameCode"] . '>
                                            <button type="submit" class="cardsAllButton">
                                                <div class="cardsAll">
                                                    <img class="cardsImg" src="img/' . $best_sellers[$i]["name"] . '.jpg" alt="">
                                                    <div class="cardsBody">
                                                        <div class="gamesTitleText">' . $best_sellers[$i]["name"] . '</div>
                                                        <div class="gamesPlatformText">' . $best_sellers[$i]["platform"] . '</div>
                                                        <div class="gamesPrizeText">';
                                    if ($best_sellers[$i]["discount"] == 0) {
                                        echo '₺' . $best_sellers[$i]["price"];
                                    } else {
                                        echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $best_sellers[$i]["price"] . '</span>';
                                        echo ' ₺' . discount($best_sellers[$i]["price"], $best_sellers[$i]["discount"]);
                                    }
                                    if ($best_sellers[$i]["rate"] != null && $best_sellers[$i]["howRate"] != 0) {
                                        for ($j = 0; $j < $best_sellers[$i]["rate"] / $best_sellers[$i]["howRate"]; $j++) {
                                            echo '<span class="fa fa-star f-Right"></span>';
                                        }
                                        for ($j = $best_sellers[$i]["rate"] / $best_sellers[$i]["howRate"]; $j < 5; $j++) {
                                            echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                        }
                                    } else {
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
                        <!--/.First slide-->

                        <!--Second slide-->
                        <div class="carousel-item sliderItemsContent">

                            <div class="row justify-content-center">
                                <?php
                                for ($i = 4; $i < 8; $i++) {
                                    echo
                                        '<form method="post" action="gamePage.php">
                                            <input type="hidden" name="gameCode" value=' . $best_sellers[$i]["gameCode"] . '>
                                            <button type="submit" class="cardsAllButton">
                                                <div class="cardsAll">
                                                    <img class="cardsImg" src="img/' . $best_sellers[$i]["name"] . '.jpg" alt="">
                                                    <div class="cardsBody">
                                                        <div class="gamesTitleText">' . $best_sellers[$i]["name"] . '</div>
                                                        <div class="gamesPlatformText">' . $best_sellers[$i]["platform"] . '</div>
                                                        <div class="gamesPrizeText">
                                                        ';
                                    if ($best_sellers[$i]["discount"] == 0) {
                                        echo '₺' . $best_sellers[$i]["price"];
                                    } else {
                                        echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $best_sellers[$i]["price"] . '</span>';
                                        echo ' ₺' . discount($best_sellers[$i]["price"], $best_sellers[$i]["discount"]);
                                    }
                                    if ($best_sellers[$i]["rate"] != null && $best_sellers[$i]["howRate"] != 0) {
                                        for ($j = 0; $j < $best_sellers[$i]["rate"] / $best_sellers[$i]["howRate"]; $j++) {
                                            echo '<span class="fa fa-star f-Right"></span>';
                                        }
                                        for ($j = $best_sellers[$i]["rate"] / $best_sellers[$i]["howRate"]; $j < 5; $j++) {
                                            echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                        }
                                    } else {
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
                        <!--/.Second slide-->

                        <!--Third slide-->
                        <div class="carousel-item sliderItemsContent">

                            <div class="row justify-content-center">
                                <?php
                                for ($i = 8; $i < 12; $i++) {
                                    echo
                                        '<form method="post" action="gamePage.php">
                                            <input type="hidden" name="gameCode" value=' . $best_sellers[$i]["gameCode"] . '>
                                            <button type="submit" class="cardsAllButton">
                                                <div class="cardsAll">
                                                    <img class="cardsImg" src="img/' . $best_sellers[$i]["name"] . '.jpg" alt="">
                                                    <div class="cardsBody">
                                                        <div class="gamesTitleText">' . $best_sellers[$i]["name"] . '</div>
                                                        <div class="gamesPlatformText">' . $best_sellers[$i]["platform"] . '</div>
                                                        <div class="gamesPrizeText">';
                                    if ($best_sellers[$i]["discount"] == 0) {
                                        echo '₺' . $best_sellers[$i]["price"];
                                    } else {
                                        echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $best_sellers[$i]["price"] . '</span>';
                                        echo ' ₺' . discount($best_sellers[$i]["price"], $best_sellers[$i]["discount"]);
                                    }
                                    if ($best_sellers[$i]["rate"] != null && $best_sellers[$i]["howRate"] != 0) {
                                        for ($j = 0; $j < $best_sellers[$i]["rate"] / $best_sellers[$i]["howRate"]; $j++) {
                                            echo '<span class="fa fa-star f-Right"></span>';
                                        }
                                        for ($j = $best_sellers[$i]["rate"] / $best_sellers[$i]["howRate"]; $j < 5; $j++) {
                                            echo '<span class="fa fa-star f-Right ratingStar"></span>';
                                        }
                                    } else {
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
                        <!--/.Third slide-->

                    </div>
                    <!--/.Slides-->

                </div>
                <!--/.Carousel Wrapper-->


            </div>
        </div>
        <div class="contentTextBar">
            <div class="contentText">
                <h2>Oyunlar</h2>
            </div>
        </div>
        <div id="mainContentAll">
            <div class="row justify-content-center">
                <?php
                while ($games = mysqli_fetch_array($games_result)) {
                    echo '<form method="post" action="gamePage.php">
                    <input type="hidden" name="gameCode" value=' . $games["gameCode"] . '>
                    <button type="submit" class="cardsAllButton">
                    <div class="cardsAll">
                        <img class="cardsImg" src="img/' . $games["name"] . '.jpg" alt="">
                        <div class="cardsBody">
                            <div class="gamesTitleText">' . $games["name"] . '</div>
                            <div class="gamesPlatformText">' . $games["platform"] . '</div>
                            <div class="gamesPrizeText">';
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
                    echo '</div>
                        </div>
                    </div>
                </button></form>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</html>