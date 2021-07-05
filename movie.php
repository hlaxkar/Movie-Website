<?php
session_start();
require('php/getdata.php');
require('php/connect.php');

if (isset($_GET['q1']) && ($_GET['q1'] != "")) {
  $movieID =  $_GET['q1'];
} else {
  $movieID = '550';
}

$r = getData(createurl('movie', $movieID));
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

$log = mysqli_query($conn, 'select * from reviews where movid = "' . $_GET['q1'] . '" order by revid DESC limit 3');
$num = mysqli_num_rows($log);


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/Grid.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/logout.css">
  <link href="css/grid2.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/comments.css">

  <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
  <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>

  <script src="js/JQuery3.3.1.js" async></script>
  <script src="js/logout.js" async></script>
  <script>
    function watched(movid) {

      $.ajax({
        url: 'php/insert-review.php',
        type: 'post',
        data: 'movid=' + movid + '&type=watched',
        success: function(output) {
          alert(output);
        },
        error: function() {
          alert('something went wrong, rating failed');
        }
      });

    }

    function tolist(movid) {

      $.ajax({
        url: 'php/tolist.php',
        type: 'post',
        data: 'movid=' + movid + '&type=tolist',
        success: function(output) {
          alert(output);
        },
        error: function() {
          alert('something went wrong, rating failed');
        }
      });

    }
  </script>
  <title><?= $r['title'] ?></title>
</head>

<body>

  <!-- Big Poster Header -->
  <div class="big-poster" style="background-image: url('<?php echo $bg ?>');">

    <!--====== Navigation bar==== -->

    <div class="header">
      <div class="inner-Header">
        <span class="logo"><a href="index.php">
            <div class="nav-logo"></div>
          </a>
        </span>


        <span class="searchbar">
          <form action="search.php" method="get">
            <input type="text" class="Search fa" name="q1" id="q1" placeholder="&#xF002;  Search Movie" id="Search">

          </form>
        </span>

        <?php if (isset($_SESSION['username'])) {
        ?>

          <div class="background background--light">
            <button onclick="location.href='login.php?action=logout';" class="logoutButton logoutButton--dark">
              <svg class="doorway" viewBox="0 0 100 100">
                <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z" />
                <path class="bang" d="M40.5 43.7L26.6 31.4l-2.5 6.7zM41.9 50.4l-19.5-4-1.4 6.3zM40 57.4l-17.7 3.9 3.9 5.7z" />
              </svg>
              <svg class="figure" viewBox="0 0 100 100">
                <circle cx="52.1" cy="32.4" r="6.4" />
                <path d="M50.7 62.8c-1.2 2.5-3.6 5-7.2 4-3.2-.9-4.9-3.5-4-7.8.7-3.4 3.1-13.8 4.1-15.8 1.7-3.4 1.6-4.6 7-3.7 4.3.7 4.6 2.5 4.3 5.4-.4 3.7-2.8 15.1-4.2 17.9z" />
                <g class="arm1">
                  <path d="M55.5 56.5l-6-9.5c-1-1.5-.6-3.5.9-4.4 1.5-1 3.7-1.1 4.6.4l6.1 10c1 1.5.3 3.5-1.1 4.4-1.5.9-3.5.5-4.5-.9z" />
                  <path class="wrist1" d="M69.4 59.9L58.1 58c-1.7-.3-2.9-1.9-2.6-3.7.3-1.7 1.9-2.9 3.7-2.6l11.4 1.9c1.7.3 2.9 1.9 2.6 3.7-.4 1.7-2 2.9-3.8 2.6z" />
                </g>
                <g class="arm2">
                  <path d="M34.2 43.6L45 40.3c1.7-.6 3.5.3 4 2 .6 1.7-.3 4-2 4.5l-10.8 2.8c-1.7.6-3.5-.3-4-2-.6-1.6.3-3.4 2-4z" />
                  <path class="wrist2" d="M27.1 56.2L32 45.7c.7-1.6 2.6-2.3 4.2-1.6 1.6.7 2.3 2.6 1.6 4.2L33 58.8c-.7 1.6-2.6 2.3-4.2 1.6-1.7-.7-2.4-2.6-1.7-4.2z" />
                </g>
                <g class="leg1">
                  <path d="M52.1 73.2s-7-5.7-7.9-6.5c-.9-.9-1.2-3.5-.1-4.9 1.1-1.4 3.8-1.9 5.2-.9l7.9 7c1.4 1.1 1.7 3.5.7 4.9-1.1 1.4-4.4 1.5-5.8.4z" />
                  <path class="calf1" d="M52.6 84.4l-1-12.8c-.1-1.9 1.5-3.6 3.5-3.7 2-.1 3.7 1.4 3.8 3.4l1 12.8c.1 1.9-1.5 3.6-3.5 3.7-2 0-3.7-1.5-3.8-3.4z" />
                </g>
                <g class="leg2">
                  <path d="M37.8 72.7s1.3-10.2 1.6-11.4 2.4-2.8 4.1-2.6c1.7.2 3.6 2.3 3.4 4l-1.8 11.1c-.2 1.7-1.7 3.3-3.4 3.1-1.8-.2-4.1-2.4-3.9-4.2z" />
                  <path class="calf2" d="M29.5 82.3l9.6-10.9c1.3-1.4 3.6-1.5 5.1-.1 1.5 1.4.4 4.9-.9 6.3l-8.5 9.6c-1.3 1.4-3.6 1.5-5.1.1-1.4-1.3-1.5-3.5-.2-5z" />
                </g>
              </svg>
              <svg class="door" viewBox="0 0 100 100">
                <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z" />
                <circle cx="66" cy="50" r="3.7" />
              </svg>
              <span class="button-text">Log Out</span>
            </button>

          </div>
        <?php  } else { ?>

          <a href="login.php"> Login/Signup</a>

        <?php } ?>




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

        <div class="info-container">
          <div class="posterside">

            <div class="Poster">
              <img src=<?php echo ('"https://image.tmdb.org/t/p/w500' . $r['poster_path'] . '"') ?> alt="<?= $r['title'] ?>" id="poster" onerror="this.onerror=null;this.src='img/default_poster.jpg';" />
              <div class="overlay" id="overlay">
                <div class="expandtext"><i class="fa fa-expand" aria-hidden="true"></i> Expand</div>
              </div>

            </div>
            <div class="Buttons">
              <a class="sidebuttons" onclick="watched(<?= $_GET['q1'] ?>); event.preventDefault();" href="#"><span><i class="fa fa-heart" style="color: #f7484f;" aria-hidden="true"></i>Watched</span></a>
              <a class="sidebuttons" href="#" onclick="tolist(<?= $_GET['q1'] ?>); event.preventDefault();"><span><i class=" fa fa-plus" aria-hidden="true"></i> Add to list</span></a>
              <a class="sidebuttons" href="#"><span><i class="fa fa-dot-circle-o" aria-hidden="true"></i> </span>Translate</a>

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
                      <li><b><i class="fa fa-video-camera" aria-hidden="true"></i> Director: </b><a href="#"><?php if (isset($director)) { echo $director; } else { echo 'NA';} ?></a> </li>
                      <li><b><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Release Date: </b><a href="#"> <?php if (isset($date)) { echo date_format($date, "j M Y"); } else { echo 'NA'; } ?></a></li>
                      <li><b><i class="fa fa-globe" aria-hidden="true"></i> Country: </b><a href="#"> <?php if (isset($r['production_countries'][0]['name'])) { echo  $r['production_countries'][0]['name']; } else { echo 'NA';} ?></a></li>
                      <li><b><i class="fa fa-language" aria-hidden="true"></i> Language: </b><a href="#"><?php if (isset($r['spoken_languages'][0]['english_name'])) {echo $r['spoken_languages'][0]['english_name']; } else { echo 'NA'; }  ?></a></li>
                    </ul>
                    </p>

                  </div>
                  <div class="cast">
                    <h2>Cast</h2>
                    <br>
                    <ul>
                      <?php
                      $i = 0;
                      if (isset($r['credits']['cast'][0])) {
                        foreach ($r['credits']['cast'] as $cast) {
                          if ($i == 5) {
                            break;
                          }
                      ?>
                          <li> <span><img src="<?= $imgbase . $cast['profile_path'] ?>" alt="img" onerror="this.onerror=null;this.src='img/user.png';"></span> <?= $cast['name'] ?></li>

                        <?php $i++;
                        }
                      } else { ?>

                        <li>
                          <h3> No cast info available</h3>
                        </li>
                      <?php } ?>
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
                      <i class="fa fa-star" aria-hidden="true" style='color: #ffc83d;'></i> <?= number_format((float)$r['vote_average'], 1, '.', ''); ?>
                    </span>
                    <?php if($r['adult']=='true'){?>
                      <span>Adult</span>
                      <?php }?>
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
          if (isset($simres['results'][0])) {

            $i = 0;

            foreach ($simres['results'] as $s) {
              if ($i == 6) {
                break;
              }

          ?>
              <a href="movie.php?q1=<?= $s['id'] ?>">
                <div class="similarposters">
                  <img src=<?php echo ('"https://image.tmdb.org/t/p/w500' . $s['poster_path'] . '"') ?> alt="poster" srcset="" onerror="this.onerror=null;this.src='img/default_poster.jpg';">
                  <div class="caption"> <?php echo ($s['title']); ?>

                    <span><?php echo (number_format((float)$s['vote_average'], 1, '.', '')); ?></span>
                  </div>

                </div>
              </a>
          <?php
              $i++;
            }
          } else {
            echo '<h3>No similar movies found </h3>';
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

      <div>
        <div class="comment-form">
          <?php if (!isset($_SESSION['uid'])) {
          ?>
            <div class="blocker">
              <a href="login.php" style="color: #fcbe11;">Login to post review </a>
            </div>
          <?php } ?>
          <form action="php/insert-review.php" method="POST" id="my-form">
            <table class="unstyledTable">
              <tbody>
                <tr>
                  <td><label for="q-title">One Line:</label></td>
                  <td><input type="text" value="" placeholder="Enter Title" name="q-title" id="q-title"></td>
                </tr>
                <tr>
                  <td><label for="q-rate">Your Rating:</label></td>
                  <td><input type="number" max="10" min="0" id="q-rating" name="q-rating" placeholder="0"> / 10
                  </td>
                </tr>
                <tr>
                  <td><label for="q-review">Your view of the movie:</label></td>
                  <td><textarea id="q-review" name="comment" id="" cols="30" rows="5" class="comment-box" placeholder="Enter your Review of the movie"></textarea></td>
                </tr>
              </tbody>
            </table>
            <input id="movid" type="text" name="movid" value="<?= $_GET['q1'] ?>" hidden>
            <button id="q-submit" type="submit" name="revsub"> submit</button>
          </form>
        </div>

        <div class="comments">
          <?php
          if ($num > 0) {
            while ($row = mysqli_fetch_array($log)) {
          ?>

              <article class="comment-review">
                <div class="user">
                  <div class="avatar">
                    <img src="img/avatar1.jpg" alt="avatar">

                  </div>
                  <h5>Robert Pattinson</h5>

                  <h6>Top Critic</h6>
                </div>
                <div class="review">
                  <div class="rev-title">
                    <span>
                      <h2><?= $row['title'] ?></h2>
                    </span>
                    <span class="userscore">
                      <span>
                        &#11088; <?= $row['rating'] ?>
                      </span>

                  </div>

                  <p>
                    <?= $row['review'] ?></p>
                </div>
              </article>


          <?php }
          }


          ?>


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
                &#11088; 8.9
              </span>
              <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta odit autem aut nostrum temporibus sunt illum
                optio molestiae corporis. Repellat incidunt at iure repellendus molestias, omnis eveniet cupiditate autem
                dicta? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum, quo iure in sapiente ad debitis,
                ipsa aspernatur possimus enim eum excepturi sit optio itaque, voluptatum quasi doloremque. Nobis, cupiditate
                sapiente?</p>
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

  <footer class="bootstrap-wrapper site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6>About</h6>
          <p class="text-justify">ScreenDuck.com is a Movie & TV show Tracking Website.
            That lets you keep track of every film you've watched.
            Members can rate films, write and share reviews and follow friends and other members to read theirs.
            Compile and share lists of films on any topic and keep a watchlist of films to see.
          </p>
        </div>



        <div class="col-xs-6 col-md-3">
          <h6>Quick Links</h6>
          <ul class="footer-links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Contribute</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Sitemap</a></li>
          </ul>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by
            <a href="#">ScreenDuck</a>.
          </p>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="github" href="https://github.com/hlaxkar"><i class="fa fa-github"></i></a></li>
            <li><a class="linkedin" href="https://www.linkedin.com/in/hlaxkar/"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

</body>


</html>