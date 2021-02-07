<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>포인트 충전하기</title>
<style>
h3 {
    padding-left:10px;
    border-left: solid 10px #000;
}
.content {
    margin: 20px 0;
    text-align: center;
}
.content img{
    cursor:pointer;
    width: 30px;
}
</style>
<script>
    function check(){
      
        if(document.myform.point.value == ""){
            alert("충전할 포인트를 입력해주세요.");
            return;
        }
         document.myform.submit();
    }
</script>
</head>
<body>
    <?php
        $my_idx = $_GET["my_idx"];
    ?>
    <h3>포인트 충전하기</h3>
    <div class = "content">
    <form name = "myform" method = "POST" action = "my_point_charge.php?my_idx=<?=$my_idx?>">
        충전 금액: <input type="number" name = "point" step ="10000" min = "10000" style = "width: 80px;"><br>
        <hr>
        <img src="./img/check_icon.png" onclick="check()"> 
        <img src="./img/close_icon.png" onclick="javascript:self.close()">
    </form>
    </div>
</body>
</html>