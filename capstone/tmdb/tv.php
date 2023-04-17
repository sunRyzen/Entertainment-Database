<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  if (isset($_GET['id'])) {
    $tv = $tmdb->getTVShow($_GET['id']);
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
      echo "TV show data saved successfully";
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
        <link rel="stylesheet" type="text/css" href="styles2.css">
        <button onclick="goBack()">Back</button>

<script>
function goBack() {
  window.location.href = "search-options.php";
}
</script>
  </head>
  <body>
    <?php if (isset($tv)): ?>
      <h1>TV Show Information</h1>
      <ul>
        <li>Title: <?php echo $tv->GetName(); ?></li>
        <li>Overview: <?php echo $tv->getOverview(); ?></li>
        <li>Release Date: <?php echo $tv->getReleaseDate(); ?></li>
        <li>Popularity: <?php echo $tv->getPopularity(); ?></li>
      </ul>
          <form action="tv.php?id=<?php echo $_GET['id']; ?>" method="post">
        <input type="submit" name="save" value="Add to Favorites">
      </form>
    <?php else: ?>
      <h1>Show not found</h1>
    <?php endif; ?>
  </body>
</html>
