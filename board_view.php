<!DOCTYPE html>
<html>
<head>
<meta charset = 'utf-8'>
<link rel="stylesheet" href="index.css">
<title>진행 중인 프로젝트</title>
</head>
<body>
<header><?php include "header.php";?></header>
<!---<script>var money = <?=$org_price?>; document.write(money.toLocaleString());</script>-->
<section>
<?php
    $board_idx = $_GET['board_idx'];
?>
<script>
      function pop_up(){
         window.open("fund_form.php?board_idx=<?=$board_idx?>", 
         "buy","left = 700, top=300,width=400,height=210,scrollbars=no,resizeable=yes");
      }
</script>   
<?php
    $con = mysqli_connect('localhost','root','','sample2');
    $sql = "select * from board where idx = '$board_idx'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $writer_idx = $row['user_idx'];
    $title = $row['title'];
    $content = $row['content'];
    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);
    $goal_price = $row["goal_price"];
    $org_price = $row["org_price"];
    $sale_price = $row["sale_price"];
    $amount = $row["amount"];
    $end_date = $row["end_date"];
    $percent = $row["percent"];
    $created_at = $row['created_at'];
    $cond = $row["cond"];
    $hit = $row['hit'] + 1;
    $benefit = $org_price - $sale_price;

    $file_name = $row['file_name'];
    if($file_name){
       $real_name = $row['file_copied'];
       $file_dir = './data/'.$real_name;
    }

    $sql = "update board set hit = $hit where idx = $board_idx";
    mysqli_query($con, $sql);

    $sql = "select * from user1 where idx = '$writer_idx'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $writer_name = $row['name'];
    $writer_id = $row['id'];
    
    mysqli_close($con);
?>
      <div class = "board_view_content">
      <hr>
      <?php
      /*서포터 수와  총 펀딩금액 퍼센트 계산 부분*/
         $con = mysqli_connect("localhost","root","","sample2");
         $sql = "select * from fund where board_idx = $board_idx";
         $result = mysqli_query($con, $sql);
         $total_supporter = mysqli_num_rows($result);
         $total_fund_price = 0;
         while( $row = mysqli_fetch_array($result)){
               $total_fund_price = $total_fund_price + ($row['fund_price'] * $row['fund_amount']);
         }

      ?>
      <b><p>제목:</b> <?=$title?></p>
      <img src = '<?=$file_dir?>'> <br>
      <hr>
      <?php
         if($cond != "end" && $percent >= 100){
            echo"<p style = 'font-size: 30px; color: red;'><b> 프로젝트가 곧 마감됩니다. 서둘러 펀딩해주세요!</b></p><hr>";
         }
         if($cond =="end"){
            echo"<p style = 'font-size: 30px; color: red;'><b> 마감된 프로젝트 입니다. 상품 제작중. </b></p><hr>";
         }
      ?>
      <h1>현재 펀딩 현황</h1>
      <b><?=$percent?>%</b>달성<br>
      <p><b> <script>var money = <?=$total_fund_price?>;document.write(money.toLocaleString());</script></b>원 펀딩</p>
      <p><b><?=$total_supporter?></b> 명의 서포터</p>
      <p><b>지금 펀딩시 최대 할인 금액:</b> -<script>var money = <?=$benefit?>;document.write(money.toLocaleString());</script>원</p>
      <hr>
            <b><p>DESIGNER</p></b>
            <p><?=$writer_name?></p>
            <b><p>내용</p></b>
            <p><?=$content?></p>
            <p style="text-decoration:line-through;">정가: <script>var money = <?=$org_price?>; document.write(money.toLocaleString());</script>원</p>
            <b><p>얼리버드 가격:</b> <script>var money = <?=$sale_price?>; document.write(money.toLocaleString());</script>원</p>
            <b>목표 펀딩 금액:</b> <script>var money = <?=$goal_price?>;document.write(money.toLocaleString());</script>원<br>
            <p><b>펀딩 마감일:</b> <?=$end_date?></p>
            <b><p>등록 날짜:</b> <?=$created_at?></p>
         <?php
            if($writer_idx == $useridx){
               if($cond != "end"){
         ?>
                  <button class = 'submit_btn' onclick = "location.href ='board_modify_form.php?board_idx=<?=$board_idx?>'">수정</button>
         <?php
               }if($total_supporter == 0){
         ?>
                  <button class = 'submit_btn' onclick = "location.href ='board_delete.php?board_idx=<?=$board_idx?>'">펀딩 삭제하기</button>
         <?php
               }if($percent >= 100 && $cond != "end"){
         ?> 
                  <button class = 'submit_btn' onclick = "location.href = 'fund_end.php?board_idx=<?=$board_idx?>'">펀딩 마감하기</button>
         <?php
               }
           }else{
         ?>
            <button class = 'submit_btn' onclick = "location.href = 'message_form.php?writer_id=<?=$writer_id?>'">메세지 보내기</button>
         <?php
            if($cond != "end"){
         ?>
            <button class = 'submit_btn' onclick = "pop_up()">펀딩하기</button>
         <?php
            }
         }
         ?>
         <button class = 'submit_btn' onclick = "location.href ='board_list.php'">목록</button>
   </div>
      </section>
  <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>