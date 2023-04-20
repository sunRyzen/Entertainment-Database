

<style>   
 .button{
        padding: 10px;
        text-decoration: none;
        border: 1px solid;
        display: inline-block;
    }
    .remove{
        background: red;
        color:#fff;
        border-color: red;
    }
    .add{
        background: green;
        color:#fff;
        border-color: green;
    }
body {
    background-color: #333;
    color: #fff;
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
</style>

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
        echo "Publisher: $publisher</div><br>";
        echo ($book['fav'] == 1)? "<a class='button remove' href='remove_from_fav.php?id=$id'>Remove from favourite</a><br>": "<a class='button add' href='add_to_fav.php?id=$id'>Add to favourite</a><br>";
        echo "<hr>";
    }else {
        echo 'No book found <a href="app.php">click here </a> to go back.';
    }

}
