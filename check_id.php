<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
h3 {
    padding-left:10px;
    border-left: solid 10px #000;
}
.close{
    margin: 10px 0 0 80px;
    cursor:pointer;

}
.close img{
   width: 30px;
}
</style>
</head>
<body>
    <h3>아이디 중복체크</h3>
<?php
    $id = $_GET["id"];
    if(!$id){
        echo"<li>아이디를 입력해주세요</li>";
        echo"<div class='close'>
                <img src='./img/close_icon.png' onclick='javascript:self.close()'>
            </div>";
     exit;
    }

    $con = mysqli_connect("localhost","root","","sample2");
    $sql = "select * from user1 where id = '$id'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    
    if(!$num){
        echo"<li>'$id'는 사용가능합니다.</li>";
    }
    else{
        echo"<li>'$id'는 중복됩니다.</li>";
    }
   
    mysqli_close($con);
?>
<div class="close">
   <img src="./img/close_icon.png" onclick="javascript:self.close()">
</div>


</div>
</body>
</html>