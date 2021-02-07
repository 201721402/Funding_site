<meta charset="utf-8">
<?php
   session_start();
   $my_point = $_SESSION["point"];
   $user_idx = $_GET["user_idx"];
   $board_idx = $_GET["board_idx"];
   $fund_price = $_POST["sale_price"];
   $fund_amount = $_POST["fund_amount"];
   $total_fund_price = $_POST["total_fund_price"];
   $date = date("Y-m-d");
   /*수량 체크*/
   $con = mysqli_connect("localhost","root","","sample2");
   $sql = "select * from board where idx = $board_idx";
   $result = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($result);
   $amount = $row["amount"];
   $goal_price = $row["goal_price"];
   $cond = $row["cond"];

   if($amount < $fund_amount){
      echo"<script> 
               alert('제한 수량을 초과하였습니다.')
               history.go(-1);
            </script>";
            exit;
   }
   /*포인트 체크*/
   if($total_fund_price > $my_point){
      echo"<script> 
                  alert('포인트가 부족합니다.');
                  history.go(-1);
          </script>";
            exit;
   }
   else{
      $sql = "INSERT INTO fund (user_idx, board_idx, fund_price, fund_amount, created_at, cond) 
      VALUES ('$user_idx', '$board_idx', '$fund_price', '$fund_amount','$date','$cond')";
      mysqli_query($con, $sql);

      /*퍼센트 계산후 데이터베이스에 대입 부분*/
      $sql = "select * from fund where board_idx = $board_idx";
      $result = mysqli_query($con, $sql);
      $total_supporter = mysqli_num_rows($result);
      $sql_total_fund_price = 0;
         while( $row = mysqli_fetch_array($result)){
              
               $sql_total_fund_price = $sql_total_fund_price + ($row["fund_amount"] * $row["fund_price"]);
         }  
      $percent = floor(($sql_total_fund_price / $goal_price) *100);
      $sql = "update board set percent = $percent where idx = $board_idx";
      mysqli_query($con, $sql);

      /*포인트 계산후 데이터베이스에 대입 부분*/
      $my_point = $my_point - $total_fund_price;
      $sql = "update user1 set point = $my_point where idx = $user_idx";
      $_SESSION["point"] = $my_point;
      mysqli_query($con, $sql);
      mysqli_close($con);
      echo "<script>alert('축하합니다! 펀딩이 완료되었습니다.')</script>"; 
      echo "<script> 
                  alert('$total_fund_price p가  소진되었습니다. 남은 포인트: $my_point p');
                  location.href='board_view.php?idx=$board_idx';
                  opener.parent.location.reload();
                  window.close();
            </script>"; 
   }
?>