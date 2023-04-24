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
        <style>
          body {
                background-color: #333;
          }
          h1, h2 {
                color: white;
          }
          a {
                color: white;
                text-decoration: none;
          }
          a:visited {
                color: white;
          }
          a:hover, a:active {
                color: white;
                text-decoration: underline;
          }

      .header-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
      }

          .back-button {
        position: absolute;
        left: 0;
        top: 0;
      }

      .search-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
      }

      .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

          .green-button {
                background-color: green;
                color: white;
          }

          .results-container {
                display: flex;
                justify-content: center;
                align-items: center;
          }

        .header-button-container {
        position: absolute;
        top: 0;
        right: 0;
        margin: 10px;
      }
    </style>
  </head>
  <body>
    <div class="header-container">
      <h1>TV Search</h1>
          <a href="http://elvis.rowan.edu/~umanaj47/" class="back-button"><button>Back</button></a>
          <a href="search-history.php" class="header-button-container"><button>View Search History</button></a>
        </div>
        <div class="search-container">
    <form action="" method="post">
      <input type="text" name="query">
      <input type="submit" value="Search" name="search">
    </form>
        <div class="button-container">
      <a href="movie-search.php"><button class="green-button">Swap to Movie Search</button></a>
      <a href="top-shows.php"><button class="green-button">Show Popular TV Shows</button></a>
      </div>
    </div>
        <div class="results-container">
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
        </div>
  </body>
</html>
