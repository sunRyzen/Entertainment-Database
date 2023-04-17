<?php
$servername = "sql9.freemysqlhosting.net";
$username = "sql9611840";
$password = "n74TrMNk2r";
$dbname = "sql9611840";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Song Search</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
    <style>
        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
            padding: 12px;
            margin: 8px 0;
        }

        body {
            background-color: #333;
                        color: #FFF;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        input[type=text], input[type=submit] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .light-mode {
            background-color: white;
            color: #000;
        }

        .light-mode input[type=text], .light-mode input[type=submit] {
            border: 1px solid #333;
        }

        .light-mode table thead th {
            background-color: #f8f9fa;
            color: #000;
        }

        .light-mode .text-danger {
            color: red;
		}
		button {
			border-radius: 10px;
		}
		
		.back-btn {
			position: absolute;
			left: 5px;
			top: 5px;
	    }

    </style>
	<button class="back-btn" onclick="goBack()">Back</button>
		
		<script>
	function goBack() {
	  window.location.href = "http://elvis.rowan.edu/~umanaj47/";
	}
	</script>
</head>

<body>
<div class="container">
    <div class="light-mode-toggle" style="position:fixed; top:50%; right:0px;">
        <button onclick="lightMode();">Toggle Light Mode</button>
    </div>
    <script>
        function lightMode() {
            var element = document.body;
            element.classList.toggle("light-mode");
        }
    </script>

    <h1>Song Search</h1>

    <form action="" method="post">
        <input type="text" name="search" placeholder="Input value">
        <button class="btn btn-success btn-lg btn-block" name="submit">Search</button>
    </form>

    <div class="container my-5">
        <table class="table">
            <?php
				if (isset($_POST['submit'])) {
					$search = $_POST['search'];

					// query to search for songs
					$sql = "SELECT * FROM itunesapi WHERE artist_name LIKE '%$search%' OR
							track_name LIKE '%$search%' OR release_date LIKE '%$search%' OR explicitness LIKE
							'%$search%' OR primary_genre LIKE '%$search%'";
					$result = mysqli_query($conn, $sql);

					if ($result) {
						if (mysqli_num_rows($result) > 0) {
							echo '<table class="table">
									  <thead>
										  <tr>
											  <th>Artist Name</th>
											  <th>Track Name</th>
											  <th>Release Date</th>
											  <th>Explicitness</th>
											  <th>Primary Genre</th>
											  <th>Link URL</th>
											  <th>Add to Favorites</th>
										  </tr>
									  </thead>
									  <tbody>';

							while($row = mysqli_fetch_assoc($result)) {
								echo '<tr>
										  <td>'.$row['artist_name'].'</td>
										  <td>'.$row['track_name'].'</td>
										  <td>'.$row['release_date'].'</td>
										  <td>'.$row['explicitness'].'</td>
										  <td>'.$row['primary_genre'].'</td>
										  <td><a href="'.$row['track_url'].'" class="btn btn-outline-primary">Open in iTunes</a></td>
										  <td>
											  <form action="" method="post">
												  <input type="hidden" name="artist_name" value="'.$row['artist_name'].'">
												  <input type="hidden" name="track_name" value="'.$row['track_name'].'">
												  <input type="hidden" name="release_date" value="'.$row['release_date'].'">
												  <input type="hidden" name="explicitness" value="'.$row['explicitness'].'">
												  <input type="hidden" name="primary_genre" value="'.$row['primary_genre'].'">
												  <input type="hidden" name="track_url" value="'.$row['track_url'].'">
												  <button class="btn btn-outline-primary" name="add_to_favorites">Add to Favorites</button>
											  </form>
										  </td>
									  </tr>';
							}

							echo '</tbody></table>';
						} else {
							echo '<h2 class="text-danger">Song not found.</h2>';
						}
					}
				}

				if (isset($_POST['add_to_favorites'])) {
					$artist_name = $_POST['artist_name'];
					$track_name = $_POST['track_name'];
					$release_date = $_POST['release_date'];
					$explicitness = $_POST['explicitness'];
					$primary_genre = $_POST['primary_genre'];
					$track_url = $_POST['track_url'];

					// query to insert song into favorites table
					$sql = "SELECT COUNT(*) FROM favoritesong WHERE track_url = '$track_url'";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_fetch_array($result)[0];

					if ($count > 0) {
					  echo '<div class="alert alert-warning" role="alert">Song is already in favorites!</div>';
					} else {
					  // query to insert song into favorites table
					  $sql = "INSERT INTO favoritesong (artist_name, track_name, release_date, explicitness, primary_genre, track_url)
							  VALUES ('$artist_name', '$track_name', '$release_date', '$explicitness', '$primary_genre', '$track_url')";
					  if (mysqli_query($conn, $sql)) {
						echo '<div class="alert alert-success" role="alert">Song added to favorites!</div>';
					  } else {
						echo '<div class="alert alert-danger" role="alert">Error adding song to favorites.</div>';
					  }
					}
				}
					?>
        </table>
  </div>
  </div>
  </body>
  </html>
