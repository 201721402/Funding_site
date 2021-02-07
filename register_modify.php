<meta charset="utf-8">
<?php
    $id = $_GET['id'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $email = $_POST['email1']."@".$_POST['email2'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];
    if($password != $password_again){
        echo"<script>
            alert('비밀번호가 일치하지 않습니다.');
            history.go(-1);
            </script>";
            exit;
    }
    $con = mysqli_connect('localhost','root','','sample2');
    $sql = "update user1 set tel = '$tel', address = '$address', email = '$email', password = '$password' where id = '$id'";
    mysqli_query($con, $sql);
    mysqli_close($con);
  
    echo"<script>
            alert('정보수정이 완료되었습니다.');
            location.href = 'index.php';
        </script>
    ";
?>