
<meta charset="utf-8">
<?php
    session_start();
    $my_point = $_SESSION["point"] + $_POST["point"];
    $my_idx =  $_GET["my_idx"];
    $con = mysqli_connect("localhost", "root", "","sample2");
    $sql = "update user1 set point = $my_point where idx = $my_idx";
    mysqli_query($con,$sql);
    mysqli_close($con);
    $_SESSION["point"] = $my_point;

    echo"<script> 
                alert('포인트 충전이 완료되었습니다.'); 
                opener.parent.location.reload();
                window.close();
        </script>";
?>