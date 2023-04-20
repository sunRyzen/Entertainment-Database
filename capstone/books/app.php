
  <title>Book Search</title>
  <style>
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
  <h2>Book Search</h2>
  <form action="search.php" method="get">
    <input type="text" name="query" placeholder="Enter search query">
    <input type="submit" value="Search">
  </form>
<a href="favorites.php"><button>View Favorites</button></a>
  <a href="http://elvis.rowan.edu/~rejisa33/search-history.php"><button>Redirect to Search history</button></a>
</body>
</html>
