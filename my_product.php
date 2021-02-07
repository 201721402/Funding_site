<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>등록한 프로젝트</title>
      <link rel="stylesheet" href="index.css">
   </head>
   <body>
   <header><?php include 'header.php'; ?></header>
   <section>
      <div class="content">
      <hr>
      <h1>등록한 프로젝트</h1>
      <hr>
      <table>
         <thead>
            <tr>
               <td>번호</td>
               <td>제목</td>
               <td>사진</td>
               <td>현황</td>
               <td>펀딩률</td>
               <td>생성 날짜</td>
               <td>조회수</td>
            </tr>
         </thead>
         <tbody>
         <?php
            if(isset($_GET['page'])){
               $page = $_GET['page'];
            }
            else{
               $page = 1;
            }
            $con = mysqli_connect("localhost", "root", "", "sample2");
            $my_idx = $_SESSION["idx"];

            $sql = "SELECT * FROM board where user_idx = '$my_idx' order by idx desc";
            $result = mysqli_query($con, $sql);
            $total_num = mysqli_num_rows($result);

            $cut = 2;
            $start_num = ($page - 1) * $cut;
            $page_num = ceil($total_num/$cut);
            $number = 1;

            for($i = $start_num; $i < $start_num + $cut && $i < $total_num; $i++){
               mysqli_data_seek($result, $i);
               $row = mysqli_fetch_array($result);

               $board_idx = $row["idx"];
            
               echo "<tr>";
               echo "<td>" . $number . "</td>";
               echo "<td>" . $row["title"] . "</td>";
               echo "<td><a href= 'board_view.php?board_idx=$board_idx'><img src = './data/". $row["file_copied"] ."'></a></td>";
               if($row["cond"] == "end"){
                  $cond = "마감";
               }
               else{
                  $cond = "진행중";
               }
               echo "<td><b>" . $cond. "</b></td>";
               echo "<td>" . $row["percent"]. "%</td>";
               echo "<td>" . $row["created_at"] . "</td>";
               echo "<td>" . $row["hit"]."</td>";
               echo "</tr>";
               
               $number++;
            }
         ?>
         </tbody>
         
      </table> 
      <p class = "before_next_btn">
         <?php
            if($page != 1){
               $before = $page - 1;
               echo"<a href = 'my_product.php?page=$before'><img src = './img/before_icon.png'></a>";
            }
            for($i =1; $i <= $page_num; $i++){
               if($i == $page){
                  echo"<b>$i &nbsp;&nbsp;</b>";
               }
               else{
                  echo"<a href = 'my_product.php?page=$i'>$i &nbsp;&nbsp;</a>";
               }
            }
            if($page != $page_num && $page_num >=2){
               $next = $page + 1;
               echo"<a href = 'my_product.php?page=$next'><img src = './img/after_icon.png'></a>";
            }
            echo"<br>";
         ?>
      </p>
      <button class = 'submit_btn' onclick = "location.href = 'board_write.php'">프로젝트 등록하기</button>
      <button class = 'submit_btn' onclick = "location.href = 'my_page.php'">마이페이지</button>
   </div>
   </section>   
   <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>