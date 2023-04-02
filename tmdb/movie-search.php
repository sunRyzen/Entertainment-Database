<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $movies = $tmdb->searchMovie($query);
  }

  if (isset($_GET['id'])) {
    $movie = $tmdb->getMovie($_GET['id']);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Movie Search</title>
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