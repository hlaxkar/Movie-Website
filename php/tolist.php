<?php
session_start();
require('connect.php');


if(isset($_POST['movid']) && !empty($_SESSION['uid']) && $_POST['type']=='tolist'){

mysqli_query($conn,'update users  set towatch = CONCAT(towatch,",'.$_POST['movid'].'") where uid = "'.$_SESSION['uid'].'"');


echo 'Added to your towatch list';

}else{
    echo 'You need to login first';
}
?>