<?php
if(!$_GET['query']) die('Your search query is empty.');


$apiKey = "AIzaSyASbE8-BJ9Z38yGhqt7BEIdW6jc1ZxnON4";


if(!$_GET['query']) die('');
$conn = mysqli_connect("localhost", "root", "", "book");
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$query = urlencode($_GET['query']);
  // Insert a new row into the search history table
 $sqlquery = "INSERT INTO search_history (title) VALUES ('$query')";
 mysqli_query($conn, $sqlquery);


$url = "https://www.googleapis.com/books/v1/volumes?q=$query&key=$apiKey";



$response = file_get_contents($url);

$data = json_decode($response, true);

$books = $data['items'];
echo "<h2>Results:</h2>";
if(count($books) > 0) {
    foreach ($books as $book) {
        $id = $book['id'];
        $title = $book['volumeInfo']['title'];
        $authors = (isset($book['volumeInfo']['authors']))?implode(", ", $book['volumeInfo']['authors']):'';
        $publisher = isset($book['volumeInfo']['publisher']) ? $book['volumeInfo']['publisher'] : 'N/A';
        $thumbnail = isset($book['volumeInfo']['imageLinks']['thumbnail']) ? $book['volumeInfo']['imageLinks']['thumbnail'] : 'https://via.placeholder.com/150x200?text=No+Image';
//        insert into database
//        first check if ID is in the databse
        $get = "select id from book where id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $get);
        $count = mysqli_num_rows($query);
        if ($count < 1){
//            insert into database no record found
            $id = mysqli_real_escape_string($conn, $id);
            $title = mysqli_real_escape_string($conn, $title);
            $author = mysqli_real_escape_string($conn, $authors);
            $publisher = mysqli_real_escape_string($conn, $publisher);
            $thumbnail = mysqli_real_escape_string($conn, $thumbnail);
            $ins = "INSERT INTO book (id, title, author, pub, thumb, date) 
            VALUES(
            '$id',
            '$title',
            '$authors',
            '$publisher',
            '$thumbnail',
             now()
            )";
            $query = mysqli_query($conn, $ins);
        }

        echo "<h3>$title</h3>";
        echo "<div style='display: inline-block;'><img src='$thumbnail' alt='Book Cover'></div>";
        echo "<div style='display: inline-block;'>Author(s): $authors<br>";
        echo "Publisher: $publisher</div>";
        echo "<hr>";
    }
}
