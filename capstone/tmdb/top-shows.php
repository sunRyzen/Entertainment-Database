<button onclick="goBack()">Back</button>

<script>
function goBack() {
  window.location.href = "tv-search.php";
}
</script>
<link rel="stylesheet" type="text/css" href="styles2.css">
<?php
  require 'includes/tmdb-api.php';

  $tmdb = new TMDB();
  $tmdb->setAPIKey('21855c98a465091b126f54446a358b4a');

  $shows = $tmdb->getTopRatedTVShows();

  // Output the results
  if ($shows) {
    foreach ($shows as $show) {
      echo "<h2>" . $show->getName() . "</h2>";
      echo "<p>" . $show->getOverview() . "</p>";
      echo "<p>Release Date: " . $show->getFirstAirDate() . "</p>";
      echo "<p>Popularity: " . $show->getPopularity() . "</p>";
      echo "<hr>";
    }
  } else {
    echo "No shows found.";
  }
?>
