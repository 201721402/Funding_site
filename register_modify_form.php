<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>정보 수정</title>
      <link rel="stylesheet" href="index.css">
      <script>
         function check(){
         if(!document.myform.tel.value){
            alert('전화번호를 입력하시오');
            document.myform.tel.focus();
            return;
         }
         if(!document.myform.address.value){
            alert('주소를 입력하시오');
            document.myform.address.focus();
            return;
         }
         if(!document.myform.email1.value){
            alert('이메일을 입력하시오');
            document.myform.email1.focus();
            return;
         }
         if(!document.myform.email2.value){
            alert('이메일을 입력하시오');
            document.myform.email2.focus();
            return;
         }
         if(!document.myform.password.value){
            alert('비밀번호를 입력하시오');
            document.myform.password.focus();
            return;
         }
         if(!document.myform.password_again.value){
            alert('비밀번호 확인을 입력하시오');
            document.myform.password_again.focus();
            return;
         }
         document.myform.submit();
      }
      function reset(){
         
         document.myform.password.value = "";
         document.myform.password_again.value = "";
         document.myform.name.value = "";
         document.myform.tel.value = "";
         document.myform.address.value = "";
         document.myform.email1.value = "";
         document.myform.email2.value = "";
         document.myform.tel.focus()
         return;
      }
      </script>
   </head>
   <body>
      <header><?php include 'header.php'; ?></header>
      <section>
      <?php
            $con = mysqli_connect('localhost','root','','sample2');
            $sql = "select * from user1 where id = '$userid'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);

            $tel = $row['tel'];
            $address = $row['address'];
            $email = explode("@", $row['email']);
            $email1 = $email[0];
            $email2 = $email[1];
            $password = $row['password'];
            ?>
      <div class="content">
         <form name = 'myform'action="register_modify.php?id=<?=$userid?>" method="post">
            <b><p>아이디: <?=$userid?></p></b>
            <b><p>이름: <?=$username?></p></b>
            <b><p>전화 번호: <input name="tel" type="text"  value = "<?=$tel?>"></p></b>
            <b><p>주소: <input name="address" type="text" value="<?=$address?>" style = 'width: 300px;'></p></b>
            <b><p>이메일
            <input name="email1" type="text" value= "<?=$email1?>">
            @
            <select name="email2">
               <option value ="" selected >선택하세요</option>
               <option value = "naver.com">naver.com</option>
               <option value = "gmail.com">gmail.com</option>
               <option value = "google.com">google.com</option>
               <option value = "hanmail.com">hanmail.com</option>
            </select> 
            </p></b> 
            <b><p>비밀번호:  <input name="password" type="password" value="<?=$password?>"></p></b>
            <b><p>비밀번호 확인: <input name="password_again" type="password" value="<?=$password?>"></p></b>
            <br>
         </form>
         
            <button class = 'submit_btn' onclick = 'check()'>수정하기</button> <button class = 'submit_btn'onclick = 'reset()'>재입력</button>
            <button class = 'submit_btn' onclick = "location.href = 'my_page.php'">마이페이지</button>
         </div>
      </section>
      <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>
