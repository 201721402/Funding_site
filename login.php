<meta charset="utf-8">
<?php
   session_start();
   session_unset();
   $con = mysqli_connect("localhost", "root", "", "sample2");
   $id = $_POST["id"];
   $password = $_POST["password"];

   $sql = "SELECT * from user1 where `id` = '$id'";

   $result = mysqli_query($con, $sql);

   $row = mysqli_fetch_array($result);

   if(!isset($row)) {
      
      echo "<script>
               alert('아이디를 확인해주세요.');
               history.go(-1);
            </script>
      ";

      exit;
   }
   else{
      $db_pass = $row['password'];
      if($db_pass != $password){
         echo "<script>
               alert('비밀번호를 확인해주세요.');
               history.go(-1);
            </script>
      ";
      exit;
      }
      else{
         mysqli_query($con, $sql);
         mysqli_close($con); 
         $_SESSION["idx"] = $row["idx"];
         $_SESSION["id"] = $row["id"];
         $_SESSION["name"] = $row["name"];
         $_SESSION["point"] = $row["point"];
         $_SESSION["level"] = $row["level"];
          echo "
            <script>
               alert('성공적으로 로그인 되었습니다.');
               location.href = 'index.php';
            </script>
         ";

      }
   }

  