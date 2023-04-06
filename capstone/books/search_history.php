<!-- search form -->
<form method="get" action="">
  <input type="text" name="search_query" placeholder="Search by title">
  <button type="submit" value="yes" name="search">Search</button>
</form>
<?php
// Step 1: Connect to the database
$conn = mysqli_connect("localhost", "root", "", "book");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Get the search query
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
} else {
    $search_query = "";
}

// Step 3: Perform the search
if (isset($_GET['search'])) {
    $query = "SELECT * FROM book WHERE title LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM book";
    $result = mysqli_query($conn, $query);

}
$i = 0;
// Step 4: Display the results
if ($result && mysqli_num_rows($result) > 0) {

    echo "<table border='1'>";
    echo "<tr>
            <th>Sr</th>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Search date</th
            ></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td><img src='".$row['thumb']."' width='100pc' height='100'/></td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['pub'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No search results found.";
}
?>
