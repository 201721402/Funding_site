<meta charset="utf-8">
<?php
    $board_idx = $_GET["board_idx"];
    $con = mysqli_connect("localhost","root","","sample2");
    $sql = "delete from board where idx = '$board_idx'";
    mysqli_query($con, $sql);
    mysqli_close($con);
    echo"<script>
            alert('등록하신 상품이 삭제되었습니다.');
            location.href = 'my_product.php';
        </script>";
?>