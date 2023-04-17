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
    $tvs = $tmdb->searchTVShow($query);

        //add top 5 search results to search-history (inside the isset)
        $stmt = $conn->prepare('INSERT INTO `search-history` (title, search_date, media_type) VALUES (?, ?, ?)');
        for($i =0; $i < 5 && isset($tvs[$i]); $i++)
        {
    $title = $tvs[$i]->getName();
    $search_date = date('Y-m-d H:i:s');
        $media_type = 'Show';
    $stmt->bind_param('sss', $title, $search_date, $media_type);
    $stmt->execute();
        }
  }

  if (isset($_GET['id'])) {
    $tv = $tmdb->getName($_GET['id']);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TV Search</title>
        <link rel="stylesheet" type="text/css" href="styles2.css">
        <button onclick="goBack()">Back</button>

<script>
function goBack() {
  window.location.href = "search-options.php";
}
</script>
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
