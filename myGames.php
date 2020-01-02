<?php
include "header.php";
include "dbInfo.php";
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
    <script>
        function copyKey(gameKey) {
            const el = document.createElement('textarea'); // Create a <textarea> element
            el.value = gameKey; // Set its value to the string that you want copied
            el.setAttribute('readonly', ''); // Make it readonly to be tamper-proof
            el.style.position = 'absolute';
            el.style.left = '-9999px'; // Move outside the screen to make it invisible
            document.body.appendChild(el); // Append the <textarea> element to the HTML document
            const selected =
                document.getSelection().rangeCount > 0 // Check if there is any content selected previously
                ?
                document.getSelection().getRangeAt(0) // Store selection if found
                :
                false; // Mark as false to know no selection existed before
            el.select(); // Select the <textarea> content
            document.execCommand('copy'); // Copy - only works as a result of a user action (e.g. click events)
            document.body.removeChild(el); // Remove the <textarea> element
            if (selected) { // If a selection existed before copying
                document.getSelection().removeAllRanges(); // Unselect everything on the HTML document
                document.getSelection().addRange(selected); // Restore the original selection
            }
            alert("Kopyalandı");
        };

        function rating(star) {
            for (let i = star; i < 5; i++)
                $("#_" + (i + 1)).removeClass("ratingStar");
            for (let i = 0; i < star; i++)
                $("#_" + (i + 1)).addClass("ratingStar");
        };
        function rateOnclick(star){
            rating(star);
        }
    </script>
    <link href="style.css" rel="stylesheet">
</head>

<body>

</body>
<html>
<div id="AllPage" class="bg-dark">
    <div id="userProfileContent">
        <div id="gamesContent">
            <div class="myGamesTitle">
                Oyunlarım
            </div>
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row justify-content-center">
                    <?php
                    if (isset($_SESSION["username"])) {
                        $username = $_SESSION["username"];
                        $myGames_query = "select gameCode,username,(select name from platform where p_code=games.p_code)as platform,name,price,gameKey from myGames inner join games using(gameCode) where username='$username';";
                        $myGames_result = $conn->query($myGames_query);
                    }
                    while ($myGames = mysqli_fetch_array($myGames_result)) {
                        echo '<a>
                            <div class="cardsAll">
                                <img class="cardsImg" src="img/' . $myGames["name"] . '.jpg" alt="">
                                <div class="cardsBody">
                                <div class="myGamesCardHover">      
                                    <div class="myGameCardHoverKey" style="font-size:16px;" onclick="copyKey(`' . $myGames["gameKey"] . '`)">
                                    ' . $myGames["gameKey"] . '
                                    </div>
                                    <form method="post" action="gamePage.php">
                                        <input type="hidden" value="'.$myGames["gameCode"].'" name="gameCode">
                                        <button type="submit" class="btn bg-warning text-dark myGamesCardButtons">Değerlendir</button>
                                    </form>
                                    </div>
                                    <div class="gamesTitleText">' . $myGames["name"] . '</div>
                                    <div class="gamesPlatformText">' . $myGames["platform"] . '</div>
                                    <div class="gameCodeText">
                                       ' . $myGames["gameKey"] . '
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
</div>

</html>