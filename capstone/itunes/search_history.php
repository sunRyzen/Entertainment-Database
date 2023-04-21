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
		
		body {
            background-color: #333;
                        color: #FFF;
        }
		
		form {
            width: 300px;
            margin: 0 auto;
        }
		
		button {
            border-radius: 5px;
        }

        .back-btn {
            position: absolute;
            left: 5px;
            top: 5px;
        }
		
		.clear-btn {
			  display: block;
			  margin: 0 auto;
			  text-align: center;
			}
	</style>
	<button class="back-btn" onclick="goBack()">Back</button>

    <script>
        function goBack() {
          window.location.href = "http://elvis.rowan.edu/~zhengj29/";
        }
	</script>
	
	<body>
		<h1>Search History</h1>
		<div class="container my-5">
			<div style="text-align: center;">
			<form method="post">
				<button class="btn btn-danger mb-2" name="clear">Clear History</button>
			</form>
			</div>
			<table class="table">
				<?php
					$sql = "SELECT * from ssearch_history";
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
									  </tr>';
							}
							echo '</tbody></table>';
					}
				}
				if (isset($_POST['clear'])) {
					$clear_sql = "TRUNCATE TABLE ssearch_history;";
					mysqli_query($conn, $clear_sql);
					header("Refresh:0"); // Reload the page
				}				
			?>
        </table>
  </div>
  </div>
  </body>