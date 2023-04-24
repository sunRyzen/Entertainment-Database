<?php
  require 'includes/tmdb-api.php';
  //require 'includes/database.php'; work on this later

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  if (isset($_GET['id'])) {
    $movie = $tmdb->getMovie($_GET['id']);
    $genres = $movie->getGenres();
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
      echo " ";
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
        <style>
        body {
        background-color: #333;
                color: white;
    }
        img {
          display: block;
          margin: 0 auto;
    }
        .back-button {
        position: absolute;
        left: 0;
        top: 0;
      }

        .header-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
      }

        .results-container {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                position: relative;
                right: 20px;
          }

        .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

        .message-container {
                display: flex;
        justify-content: center;
        margin-top: 10px;
                color: green;
          }
        </style>
  </head>
  <body>
    <?php if (isset($movie)): ?>
          <div class="header-container">
      <h1>Movie Information</h1>
          <a href="movie-search.php" class="back-button"><button>Back</button></a>
          </div>
          <img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $movie->getPosterPath(); ?>" alt="<?php echo $movie->getName(); ?>" style="max-width: 300px; margin: 0 auto;">
          <div class="results-container">
      <ul style="list-style: none;">
        <li>Title: <?php echo $movie->getTitle(); ?></li>
        <li>Overview: <?php echo $movie->getOverview(); ?></li>
        <li>Release Date: <?php echo $movie->getReleaseDate(); ?></li>
        <li>Popularity: <?php echo $movie->getPopularity(); ?></li>
        <li>Genre(s): <?php foreach($genres as $genre) { echo $genre->getName() . ' '; } ?></li>
      </ul>
          </div>
          <div class="button-container">
          <form action="movie.php?id=<?php echo $_GET['id']; ?>" method="post">
        <input type="submit" name="save" value="Add to Favorites">
      </form>
          </div>
          <?php if (isset($_POST['save'])): ?>
          <div class="message-container">
                Movie data saved successfully
          </div>
          <?php endif; ?>
    <?php else: ?>
      <h1>Movie not found</h1>
    <?php endif; ?>
  </body>
</html>
