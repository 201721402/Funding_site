<meta charset="utf-8">
<?php
    $board_idx = $_GET["board_idx"];
    $my_idx = $_GET["my_idx"];

    $title = $_POST["title"];
    $content = $_POST["content"];
    $org_price = $_POST["org_price"];
    $sale_price = $_POST["sale_price"];
    $amount = $_POST["amount"];
    $end_date = $_POST["date_year"]."-".$_POST["date_month"]."-".$_POST["date_day"];

    $title = htmlspecialchars($title, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $date = date("Y-m-d H:i:s");

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
    $sql = "UPDATE board SET user_idx = $my_idx, title = '$title', content = '$content', 
    file_name = '$upfile_name', file_type = '$file_ext', file_copied = '$copied_file_name',
    created_at = '$date', org_price = $org_price, sale_price = $sale_price, amount = $amount, 
    end_date = '$end_date' where idx = '$board_idx'";
    echo "
    <script>
        alert('성공적으로 게시글을 수정 했습니다.');
        location.href = 'my_product.php';
    </script>
";
    mysqli_query($con, $sql);
    mysqli_close($con);
?>