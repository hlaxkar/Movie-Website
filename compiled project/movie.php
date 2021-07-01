<?php
session_start();
require('php/getdata.php');

if (isset($_GET['q1']) && ($_GET['q1'] != "")) {
  $movieID =  $_GET['q1'];
} else {
  $movieID = '550';
}

$r= getData(createurl('movie', $movieID));
$imgbase = 'https://image.tmdb.org/t/p/original';

$num =  count($r['images']['backdrops']);
if ($num != 0) {

  $bg = $imgbase . $r['images']['backdrops'][mt_rand(0, $num - 1)]['file_path'];
  $bg2 = $imgbase . $r['images']['backdrops'][mt_rand(0, $num - 1)]['file_path'];
}

$date = date_create($r['release_date']);
foreach ($r['credits']['crew'] as $crew) {

  if (isset($director)) {
    break;
  } elseif ($crew['job'] == 'Director') {
    $director = $crew['name'];
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/Grid.css" rel="stylesheet" />
  <link href="css/grid2.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/comments.css">
  <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
  <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>
  <title>Movie Ducks</title>
</head>

<body>

  <!-- Big Poster Header -->
  <div class="big-poster" style="background-image: url('<?php echo $bg ?>');">

    <!--====== Navigation bar==== -->

    <div class="header">
      <div class="inner-Header">
        <span class="logo">LOGO</span>

        
          <span class="searchbar"><form action="search.php" method="get">
            <input type="text" class="Search fa" name="q1" id="q1" placeholder="&#xF002;  Search Movie" id="Search">
          
        </form></span>
        <a href="#" role="button" class="header-links">Logout</a>
        


      </div>
    </div>
    <!--====== //Navigation bar==== -->



  </div>
  <!-- ===Movie Info Starts==== -->
  <div class="info">

    <!-- Top Title -->
    <div class="info-top">
      <span class="title">
        <!-- John Wick 3-->
        <?php echo $r['title']; ?>
      </span>
      <a href="#" class="imdb">
      <span class="imdb title-buttons ">

        IMDb <?php echo (number_format((float)$r['vote_average'], 1, '.', '')); ?>
      </span></a>
     <a href="#"> <span class="title-buttons">

        Watch Later
      </span></a>

    </div>
    <!-- //Top Tile END -->

    <div class="info-box">
      <div class="Movieinfo">

        <div class="container">
          <div class="posterside">

            <div class="Poster">
              <img src=<?php echo ('"https://image.tmdb.org/t/p/w500' . $r['poster_path'] . '"') ?> alt="<?= $r['title'] ?>" id="poster" onerror="this.onerror=null;this.src='img/default_poster.jpg';" />
              <div class="overlay" id="overlay">
                <div class="expandtext"><i class="fa fa-expand" aria-hidden="true"></i> Expand</div>
              </div>

            </div>
            <div class="Buttons">
              <a class="sidebuttons" href="#"><span><i class="fa fa-heart" style="color: #f7484f;" aria-hidden="true"></i>Watched</span></a><a class="sidebuttons" href="#"><span><i class="fa fa-plus
            " aria-hidden="true"></i> Add to list</span></a><a class="sidebuttons" href="#"><span><i class="fa fa-dot-circle-o" aria-hidden="true"></i> </span>Translate</a>

            </div>


          </div>
          <div class="infoside">
            <div class="summery">
              <h2>Storyline</h2>
              <br>
              <p><?php echo $r['overview']; ?>
              </p>

            </div>
            <div class="movieinfo">
              <div class="info1">
                <div class="Details-cast">
                  <div class="details">
                    <h2>Details</h2>
                    <br>
                    <p>
                    <ul>
                      <li><b><i class="fa fa-video-camera" aria-hidden="true"></i> Director: </b><a href="#"><?= $director; ?></a> </li>
                      
                      <li><b><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Release Date: </b><a href="#"> <?= date_format($date, "j M Y"); ?></a></li>
                      <li><b><i class="fa fa-globe" aria-hidden="true"></i> Country: </b><a href="#"> <?= $r['production_countries'][0]['name']  ?></a></li>
                      <li><b><i class="fa fa-language" aria-hidden="true"></i> Language: </b><a href="#"><?= $r['spoken_languages'][0]['english_name'] ?></a></li>
                    </ul>
                    </p>

                  </div>
                  <div class="cast">
                    <h2>Cast</h2>
                    <br>
                    <ul>
                      <li> <span><img src="<?= $imgbase . $r['credits']['cast'][0]['profile_path'] ?>" alt="img" onerror="this.onerror=null;this.src='img/user.png';"></span> <?= $r['credits']['cast'][0]['name'] ?></li>
                      <li> <span><img src="<?= $imgbase . $r['credits']['cast'][1]['profile_path'] ?>" alt="img" onerror="this.onerror=null;this.src='img/user.png';"></span> <?= $r['credits']['cast'][1]['name'] ?></li>
                      <li> <span><img src="<?= $imgbase . $r['credits']['cast'][2]['profile_path'] ?>" alt="img" onerror="this.onerror=null;this.src='img/user.png';"></span> <?= $r['credits']['cast'][2]['name'] ?></li>
                      <li> <span><img src="<?= $imgbase . $r['credits']['cast'][3]['profile_path'] ?>" alt="img" onerror="this.onerror=null;this.src='img/user.png';"></span> <?= $r['credits']['cast'][3]['name'] ?></li>
                      <li> <span><img src="<?= $imgbase . $r['credits']['cast'][4]['profile_path'] ?>" alt="img" onerror="this.onerror=null;this.src='img/user.png';"></span> <?= $r['credits']['cast'][4]['name'] ?></li>
                    </ul>
                  </div>
                </div>
                <div class="titlepart">
                  <div class="filmTitle">
                    <h2><?php echo $r['original_title']; ?></h2>
                  </div>
                  <div class="OneLine"><?php echo $r['tagline']; ?></div>

                  <div class="Genres">

                    <i class="fa fa-eye" aria-hidden="true"></i>


                    <span class="vote-count">
                      <?php

                      echo (number_format($r['vote_count']));
                      ?>

                    </span>
                    <span>
                      <?php
                      foreach ($r['genres'] as $n) {
                        echo ($n['name'] . ", ");
                      } ?>
                    </span>
                    <span>
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                      <?= $r['runtime'] . " min" ?>

                    </span>
                    <span>
                      <i class="fa fa-star" aria-hidden="true"></i> <?= number_format((float)$r['vote_average'], 1, '.', ''); ?>
                    </span>

                  </div>



                </div>
              </div>
              <div class="watchopts">

                <h2>Available on:</h2>

                <div class="button">
                  <a class="a" href="#">NETFLIX</a>
                  <div class="background__button"></div>
                </div>
              </div>
            </div>
          </div>
        </div>





      </div>
      <!-- ====Similar Movies grid==== -->
      <div class="similarmovies">

        <h3 style="font-weight: bold;"><i class="fa fa-film" aria-hidden="true"></i>Similar Movies</h3>

        <div class="suggestions">
          <?php
          $simres = getData(createurl('similar', $movieID));


          $i = 0;
          foreach ($simres['results'] as $s) {
            if ($i == 6) {
              break;
            }

          ?>
            <a href="movie.php?q1=<?= $s['id'] ?>">
              <div class="similarposters">
                <img src=<?php echo ('"https://image.tmdb.org/t/p/w500' . $s['poster_path'] . '"') ?> alt="poster" srcset="">
                <div class="caption"> <?php echo ($s['title']); ?>

                  <span><?php echo (number_format((float)$s['vote_average'], 1, '.', '')); ?></span>
                </div>

              </div>
            </a>
          <?php
            $i++;
          }

          ?>



        </div>

      </div>
      <!-- ====//Similar Movies grid END==== -->
    </div>
  </div>


  <div class="comment-container" style="background: linear-gradient( rgb(0 0 0), rgb(0 0 0 / 14%)), url(<?php echo $bg2; ?>);
  
          background-repeat: no-repeat;
          background-position: bottom;
          background-size: cover;">
    <div class="comment-pannel">
      <h1>Rate and Reviews</h1>
      <div class="comment-form">
        <textarea name="comment" id="" cols="30" rows="5" class="comment-box" placeholder="Enter your Review of the movie"></textarea>


      </div>

      <div class="comments">

        <article class="comment-review">
          <div class="user">
            <div class="avatar">
              <img src="img/avatar1.jpg" alt="avatar">

            </div>
            <h5>Robert Pattinson</h5>

            <h6>Top Critic</h6>
          </div>
          <div class="review">
            <span>
              <h2>Great work!</h2>
            </span>
            <span class="userscore">
              8.9
            </span>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta odit autem aut nostrum temporibus sunt illum
            optio molestiae corporis. Repellat incidunt at iure repellendus molestias, omnis eveniet cupiditate autem
            dicta? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum, quo iure in sapiente ad debitis,
            ipsa aspernatur possimus enim eum excepturi sit optio itaque, voluptatum quasi doloremque. Nobis, cupiditate
            sapiente?
          </div>
        </article>


        <article class="comment-review">
          <div class="user">
            <div class="avatar">
              <img src="img/avatar1.jpg" alt="avatar">

            </div>
            <h5>Robert Pattinson</h5>

            <h6>Top Critic</h6>
          </div>
          <div class="review">
            <span>
              <h2>Great work!</h2>
            </span>
            <span class="userscore">
              8.9
            </span>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta odit autem aut nostrum temporibus sunt illum
            optio molestiae corporis. Repellat incidunt at iure repellendus molestias, omnis eveniet cupiditate autem
            dicta? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum, quo iure in sapiente ad debitis,
            ipsa aspernatur possimus enim eum excepturi sit optio itaque, voluptatum quasi doloremque. Nobis, cupiditate
            sapiente?
          </div>
        </article>
        <article class="comment-review">
          <div class="user">
            <div class="avatar">
              <img src="img/avatar1.jpg" alt="avatar">

            </div>
            <h5>Robert Pattinson</h5>

            <h6>Top Critic</h6>
          </div>
          <div class="review">
            <span>
              <h2>Great work!</h2>
            </span>
            <span class="userscore">
              8.9
            </span>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta odit autem aut nostrum temporibus sunt illum
            optio molestiae corporis. Repellat incidunt at iure repellendus molestias, omnis eveniet cupiditate autem
            dicta? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum, quo iure in sapiente ad debitis,
            ipsa aspernatur possimus enim eum excepturi sit optio itaque, voluptatum quasi doloremque. Nobis, cupiditate
            sapiente?
            <br>

          </div>
        </article>



        <a href="#" class="showmore-btn">
          <div class="showmore">

            <span>
              <h4>Show More</h4>
            </span>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div id="expandimage" class="modal">

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
  </div>



  <script>
    let button = document.querySelector('.button');
    let testA = document.querySelector('.a');
    let backgroundButton = document.querySelector('.background__button');

    button.addEventListener('mouseenter', function() {
      testA.classList.add('is-white')
      backgroundButton.classList.add('is-hover');
    });

    button.addEventListener('mouseleave', function() {
      testA.classList.remove('is-white')
      backgroundButton.classList.remove('is-hover');
    });




    // Get the modal
    var modal = document.getElementById("expandimage");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var overlay = document.getElementById('overlay');
    var img = document.getElementById("poster");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    overlay.onclick = function() {
      modal.style.display = "block";
      modalImg.src = img.src;
      captionText.innerHTML = img.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
  </script>
</body>
<footer>Made by Harshit Laxkar aka Lord Duck</footer>

</html>