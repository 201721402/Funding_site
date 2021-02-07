<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>마이페이지</title>
      <link rel="stylesheet" href="index.css">
   </head>  
   <body>
      <header> <?php include "header.php" ?></header>
      <section>
         <script>
            function pop_up(){
               window.open("my_point_charge_form.php?my_idx=<?=$useridx?>", 
               "buy","left = 700, top=300,width=400,height=210,scrollbars=no,resizeable=yes");
            }
         </script> 
         <div class="content">
         <hr>
         <h1>마이페이지</h1>
         <hr>
         <button class="submit_btn" onclick = "pop_up()">포인트 충전</button>
         <button class="submit_btn" onclick = "location.href = 'register_modify_form.php'">정보수정</button>
         <button class="submit_btn" onclick = "location.href = 'my_funding.php'">펀딩한 프로젝트</button>
         <button class="submit_btn" onclick = "location.href = 'my_product.php'">등록한 프로젝트</button>
         </div>
      </section>
   <footer><?php include "footer.php" ?></footer>
   </body>
</html>