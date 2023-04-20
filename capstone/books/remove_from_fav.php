<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = mysqli_connect("sql9.freemysqlhosting.net", "sql9611840", "n74TrMNk2r", "sql9611840", 3306);
    $book = mysqli_query($conn,"SELECT * FROM book where id = '$id' LIMIT 1") or die (mysqli_error($conn));
    $count = mysqli_num_rows($book);
    $book = mysqli_fetch_array($book);
    if($count > 0){
        mysqli_query($conn, "UPDATE book set fav = 0 where id = '$id' LIMIT 1")or die (mysqli_error($conn));
        header('location: detail.php?id='.$id);
    }else {
        echo 'No book found <a href="detail.php?id='.$id.'">click here </a> to go back.';
    }

}
