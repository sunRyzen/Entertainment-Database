<button onclick="goBack()">Back</button>

<script>
function goBack() {
  window.location.href = "movie-search.php";
}
</script>
<link rel="stylesheet" type="text/css" href="styles2.css">
<title>Top Movies</title>

<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  $movies = $tmdb->getPopularMovies();

  // Output the results
  if ($movies) {
    foreach ($movies as $movie) {
      echo "<h2>" . $movie->getTitle() . "</h2>";
      echo "<p>" . $movie->getOverview() . "</p>";
      echo "<p>Release Date: " . $movie->getReleaseDate() . "</p>";
      echo "<p>Popularity: " . $movie->getPopularity() . "</p>";
      echo "<hr>";
    }
  } else {
    echo "No movies found.";
  }
?>
