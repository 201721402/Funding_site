<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>메세지함</title>
      <link rel="stylesheet" href="index.css">
   </head>
   <body>
      <header><?php include 'header.php'; ?></header>
      <section>
      <?php
         if(!isset($userid)) {
            echo "<script>
                     alert('로그인 해주세요.');
                     location.href = '/assign';
                  </script>
            ";
            exit;
         }
      ?>
   <div class="content">
   <hr>
        <?php
           $mode = $_GET['mode'];
           if($mode == 'my'){
                echo"<h1>나의 메세지함</h1> ";
           }
           else{
                echo"<h1>보낸 메세지함</h1> ";
           }
        ?>
   <hr>    
      
   <table>
      <thead>
         <tr>
            <td>번호</td>
            <?php
               if($mode == 'my')
                  echo"<td>보낸이</td>";
               else
                  echo"<td>받는이</td>";
            ?>
            <td>제목</td>
            <?php
               if($mode == 'my')
                  echo"<td>받은 날짜</td>";
               else
                  echo"<td>보낸 날짜</td>";
            ?>
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
         if($mode =='my'){
            $sql = "SELECT * FROM message where receiver_user_idx = '$my_idx' order by idx desc";
         }
         else{
            $sql = "SELECT * FROM message where send_user_idx = '$my_idx' order by idx desc";
         }
         $result = mysqli_query($con, $sql);
         $total_num = mysqli_num_rows($result);
         $cut = 3;
         $page_num = ceil($total_num/ $cut);
         $start_num = ($page - 1) * $cut;
         $number = $total_num - $start_num;
         
         for($i = $start_num; $i < $start_num + $cut && $i < $total_num; $i++){
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);

            if($mode == 'my'){
               $msg_user_idx = $row['send_user_idx']; 
            }
            else{
               $msg_user_idx = $row['receiver_user_idx'];    
            }

            $msg_user_sql = "SELECT * FROM user1 where idx = '$msg_user_idx'";
            $result_sql = mysqli_query($con, $msg_user_sql);
            $msg_user_row = mysqli_fetch_array($result_sql);
            $idx = $row['idx'];

            echo '<tr>';
            echo "<td>" . $number . "</td>";
            echo "<td>" . $msg_user_row["name"] . "(" . $msg_user_row["id"] . ")" . "</td>";
            echo "<td><a href = 'message_view.php?idx=$idx&mode=$mode' style='text-decoration:none;'>" . $row["title"] . "</a></td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo '</tr>';
            $number--;
         }
         ?>
         </tbody>
   </table> 
   <p class = "before_next_btn">
   <?php
         if($page != 1){
            $before = $page -1;
            echo" <a href = 'message_box.php?mode=$mode&page=$before'><img src = './img/before_icon.png'></a>";
         }
         for($i=1; $i <= $page_num; $i++){
            if($i == $page){
               echo"<b>$i&nbsp;&nbsp;</b>";
            }
            else{
               echo"<a href = 'message_box.php?mode=$mode&page=$i'>$i&nbsp;&nbsp;</a>";
            }
         }
         if($page != $page_num && $page_num >=2){
            $next = $page +1;
            echo"<a href = 'message_box.php?mode=$mode&page=$next'><img src = './img/after_icon.png'></a>";
         }
         echo"<br>";

         if($mode == "send"){
            $txt = "나의";
            $mode1 = "my";
         }
         else{
            $txt = "보낸";
            $mode1 = 'send';
         }
      ?>
   </p>
   <button class= "submit_btn" onclick = "location.href = 'message_form.php'">메세지 보내기</button>
   <button class = "submit_btn" onclick ="location.href = 'message_box.php?mode=<?=$mode1?>'"> <?=$txt?> 메시지함</button>
   </div>
   <br>
      </section>
   <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>