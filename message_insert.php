<meta charset="utf-8">
<?php
    $con = mysqli_connect("localhost", "root", "", "sample2");

    $send_user_idx = $_GET["idx"];
    $receiver_user_id = $_POST["receiver_user_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    $sql = "SELECT idx from user1 where id = '$receiver_user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $receiver_user_idx = $row["idx"];

    if(!isset($receiver_user_idx)) {
        echo "
            <script>
                alert('존재 하지 않는 유저 아이디 입니다.');  
                history.go(-1);
            </script>
        ";
        exit;
    }
    if($send_user_idx == $receiver_user_idx) {
        echo "
            <script>
                alert('나 자신에게 메세지를 보낼 수 없습니다.');  
                history.go(-1);
            </script>
        ";
        exit;
    }
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO message (`send_user_idx`, `receiver_user_idx`, `title`, `content`, `created_at`) VALUES ('$send_user_idx', '$receiver_user_idx', '$title', '$content', '$date')";

    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
        <script>
            alert('성공적으로 메세지를 보냈습니다.');
            location.href = 'message_box.php?mode=send';
        </script>
    ";