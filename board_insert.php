<meta charset="utf-8">
<?php
    $my_idx = $_GET["idx"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $goal_price = $_POST["goal_price"];
    $org_price = $_POST["org_price"];
    $sale_price = $_POST["sale_price"];
    $amount = $_POST["amount"];
    $end_date = $_POST["date_year"]."-".$_POST["date_month"]."-".$_POST["date_day"];
    $title = htmlspecialchars($title, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $date = date("Y-m-d");
    $upload_dir = './data/';
    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];
    
    if($upfile_name && !$upfile_error)
    {
        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name;
        $copied_file_name = $new_file_name.".".$file_ext;
        $uploaded_file = $upload_dir.$copied_file_name;
        
        if($upfile_size > 1000000){
            echo "<script>
                    alert('업로드 파일 크기가 지정된 용량(1MB)를 초과합니다!<br>
                    파일 크기를 체크해주세요!');
                    history.go(-1);
                  </script>";    
                exit;
        }
        if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
            echo"<script>
                alret('파일을 지정한 디렉토리에 복사하는데 실패하였습니다.');
                history.go(-1);
                </script>";
                exit;
        }
    }
    else{
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";
    }
    $con = mysqli_connect("localhost", "root", "", "sample2");
    $sql = "INSERT INTO board (user_idx, title, content, file_name, file_type, file_copied, created_at, goal_price, org_price, sale_price, amount, end_date, percent, cond) 
    VALUES ('$my_idx', '$title', '$content', '$upfile_name','$upfile_type','$copied_file_name','$date', '$goal_price','$org_price', '$sale_price','$amount','$end_date',0,'progress')";
    mysqli_query($con,$sql);
    //게시물 작성시 1000포인트씩 자동 지급
    $point_up = 1000;
    $sql = "select * from user1 where idx = '$my_idx'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $reset_point  = $row['point'] + $point_up;
    $sql = "update user1 set point = $reset_point where idx = '$my_idx'";
    mysqli_query($con, $sql);
    mysqli_close($con);
    session_start();
    $_SESSION['point'] = $reset_point;

    echo "
        <script>
            alert('성공적으로 게시글을 작성 했습니다.');
            alert('1000 포인트가 자동 지급 되었습니다.');
            location.href = 'board_list.php';
        </script>
    ";
?>