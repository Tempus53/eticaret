<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "dbInfo.php";
$hadGame = False;
if (isset($_POST["gameCode"])) {
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    }
    $gameCode = $_POST["gameCode"];
    $control_query = "select gameCode from myGames where username = '$username' and gameCode='$gameCode';";
    $control_result = $conn->query($control_query);
    if ($control_result->num_rows > 0) {
        $hadGame = true;
    }
    $games_query = "select gameCode,name,(select name from platform where games.p_code=p_code) as platform,price,about,discount from games where gameCode='$gameCode';";
    $comment_query = "select username,comment,rate from comments inner join rating using (username,gameCode) where gameCode='$gameCode';";
    $comment_result = $conn->query($comment_query);
    $rate_query = "select sum(rate)as rate,(select count(username) from rating where gameCode='$gameCode')as adet from rating where gameCode='$gameCode';";
    $rate_result = $conn->query($rate_query);
    $rating = mysqli_fetch_assoc($rate_result);
    $games_result = $conn->query($games_query);
    while ($games_Array = mysqli_fetch_array($games_result)) {
        $games = $games_Array;
    }
} else {
    echo '<script>alert("post EDILMEDİ");</script>';
}
function commentRate($rate)
{
    for ($i = $rate; $i < 5; $i++) {
        echo '<span class="fa fa-star"></span>';
    }
    for ($i = 0; $i < $rate; $i++) {
        echo '<span class="fa fa-star ratingStar"></span>';
    }
}
function rate($rate)
{
    if ($rate <= 0) {
        echo '<span id="_1" onmouseout="rating(0)" onmouseover="rating(1)" onclick="insertRate(1);" class="fa fa-star f-left"></span>
        <span id="_2" onmouseout="rating(0)" onmouseover="rating(2)" onclick="insertRate(2);" class="fa fa-star f-left"></span>
        <span id="_3" onmouseout="rating(0)" onmouseover="rating(3)" onclick="insertRate(3);" class="fa fa-star f-left"></span>
        <span id="_4" onmouseout="rating(0)" onmouseover="rating(4)" onclick="insertRate(4);" class="fa fa-star f-left"></span>
        <span id="_5" onmouseout="rating(0)" onmouseover="rating(5)" onclick="insertRate(5);" class="fa fa-star f-left"></span>';
    } else if ($rate <= 1) {
        echo '<span id="_1" onmouseout="rating(1)" onmouseover="rating(1)" onclick="insertRate(1);" class="fa fa-star f-left ratingStar"></span>
        <span id="_2" onmouseout="rating(1)" onmouseover="rating(2)" onclick="insertRate(2);" class="fa fa-star f-left"></span>
        <span id="_3" onmouseout="rating(1)" onmouseover="rating(3)" onclick="insertRate(3);" class="fa fa-star f-left"></span>
        <span id="_4" onmouseout="rating(1)" onmouseover="rating(4)" onclick="insertRate(4);" class="fa fa-star f-left"></span>
        <span id="_5" onmouseout="rating(1)" onmouseover="rating(5)" onclick="insertRate(5);" class="fa fa-star f-left"></span>';
    } else if ($rate <= 2) {
        echo '<span id="_1" onmouseout="rating(2)" onmouseover="rating(1)" onclick="insertRate(1);"  class="fa fa-star f-left ratingStar"></span>
        <span id="_2" onmouseout="rating(2)" onmouseover="rating(2)" onclick="insertRate(2);" class="fa fa-star f-left ratingStar"></span>
        <span id="_3" onmouseout="rating(2)" onmouseover="rating(3)" onclick="insertRate(3);" class="fa fa-star f-left"></span>
        <span id="_4" onmouseout="rating(2)" onmouseover="rating(4)" onclick="insertRate(4);" class="fa fa-star f-left"></span>
        <span id="_5" onmouseout="rating(2)" onmouseover="rating(5)" onclick="insertRate(5);" class="fa fa-star f-left"></span>';
    } else if ($rate <= 3) {
        echo '<span id="_1" onmouseout="rating(3)" onmouseover="rating(1)" onclick="insertRate(1);"  class="fa fa-star f-left ratingStar"></span>
        <span id="_2" onmouseout="rating(3)" onmouseover="rating(2)" onclick="insertRate(2);" class="fa fa-star f-left ratingStar"></span>
        <span id="_3" onmouseout="rating(3)" onmouseover="rating(3)"onclick="insertRate(3);" class="fa fa-star f-left ratingStar"></span>
        <span id="_4" onmouseout="rating(3)" onmouseover="rating(4)"onclick="insertRate(4);" class="fa fa-star f-left"></span>
        <span id="_5" onmouseout="rating(3)" onmouseover="rating(5)"onclick="insertRate(5);" class="fa fa-star f-left"></span>';
    } else if ($rate <= 4) {
        echo '<span id="_1" onmouseout="rating(4)" onmouseover="rating(1)" onclick="insertRate(1);" class="fa fa-star f-left ratingStar"></span>
        <span id="_2" onmouseout="rating(4)" onmouseover="rating(2)" onclick="insertRate(2);" class="fa fa-star f-left ratingStar"></span>
        <span id="_3" onmouseout="rating(4)" onmouseover="rating(3)" onclick="insertRate(3);" class="fa fa-star f-left ratingStar"></span>
        <span id="_4" onmouseout="rating(4)" onmouseover="rating(4)" onclick="insertRate(4);" class="fa fa-star f-left ratingStar"></span>
        <span id="_5" onmouseout="rating(4)" onmouseover="rating(5)" onclick="insertRate(5);" class="fa fa-star f-left"></span>';
    } else if ($rate <= 5) {
        echo '<span id="_1" onmouseout="rating(5)" onmouseover="rating(1)" onclick="insertRate(1);" class="fa fa-star f-left ratingStar"></span>
        <span id="_2" onmouseout="rating(5)" onmouseover="rating(2)" onclick="insertRate(2);" class="fa fa-star f-left ratingStar"></span>
        <span id="_3" onmouseout="rating(5)" onmouseover="rating(3)" onclick="insertRate(3);" class="fa fa-star f-left ratingStar"></span>
        <span id="_4" onmouseout="rating(5)" onmouseover="rating(4)" onclick="insertRate(4);" class="fa fa-star f-left ratingStar"></span>
        <span id="_5" onmouseout="rating(5)" onmouseover="rating(5)" onclick="insertRate(5);" class="fa fa-star f-left ratingStar"></span>';
    }
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
    <script>
        function addCart() {
            let gameCode = $("#gameCodeID").val();
            if (gameCode != "") {
                $.ajax({
                    type: "post",
                    url: "addCart.php",
                    data: {
                        "gameCode": gameCode,
                    },
                    success: function(response) {
                        if (response == "success") {
                            alert("Ürün sepetinize eklendi.");
                            location.reload();
                        } else if (response == "POST ERROR") {
                            alert("Post edilmedi.");
                        } else
                            alert(response);
                    }
                });
            } else {
                alert("gameCode = nulll");
            }
            return false;
        };

        function insertRate(rate) {
            let gameCode = $("#gameCodeID").val();
            if (gameCode != "" && rate != "") {
                $.ajax({
                    method: "POST",
                    url: "rateGame.php",
                    data: {
                        "gameCode": gameCode,
                        "rate": rate
                    },
                    success: function(response) {
                        if (response == "success") {
                            alert("Değerlendirmeniz Başarıyla Kaydedildi");
                            location.reload();
                        } else if (response == "updated") {
                            alert("Değerlendirmeniz başarıyla Güncellendi");
                            location.reload();
                        } else if (response == "donthaveGame") {
                            alert("Değerlendirme yapabilmek için oyuna sahip olmalısınız.");
                        } else if (response == "notLogin")
                            alert("Değerlenidrme yapabilmek için Lütfen Gİriş Yapınız.");
                        else
                            alert(response);
                    }
                });
            } else {
                alert("gameCode = nulll");
            }
            return false;
        };

        function rating(star) {
            for (let i = star; i < 5; i++)
                $("#_" + (i + 1)).removeClass("ratingStar");
            for (let i = 0; i < star; i++)
                $("#_" + (i + 1)).addClass("ratingStar");
        };

        function insertComment() {
            let gameCode = $("#gameCodeID").val();
            let comment = $("#commentID").val();
            if (gameCode != "" && comment != "") {
                $.ajax({
                    method: "POST",
                    url: "insertComment.php",
                    data: {
                        "commentGameCode": gameCode,
                        "comment": comment
                    },
                    success: function(response) {
                        if (response == "success") {
                            alert("Yorumunuz Başarıyla Kaydedildi.");
                            location.reload();
                        } else if (response == "updated") {
                            alert("Yorumunz başarıyla Güncellendi");
                            location.reload();
                        } else
                            alert(response);
                    }
                });
            } else {
                alert("Lütfen yorumunuzu yazınız.");
            }
            return false;
        };

        function rating(star) {
            for (let i = star; i < 5; i++)
                $("#_" + (i + 1)).removeClass("ratingStar");
            for (let i = 0; i < star; i++)
                $("#_" + (i + 1)).addClass("ratingStar");
        };
    </script>
</head>

<body>
</body>
<html>
<div id="AllPage" class="bg-dark">
    <div class="container" style="margin-top: 100px;padding:20px;">
        <div class="row">
            <div class="col">
                <img src="img/<?php echo $games['name']; ?>.jpg" alt="" class="img-thumbnail" style="background-color:transparent;border:none;" height="300px" width="400px">
            </div>
            <div class="col">
                <div class="row col-sm-auto w-100">
                    <div class="gameInfoTitle">
                        <?php echo $games['name']; ?>
                    </div>
                </div>
                <div class="row col-sm-auto w-100">
                    <div class="gameInfoPlatform">
                        <?php echo $games['platform']; ?>
                    </div>
                </div>
                <div class="row col-sm-auto w-100">
                    <div class="gameInfoAbout">
                        <?php echo $games['about']; ?>
                    </div>
                </div>
                <div class="row col-sm-auto w-100">
                    <div class="col">
                        <div id="gameRating">
                            <?php if ($rating["adet"] != 0)
                                echo rate(intval($rating["rate"] / $rating["adet"]));
                            else
                                echo rate(0);
                            ?>
                            <span id="howManyRate">
                                (<?php echo $rating["adet"]; ?>)
                            </span>
                        </div>
                    </div>
                    <?php
                    if ($hadGame) {
                        echo '<div class="col" style="max-width:150px">
                                    <button class="btn bg-mygreen text-light commentButton" data-toggle="modal" data-target="#commentModal">+ Yorum Yap</button>
                                </div>';
                    } else {
                    }
                    ?>
                </div>
                <div class="row col-sm-auto w-100">
                    <div id="addBasketButton">
                        <form method="post" action="addCart.php" onsubmit="return addCart()">
                            <input id="gameCodeID" type="hidden" value="<?php echo $games['gameCode'] ?>">
                            <button style="width: 100%; height:100%; background:transparent; border:none;">
                                <div id="basketPrize">
                                    <div id="addBasket">
                                        <i class="fas fa-cart-plus"></i>
                                    </div>
                                    <?php
                                    if ($games["discount"] == 0) {
                                        echo '₺' . $games["price"];
                                    } else {
                                        echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $games["price"] . '</span>';
                                        echo ' ₺' . discount($games["price"], $games["discount"]);
                                    }
                                    ?>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contentTextBar">
        <div class="contentText">
            <h2>İlginizi Çekebilecek Ürünler</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <a href="">
            <div class="cardsAll">
                <img class="cardsImg" src="https://store-images.s-microsoft.com/image/apps.47844.14554784103656548.c603f1f6-32b9-41dc-8f67-41374fe8b6db.e1b20439-8be8-46e6-890a-f05a6cae6d1c" alt="">
                <div class="cardsBody">
                    <div class="gamesTitleText">Sea of Thieves</div>
                    <div class="gamesPlatformText">Microsoft</div>
                    <div class="gamesPrizeText">
                        $50.00
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                    </div>
                </div>
            </div>
        </a>
        <a href="">
            <div class="cardsAll">
                <img class="cardsImg" src="https://store-images.s-microsoft.com/image/apps.47844.14554784103656548.c603f1f6-32b9-41dc-8f67-41374fe8b6db.e1b20439-8be8-46e6-890a-f05a6cae6d1c" alt="">
                <div class="cardsBody">
                    <div class="gamesTitleText">Sea of Thieves</div>
                    <div class="gamesPlatformText">Microsoft</div>
                    <div class="gamesPrizeText">
                        $50.00
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                    </div>
                </div>
            </div>
        </a>
        <a href="">
            <div class="cardsAll">
                <img class="cardsImg" src="https://store-images.s-microsoft.com/image/apps.47844.14554784103656548.c603f1f6-32b9-41dc-8f67-41374fe8b6db.e1b20439-8be8-46e6-890a-f05a6cae6d1c" alt="">
                <div class="cardsBody">
                    <div class="gamesTitleText">Sea of Thieves</div>
                    <div class="gamesPlatformText">Microsoft</div>
                    <div class="gamesPrizeText">
                        $50.00
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                    </div>
                </div>
            </div>
        </a>
        <a href="">
            <div class="cardsAll">
                <img class="cardsImg" src="https://store-images.s-microsoft.com/image/apps.47844.14554784103656548.c603f1f6-32b9-41dc-8f67-41374fe8b6db.e1b20439-8be8-46e6-890a-f05a6cae6d1c" alt="">
                <div class="cardsBody">
                    <div class="gamesTitleText">Sea of Thieves</div>
                    <div class="gamesPlatformText">Microsoft</div>
                    <div class="gamesPrizeText">
                        $50.00
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                    </div>
                </div>
            </div>
        </a>
        <a href="">
            <div class="cardsAll">
                <img class="cardsImg" src="https://store-images.s-microsoft.com/image/apps.47844.14554784103656548.c603f1f6-32b9-41dc-8f67-41374fe8b6db.e1b20439-8be8-46e6-890a-f05a6cae6d1c" alt="">
                <div class="cardsBody">
                    <div class="gamesTitleText">Sea of Thieves</div>
                    <div class="gamesPlatformText">Microsoft</div>
                    <div class="gamesPrizeText">
                        $50.00
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                        <span class="fa fa-star f-Right"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="contentTextBar">
        <div class="contentText">
            <h2>Yorumlar</h2>
        </div>
    </div>
    <div id="allComments">
        <div class="row justify-content-center">
            <?php
            while ($comments = mysqli_fetch_array($comment_result)) {
                echo '<div class="card mb-3 userCommentsCards" style="min-width:250px; min-height:250px;">
                        <div class="card-header text-warning">' . $comments["username"] . '</div>
                            <div class="card-body text-light">
                                <p class="card-text" style="min-height:125px">' . $comments["comment"] . '</p>
                                <h5 class="card-title">';
                for ($i = 0; $i < $comments["rate"]; $i++) {
                    echo '<span class="fa fa-star ratingStar"></span>';
                }
                for ($i = $comments["rate"]; $i < 5; $i++) {
                    echo '<span class="fa fa-star"></span>';
                }
                echo '</h5>
                        </div>
                    </div>';
            }
            ?>
        </div>


    </div>
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark" style="max-width:24rem;">
                <div class="modal-header bg-mygreen" style="color:white; border:none;">
                    <div class="modal-title" id="commentTitleLabel">Yorum Yap</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-light f-left">Yorumun :</label>
                        <textarea id="commentID" class="form-control rounded-0" name="comment" id="commentID" rows="5"></textarea>
                    </div>
                    <button type="submit" onclick="insertComment();" class="btn bg-mygreen w-100 text-light">Yorum Yap</button>
                </div>
            </div>
        </div>
    </div>

</html>