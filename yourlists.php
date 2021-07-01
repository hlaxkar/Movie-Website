<?php
session_start();
require('php/connect.php');
require('php/getdata.php');

//-------------LOGIN-----------//

if (!isset($_SESSION['uid']) /* &&  $_SESSION['uid']==""*/) //----------LOGOUT if not valid-------
{
    header("location:login.php");
    exit();
} else {


    $userq = mysqli_query($conn, "select * from users where uid = '" . $_SESSION['uid'] . "' ");


    $user = mysqli_fetch_array($userq);
    $userwatch = explode(",", $user['watched']);
    array_shift($userwatch);
    $userwatch = array_unique($userwatch);
    $usertowatch = explode(",", $user['towatch']);
    array_shift($usertowatch);
    $usertowatch = array_unique($usertowatch);

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Lists</title>
        <link rel="stylesheet" href="css/bootstrap-grid.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/search.css">
        <link rel="stylesheet" href="css/yourlists.css">
    </head>

    <body>
        <div class="nav-header">
            <a href="index.php">
                <div class="nav-logo"></div>
            </a>
            <div class="nav-links">
                <div class="nav-link-div">
                    <a href="#" class="nav-link-a">
                        <span class="nav-link-span">
                            TV Shows
                        </span>
                    </a>
                </div>



                <div class="nav-link-div">
                    <a href="#" class="nav-link-a">
                        <span class="nav-link-span">
                            Movies
                        </span>
                    </a>
                </div>



                <div class="nav-link-div">
                    <a href="#" class="nav-link-a">
                        <span class="nav-link-span">
                            Your Lists
                        </span>
                    </a>
                </div>



                <div class="nav-link-div">
                    <a href="#" class="nav-link-a">
                        <span class="nav-link-span">
                            Popular
                        </span>
                    </a>
                </div>

            </div>

            <div class="nav-spacer"></div>

            <div class="nav-login-block">
                <?php if (isset($_SESSION['username'])) {
                ?>
                    <span class="login"><a href="profile.html"><i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['username'] ?></a></span>
                <?php } else { ?>

                    <span class="login"><a href="login.php">Login/Signup</a></span>
                <?php }  ?>
            </div>
            <div class="nav-globalsearch">
                <div class="nav-search">
                    <form action="search.php" method="GET" id="form">
                        <input type="text" name="q1" id="search" class="searchbox fa" placeholder="&#xF002;  What are you looking for?">

                    </form>
                </div>

            </div>
        </div>

        <div class="heading">
            <h1>Your Movie Lists</h1>
        </div>
        <div class="search-container">
            <div class="query" id='query'>
                Movies you have watched:
            </div>
            <div class="filters">
                <select name="genre" id="">
                    <option value="">Action</option>
                    <option value="">Comedy</option>
                    <option value="">Romance</option>
                    <option value="">Sci-fi</option>
                    <option value="">Thriller</option>
                    <option value="">Horror</option>
                    <option value="">Anime</option>

                </select>

            </div>
            <div class="results" id="results">
                <?php
                if (!empty($userwatch)) {

                    foreach ($userwatch as $movie) {
                        $res = getData(createurl('movie', $movie));



                ?>


                        <div class="search-card">
                            <a href="movie.php?q1=<?= $res['id'] ?>">
                                <div class="movie-img">
                                    <img src="<?= $imgbase . 'w500' . $res['poster_path'] ?>" alt="poster" onerror="this.onerror=null;this.src='img/default_poster.jpg';">
                                    <div class="card-rate">

                                        <div class="card-ratings  ">
                                            <img src="img/IMDB.svg" alt="IMDB">
                                            <span>
                                                <b><?= number_format((float)$res['vote_average'], 1, '.', '') ?></b>/10</span>

                                        </div>


                                    </div>
                                    <!-- <button role="button" href="#" class="card-button card-watched">
                                        <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                                    </button>
                                    <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                                            List</span>
                                    </button> -->


                                </div>
                                <span class="card-name">
                                    <?= $res['title'] ?> (<?php if (isset($res['release_date'])) {
                                                                echo (date_format(date_create($res['release_date']), 'Y'));
                                                            } else {
                                                                echo ('NA');
                                                            } ?>)
                                </span>
                            </a>
                        </div>

                    <?php  }
                } else {
                    ?>
                    <div class="heading">
                        <h1>No movies in your watchlist currently</h1>
                    </div>
                <?php  } ?>

            </div>
        
            <div class="query" id='query'>
                Movies you want to watch:
            </div>
            <div class="filters">
                <select name="genre" id="">
                    <option value="">Action</option>
                    <option value="">Comedy</option>
                    <option value="">Romance</option>
                    <option value="">Sci-fi</option>
                    <option value="">Thriller</option>
                    <option value="">Horror</option>
                    <option value="">Anime</option>

                </select>

            </div>
            <div class="results" id="results">
                <?php
                if (!empty($usertowatch)) {

                    foreach ($usertowatch as $movie) {
                        $res = getData(createurl('movie', $movie));



                ?>


                        <div class="search-card">
                            <a href="movie.php?q1=<?= $res['id'] ?>">
                                <div class="movie-img">
                                    <img src="<?= $imgbase . 'w500' . $res['poster_path'] ?>" alt="poster" onerror="this.onerror=null;this.src='img/default_poster.jpg';">
                                    <div class="card-rate">

                                        <div class="card-ratings  ">
                                            <img src="img/IMDB.svg" alt="IMDB">
                                            <span>
                                                <b><?= number_format((float)$res['vote_average'], 1, '.', '') ?></b>/10</span>

                                        </div>


                                    </div>
                                    <!-- <button role="button" href="#" class="card-button card-watched">
                                        <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                                    </button>
                                    <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                                            List</span>
                                    </button> -->


                                </div>
                                <span class="card-name">
                                    <?= $res['title'] ?> (<?php if (isset($res['release_date'])) {
                                                                echo (date_format(date_create($res['release_date']), 'Y'));
                                                            } else {
                                                                echo ('NA');
                                                            } ?>)
                                </span>
                            </a>
                        </div>

                    <?php  }
                } else {
                    ?>
                    <div class="heading">
                        <h1>No movies in your towatch list currently</h1>
                    </div>
                <?php  } ?>

            </div>
        
        
        
        </div>
    </body>
<?php } ?>

    </html>