<?php
  require 'includes/tmdb-api.php';
  //require 'includes/database.php'; work on this later

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  if (isset($_GET['id'])) {
    $movie = $tmdb->getMovie($_GET['id']);
  }
  //above gets the TMDB wrapper, calls it to get the movie by id.
  //below starts the database connection,

    if (isset($_POST['save'])) {

//db connection to main db
  $host = "sql9.freemysqlhosting.net";
  $username = "sql9611840";
  $password = "n74TrMNk2r";
  $database = "sql9611840";


    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    $title = $conn->real_escape_string($movie->getTitle());
    $overview = $conn->real_escape_string($movie->getOverview());
    $release_date = $conn->real_escape_string($movie->getReleaseDate());
    $popularity = $conn->real_escape_string($movie->getPopularity());
    $json_data = $conn->real_escape_string(json_encode($movie));

    $sql = "INSERT INTO movies (title, overview, release_date, popularity, json_data) VALUES ('$title', '$overview', '$release_date', '$popularity', '$json_data')";

    if ($conn->query($sql) === TRUE) {
      echo "Movie data saved successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Movie Information</title>
        <link rel="stylesheet" type="text/css" href="styles2.css">
                <button onclick="goBack()">Back</button>

<script>
function goBack() {
  window.location.href = "search-options.php";
}
</script>
  </head>
  <body>
    <?php if (isset($movie)): ?>
      <h1>Movie Information</h1>
      <ul>
        <li>Title: <?php echo $movie->getTitle(); ?></li>
        <li>Overview: <?php echo $movie->getOverview(); ?></li>
        <li>Release Date: <?php echo $movie->getReleaseDate(); ?></li>
        <li>Popularity: <?php echo $movie->getPopularity(); ?></li>
      </ul>
          <form action="movie.php?id=<?php echo $_GET['id']; ?>" method="post">
        <input type="submit" name="save" value="Add to Favorites">
      </form>
    <?php else: ?>
      <h1>Movie not found</h1>
    <?php endif; ?>
  </body>
</html>
