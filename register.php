<meta charset="utf-8">
<?php
   $con = mysqli_connect("localhost", "root", "", "sample2");
   $id = $_POST["id"];
   $password = $_POST["password"];
   $password_again = $_POST["password_again"];
   $name = $_POST["name"];
   $tel = $_POST["tel"];
   $address = $_POST["address"];
   $email1 = $_POST["email1"];
   $email2 = $_POST["email2"];
   $email = $email1."@".$email2;
   if($password != $password_again){
      echo "<script>
               alert('비밀번호가 일치하지 않습니다.');
               history.go(-1);
            </script>";
            exit;
      
   }
   $sql = "SELECT * from user1 where id = '$id'";
   $result = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($result);
   if(isset($row)) {
      
      echo "<script>
               alert('이미 존재 하는 아이디 입니다.');
               history.go(-1);
            </script>";
      exit;
   }
   $sql = "SELECT * from user1 where email = '$email'";
   $result = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($result);
   if(isset($row)) {
      echo "<script>
               alert('이미 존재 하는 이메일 입니다.');
               history.go(-1);
            </script>";
      exit;
   }
   $date = date("Y-m-d H:i:s");
   $sql = "INSERT INTO user1 (`id`, `password`, `name`, `email`, `address`, `tel`, `created_at`, `point`, `level`) VALUES ('$id', '$password', '$name', '$email', '$address', '$tel', '$date', 1000, 1)";
   mysqli_query($con, $sql);
   mysqli_close($con);  
    echo "
      <script>
         alert('성공적으로 가입 되었습니다.');
         location.href = 'login_form.php';
      </script>";