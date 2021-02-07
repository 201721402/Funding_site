<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>메세지함</title>
      <link rel="stylesheet" href="index.css">
      <script>
         function check(){
            if(!document.myform.receiver_user_id.value){
               alert('받는 유저 아이디를 입력하세요');
               document.myform.receiver_user_id.focus();
               return;
            }
            if(!document.myform.title.value){
               alert('제목을 입력하세요');
               document.myform.title.focus();
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
         
      
         if(!$userid) {
            
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
         if(isset($_GET["reply_name"])){
            $txt = "답변";
         }
         else{
            $txt = "메세지";
         }
      ?>
   <h1><?=$txt?> 보내기</h1>
   <hr>
      <form name= 'myform' action="message_insert.php?idx=<?=$useridx?>" method="post">
      <?php
         if(isset($_GET["reply_id"])){
            $reply_name = $_GET["reply_name"];
            $reply_id= $_GET["reply_id"];

            echo"<p>받는 유저 이름: $reply_name</p>";
            echo"<p>받는 유저 아이디: $reply_id</p>";
            echo "<input type='hidden' name='receiver_user_id' value= '$reply_id' >";
         }
         else{
           

            echo"<p>받는 유저 아이디</p>";
             /*board 에서 답변하기 누를때 메세지 함에서 받는 유저 아이디 글쓴이로 자동입력 */
             if(isset($_GET["writer_id"])){
               $receiver_user_id = $_GET["writer_id"];
               echo "<input name='receiver_user_id' class='text' type='text' style = 'width: 150px;' value = '$receiver_user_id'>";
            }
             else{
               echo "<input name='receiver_user_id' class='text' type='text' style = 'width: 150px;'>";
             }
         }
      ?>
         <p>제목</p>
         <input name="title" class="text" type="text" style = "width: 700px;">
         <p>내용</p>
         <textarea name="content" class="text" rows="10"></textarea>
         <br/>
      </form>
      <button class = "submit_btn" onclick = "location.href = 'message_box.php?mode=my'">나의 메세지함</button>
      <button class = "submit_btn" onclick = 'check()'>보내기</button>
      <button class = "submit_btn" onclick = "location.href = 'message_box.php?mode=send'">보낸 메세지함</button>
      </div>
   </section>
   <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>