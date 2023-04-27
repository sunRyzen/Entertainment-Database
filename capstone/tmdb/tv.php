<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  if (isset($_GET['id'])) {
    $tv = $tmdb->getTVShow($_GET['id']);
    $genres = $tv->getGenres();
  }

  //above gets the TMDB wrapper, calls it to get the movie by id.
  //below starts the database connection

   if (isset($_POST['save'])) {

  $host = "sql9.freemysqlhosting.net";
  $username = "sql9611840";
  $password = "n74TrMNk2r";
  $database = "sql9611840";
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    $name = $conn->real_escape_string($tv->getName());
    $overview = $conn->real_escape_string($tv->getOverview());
    $first_air_date = $conn->real_escape_string($tv->getFirstAirDate());
    $popularity = $conn->real_escape_string($tv->getPopularity());
    $json_data = $conn->real_escape_string(json_encode($tv));

    $sql = "INSERT INTO tv_shows (name, overview, first_air_date, popularity, json_data) VALUES ('$name', '$overview', '$first_air_date', '$popularity', '$json_data')";

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
    <title>TV Show Information</title>
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
  <link rel="stylesheet" type="text/css" href="stylestext.css">
  <body>
    <?php if (isset($tv)): ?>
        <div class="header-container">
      <h1>TV Show Information</h1>
          <a href="tv-search.php" class="back-button"><button>Back</button></a>
          </div>
      <img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $tv->getPosterPath(); ?>" alt="<?php echo $tv->getName(); ?>" style="max-width: 300px; margin: 0 auto;">
          <div class="results-container">
      <ul style="list-style: none;">
        <li>Title: <?php echo $tv->GetName(); ?></li>
        <li>Overview: <?php echo $tv->getOverview(); ?></li>
        <li>Release Date: <?php echo $tv->getFirstAirDate(); ?></li>
        <li>Popularity: <?php echo $tv->getPopularity(); ?></li>
        <li>Genre: <?php foreach($genres as $genre) { echo $genre->getName() . ' '; } ?></li>
      </ul>
          </div>
          <div class="button-container">
          <form action="tv.php?id=<?php echo $_GET['id']; ?>" method="post">
        <input type="submit" name="save" value="Add to Favorites">
      </form>
          </div>
          <?php if (isset($_POST['save'])): ?>
          <div class="message-container">
                TV Show data saved successfully
          </div>
          <?php endif; ?>
    <?php else: ?>
      <h1>TV Show not found</h1>
    <?php endif; ?>
  </body>
</html>
