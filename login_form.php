<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>로그인</title>
      <link rel="stylesheet" href="index.css">
   <script>
      function check(){

         if(!document.myform.id.value){
            alert('아이디를 입력해주세요.');
            document.myform.id.focus();
            return;
         }
         if(!document.myform.password.value){
            alert('비밀번호를 입력해주세요.');
            document.myform.password.focus();
            return;
         }
         document.myform.submit();
      }
   </script>
   </head>
   <body>
   <header><?php include 'header.php'; ?></header>
   <section>
      <div class="content">
         <form name="myform" action="login.php" method="post">
            <p>아이디</p>
            <input name="id" type="text" >
            <p>비밀번호</p>
            <input name="password" type="password"> <br> 
            <p><button class = "submit_btn" onclick='check()'>로그인</button></p>
         </form>
        
      </div>
   </section>   
   <footer><?php include 'footer.php'; ?></footer>
         
   </body>
</html>
