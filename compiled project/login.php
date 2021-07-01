<?php   
session_start();
require("php/connect.php");


if (
  isset($_POST['b1']) && !empty($_POST['q1']) &&  !empty($_POST['q2'])){
  $log = mysqli_query($conn, "select * from users where username = '" . $_POST['q1'] . "' 

                                                            and 

                                                            pass = PASSWORD ('" . $_POST['q2'] . "') ");

  $num = mysqli_num_rows($log);
  if ($num > 0) {

    $row = mysqli_fetch_array($log);

    $_SESSION['uid'] = $row[0];

    $_SESSION['username'] = $row[1];

 header("location:index.php");

    exit();
  } else {

    echo "wrong password";
  }
}

if (isset($_GET['action']) && $_GET['action'] == "logout") {

  session_destroy();
}

?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    
    <link rel="stylesheet" href="css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
   
    <div class="animation-area">
		<ul class="box-area">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
        <div class="icon">
            <ul>
               <li><a href="#"><i class="fab fa-facebook-f"></i><span>Facebook</span></a></li>
               <li><a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
               <li><a href="#"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
               <li><a href="#"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a></li>
               <li><a href="#"><i class="fab fa-github"></i><span>Github</span></a></li>
               <li><a href="#"><i class="fab fa-youtube"></i><span>Youtube</span></a></li>
            </ul>
        </div>
	
    <div class="full-page">
            <div class="navigation-bar">
                <div class="logo">
                    <a href="index.php"><img src="img/logo3.png" alt=""></a>
                </div>
                <nav>
                    <ul id='MenuItems'>
                        <li><a href='#'>Home</a></li>
                        <li><a href='#'>Photos</a></li>
                        <li><a href='#'>Services</a></li>
                        <li><a href='#'>Contact</a></li>
                    </ul>
                </nav>
            </div>
    
            <div class="row">
                    <div class="form-box">
                        <div class="form">
                            <form class="login-form" action="?" method="POST">
                                <center><h1 class="main-heading">Login Form</h1></center>
				                <input type="text"placeholder="user name" name="q1" required="required"/>
				                <input type="password"placeholder="password" name="q2" required="required"/>
				                <button type="submit" name="b1">LOGIN</button>
				                <p class="message">Not Registered? <a href="#">Register</a></p>
				            </form>
                            <form class="register-form" action="php/reg.php" method="POST">
                                <center><h1 class="main-heading">Register Form</h1></center>
				                <input type="text" placeholder="user name" name="username" required="required"/>
				                <input type="text" placeholder="email-id" name="email" required="required"/>
				                <input type="password" placeholder="password" name="upass" required="required"/>
				                <button type="submit" name="b2">REGISTER</button>
				                <p class="message">Already Registered?<a href="#">Login</a>
				                </p>
				            </form>
			             </div>
	                </div>
                </div>
            </div>
    <script src='https://code.jquery.com/jquery-3.2.1.min.js'>
    </script>
    <script>
        $('.message a').click(function(){$('form').animate({height: "toggle",opacity: "toggle"},"slow");});
    </script>
        
    </div>
</body>
</html>
