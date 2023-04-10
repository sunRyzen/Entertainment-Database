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
    </style>
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

                $sql = "Select * from itunesapi where artist_name like '%$search%' or
                track_name like '%$search%' or release_date like '%$search%' or explicitness like
                '%$search%' or primary_genre like '%$search%'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<thead>
                            <tr>
                            <th>Artist Name</th>
                            <th>Track Name</th>
                            <th>Release Date</th>
                            <th>Explicitness</th>
                            <th>Primary Genre</th>
                            <th>Link URL</th>
                            </tr>

                  </thead>
                  ';

                  while($row=mysqli_fetch_assoc($result)){
					echo '<tbody>
                    <tr>
                    <th>'.$row['artist_name'].'</th>
                    <th>'.$row['track_name'].'</th>
                    <th>'.$row['release_date'].'</th>
                    <th>'.$row['explicitness'].'</th>
                    <th>'.$row['primary_genre'].'</th>
                    <td>
                    <a href="'.$row['track_url'].'" class="btn btn-outline-primary">Open in iTunes</a>
                    </td>
                    </tr>
                    </tbody>';
                    }
                  } else {
                     echo '<h2 class="text-danger">Song not found.</h2>';
                       }
                    }
                   }
             ?>
        </table>
  </div>
  </div>
  </body>
  </html>
