<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
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
        var a = document.myform.fund_amount.value;
        if(a == ""){
            alert("펀딩할 수량을 입력해주세요.");
            return;
        }
        if(isNaN(a) == true){
                alert("펀딩할 수량을 숫자로 입력해주세요.")
                return;
            }
         document.myform.submit();
    }
</script>
</head>
<body onload ="init()">
<script>
    var sale_price;
    var fund_amount;
    function init(){
	    sale_price = document.myform.sale_price.value;
	    fund_amount = document.myform.fund_amount.value;
	    document.myform.total_fund_price.value = sale_price;
	    change();
    }

    function add(){
	    fund_amount = document.myform.fund_amount;
	    total_fund_price = document.myform.total_fund_price;
	    fund_amount.value++ ;
	    total_fund_price.value = parseInt(fund_amount.value) * sale_price;
    }

    function del(){
	    fund_amount = document.myform.fund_amount;
	    total_fund_price = document.myform.total_fund_price;
		    if(fund_amount.value > 1){
		    	fund_amount.value--;
			    total_fund_price.value = parseInt(fund_amount.value) * sale_price;
		    }
    }

    function change(){  
	    fund_amount = document.myform.fund_amount;
	    total_fund_price = document.myform.total_fund_price;
		    if(fund_amount.value < 0){
			    fund_amount.value = 0;
		    }
	    total_fund_price.value = parseInt(fund_amount.value) * sale_price;
    }  
</script>
<?php
    session_start();
    $useridx = $_SESSION["idx"];
    
    $board_idx = $_GET["board_idx"];
    $con = mysqli_connect('localhost','root','','sample2');
    $sql = "select * from board where idx = '$board_idx'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $org_price = $row['org_price'];
    $sale_price = $row['sale_price'];
    $amount = $row['amount'];
?>
    <h3>펀딩하기</h3>
    <div class = "content">
    <form name = "myform" method = "POST" action = "fund_insert.php?board_idx=<?=$board_idx?>&user_idx=<?=$useridx?>">
        <b>얼리버드 가격: </b><span style="text-decoration:line-through;"><?=$org_price?>&nbsp;</span>
        <span><?=$sale_price?>원</span><br>
        <input type = "hidden" name = "sale_price" value = '<?=$sale_price?>'>
        <span><b>제한 수량:</b> <?=$amount?>개</span><br>
        <span><b>수량:</b> 
        <input type = "text" name = "fund_amount" onclick="change()" value ="1" style = "width: 40px;">개
        <input type = "button" value = "+" onclick = "add()"> <input type = "button" value = "-" onclick = "del()"></span><br>
        <span><b>총 비용:</b> <input type = "text" name = "total_fund_price" style = "width: 90px;" readonly> 원</span><br>
        <hr>
        <span><b>보유 포인트:</b> <script>var money = <?=$_SESSION['point']?>;document.write(money.toLocaleString());</script>P</span>
        <hr>
        <img src="./img/buy_icon.png" onclick="check()"> 
        <img src="./img/close_icon.png" onclick="window.close()">
    </form>
    </div>
</body>
</html>