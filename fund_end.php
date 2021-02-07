<meta charset="utf-8">
<?php
    $board_idx = $_GET["board_idx"];
    $con = mysqli_connect('localhost','root','','sample2');
    $sql = "update board set cond = 'end' where idx = $board_idx";
    mysqli_query($con, $sql);
    
    $sql = "update fund set cond = 'end' where board_idx = $board_idx";
    mysqli_query($con, $sql);

    mysqli_close($con);
            
    echo"<script>
        alert('펀딩이 마감되었습니다.');
        location.href='my_product.php'
        </script>";
?>
       
