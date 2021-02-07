<meta charset="utf-8">
<?php
   $con = mysqli_connect('localhost','root','','sample2');
    $sql = "select * from user1 where id ='$userid'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $before_level_sql = $row['level'];

    if($userpoint >= 0 && $userpoint < 50000){
        $_SESSION["level"] = 1;
        $new_level = 1;
    }
    if($userpoint >= 50000 && $userpoint < 100000){
        $_SESSION["level"] = 2;
        $new_level = 2;
    }
    if($userpoint >= 100000 && $userpoint < 150000){
        $_SESSION["level"] = 3;
        $new_level = 3;
    }
    if($userpoint >= 150000 &&  $userpoint < 200000){
        $_SESSION["level"] = 4;
        $new_level = 4;
    }
    if($userpoint >= 200000 &&  $userpoint < 250000){
        $_SESSION["level"] = 5;
        $new_level = 5;
    }
    if($userpoint >= 250000){
        $_SESSION["level"] = 6;
        $new_level = 6;
    }
    if($before_level_sql < $new_level){
        echo "<script> alert('축하합니다 등급이 올랐습니다.');</script>";
    }
    if($before_level_sql > $new_level){
        echo "<script> alert('등급이 떨어졌습니다. 포인트를 충전해주세요.');</script>";
    }
    $sql = "update user1 set level = $new_level where id = '$userid'";
    mysqli_query($con,$sql);
    mysqli_close($con);

?>