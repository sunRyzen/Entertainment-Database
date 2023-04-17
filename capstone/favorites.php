<link rel="stylesheet" type="text/css" href="styles2.css">

<?php

//db connection to main db
  $host = "sql9.freemysqlhosting.net";
  $username = "sql9611840";
  $password = "n74TrMNk2r";
  $database = "sql9611840";

  $conn = new mysqli($host, $username, $password, $database);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

//selects and outputs from movies table
  $sql = "SELECT * FROM movies";
  $result = mysqli_query($conn, $sql);

  echo "<h1 style='font-size: 48px;'>Movies</h1>";
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<h2>" . $row["title"] . "</h2>";
      echo "<p>" . $row["overview"] . "</p>";
      echo "<p>Release Date: " . $row["release_date"] . "</p>";
      echo "<p>Popularity: " . $row["popularity"] . "</p>";
      echo "<hr>";
    }
  } else {
    echo "No movies found.";
  }

//selects and outputs from tv_shows table
  $sql = "SELECT * FROM tv_shows";
  $result = mysqli_query($conn, $sql);

  echo "<h1 style='font-size: 48px;'>TV Shows</h1>";
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<h2>" . $row["name"] . "</h2>";
      echo "<p>" . $row["overview"] . "</p>";
      echo "<p>First Air Date: " . $row["first_air_date"] . "</p>";
      echo "<p>Popularity: " . $row["popularity"] . "</p>";
      echo "<hr>";
    }
  } else {
    echo "No TV shows found.";
  }

echo "<h1 style='font-size: 48px;'>Books</h1>";
  //start books code below. all you need to do is print out the results saved in your db. no need to make an extra connection, its already connected.

echo "<h1 style='font-size: 48px;'>Music</h1>";
  //start music code below. all you need to do is print out the results saved in your db. no need to make an extra connection, its already connected.
  // Songs
  $sql = "SELECT * FROM favoritesong";
  $result = mysqli_query($conn, $sql);

  echo "<h1 style='font-size: 48px;'>Songs</h1>";
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<h2>" . $row["track_name"] . "</h2>";
      echo "<p>Artist: " . $row["artist_name"] . "</p>";
      echo "<p>Release Date: " . $row["release_date"] . "</p>";
      echo "<p>Explicitness: " . $row["explicitness"] . "</p>";
	  echo "<p>Genre: " . $row["primary_genre"] . "</p>";
      echo "<hr>";
    }
  } else {
    echo "No Songs found.";
  }

  $conn->close();
?>
