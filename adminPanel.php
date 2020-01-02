<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "dbInfo.php";
$p_query = "select * from platform;";
$p_result = $conn->query($p_query);
$games_query = "select gameCode,name,(select name from platform where games.p_code=p_code) as platform,price,about,(select sum(rate) from rating where gameCode=games.gameCode)as rate,(select count(rate) from rating where gameCode=games.gameCode)as howRate,discount from games;";
$games_result = $conn->query($games_query);

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
        function selectionChange() {
            var selection = document.getElementById("platSelectID");
            var selectionVal = selection.options[selection.selectedIndex].value;
            document.getElementById("p_CodeID").innerHTML = selectionVal;
        };

        function insertGame() {
            let gameCode = $("#addGameCode").val();
            let name = $("#addName").val();
            let about = $("#addAbout").val();
            let price = $("#addPrice").val();
            let pCode = document.getElementById("p_CodeID").innerHTML;
            if (gameCode != "" && name != "" && about != "" && price != "") {
                $.ajax({
                    type: "post",
                    url: "insertGame.php",
                    data: {
                        "gameCode": gameCode,
                        "name": name,
                        "about": about,
                        "price": price,
                        "p_code": pCode,
                    },
                    success: function(response) {
                        if (response == "success") {
                            alert("Ürün Başarıyla Eklendi");
                        } else if (response == "code") {
                            alert("Bu kodlu bir oyun zaten mevcut.")
                        } else
                            alert(response);
                    }
                });
            } else {
                alert("Lütfen alanları doldurun");
            }
            return false;
        };
        function insertDiscount() {
            let discount = $("#discountInput").val();
            let gameCode = document.getElementById("discountGameCodeID").innerHTML;
            if (discount != "" && gameCode != "") {
                $.ajax({
                    type: "post",
                    url: "insertDiscount.php",
                    data: {
                        "gameCode": gameCode,
                        "discount": discount
                    },
                    success: function(response) {
                        if (response == "success") {
                            alert("İndirim başarıyla uygulandı.");
                        } else if (response == "posterror") {
                            alert("postHatası")
                        } else
                            alert(response);
                    }
                });
            } else {
                alert("Lütfen alanları doldurun");
            }
            return false;
        };
        function discount(gameCode){
            document.getElementById("discountGameCodeID").innerHTML = gameCode;
        }

        function editGameInfo(gameCode, name, about, price, p_code) {


        }
    </script>
</head>

<body>

</body>
<html>
<div id="AllPage" class="bg-dark">
    <div class="Content">
        <div id="gamesFilterBar">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-light bg-mygreen" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                        Oyun Ekle</a>
                </li>
                <li class="nav-item bg-succes">
                    <a class="nav-link text-light bg-mygreen" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Oyun Düzenle</a>
                </li>
                <li class="nav-item bg-succes">
                    <a class="nav-link text-light bg-mygreen" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                        İçerik</a>
                </li>
                <li class="nav-item bg-succes">
                    <a class="nav-link text-light bg-mygreen" id="pills-contact-tab" data-toggle="pill" href="#pills-discount" role="tab" aria-controls="pills-contact" aria-selected="false">
                        İndirim Uygula</a>
                </li>
        </div>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row justify-content-center">
                    <div class="adminPanel">
                        <label class="adminPanelTitle" for="gamePng">Platform :</label>
                        <div class="form-group">
                            <select class="form-control" id="platSelectID" onchange="selectionChange();">
                                <?php
                                echo '<option> Platform Seç </option>';
                                while ($platform = mysqli_fetch_array($p_result)) {
                                    echo '<option>' . $platform["p_code"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div id="p_CodeID" class="input-group-text"></div>
                            </div>
                            <input type="text" class="form-control" id="addGameCode" placeholder="Örn: GTAV">
                        </div>
                        <label class="adminPanelTitle" for="gamePng">Oyun Adı :</label>
                        <input id="addName" type="text" class="form-control" placeholder="Örn : Sea of Thieves" aria-label="gameName" aria-describedby="basic-addon1">
                        <div class="form-group">
                            <label class="adminPanelTitle">Hakkında :</label>
                            <textarea class="form-control" placeholder="..." id="addAbout" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="adminPanelTitle" for="activationCodes">Aktivasyon Kodları :</label>
                            <textarea class="form-control" placeholder="Örn : &#10EBC20-ASDWV2-VBNTY20&#10OP20S-FOE20P-CVB2321" id="activationCodes" rows="3"></textarea>
                        </div>
                        <label class="adminPanelTitle" for="gamePng">Fiyat :</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">₺</div>
                            </div>
                            <input type="text" class="form-control" id="addPrice" placeholder="Örn: 50.00">
                        </div>
                        <div class="form-group">
                            <label class="adminPanelTitle" for="gamePng">Resim :</label>
                            <input type="file" class="form-control-file" id="gamePng">
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin:20px;width:90%;" onclick="insertGame();">Ekle</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div style="width:50%; margin-top:25px; margin-left:auto;margin-right:auto;margin-bottom:15px;">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width:90%">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="row justify-content-center">
                    
                </div>
            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row justify-content-center">
                    <div class="adminPanel">
                        <div class="form-group">
                            <label class="adminPanelTitle" for="gamePng">Slider Resim:</label>
                            <input type="file" class="form-control-file" id="gamePng">
                        </div>
                        <label class="adminPanelTitle" for="gamePng">Oyun Kodu :</label>
                        <input type="text" class="form-control" placeholder="Örn : SEA01" aria-label="gameCode" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-discount" role="tabpanel" aria-labelledby="pills-discount-tab">
                <div style="width:50%; margin-top:25px; margin-left:auto;margin-right:auto;margin-bottom:15px;">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width:90%">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="row justify-content-center">
                <?php
                    while ($disgames = mysqli_fetch_array($games_result)) {
                        echo '
                            <button data-toggle="modal" data-target="#discountModal" class="cardsAllButton" onclick="discount(\''.$disgames["gameCode"].'\');">
                            <div class="cardsAll">
                                <img class="cardsImg" src="img/' . $disgames["name"] . '.jpg" alt="">
                                <div class="cardsBody">
                                    <div class="gamesTitleText">' . $disgames["name"] . '</div>
                                    <div class="gamesPlatformText">' . $disgames["platform"] . '</div>
                                    <div class="gamesPrizeText">';
                        if ($disgames["discount"] == 0) {
                            echo '₺' . $disgames["price"];
                        } else {
                            echo '<span style="text-decoration: line-through; font-size:15px; color:yellow">₺' . $disgames["price"] . '</span>';
                            echo ' ₺' . discount($disgames["price"], $disgames["discount"]);
                        }
                        if ($disgames["rate"] != null && $disgames["howRate"] != 0) {
                            for ($j = $disgames["rate"] / $disgames["howRate"]; $j < 5; $j++) {
                                echo '<span class="fa fa-star f-Right"></span>';
                            }
                            for ($k = 0; $k < intval($disgames["rate"] / $disgames["howRate"]); $k++) {
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
                        </button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editGameModal" tabindex="-1" role="dialog" aria-labelledby="editGameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:50rem;">
            <div class="modal-header bg-mygreen" style="color:white; border:none;">
                <div class="modal-title" id="exampleModalLabel">Oyun Düzenle</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark">
                <label class="adminPanelTitle" for="gamePng">Platform :</label>
                <div class="form-group">
                    <select class="form-control" id="platSelectID" onchange="selectionChange();">
                        <?php
                        echo '<option> Platform Seç </option>';
                        while ($platform = mysqli_fetch_array($p_result)) {
                            echo '<option>' . $platform["p_code"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div id="p_CodeID" class="input-group-text"></div>
                    </div>
                    <input type="text" class="form-control" id="addGameCode" placeholder="Örn: GTAV">
                </div><label class="adminPanelTitle" for="gamePng">Oyun Adı :</label>
                <input type="text" class="form-control" placeholder="Örn : Sea of Thieves" aria-label="gameName" aria-describedby="basic-addon1">
                <div class="form-group">
                    <label class="adminPanelTitle" for="gamePng">Hakkında :</label>
                    <textarea class="form-control" placeholder="..." id="about" rows="3"></textarea>
                </div>
                <label class="adminPanelTitle" for="gamePng">Fiyat :</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="price" placeholder="Örn: 50.00">
                </div>
                <button type="submit" class="btn btn-primary" style="margin:20px;width:90%;">Düzenle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="discountModallabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:50rem;">
            <div class="modal-header bg-mygreen" style="color:white; border:none;">
                <div class="modal-title" id="exampleModalLabel">İndirim Uygula</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark">
                <label class="adminPanelTitle">İndirim Yüzdesi :</label>
                <label id="discountGameCodeID" class="text-light">GAMECODE</label>
                <input id="discountInput" type="text" class="form-control" placeholder="Örn : 30" aria-label="gameName" aria-describedby="basic-addon1">
                <button type="submit" onclick="insertDiscount();" class="btn btn-primary" style="margin:20px;width:90%;">İndirimi Uygula</button>
            </div>
        </div>
    </div>
</div>


</html>