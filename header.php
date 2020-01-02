<?php
session_start();
$login;
if (isset($_SESSION["username"])) {
    $login = true;
    $ssn_username = $_SESSION["username"];
    $ssn_name = $_SESSION["name"];
    $ssn_surname = $_SESSION["surname"];
    $ssn_email = $_SESSION["email"];
} else {
    $login = False;
}
function header_discount($price,$discount){
    $price = $price - $price * ($discount / 100) ;
    return intval($price);
}
?>
<script type="text/javascript">
    function login() {
        let login_username = $("#username").val();
        let login_password = $("#password").val();
        if (login_username != "" && login_password != "") {
            $.ajax({
                type: "post",
                url: "login.php",
                data: {
                    "username": login_username,
                    "password": login_password
                },
                success: function(response) {
                    if (response == "success") {
                        window.location.href = "index.php";
                    } else {
                        document.getElementById("loginError").innerHTML = "Kullanıcı adı veya şifre hatalı.";
                    }
                }

            });
        } else {
            document.getElementById("loginError").innerHTML = "Lütfen Kullanıcı Adı ve Şifrenizi giriniz.";
        }
        return false;
    };

    function register() {
        let username = $("#registerUsername").val();
        let password = $("#registerPassword").val();
        let confPass = $("#registerConfirmPass").val();
        let name = $("#registerName").val();
        let surname = $("#registerSurname").val();
        let email = $("#registerEmail").val();
        if (username != "" && password != "" && name != "" && surname != "" && email != "" && confPass != "") {
            if (password != confPass) {
                document.getElementById("registerLoginError").innerHTML = "Şifreleriniz eşleşmiyor.";
            } else {
                var registerAJAX = $.ajax({
                    type: "post",
                    url: "register.php",
                    data: {
                        "username": username,
                        "password": password,
                        "name": name,
                        "surname": surname,
                        "email": email
                    },
                    success: function(response) {
                        if (response == "usernameExists") {
                            document.getElementById("registerLoginError").innerHTML = "Kullanıcı adı mevcut.";
                        } else if (response == "emailExists") {
                            document.getElementById("registerLoginError").innerHTML = "Bu E-Mail adresi kullanılmakta.";
                        } else {
                            window.location.href = "index.php";
                        }
                    }
                });
            }
        } else {
            document.getElementById("registerLoginError").innerHTML = "Lütfen Kullanıcı Adı ve Şifrenizi giriniz.";
        }
        return false;
    };
</script>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color:#009655;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbarWidth" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <img src="logo.png" alt="" class="img-thumbnail" style="background-color:transparent;border:none;" height="" width="120px">
            </li>
            <li class="nav-item active">
                <a class="headerButtonsText" href="index.php">
                    <button class="headerButtons">
                        <i class="fas fa-store-alt"></i> Mağaza
                        <div class="buttonsUnderline"></div>
                    </button>
                </a>
            </li>
            <li class="nav-item">
                <a class="headerButtonsText" href="games.php">
                    <button class="headerButtons">
                        <i class="fas fa-gamepad"></i> Oyunlar
                        <div class="buttonsUnderline"></div>
                    </button>
                </a>
            </li>
        </ul>
        <form class="form-inline mr-auto my-2 my-lg-0" style="width:650px;" method="post" action="search.php">
            <input id="searchBarID" name="input" class="form-control mr-sm-2 mdb-autocomplete" type="search" placeholder="Oyun Ara" aria-label="Search" style="width:90%" data-toggle="dropdown">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <?php
        if ($login == false) {
            echo '<button class="headerUserButtons" data-toggle="modal" data-target="#registerModal">
                <div class="headerButtonsText" href="">
                    Kayıt Ol
                    <div class="buttonsUnderline"></div>
                </div>
            </button>
            <button class="headerUserButtons" data-toggle="modal" data-target="#loginModal">
                <div class="headerButtonsText" href="">
                    Giriş Yap
                    <div class="buttonsUnderline"></div>
                </div>
            </button>';
        } else {
            echo '<div class="dropdown">
                <button class="btn dropdown-toggle text-light" type="button" id="userDropDownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    ' . $_SESSION["username"] . '
                </button>
                <div class="dropdown-menu" aria-labelledby="userDropDownMenu">
                    <a class="dropdown-item" href="myGames.php">Oyunlarım</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#editUserModal" href="">Bilgileri Düzenle</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="logOut.php">Çıkış</a>
                </div>
            </div>';
        }
        ?>
        <div class="dropdown">
            <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart"></i> Sepetim
            </button>
            <div class="dropdown-menu dropDownCartAll" aria-labelledby="dropdownMenuButton">
                <?php
                if (isset($_SESSION["myCart"]))
                    foreach ($_SESSION["myCart"] as $row) {
                        echo '<div class="dropdown-item" href="#">
                                <div class="cartItems">
                                    <img src="img/' . $row["name"] . '.jpg" alt="" class="img-thumbnail f-left" style="background-color:transparent;border:none;" height="100%" width="70px">
                                    <div class="cartItemInfo">
                                        <div class="cartItemTitle">
                                        ' . $row["name"] . '
                                        </div>
                                    <div class="cartItemsPlatform">
                                        ' . $row["platform"] . '
                                    </div>
                                    <div class="cartItemPrize">
                                        '; if ($row["discount"] == 0) {
                                            echo '₺' . $row["price"];
                                        } else {
                                            echo '<span style="text-decoration: line-through; font-size:15px; color:royalblue">₺' . $row["price"] . '</span>';
                                            echo ' ₺'.header_discount($row["price"], $row["discount"]);
                                        } 
                                        
                                    echo ' (x' . $row["adet"] . ')
                                    </div>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
                <div class="dropdown-divider"></div>
                <div class="">
                    <form method="post" action="myCart.php">
                        <button type="submit" class="btn bg-info text-light w-100">
                            <i class="fas fa-shopping-cart"></i>Sepete Git
                    </form>
                </div>
            </div>
        </div>
</nav>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="max-width:20rem;">
            <div class="modal-header bg-mygreen" style="color:white; border:none;">
                <div class="modal-title" id="loginTitleLabel">Giriş</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark">
                <form method="post" action="login.php" onsubmit="return login();">
                    <input type="text" name="username" require id="username" class="form-control loginModalInputs" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <input type="password" require name="password" id="password" class="form-control loginModalInputs" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                    <span id="loginError" style="text-align:center; color:red;"></span>
                    <button type="submit" class="btn bg-mygreen w-100 text-light">Giriş</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark" style="max-width:24rem;">
            <div class="modal-header bg-mygreen" style="color:white; border:none;">
                <div class="modal-title" id="registerTitleLabel">Kayıt Ol</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="register.php" onsubmit="return register();">
                    <input type="text" id="registerUsername" class="form-control registerInputs" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <input type="password" id="registerPassword" class="form-control registerInputs" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                    <input type="password" id="registerConfirmPass" class="form-control registerInputs" placeholder="Confirm Password" aria-label="confirmPassword" aria-describedby="basic-addon1">
                    <div class="form-row">
                        <div class="col">
                            <input id="registerName" type="text" class="form-control registerInputs" placeholder="İsim">
                        </div>
                        <div class="col">
                            <input id="registerSurname" type="text" class="form-control registerInputs" placeholder="Soyisim">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="registerEmail" type="text" class="form-control" placeholder="E - Posta" aria-label="eMail" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@ornek.com</span>
                        </div>
                    </div>
                    <span id="registerLoginError" style="text-align:center; color:red;"></span>
                    <button type="submit" class="btn bg-mygreen w-100 text-light">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark" style="max-width:24rem;">
            <div class="modal-header bg-mygreen" style="color:white; border:none;">
                <div class="modal-title" id="titleLabel">Bilgileri Düzenle</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" onsubmit="">
                    <div class="registerInputs text-light"><?php echo "$ssn_username"; ?> </div>
                    <div class="form-row">
                        <div class="col">
                            <input id="editName" value="<?php echo " $ssn_name"; ?>" type="text" class="form-control registerInputs" placeholder="İsim">
                        </div>
                        <div class="col">
                            <input id="editSurname" value="<?php echo "$ssn_surname";?>" type="text" class="form-control registerInputs" placeholder="Soyisim">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="editEmail" value="<?php echo "$ssn_email"; ?>" type="text" class="form-control" placeholder="E - Posta" aria-label="eMail" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@ornek.com</span>
                        </div>
                    </div>
                    <span id="registerLoginError" style="text-align:center; color:red;"></span>
                    <button type="submit" class="btn bg-mygreen w-100 text-light">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>