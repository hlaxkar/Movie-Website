<?php
$API_KEY='api_key=7432355f4f5f5ce12ec85408a877ac57&';
$API_URL='https://api.themoviedb.org/3';
$base_url = '/discover/movie?sort_by=popularity.desc&';
$similar='https://api.themoviedb.org/3/movie/550/recommendations?api_key=7432355f4f5f5ce12ec85408a877ac57&language=en-US&page=1
';

$movie_url = '/movie/4515?';
$lang='&language=en-US';



    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $API_URL.$movie_url.$API_KEY.$lang,
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
    $bg = 'https://image.tmdb.org/t/p/original'.$r["backdrop_path"] ;

  
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/Grid.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
  <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>
  <title>Movie Ducks</title>
</head>

<body>
  <div class="big-poster" style="background-image: url('<?php echo $bg?>');" >
    <div class="header">
      <div class="inner-Header">
        <div class="logo">LOGO</div>
        <div class="searchbar"><input type="text" class="Search" name="Search" placeholder="Enter Search Term..." id="Search"></div>
        <div class="header-links">Link1</div>
        <div class="header-links">Link2</div>


      </div>
    </div>


    <img src="img/spider.jpg" alt="imgae" style="display: none;">

  </div>

  <div class="info">
    <div class="info-top">
      <span class="title">
        <!-- John Wick 3-->
        <?php echo $r['title'];?>
  </span> 
      <span class="title-buttons">

        <a href="#">IMDb <?php echo $r['vote_average'];?></a>
      </span>
      <span class="title-buttons">
 
        <a href="#">Watch Later</a>
      </span>

    </div>
    <div class="info-box">
      <div class="Movieinfo">
        <div class="container">
          <div class="Summery">
            <h2>Storyline</h2>
            <br>
            <p><?php echo $r['overview'];?>
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
              <img src=<?php echo('"https://image.tmdb.org/t/p/w500'. $r['poster_path'].'"') ?> alt="Movie Poster" />
            </div>
            <div class="Buttons">
              <button>Lorem, ipsum dolor.</button><button>Voluptate, sed. Nihil.</button><button>Provident, at
                quidem.</button>

            </div>
            <div class="Commentbox">
              <h3>Show comments:</h3>
              <br>
              <i class="fa fa-comments" aria-hidden="true"></i>
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
                <li>Keanu Reaves</li>
                <li>Keanu Reaves</li>
                <li>Keanu Reaves</li>
                <li>Keanu Reaves</li>
              </ul>
            </div>
            <div class="TitleDetails">
              <div class="filmTitle">
                <h2><?php echo $r['original_title'];?></h2>
              </div>
              <div class="OneLine"><?php echo $r['tagline'];?></div>

              <div class="Genres">
                
              
              
              <?php
              
              foreach($r['genres'] as $n ){
                echo($n['name'].", ");
              }
              
              
              
              
              ?></div>
            </div>
          </div>
          <div class="otherbutton"></div>



        </div>


      </div>

      <div class="similarmovies">
        <br>
        <h3 style="font-weight: bold;"><i class="fa fa-film" aria-hidden="true"></i>Similar Movies</h3>
        <br>
        <hr>
        <br>
        <div class="suggestions">
        <?php 
        $i=0;
        foreach($simres['results'] as $s)
        {
          if($i==5){
            break;
          }
        
        ?>

          <div class="similarposters">
            <img src=<?php echo('"https://image.tmdb.org/t/p/w500'. $s['poster_path'].'"') ?>  alt="poster" srcset="">
            <div class="caption"> <?php echo($s['title']);?>

              <span><?php echo($s['vote_average']);?></span>
            </div>

          </div>

          <?php
        $i++;
      }
          
          ?>



        </div>

      </div>
    </div>
  </div>
</body>
<footer>Made by Harshit Laxkar aka Lord Duck</footer>

</html>