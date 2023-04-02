<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $tvs = $tmdb->searchTVShow($query);
  }

  if (isset($_GET['id'])) {
    $tv = $tmdb->getName($_GET['id']);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TV Search</title>
  </head>
  <body>
    <h1>TV Search</h1>
    <form action="" method="post">
      <input type="text" name="query">
      <input type="submit" value="Search" name="search">
    </form>
    <?php if (isset($tvs)): ?>
      <h2>Results</h2>
      <ul>
        <?php foreach ($tvs as $tv): ?>
          <li>
            <a href="tv.php?id=<?php echo $tv->getID(); ?>">
              <?php echo $tv->getName(); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </body>
</html>