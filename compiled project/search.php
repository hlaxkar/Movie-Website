<?php
session_start();
require('php/getdata.php');
if (isset($_GET['q1']) && $_GET['q1'] != '') {
    $term = $_GET['q1'];
    $r = getData(createurl('search', $term));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/main.css">

    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/search.css">

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
                <form action="?" method="GET" id="form">
                    <input type="text" name="q1" id="search" class="searchbox fa" placeholder="&#xF002;  What are you looking for?">

                </form>
            </div>

        </div>
    </div>



    <div class="search-container">
        <div class="query" id='query'>
            Movies Found for: &nbsp '<?= $term ?>'
        </div>
        <!-- <div class="filters">
            <select name="genre" id="">
                <option value="">Action</option>
                <option value="">Comedy</option>
                <option value="">Romance</option>
                <option value="">Sci-fi</option>
                <option value="">Thriller</option>
                <option value="">Horror</option>
                <option value="">Anime</option>

            </select>
            <select name="genre" id="">
                <option value="">Action</option>
                <option value="">Comedy</option>
                <option value="">Romance</option>
                <option value="">Sci-fi</option>
                <option value="">Thriller</option>
                <option value="">Horror</option>
                <option value="">Anime</option>

            </select>
            <select name="genre" id="">
                <option value="">Action</option>
                <option value="">Comedy</option>
                <option value="">Romance</option>
                <option value="">Sci-fi</option>
                <option value="">Thriller</option>
                <option value="">Horror</option>
                <option value="">Anime</option>

            </select>
        </div> -->
        <div class="results" id="results">
            <?php foreach ($r['results'] as $res) { ?>
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
                            <button onclick="watched(<?= $res['id'] ?>); event.preventDefault();" role="button" href="#" class="card-button card-watched">
                                <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                            </button>
                            <button onclick="tolist(<?= $res['id'] ?>); event.preventDefault();" role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                                    List</span>
                            </button>


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
            <?php } ?>

        </div>
    </div>

    <script src="js/search-script.js"></script>


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