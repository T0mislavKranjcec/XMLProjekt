<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pretraživanje</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .center {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.html">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Pretraživanje filmova</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontakt.html">Kontakt</a>
        </li>
      </ul>
    </div>
  </nav>

<div class="container">
  <div class="center">
    <!-- OMDb API Integration -->
    <form style="max-width: 400px;" method="GET" action="omdb.php">
      <!-- Movie Title input -->
      <div class="form-outline mb-4">
        <input type="text" id="movieTitle" name="movieTitle" class="form-control" placeholder="Naslov filma" />
        <label class="form-label" for="movieTitle">Naslov filma</label>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">Pretraži</button>
    </form>

    <?php
if (isset($_GET["movieTitle"])) {
    $apiKey = "650d2693";
    $movieTitle = urlencode($_GET["movieTitle"]);
    $url = "http://www.omdbapi.com/?apikey={$apiKey}&t={$movieTitle}";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data["Response"] == "True") {
        // Movie found, display the information
        $title = $data["Title"];
        $year = $data["Year"];
        $poster = $data["Poster"];
        $plot = $data["Plot"];
        $year = $data["Year"];
        $released = $data["Released"];
        $genre = $data["Genre"];
        $director = $data["Director"];
        $actors = $data["Actors"];

        echo "<h2>{$title} ({$year})</h2>";
        echo "<img src='{$poster}' alt='Movie Poster'>";
        echo "<p>{$plot}</p>";
        echo "<p>{$director}</p>";
       
        
    } else {
        // Movie not found
        echo "Film nije pronađen.";
    }
}
?>

  </div>
</div>

</body>
</html>
