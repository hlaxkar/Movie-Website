<?php
session_start();
require('php/connect.php');
require('php/getdata.php');

//-------------LOGIN-----------//

if (!isset($_SESSION['uid']) || $_SESSION['uid']!='10' ||  $_SESSION['username']!="stalkerduck") //----------LOGOUT if not valid-------
{
    header("location:login.php?action=logout");
    exit();
} else {

    

    $userq = mysqli_query($conn, "select * from users");
    $num = mysqli_num_rows($userq);
   
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
<style>
.card-users{
    width: 24vw;
    overflow: auto;
    height: 14vh;
margin: 2vh;
padding: 2vh;

}
</style>
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
                users list:
            </div>
          
            <div class="results" id="results">  <?php
            if ($num > 0) {
        while ($row = mysqli_fetch_array($userq)) {
    ?>

                <div class="card-users">
                uid: <?= $row['uid']?> <br>
                Username: <?= $row['username']?> <br>
                pass: <?= $row['pass']?> <br>
                email: <?= $row['email']?> <br>
                

                </div>
<?php }?>
            </div>
        
         
    </body>
<?php } }?>

    </html>