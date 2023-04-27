<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Search</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
body.dark-mode {
            background-color: #000;
            color: #fff;
        }

        h1, h2 {
            text-align: center;
            margin-top: 40px;
        }

        body {
            background-color: #333;
            color: #FFF;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
        }

        input[type=text] {
            flex: 1;
            margin-right: 10px;
            width: 300px;
            height: 60px;
            padding: 12px 16px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 10px;
        }

        input[type=submit] {
            margin-left: 10px;
            width: 150px;
                height: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border-radius: 10px;
        }

  input[type=submit]:hover {
            background-color: #4CAF50;
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

        .btn-group {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        .btn-group button {
            margin-right: 10px;
            border-radius: 10px;
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: #fff;
        }

        .back-btn {
            position: absolute;
            left: 10px;
            top: 10px;
                border-radius: 10px;
                background-color: #FF0000;
                border-color: #FF0000;
                color: #fff;
            border-radius: 10px


        }

        button {
            border-radius: 0;
        }


    </style>
</head>
<body>
<div class="container">
    <script>
        function goBack() {
            window.location.href = "http://elvis.rowan.edu/~umanaj47/";
        }

        function toggleDarkMode() {
            const body = document.querySelector('body');
            body.classList.toggle('dark-mode');
        }
    </script>

    <h2>Book Search</h2>
    <button class="back-btn" onclick="goBack()">Back</button>
    <form action="search.php" method="get">
        <div class="input-group mb-3">

            <input type="text" name="query" placeholder="Enter search query" class="form-control">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Search</button>
            </div>
        </div>
    </form>
<div class="btn-group d-flex flex-wrap flex-column justify-content-center">
  <a href="http://elvis.rowan.edu/~rejisa33/fav" class="btn btn-success btn-lg mx-2 mb-2">Book Favorites</a>
  <a href="http://elvis.rowan.edu/~rejisa33/search-history.php" class="btn btn-success btn-lg mx-2 mb-2">Search History</a>
  <a href="http://elvis.rowan.edu/~umanaj47/" class="btn btn-success btn-lg mx-2 mb-2">Main Page</a>
<a href="http://elvis.rowan.edu/~umanaj47/favorites.php" class="btn btn-success btn-lg mx-2 mb-2">All Favorites</a>
  <button class="btn btn-success btn-lg mx-2 mb-2 toggle-btn" onclick="toggleDarkMode()">Dark Mode</button>
</div></div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

