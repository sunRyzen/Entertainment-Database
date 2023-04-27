<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-ZTkpTlT07gDzv1RnE8ABvnwrlwJr29NpmvMzUpqAMflq/E21aIKXZ2iOZhWXf8Q1tywIVc0oGyEEaEvnxEHKMg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap">


<div class="container" style="text-align: center;">
    <style>   
        .button{
            padding: 10px;
            text-decoration: none;
            border: 1px solid;
            display: inline-block;
        }

        .remove{
            background: red;
            color: #fff;
            border-color: red;
        }

        .add{
            background: green;
            color: #fff;
            border-color: green;
        }

        body {
            background-color: #333;
            color: #fff;
            font-family: 'Open Sans', sans-serif;
        }

        form input[type="text"] {
            background-color: #555;
            border: none;
            color: #fff;
            padding: 5px;
        }

        form button[type="submit"] {
            background-color: #ffffff;
            border: none;
            color: #333;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #555;}

        th {
            background-color: #ffffff;
            color: #333;
        }

.btn-danger {
    font-size: 1rem;
    padding: 0.5rem 1rem;
}

<style>   
    .back-btn {
        background-color: #ff0000;
        color: #fff;
        border-color: #ff0000;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
    }
</style>


    </style>

</head>
<body>
    <div class="container">


<button class="back-btn" onclick="history.go(-1)" style="float: left;">Previous Page</button>

<script>
    function goBack() {
        window.location.href = "http://elvis.rowan.edu/~rejisa33/";
    }

</script>



<?php


if (isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = mysqli_connect("sql9.freemysqlhosting.net", "sql9611840", "n74TrMNk2r", "sql9611840", 3306);
    $book = mysqli_query($conn,"SELECT * FROM book where id = '$id' LIMIT 1") or die (mysqli_error($conn));
    $count = mysqli_num_rows($book);
    $book = mysqli_fetch_array($book);
    if($count > 0){
        $id = $book['id'];
        $title = $book['title'];
        $authors = $book['author'];
        $publisher = $book['pub'];
        $thumbnail = $book['thumb'];
//        first check if ID is in the databse

        echo "<h3>$title</h3><br>";
        echo "<div style='display: inline-block;'><img src='$thumbnail' alt='Book Cover'></div><br>";
       echo "<div style='display: inline-block;'>Author(s): $authors<br><br>";
echo "Publisher: $publisher<br><br>";
echo ($book['fav'] == 1)? "<a class='button remove' href='remove-from-fav.php?id=$id'>Remove from Favorite's</a><br>": "<a class='button add' href='add-to-fav.php?id=$id'>Add to Favorite's</a><br>";
echo "<hr>";
    }else {
        echo 'No book found <a href="app.php">click here </a> to go back.';

    }




}
