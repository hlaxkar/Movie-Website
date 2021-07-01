<?php
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
    <link rel="stylesheet" href="css/main.css">

    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/63ad159168.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/search.css">


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
            <span class="login"><a href="login.php">Login/Signup</a></span>
        </div>
        <div class="nav-globalsearch">
            <div class="nav-search">
                <form action="?" method="GET" id="form">
                    <input type="text" name="q1" id="search" class="searchbox">

                </form>
            </div>

        </div>
    </div>



    <div class="search-container">
        <div class="query" id='query'>
            Movies Found for: &nbsp '<?= $term?>'
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
<?php foreach($r['results'] as $res){?>
            <div class="search-card">
                <a href="movie.php?q1=<?= $res['id']?>">
                    <div class="movie-img">
                        <img src="<?= $imgbase.'w500'.$res['poster_path'] ?>" alt="poster" onerror="this.onerror=null;this.src='img/default_poster.jpg';">
                        <div class="card-rate">

                            <div class="card-ratings  ">
                                <img src="img/IMDB.svg" alt="IMDB">
                                <span>
                                    <b><?= number_format((float)$res['vote_average'], 1, '.', '')?></b>/10</span>

                            </div>


                        </div>
                        <button role="button" href="#" class="card-button card-watched">
                            <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                        </button>
                        <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus" aria-hidden="true"></i><span> Add to
                                List</span>
                        </button>


                    </div>
                    <span class="card-name">
                        <?=$res['title']?> (<?php if(isset($res['release_date'])){ echo(date_format(date_create($res['release_date']), 'Y'));} else{echo('NA');}?>)
                    </span>
                </a>
            </div>
           <?php } ?>

        </div>
    </div>

    <script src="js/search-script.js"></script>


    <footer>
        footer box
    </footer>
</body>

</html>