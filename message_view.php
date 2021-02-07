<!DOCTYPE html>
<html>
<head>
<meta charset = 'utf-8'>
<link rel="stylesheet" href="index.css">
<title>메세지 내용</title>
</head>
<body>
   <header><?php include "header.php"; ?></header>
   <section>
   <?php
    $idx = $_GET["idx"];
    $mode = $_GET["mode"];
    $con = mysqli_connect('localhost','root','','sample2');
    $sql = "select * from message where idx= '$idx'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $title = $row["title"];
    $content = $row["content"];
    $created_at = $row["created_at"];

    if($mode == 'send'){
       $msg_user_idx = $row["receiver_user_idx"];
       $msg_user_txt = "받는이";
    }
    else{
       $msg_user_idx = $row["send_user_idx"];
       $msg_user_txt = "보낸이";
    }
    $sql = "select * from user1 where idx = '$msg_user_idx'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $msg_user_name = $row["name"];
    $msg_user_id = $row["id"];
   ?>
      <div class="content">
      <hr>
      <h1>메세지 내용</h1>
      <hr>
            <b><p><?=$msg_user_txt?></b>: <?=$msg_user_name?>(<?=$msg_user_id?>)</p>
            <b><p>제목</b>: <?=$title?></p>
            <b><p>내용</b>: <?=$content?></p>
            <b><p>보낸 날짜</b>: <?=$created_at?></p>
        <?php
            if($mode == "my"){
         ?>
            <button class = 'submit_btn' onclick = "location.href ='message_form.php?reply_id=<?=$msg_user_id?>&reply_name=<?=$msg_user_name?>'">답변하기</button>
         <?php
            }
         ?>
            <button class = 'submit_btn' onclick = "location.href ='message_box.php?mode=<?=$mode?>'">목록</button>
      </div>
   </section>
   <footer><?php include 'footer.php'; ?></footer>
   </body>
</html>