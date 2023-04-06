        <?php
$servername = "sql9.freemysqlhosting.net";
$username = "sql9608271";
$password = "GNMjTMrfNs";
$dbname = "sql9608271";

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
    <link rel="stylesheet" href="https://maxcdn.
        bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <h1>Song Search</h1>
<style>
    h1
        {
        text-align: center;
    }
</style>
<style>
    h2
        {
        text-align: center;
                padding: 12px;
                margin: 8px 0;
        }

</head>

<body>
<style>

		form {
        width: 300px;
        margin: 0 auto;
    }

    input[type=text],
    input[type=submit]
        {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
</style>
  </head>
  <body>
<style>
    body {
        background-color: Azure;
    }
</style>
  <div class="container">
  <div class="dark-mode-toggle" style="position:fixed; top:50%; right:0px;">
  <button onclick="darkMode();">Toggle Dark Mode</button>
</div>
<script>
        function darkMode() {
                var element = document.body;
                element.classList.toggle("dark-mode");
        }
</script>
<style>
        body {
                background-color: white;
                color: #000;
        }
        .dark-mode {
                background-color: black;
                color: #FFF;
        }
</style>
        <form action="" method="post">
    <input type="text" name="search" placeholder="Input value">
    <button class="btn btn-success btn-lg btn-block" name="submit">Search</button>
        </form>
		<div class="container my-5">
                <table class="table">
                        <?php
                                if(isset($_POST['submit'])){
                                        $search=$_POST['search'];

                                        $sql="Select * from itunesapi where artist_name like '%$search%' or
                                        track_name like '%$search%' or release_date like '%$search%' or explicitness like
                                        '%$search%' or primary_genre like '%$search%'";
                                        $result=mysqli_query($conn,$sql);
                                        if($result){
                                                if(mysqli_num_rows($result)>0){
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
