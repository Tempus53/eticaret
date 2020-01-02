<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "header.php";
include "dbInfo.php";
$login;
if (isset($_SESSION["username"])) {
    $login = true;
    $username = $_SESSION["username"];
    $cart_query = "select *,(select name from platform where p_code=games.p_code) as platform from games where gameCode in(select gameCode from cart where username='$username');";
} else {
    $login = false;
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
    <script>
        function addGame(gameCode) {
            $.ajax({
                type: "post",
                url: "addMyCart.php",
                data: {
                    "gameCode": gameCode
                },
                success: function(response) {
                    if (response == "addComplete") {
                        location.reload();
                    } else {
                        alert("Bir Hata Oluştu.");
                    }
                }

            });
            return false;
        };

        function deleteGame(gameCode) {
            $.ajax({
                type: "post",
                url: "removeMyCart.php",
                data: {
                    "gameCode": gameCode
                },
                success: function(response) {
                    if (response == "deleted") {
                        location.reload();
                    } else if (response == "NoPost") {
                        alert("Post Edilmedi.");
                    } else {
                        alert(response);
                    }
                }
            });
            return false;
        };
    </script>
    <link href="style.css" rel="stylesheet">
</head>

<body>

</body>
<html>
<div id="AllPage" class="bg-dark">
    <div id="myCartPageContent" class="bg-dark">
        <div id="cartRightMenu">
            <span class="cartRightMenuTitle">Sepeti Onayla</span>
            <div id="cartRightMenuItemsContent">
                <?php
                $toplamFiyat = 0;
                foreach ($_SESSION["myCart"] as $row) {
                    echo '
                    <div class="cartRightMenuItemsText">
                        (x' . $row["adet"] . ') ' . $row["name"] . '<span class="f-Right">₺ ';
                        if ($row["discount"] == 0) {
                            echo '₺' . $row["price"];
                            $toplamFiyat += (intval($row["price"]) * intval($row["adet"]));
                        } else {
                            echo ' ₺'.discount($row["price"], $row["discount"]);
                            $toplamFiyat += ( discount($row["price"], $row["discount"]) * intval($row["adet"]));
                        }
                        echo '</span>
                    </div>';
                }
                ?>
            </div>
            <div class="cartTotalPrize">Toplam : <span class="f-Right">₺ <?php echo "$toplamFiyat"; ?></span></div>
            <button type="button" class="btn bg-info text-light" style="margin-left:25px;margin-top:15px;margin-bottom:10px;float:left;"> + Kayıtlı Kart Seç</button>
            <input type="text" class="form-control cartCreditCardInputs" placeholder="Kart Sahibi" aria-label="cardsOwner" aria-describedby="basic-addon1">
            <input type="text" class="form-control cartCreditCardInputs" placeholder="Kart Numarası" aria-label="cardsNo" aria-describedby="basic-addon1">
            <div class="cartCreditCardInputs">
                <div style="color:white;text-align:left;font-size:15px;">Son Kullanma Tarihi (Ay / Yıl)</div>
                <div class="form-group">
                    <select class="form-control cartCreditCardDate" id="month" style="width:70px; float:left;">
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <select class="form-control cartCreditCardDate" id="year" style="width:70px; float:left;margin-left:5px;">
                        <?php
                        for ($i = 19; $i <= 30; $i++) {
                            echo '<option>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" class="form-control" style="float:right;width:120px;" placeholder="CVC" aria-label="CVC" aria-describedby="basic-addon1">
                </div>
                <div class="form-check-inline f-left" style="margin-top:10px;">
                    <label class="form-check-label text-light">
                        <input type="checkbox" class="form-check-input" value=""><a href="" style="color:orange;opacity:1;">Satış Sözleşmesini<a> Okudum ve Onaylıyorum.
                    </label>
                </div>
                <button type="button" class="btn bg-info w-100 text-light" style="margin-top:15px;margin-bottom:10px;">Ödemeyi Tamamla</button>
            </div>
        </div>
        <div class="myCartTitle">
            Sepetim
        </div>
        <br>
        <div id="myCart">
            <div class="row justify-content-center">
                <?php
                foreach ($_SESSION["myCart"] as $row) {
                    echo '<a href="">
                    <div class="cartCardsAll">
                        <img class="cardsImg" src="img/' . $row["name"] . '.jpg" alt="">
                        <div class="cardsBody">
                            <div class="gamesTitleText">' . $row["name"] . '</div>
                            <div class="gamesPlatformText">' . $row["platform"] . '
                            </div>
                            <div class="gamesPrizeText">
                                ';
                                if ($row["discount"] == 0) {
                                    echo '₺' . $row["price"];
                                } else {
                                    echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $row["price"] . '</span>';
                                    echo ' ₺'.discount($row["price"], $row["discount"]);
                                }
                                echo '
                                <div class="f-Right" style="position:relative; width:auto;">
                                 <form class="f-left" method="post" action="removeMyCart.php" onsubmit="return deleteGame(`' . $row["gameCode"] . '`);">
                                    <button type="submit" class="cartItemButton bg-danger"><i class="fas fa-minus"></i></button>
                                </form><span style="margin-left:5px; margin-right:5px;">' . $row["adet"] . '</span>
                                <form class="f-Right " method="post" action="addMyCart.php" onsubmit="return addGame(`' . $row["gameCode"] . '`);" style="position: relative; width: 28px; height: 28px;">
                                    <button type="submit" class="cartItemButton bg-info"><i class="fas fa-plus"></i></button>
                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</html>