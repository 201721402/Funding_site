
<div class="header">

    <div class="header_left">
        <a href="message_form.php"><img src="./img/envelope_icon.png"></a>
        <a href="board_list.php"><img src="./img/board_icon.png"></a>
        <a href="board_popular_list_form.php"><img src="./img/popular_icon.png"></a>
    </div>
    <div class="title">
        <h1><a href="index.php">CONN:ECT</a></h1>
    </div>
    <div class="header_right">
        <?php
            session_start();
            if (isset($_SESSION["id"])) $userid = $_SESSION["id"];
            else $userid = "";
            if (isset($_SESSION["idx"])) $useridx = $_SESSION["idx"];
            else $useridx = "";
            if (isset($_SESSION["name"])) $username = $_SESSION["name"];
            else $username = "";
            if (isset($_SESSION["point"])) $userpoint = $_SESSION["point"];
            else $userpoint = "";
            if (isset($_SESSION["level"])) {
                include "level_set.php";
                $userlevel = $_SESSION["level"];
            }
            else $userlevel = "";

            if($userid){
        ?>
                    <b><span>LV.<?=$userlevel?> <?=$username?>(<?=$userid?>) 님 안녕하세요. <script>var money = <?=$userpoint?>;document.write(money.toLocaleString());</script>P </span></b>
                    <span><a href="my_page.php"><img src = "./img/mypage_icon.png" ></a></span>
                    <span class="logout_icon"><a href="logout.php"><img src = "./img/logout_icon.png"></a></span>
                   
                <?php
            } else {
                ?>
                    <a href="login_form.php" style='text-decoration:none;'>로그인</a>
                    <a href="register_form.php" style='text-decoration:none;'>회원 가입</a>
                <?php
            }
                ?>
    </div>
</div>

