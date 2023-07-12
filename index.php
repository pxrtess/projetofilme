<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Filmes</title>
  <link href="css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="icon" href="/imgs/android-chrome-192x192.png">
</head>

<body style="background-color: #383837;">
  <nav class="navbar navbar-expand-lg navbar-dark" style="height: 100px; background-color:black;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="imgs/logo.jpg" style="width: 170px;"></a>
      <form class="d-flex" action="index.php" method="post">
        <input class="form-control me-sm-2" type="get" placeholder="Pesquisar" id="pesquisa" name="pesquisa">
        <button class="btn btn-warning my-2 my-sm-0" type="submit">Enviar</button>
      </form>
    </div>
  </nav><br><br>
  <br>
    <?php
     session_start();
     if (isset($_POST['pesquisa'])) {
       echo "<h1 class='text-center fw-bold fs-1' style='color:white; margin-bottom: 1em;'>Resultados</h1>";
       $key = "2fab3c0db7da9c4e910f9d8d427904f4";
 
       $pesquisa = $_POST['pesquisa'];
 
       $url = "http://api.themoviedb.org/3/search/movie?query={$pesquisa}&api_key={$key}&language=pt-BR";
       $json = file_get_contents($url);
       $obj = json_decode($json);
       $total_pages = $obj->total_pages;
 
       $filmes = array();
 
       for ($x = 1; $x <= 1; $x++) {
         $url_single = "http://api.themoviedb.org/3/search/movie?query={$pesquisa}&api_key={$key}&language=pt-BR&page={$x}";
         $json_single = file_get_contents($url_single);
         $obj_single = json_decode($json_single);
 
         foreach ($obj_single->results as $resultado) {
           $filmes[] = $resultado;
         }
       }
 
       echo "<div class='filmes row' style='margin-inline:auto;'>";
 
       foreach ($filmes as $resultado) {
         echo "
           <div class='filme col-sm-2'>
             <a href='movie.php?id=$resultado->id'>
               <div class='card' style='background: #565655;'>
                 <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' alt='...'>
               </div><br>
             </a>
           </div>";
       }
 
       echo "</div>";
     } else {
      echo "<h1 class='text-center fw-bold fs-1' style='color:white; margin-bottom: 1em;'>Populares</h1>";
          echo "<div class='text-center lista'>
          <div id='carouselExample' class='carousel slide' data-bs-ride='carousel'>
            <div class='carousel-inner filmes'>";
          $key = "c7ab045a7a61bb551d1eea508a6d67c2";

          $filmes = array();

          for ($x = 1; $x <= 5; $x++) {
            $url_single = "https://api.themoviedb.org/3/movie/popular?api_key={$key}&language=pt-BR&page={$x}";
            $json_single = file_get_contents($url_single);
            $obj_single = json_decode($json_single);

            foreach ($obj_single->results as $resultado) {
              $filmes[] = $resultado;
            }
          }

          $grupos = array_chunk($filmes, 6);
          $active = true;

          foreach ($grupos as $grupo) {
            $activeClass = $active ? 'active' : '';
            echo "<div class='carousel-item $activeClass'>";
            echo "<div class='row'>";

            foreach ($grupo as $resultado) {
              echo "
                <div class='filme col-sm-2'>
                  <a href='movie.php?id=$resultado->id'>
                    <div class='card' style='background: #565655;'>
                      <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' alt='...'>
                    </div><br>
                  </a>
                </div>";
            }

            echo "</div>";
            echo "</div>";
            $active = false;
          }
          echo"</div>
          <button class='carousel-control-prev' type='button' data-bs-target='#carouselExample' data-bs-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Previous</span>
          </button>
          <button class='carousel-control-next' type='button' data-bs-target='#carouselExample' data-bs-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Next</span>
          </button>
        </div>";



      echo "<br><br><h1 class='text-center fw-bold fs-1' style='color:white; margin-bottom: 1em;'>Bem Avaliados</h1>";

          echo "
          <div id='carouselExample2' class='carousel slide' data-bs-ride='carousel'>
            <div class='carousel-inner filmes'>";
          $key = "c7ab045a7a61bb551d1eea508a6d67c2";

          $filmes = array();

          for ($x = 1; $x <= 5; $x++) {
            $url_single = "https://api.themoviedb.org/3/movie/top_rated?api_key={$key}&language=pt-BR&page={$x}";
            $json_single = file_get_contents($url_single);
            $obj_single = json_decode($json_single);

            foreach ($obj_single->results as $resultado) {
              $filmes[] = $resultado;
            }
          }

          $grupos = array_chunk($filmes, 6);
          $active = true;

          foreach ($grupos as $grupo) {
            $activeClass = $active ? 'active' : '';
            echo "<div class='carousel-item $activeClass'>";
            echo "<div class='row'>";

            foreach ($grupo as $resultado) {
              echo "
                <div class='filme col-sm-2'>
                  <a href='movie.php?id=$resultado->id'>
                    <div class='card' style='background: #565655;'>
                      <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' alt='...'>
                    </div><br>
                  </a>
                </div>";
            }

            echo "</div>";
            echo "</div>";
            $active = false;
          }
          echo"</div>
          <button class='carousel-control-prev' type='button' data-bs-target='#carouselExample2' data-bs-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Previous</span>
          </button>
          <button class='carousel-control-next' type='button' data-bs-target='#carouselExample2' data-bs-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Next</span>
          </button>
        </div>";


      echo "<br><br><h1 class='text-center fw-bold fs-1' style='color:white; margin-bottom: 1em;'>Proximos Lancamentos</h1>";

          echo "
          <div id='carouselProximosLancamentos' class='carousel slide' data-bs-ride='carousel'>
            <div class='carousel-inner filmes'>";
          $key = "c7ab045a7a61bb551d1eea508a6d67c2";

          $filmes = array();

          for ($x = 1; $x <= 5; $x++) {
            $url_single = "https://api.themoviedb.org/3/movie/upcoming?api_key={$key}&language=pt-BR&page={$x}";
            $json_single = file_get_contents($url_single);
            $obj_single = json_decode($json_single);

            foreach ($obj_single->results as $resultado) {
              $filmes[] = $resultado;
            }
          }

          $grupos = array_chunk($filmes, 6);
          $active = true;

          foreach ($grupos as $grupo) {
            $activeClass = $active ? 'active' : '';
            echo "<div class='carousel-item $activeClass'>";
            echo "<div class='row'>";

            foreach ($grupo as $resultado) {
              echo "
                <div class='filme col-sm-2'>
                  <a href='movie.php?id=$resultado->id'>
                    <div class='card' style='background: #565655;'>
                      <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' alt='...'>
                    </div><br>
                  </a>
                </div>";
            }

            echo "</div>";
            echo "</div>";
            $active = false;
          }
          echo"</div>
          <button class='carousel-control-prev' type='button' data-bs-target='#carouselProximosLancamentos' data-bs-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Previous</span>
          </button>
          <button class='carousel-control-next' type='button' data-bs-target='#carouselProximosLancamentos' data-bs-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Next</span>
          </button>
        </div>";
        }
        ?>
      
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2Eq..."></script>
</body>

</html>
