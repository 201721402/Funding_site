<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>프로젝트 TOP 5</title>
      <link rel="stylesheet" href="index.css">
   </head>
   <body>
   <header><?php include 'header.php'; ?></header>
   <section>
   <?php 
         if(!$userid) {
            echo "<script>
                     alert('로그인 해주세요.');
                     location.href = '/assign/index.php';
                  </script>
            ";
            exit;
         }
   ?>
   <div class="content">
      <hr>
      <h1> 프로젝트 TOP 5</h1>
      <hr>
      <table>
         <thead>
            <tr>
               <td>순위</td>
               <td>제목</td>
               <td>디자이너</td>
               <td>사진</td>
               <td>현황</td>
               <td>펀딩률</td>
               <td>조회수</td>
            </tr>
         </thead>
         <tbody>
         <?php
            
            $con = mysqli_connect("localhost", "root", "", "sample2");
            $my_idx = $_SESSION["idx"];

            $sql = "SELECT * FROM board where cond = 'progress' order by percent desc limit 5";
            $result = mysqli_query($con, $sql);
            $number = 1;
            while($row = mysqli_fetch_array($result)){
               $cond = $row["cond"];
               $percent = $row["percent"];
               if( $percent >= 100 ){
                  $board_idx = $row["idx"];
                  $writer_idx = $row["user_idx"];
                  $writer_sql = "SELECT * FROM user1 where idx = '$writer_idx'";
                  $writer_result = mysqli_query($con, $writer_sql);
                  $writer_row = mysqli_fetch_array($writer_result);
               
               echo '<tr>';
               echo "<td><b>" . $number . "위</b></td>";
               echo "<td>" . $row["title"] . "</td>";
               echo "<td>" . $writer_row["name"]. "</td>";
               echo "<td><a href= 'board_view.php?board_idx=$board_idx'><img src = './data/". $row["file_copied"] ."'></a></td>";
               echo "<td><b>진행중</b></td>";
               echo "<td>" . $row["percent"] . "%</td>";
               echo "<td>" . $row["hit"]."</td>";
               echo '</tr>';
               
               $number++;
            }
         }
         ?>
         </tbody>
      </table> 
      <button class = 'submit_btn' onclick = "location.href = 'board_write.php'">프로젝트 등록</button>
      </div>
      </section>
     <footer> <?php include 'footer.php'; ?></footer>
   </body>
</html>