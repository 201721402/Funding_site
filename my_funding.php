<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>펀딩한 프로젝트</title>
      <link rel="stylesheet" href="index.css">
   </head>
   <body>
   <header><?php include 'header.php'; ?></header>
   <section>
      <div class="content">
      <hr>
      <h1>펀딩한 프로젝트</h1>
      <hr>
      <table>
         <thead>
            <tr>
               <td>번호</td>
               <td>제목</td>
               <td>사진</td>
               <td>현황</td>
               <td>펀딩률</td>
               <td>총 펀딩 금액</td>
               <td>수량</td>
               <td>펀딩 날짜</td>
               
            </tr>
         </thead>
         <tbody>
         <?php

            $con = mysqli_connect("localhost", "root", "", "sample2");
            $sql = "SELECT * FROM fund where user_idx = '$useridx' and cond = 'end' order by idx desc";
            $result = mysqli_query($con, $sql);
            $total_num = mysqli_num_rows($result);
            $number = 1;

            for($i = 0;  $i < $total_num; $i++){
               mysqli_data_seek($result, $i);
               $row = mysqli_fetch_array($result);
               $board_idx= $row["board_idx"];

               $sql2 = "SELECT * FROM board where idx = '$board_idx' ";
               $result2 = mysqli_query($con, $sql2);
               $row2 = mysqli_fetch_array($result2);
               $total_price = $row["fund_price"] * $row["fund_amount"];
      
               echo "<tr>";
               echo "<td>" . $number . "</td>";
               echo "<td>" . $row2["title"] . "</td>";
               echo "<td><a href= 'board_view.php?board_idx=$board_idx'><img src = './data/". $row2["file_copied"] ."'></a></td>";
               echo "<td><b>마감</b></td>";
               echo "<td>" . $row2["percent"] . "%</td>";
               echo "<td> <script> var money = $total_price; document.write(money.toLocaleString()); </script>원</td>";
               echo "<td>" .  $row["fund_amount"] . "</td>";
               echo "<td>" .  $row["created_at"] . "</td>";
               echo "</tr>";
               
               $number++;  
            }
            $sql = "SELECT * FROM fund where user_idx = '$useridx' and cond = 'progress' order by idx desc";
            $result = mysqli_query($con, $sql);
          
            $total_num = mysqli_num_rows($result);  
            for($i = 0; $i < $total_num; $i++){
               mysqli_data_seek($result, $i);
               $row = mysqli_fetch_array($result);
               $board_idx= $row["board_idx"];

               $sql2 = "SELECT * FROM board where idx = '$board_idx' ";
               $result2 = mysqli_query($con, $sql2);
               $row2 = mysqli_fetch_array($result2);
               $total_price = $row["fund_price"] * $row["fund_amount"];
            
               echo "<tr>";
               echo "<td>" . $number . "</td>";
               echo "<td>" . $row2["title"] . "</td>";
               echo "<td><a href= 'board_view.php?board_idx=$board_idx'><img src = './data/". $row2["file_copied"] ."'></a></td>";
               echo "<td><b>진행중</b></td>";
               echo "<td>" . $row2["percent"] . "%</td>";
               echo "<td> <script> var money = $total_price; document.write(money.toLocaleString()); </script>원</td>";
               echo "<td>" .  $row["fund_amount"] . "</td>";
               echo "<td>" .  $row["created_at"] . "</td>";
               echo "</tr>";
               $number++;
            }
         ?>
         </tbody>
      </table>    
      <button class = 'submit_btn' onclick = "location.href = 'board_list.php'">펀딩하러 가기</button>
      <button class = 'submit_btn' onclick = "location.href = 'my_page.php'">마이페이지</button>
      </div>
   </section>   
   <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>