<?php

//make this an includes -- old database connection to xampp db
//  $host = "localhost";
//  $username = "root";
//  $password = "test123";
//  $database = "movies";

  $host = "sql9.freemysqlhosting.net";
  $username = "sql9608271";
  $password = "GNMjTMrfNs";
  $database = "sql9608271";

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

  $conn->close();
?>