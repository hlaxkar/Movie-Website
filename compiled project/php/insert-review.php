<?php
session_start();
require('connect.php');



if ( isset( $_POST[ 'revsub' ] ) &&  !empty( $_POST[ 'comment' ] ) ) {

     mysqli_query($conn,'insert into reviews set 
     uid = "'.$_SESSION['uid'].'",
             username = "'.$_SESSION['username'].'",
             movid = "'.$_POST['movid'].'",
            rating = "'.$_POST['q-rating'].'",
            title = "'.$_POST['q-title'].'",
            review = "'.$_POST['comment'].'"');


    $numreg = mysqli_insert_id( $conn );
    if ( $numreg > 0 ) {
			
        header( "location:../movie.php?q1=".$_POST['movid']);
        exit();

    } else {
        echo "eddrror aagaya bhai ";
    }

}



if(isset($_POST['movid']) && !empty($_SESSION['uid']) && $_POST['type']=='watched'){

mysqli_query($conn,'update users  set watched = CONCAT(watched,",'.$_POST['movid'].'") where uid = "'.$_SESSION['uid'].'"');


echo 'Added to your watched list';

}else{
    echo 'You need to login first';
}

