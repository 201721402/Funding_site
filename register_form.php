<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>회원 가입</title>
      <link rel="stylesheet" href="index.css">
      <script>
         function check(){
         if(!document.myform.id.value){
            alert('아이디를 입력하시오');
            document.myform.id.focus();
            return;
         }
         if(!document.myform.name.value){
            alert('이름을 입력하시오');
            document.myform.name.focus();
            return;
         }
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
         document.myform.id.value = "";
         document.myform.name.value = "";
         document.myform.password.value = "";
         document.myform.password_again.value = "";
         document.myform.name.value = "";
         document.myform.tel.value = "";
         document.myform.address.value = "";
         document.myform.email1.value = "";
         document.myform.email2.value = "";
         document.myform.id.focus()
         return;
      }
      function id_check(){
         window.open("check_id.php?id="+document.myform.id.value, 
         "ID check","left = 700, top=300,width=250,height=120,scrollbars=no,resizeable=yes");
         
      }
      </script>
   </head>
   <body>
      <header><?php include 'header.php'; ?></header>
      <section>
      <div class="register_content">
         <form name = 'myform'action="register.php" method="post">
            <p>아이디: <input name="id" type="text"><a href="#"><img src = "./img/check_icon.png"  onclick = "id_check()" ></a></p>
            <p>이름: <input name="name" type="text"></p>
            <p>전화 번호: <input name="tel" type="text"></p>
            <p>주소: <input name="address" type="text"></p>
            <p>이메일:  <input name="email1" type="text">
            @
            <select name="email2">
               <option value ="" selected >선택하세요</option>
               <option value = "naver.com">naver.com</option>
               <option value = "gmail.com">gmail.com</option>
               <option value = "google.com">google.com</option>
               <option value = "hanmail.com">hanmail.com</option>
            </select> 
            </p>  
            <p>비밀번호:<input name="password" type="password"></p>
            
            <p>비밀번호 확인:<input name="password_again" type="password"></p>
            <br>
         </form>
         <button class = 'submit_btn' onclick = 'check()'>가입하기</button> <button class = 'submit_btn'onclick = 'reset()'>재입력</button>
      </div>
      </section>
      <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>

