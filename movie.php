<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/movie.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <title>Filmes</title>
</head>
<?php
session_start();

$id = $_GET['id'];
$key = "c7ab045a7a61bb551d1eea508a6d67c2";
$url = "https://api.themoviedb.org/3/movie/$id?api_key=$key&language=pt-BR";
$json = file_get_contents($url);
$obj = json_decode($json); 
?>

<body style="background-image: url('https://image.tmdb.org/t/p/original/<?php echo $obj->poster_path; ?>');">
<div class="fundo"></div>
  <nav class="navbar navbar-expand-lg navbar-dark" style="height: 100px; background-color:black;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="imgs/logo.jpg" style="width: 170px;"></a>
      <form class="d-flex" action="index.php" method="post">
        <input class="form-control me-sm-2" type="get" placeholder="Pesquisar" id="pesquisa" name="pesquisa">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Enviar</button>
      </form>
    </div>
    </div>
  </nav>
  <?php
  echo "
  <div class='filme container'>
    <div class='col-sm-4'>
      <img id='img' src='https://image.tmdb.org/t/p/original/$obj->poster_path' class='card-img-top' alt='...'>
    </div>
    <div class='info-filme'>
      <h4 class='text-film'>$obj->overview</h4><br>
      <div class='other-infos'>
        <h3>Nota: $obj->vote_average ($obj->vote_count votos)</h3>
        <h3>Data de Lançamento: $obj->release_date</h3>
        <h3>Linguagem original: $obj->original_language</h3>
      </div>
  </div>
  ";
  ?><br><br>
</body>

</html>