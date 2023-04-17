<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');
  //api key set and db connect
  $host = "sql9.freemysqlhosting.net";
  $username = "sql9611840";
  $password = "n74TrMNk2r";
  $database = "sql9611840";

  $conn = new mysqli($host, $username, $password, $database);

  if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $movies = $tmdb->searchMovie($query);


  //add top 5 search results to search-history (inside the isset)
  $stmt = $conn->prepare('INSERT INTO `search-history` (title, search_date, media_type) VALUES (?, ?, ?)');
  for($i =0; $i < 5 && isset($movies[$i]); $i++)
  {
          $title = $movies[$i]->getTitle();
          $search_date = date('Y-m-d H:i:s');
          $media_type = 'Movie';
          $stmt->bind_Param('sss', $title, $search_date, $media_type);
          $stmt->execute();
  }
  }

  if (isset($_GET['id'])) {
    $movie = $tmdb->getMovie($_GET['id']);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Movie Search</title>
        <link rel="stylesheet" type="text/css" href="styles2.css">
        <button onclick="goBack()">Back</button>

<script>
function goBack() {
  window.location.href = "search-options.php";
}
</script>
  </head>
  <body>
    <h1>Movie Search</h1>
    <form action="" method="post">
      <input type="text" name="query">
      <input type="submit" value="Search" name="search">
    </form>
    <?php if (isset($movies)): ?>
      <h2>Results</h2>
      <ul>
        <?php foreach ($movies as $movie): ?>
          <li>
            <a href="movie.php?id=<?php echo $movie->getID(); ?>">
              <?php echo $movie->getTitle(); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </body>
</html>
