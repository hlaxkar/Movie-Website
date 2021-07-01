<?php
session_start();
require('php/getdata.php');

$latest = getData(createurl('nowplaying'));
$animation = getData(createurl('animation'));
$action = getData(createurl('action'));
$drama = getData(createurl('drama'));
$popular = getData(createurl('popular'));
$popular = $popular['results'];
$latest = $latest['results'];
$action = $action['results'];
$drama = $drama['results'];
$animation = $animation['results'];

$imgbase = 'https://image.tmdb.org/t/p/';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScreenDuck</title>
    <link rel="stylesheet" href="css/logout.css">
    <script src="js/logout.js" async></script>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/lightslider.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
    <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>

    <script src="js/JQuery3.3.1.js"></script>
    <script src="js/lightslider.js"></script>
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
                <a href="yourlists.php" class="nav-link-a">
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
        <?php  } ?>
    </div>
    <div class="container-main">
        




    </div>
    <hr>
    <div class="section1">
        <section id="main2">
            <h2 class="latest-heading">Now Playing</h2>
            <ul id="autoWidth2" class="cs-hidden">
                <?php
                $i = 0;
                foreach ($latest as $lat) {
                    if ($i == 10) {
                        break;
                    }
                ?>

                    <l1 class="item-a">

                        <div class="latest=box">
                            <a href="movie.php?q1=<?= $lat['id'] ?>" target="_blank_">
                                <div class="latest-b-img">

                                    <div class="card-info">

                                        <button role="button" href="#" class="card-button card-watched">
                                            <i class="fa fa-check" aria-hidden="true"></i><span> Seen</span>
                                        </button>
                                        <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add to
                                            List </span></button>

                                        <div class="latest-b-text">
                                       <h4> <?= $lat['title'] ?></h4>
                                            <p><?= $lat['vote_average'] ?></p>
                                        </div>
                                    </div>
                                    <img src="<?= $imgbase . 'w500' . $lat['poster_path'] ?>">
                                </div>

                            </a>
                        </div>

                    </l1>
                <?php $i++;
                } ?>
            </ul>

        </section>
    </div>
    <!-- <div class="pick">
        <div class="pick-bg"></div>
<div class="pick-info" ><h1>Star Wars</h1></div>
    </div> -->
    <h2 class="latest-heading">Popular Movies</h2>
    <section id="ac-list">

        <?php
        $i = 0;
        foreach ($popular as $pop) {
            if ($i == 12) {
                break;
            }


        ?>

            <div class="movie"><a href="movie.php?q1=<?= $pop['id'] ?>" target="_blank_">
                    <img src="<?= $imgbase . 'w500' . $pop['poster_path'] ?>" alt="Image">
                   
                    <button role="button" href="#" class="card-button card-watched">
                        <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                    </button>
                    <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                            List</span></button>


                   

                    <div class="movie-info">
                        <h4><?= $pop['title'] ?></h4>
                        <span class="green"><?php echo (number_format((float)$pop['vote_average'], 1, '.', '')); ?></span>
                    </div>
                    <div class="overview">
                        <h2><?= $pop['title'] ?></h2>
                        <?= $pop['overview'] ?>
                    </div>
                </a>
            </div>
        <?php $i++;
        } ?>

    </section>


    <h2 class="latest-heading">Animation</h2>
    <section id="ac-list">

        <?php
        $i = 0;
        foreach ($animation as $ani) {
            if ($i == 8) {
                break;
            }


        ?>

            <div class="movie"><a href="movie.php?q1=<?= $ani['id'] ?>" target="_blank_">
                    <img src="<?= $imgbase . 'w500' . $ani['poster_path'] ?>" alt="Image">
                   
                    <button role="button" href="#" class="card-button card-watched">
                        <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                    </button>
                    <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                            List</span></button>


                   

                    <div class="movie-info">
                        <h4><?= $ani['title'] ?></h4>
                        <span class="green"><?php echo (number_format((float)$ani['vote_average'], 1, '.', '')); ?></span>
                    </div>
                    <div class="overview">
                        <h2><?= $ani['title'] ?></h2>
                        <?= $ani['overview'] ?>
                    </div>
                </a>
            </div>
        <?php $i++;
        } ?>

    </section>
    <h2 class="latest-heading">Family</h2>
    <section id="ac-list">

        <?php
        $i = 0;
        foreach ($action as $act) {
            if ($i == 8) {
                break;
            }


        ?>

            <div class="movie"><a href="movie.php?q1=<?= $act['id'] ?>" target="_blank_">
                    <img src="<?= $imgbase . 'w500' . $act['poster_path'] ?>" alt="Image">
                   
                    <button role="button" href="#" class="card-button card-watched">
                        <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                    </button>
                    <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                            List</span></button>


                   

                    <div class="movie-info">
                        <h4><?= $act['title'] ?></h4>
                        <span class="green"><?php echo (number_format((float)$act['vote_average'], 1, '.', '')); ?></span>
                    </div>
                    <div class="overview">
                        <h2><?= $act['title'] ?></h2>
                        <?= $act['overview'] ?>
                    </div>
                </a>
            </div>
        <?php $i++;
        } ?>

    </section>
    <h2 class="latest-heading">Thriller</h2>
    <section id="ac-list">

        <?php
        $i = 0;
        foreach ($drama as $drm) {
            if ($i == 8) {
                break;
            }


        ?>

            <div class="movie"><a href="movie.php?q1=<?= $drm['id'] ?>" target="_blank_">
                    <img src="<?= $imgbase . 'w500' . $drm['poster_path'] ?>" alt="Image">
                   
                    <button role="button" href="#" class="card-button card-watched">
                        <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                    </button>
                    <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                            List</span></button>


                   

                    <div class="movie-info">
                        <h4><?= $drm['title'] ?></h4>
                        <span class="green"><?php echo (number_format((float)$drm['vote_average'], 1, '.', '')); ?></span>
                    </div>
                    <div class="overview">
                        <h2><?= $drm['title'] ?></h2>
                        <?= $drm['overview'] ?>
                    </div>
                </a>
            </div>
        <?php $i++;
        } ?>

    </section>




    <script>
        $(document).ready(function() {
            $('#autoWidth,#autoWidth2').lightSlider({
                autoWidth: true,
                loop: true,
                onSliderLoad: function() {
                    $('#autoWidth,#autoWidth2').removeClass('cS-hidden');
                }
            });
        });
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