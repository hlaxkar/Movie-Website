<?php


$base_url = '/discover/movie?sort_by=popularity.desc&';
$similar = 'https://api.themoviedb.org/3/movie/475/recommendations?api_key=7432355f4f5f5ce12ec85408a877ac57&language=en-US&page=1';

if (isset($_GET['q1']) && ($_GET['q1'] != "")) {
  $movie_url = '/movie/' . $_GET['q1'] . '?';
} else {
  $movie_url = '/movie/550?';
}


$lang = '&language=en-US';

function getData($base)
{
  // $url = createurl($base);
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $base,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache"
    ),
  ));

  $response = curl_exec($curl);
  //$err = curl_error($curl);

  curl_close($curl);

  $r = json_decode($response, true);
  return $r;
}


function createurl($base)
{
  $API_KEY = 'api_key=7432355f4f5f5ce12ec85408a877ac57&';
  $API_URL = 'https://api.themoviedb.org/3';
  $urls = array(
    'movie' => '/movie/550?',
    'similar' => 'recommendations?',
    'popular' => '/discover/movie?sort_by=popularity.desc&'

  );

  $url =  $API_URL . $urls[$base] . $API_KEY . "append_to_response=images";
  return $url;
}
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => createurl('movie'),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$r = json_decode($response, true); //because of true, it's in an array
//print_r($response2);
$bg = 'https://image.tmdb.org/t/p/original' . $r["backdrop_path"];
$bg2 = 'https://image.tmdb.org/t/p/original' . $r['images']['backdrops'][5]['file_path'];


//https://api.themoviedb.org/3/movie/{movie_id}/images?api_key=<<api_key>>&language=en-US
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/Grid.css" rel="stylesheet" />
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
        <div class="logo">LOGO</div>

        <form action="?" method="get">
          <div class="searchbar">
            <input type="text" class="Search" name="q1" id="q1" placeholder="Enter Search Term..." id="Search">
          </div>
        </form>
        <div class="header-links">Link1</div>
        <div class="header-links">Link2</div>


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
      <span class="title-buttons">

        <a href="#">IMDb <?php echo $r['vote_average']; ?></a>
      </span>
      <span class="title-buttons">

        <a href="#">Watch Later</a>
      </span>

    </div>
    <!-- //Top Tile END -->

    <div class="info-box">
      <div class="Movieinfo">
        <div class="container">
          <div class="Summery">
            <h2>Storyline</h2>
            <br>
            <p><?php echo $r['overview']; ?>
            </p>
          </div>
          <div class="Watch-Options">
            <h3>Watch on:</h3>
            <br>
            <button type="submit">Prime</button>
            <i class="fa fa-video-camera" aria-hidden="true"></i>

          </div>
          <div class="PosterButton">
            <div class="Poster">
              <img src=<?php echo ('"https://image.tmdb.org/t/p/w500' . $r['poster_path'] . '"') ?> alt="Movie Poster" />
            </div>
            <div class="Buttons">
              <a class="sidebuttons" href="#"><span><i class="fa fa-heart" style="color: #f7484f;" aria-hidden="true"></i>Watched</span></a><a class="sidebuttons" href="#"><span><i class="fa fa-plus
              " aria-hidden="true"></i> Add to list</span></a><a class="sidebuttons" href="#"><span><i class="fa fa-dot-circle-o" aria-hidden="true"></i> </span>Translate</a>

            </div>
            <div class="Commentbox">
              <a class="sidebuttons" href="#" <i class="fa fa-comments" aria-hidden="true"></i>>Show Comments</a>

            </div>
          </div>
          <div class="MovieDetails">
            <div class="Details">
              <h2>Details</h2>
              <br>
              <p>
                Director: Josh Ruben <br>
                Writer: Mishna Wolff <br>
                Stars: Sam Richardson, Milana Vayntrub

              </p>

            </div>
            <div class="Cast">
              <h2>Cast</h2>
              <br>
              <ul>
                <li>Keanu Reaves</li>
                <li>Akshay Kumar</li>
                <li>Keanu Reaves</li>
                <li>Keanu Reaves</li>
                <li>Keanu Reaves</li>
              </ul>
            </div>
            <div class="TitleDetails">
              <div class="filmTitle">
                <h2><?php echo $r['original_title']; ?></h2>
              </div>
              <div class="OneLine"><?php echo $r['tagline']; ?></div>

              <div class="Genres">
                <span>
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </span>

                <span>
                  <?php

                  echo (number_format($r['vote_count']));
                  ?>

                </span>
                <span>
                  <?php
                  foreach ($r['genres'] as $n) {
                    echo ($n['name'] . ",");
                  } ?>
                </span>

              </div>
            </div>
          </div>
          <div class="otherbutton"></div>


        </div>
      </div>
      <!-- ====Similar Movies grid==== -->
      <div class="similarmovies">
        
        <h3 style="font-weight: bold;"><i class="fa fa-film" aria-hidden="true"></i>Similar Movies</h3>
        
        <div class="suggestions">
          <?php
          $simres = getData($similar);


          $i = 0;
          foreach ($simres['results'] as $s) {
            if ($i == 6) {
              break;
            }

          ?>

            <div class="similarposters">
              <img src=<?php echo ('"https://image.tmdb.org/t/p/w500' . $s['poster_path'] . '"') ?> alt="poster" srcset="">
              <div class="caption"> <?php echo ($s['title']); ?>

                <span><?php echo ($s['vote_average']); ?></span>
              </div>

            </div>

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
background-size: cover;
  
  
  ">
    <div class="comment-pannel">
      <h1>Reviews</h1>
      <div class="comment-form">
        Lorem, ipsum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, possimus. Quasi officiis atque
        nostrum, minima eum voluptate maxime inventore itaque. <br>



      </div>

      <div class="comments">

        <article class="comment-review">
          <div class="user">
            <div class="avatar">
              <img src="img/avatar (1).jpg" alt="avatar">

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
              <img src="img/avatar (1).jpg" alt="avatar">

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
              <img src="img/avatar (1).jpg" alt="avatar">

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


</body>
<footer>Made by Harshit Laxkar aka Lord Duck</footer>

</html>