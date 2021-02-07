<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>프로젝트 수정</title>
      <link rel="stylesheet" href="index.css">
      <script>
         function check(){
            if(!document.myform.title.value){
               alert('제목을 입력하세요');
               document.myform.title.focus();
               return;
            }

            if(!document.myform.upfile.value){
               alert("사진을 업로드 해주시요.");
               return;
            }   

            var a =document.myform.org_price.value;
            if(isNaN(a) == true){
               alert("원가를 숫자로 입력하시오.");
               document.myform.org_price.focus();
               return;
            }
            if(!document.myform.org_price.value ){
               alert('원가를 입력하세요');
               document.myform.org_price.focus();
               return;
            }

            var a =document.myform.sale_price.value;
            if(isNaN(a) == true){
               alert("펀딩시 가격을 숫자로 입력하시오.");
               document.myform.sale_price.focus();
               return;
            }
            if(!document.myform.sale_price.value ){
               alert('펀딩시 가격을 입력하세요');
               document.myform.sale_price.focus();
               return;
            }

            var a =document.myform.amount.value;
            if(isNaN(a) == true){
               alert("한정 수량을 숫자로 입력하시오.");
               document.myform.amount.focus();
               return;
            }
            if(!document.myform.amount.value ){
               alert('한정 수량을 입력하세요');
               document.myform.amount.focus();
               return;
            }

            if(document.myform.date_year.value == ""){
               alert('년도를 선택하세요');
               return;
            }
            if(document.myform.date_month.value == ""){
               alert('월을 선택하세요');
               return;
            }
            if(document.myform.date_day.value == ""){
               alert('일을 선택하세요');
               return;
            }
            
            if(!document.myform.content.value){
               alert('내용을 입력하세요');
               document.myform.content.focus();
               return;
            }
               document.myform.submit();
         }
      </script>
   </head>
   <body>
   <header><?php include 'header.php'; ?></header>
   <section>
   <?php
         $board_idx = $_GET["board_idx"];
         $con = mysqli_connect("localhost","root","","sample2");
         $sql = "select * from board where idx = $board_idx";
         $result = mysqli_query($con, $sql);
         $row = mysqli_fetch_array($result);
         $goal_price = $row["goal_price"];
         $org_price = $row['org_price'];
         $sale_price = $row["sale_price"];
         $amount = $row["amount"];
         $end_date = $row["end_date"];
         $title = $row["title"];
         $content = $row["content"];
      
         $file_name = $row['file_name'];
        if($file_name){
            $real_name = $row['file_copied'];
            $file_dir = './data/'.$real_name;
        }

   ?>
      <div class = "board_view_content">
      <hr>
      <h1>프로젝트 수정</h1>
         <hr>
         <form name = "myform" action="board_modify.php?board_idx=<?=$board_idx?>&my_idx=<?=$useridx?>" method="post" enctype = "multipart/form-data">
            <b><p>제목</p></b>
            <input name="title" class="text" type="text" value = '<?=$title?>'>
            <b><p>기존 상품 이미지</p></b>
            <p><img src = "<?=$file_dir?>"></p>
            <input type = "file" name= "upfile" required>
            <b><p>원가</p></b>
            <input type = "text" name="org_price" value = '<?=$org_price?>'>원
            <b><p>펀딩시 가격</p></b>
            <input type = "text" name="sale_price" value = '<?=$sale_price?>'>원
            <b><p>목표 금액</p></b>
            <script>var money = <?=$goal_price?>; document.write(money.toLocaleString());</script>원
            <b><p>최대 수량</p></b>
            <input type = "text" name="amount" value = '<?=$amount?>'>개
            <b><p>펀딩 마감일</p></b>
            <select name = "date_year">
               <option value = "" selected>선택하시오</option>
               <option value = "2021">2021</option>
               <option value = "2022">2022</option>
               <option value = "2023">2023</option>
               <option value = "2024">2024</option>
               <option value = "2025">2025</option>
           </select>년&nbsp;
           <select name = "date_month">
               <option value = "" selected>선택하시오</option>
               <option value = "1">1</option>
               <option value = "2">2</option>
               <option value = "3">3</option>
               <option value = "4">4</option>
               <option value = "5">5</option>
               <option value = "6">6</option>
               <option value = "7">7</option>
               <option value = "8">8</option>
               <option value = "9">9</option>
               <option value = "10">10</option>
               <option value = "11">11</option>
               <option value = "12">12</option>
           </select>월&nbsp;
           <select name = "date_day">
               <option value = "" selected>선택하시오</option>
               <option value = "1">1</option>
               <option value = "2">2</option>
               <option value = "3">3</option>
               <option value = "4">4</option>
               <option value = "5">5</option>
               <option value = "6">6</option>
               <option value = "7">7</option>
               <option value = "8">8</option>
               <option value = "9">9</option>
               <option value = "10">10</option>
               <option value = "11">11</option>
               <option value = "12">12</option>
               <option value = "13">13</option>
               <option value = "14">14</option>
               <option value = "15">15</option>
               <option value = "16">16</option>
               <option value = "17">17</option>
               <option value = "18">18</option>
               <option value = "19">19</option>
               <option value = "20">20</option>
               <option value = "21">21</option>
               <option value = "22">22</option>
               <option value = "23">23</option>
               <option value = "24">24</option>
               <option value = "25">25</option>
               <option value = "26">26</option>
               <option value = "27">27</option>
               <option value = "12">28</option>
               <option value = "12">29</option>
               <option value = "12">30</option>
               <option value = "12">31</option>
           </select>일
            <b><p>DESIGNER</p></b>
            <p><b><?=$username?></b></p>
            <b><p>내용</p></b>
            <textarea name="content" class="text" rows = "10px" ><?=$content?></textarea>
            <br>
         </form>
         <button class="submit_btn" onclick = "check()">등록</button>
         <button class="submit_btn" onclick = "location.href = 'my_product.php'">목록</button>
      </div>
      </section>
     <footer> <?php include 'footer.php'; ?></footer>
   </body>
</html>