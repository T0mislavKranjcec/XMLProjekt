<?php
$result = ""; // Varijabla za pohranu rezultata poruke

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;

    if (empty($data["username"])) {
        $result = "Korisničko ime nije uneseno.";
    } elseif (empty($data["password"])) {
        $result = "Lozinka nije unesena.";
    } else {
        $username = $data["username"];
        $password = $data["password"];

        $result = provjera($username, $password);

        if ($result == "Uspješno prijavljen") {
            header("Location: omdb.php"); // Preusmjeravanje na omdb.php
            exit; // Zaustavi izvršavanje skripte nakon preusmjeravanja
        }
    }
}

function provjera($username, $password)
{
    $xml = simplexml_load_file("korisnici.xml");

    foreach ($xml->korisnik as $korisnik) {
        $korisnicko = $korisnik->korisnicko_ime;
        $lozinka = $korisnik->lozinka;
        $korisnik_ime = $korisnik->ime;
        $korisnik_prezime = $korisnik->prezime;

        if ($korisnicko == $username) {
            if ($lozinka == $password) {
                return "Uspješno prijavljen";
            } else {
                return "Netočna lozinka";
            }
        }
    }

    return "Korisnik ne postoji.";
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pretraživanje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .center {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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
<div class="center">
  <?php echo $result; ?>
  <form style="max-width: 400px;" method="POST">
    <!-- Username input -->
    <div class="form-outline mb-4">
      <input type="text" id="username" name="username" class="form-control" placeholder="Korisničko ime" />
      <label class="form-label" for="username">Korisničko ime</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
      <input type="password" id="password" name="password" class="form-control" placeholder="Lozinka" />
      <label class="form-label" for="password">Lozinka</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Prijavi se</button>
  </form>
</div>


</body>
</html>
